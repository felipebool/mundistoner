var customerKey = docCookies.getItem('customerKey');

if (!customerKey) {
    disableForm();
}

getAllMerchants('6a564b2a-d6ba-4c40-be24-a151aa864538');

function getAllMerchants(customerKey) {
    $.ajax({
        url: 'http://api.fmlopes.com.br/v1/'+ customerKey +'/merchant',
        type: 'GET',
        dataType: 'json',
        success: function(data, status) {
            for (var i = 0; i < data.items.length; i++) {
                $('.empty-select').append(
                    '<option value="' +
                    data.items[i].merchantName +
                    '">' +
                    data.items[i].merchantName +
                    '</option>'
                );
            }
        },
        error: function(xhr, desc, err) {
            console.log(err);
        }
    });
}

function disableForm() {
    $(".login-form input").prop("disabled", true);
    $(".login-button").prop("disabled", true);
    $(".not-logged").html(
        'Você precisa estar logado. <a href="index.html">Logar</a>'
    );
}
