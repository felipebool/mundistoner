/**
 * Login DONE
*/
$('.login-form').submit(function(e) {
    var formError = $('.login-error');
    var credentials = {};
    $(this).serializeArray().map(function(x) {
        credentials[x.name] = x.value;
    });

    $.ajax({
        url: 'http://api.fmlopes.com.br/v1/login',
        type: 'POST',
        dataType: 'json',
        data: credentials,
        success: function(data, status) {
            // by not setting expire date, the cookie will be
            // invalidate as soon as the session ends
            docCookies.setItem('customerKey', data.customerKey);
            window.location = "http://mundistoner.fmlopes.com.br/order.html";
        },
        error: function(xhr, desc, err) {
            var errorMessage = JSON.parse(xhr.responseText).errors.message;
            formError.html(errorMessage);
            console.log(desc);
            console.log(err);
        }
    });

    console.log(JSON.stringify(credentials));
    e.preventDefault();
});


/**
 * Order
*/
$('.order-form').submit(function(e) {
    e.preventDefault();
    var orderData = {};
    $(this).serializeArray().map(function(x) {
        orderData[x.name] = x.value;
    });

    // Price in cents
    var price = parseFloat(
        orderData['AmountInCents'].replace(',', '.')
    );
    orderData['AmountInCents'] = price * 100;

    $.ajax({
        url: 'http://api.fmlopes.com.br/v1/checkout',
        type: 'POST',
        dataType: 'json',
        data: orderData,
        success: function(data, status) {
            window.location = "http://mundistoner.fmlopes.com.br/success.html";
        },
        error: function(xhr, desc, err) {
            console.log(orderData);
        }
    });

});

