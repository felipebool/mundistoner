// sem tem o token no cookie, manda pra order.html

$('.login-form').submit(function(e) {
    var credentials = {};
    $(this).serializeArray().map(function(x) {
        credentials[x.name] = x.value;
    });

    $.ajax({
        url: 'http://mundistoner.localhost:8080/v1/login',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(credentials),
        success: function(data, status) {
            // salva cookie
            // redireciona para order.html
        },
        error: function(xhr, desc, err) {
            // mostra mensagem de erro
        }
    });

    console.log(JSON.stringify(credentials));
    e.preventDefault();
});


$('.order-form').submit(function(e) {
    var orderData = {};
    $(this).serializeArray().map(function(x) {
        orderData[x.name] = x.value;
    });

    $.ajax({
        url: 'http://mundistoner.localhost:8080/v1/checkout',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(orderData),
        success: function(data, status) {
            // salva cookie
            // redireciona para order.html
        },
        error: function(xhr, desc, err) {
            // mostra mensagem de erro
        }
    });

    console.log(JSON.stringify(credentials));
    e.preventDefault();
});


$('.merchant-selector').on('change', function(e) {
    var credentials = {};
    $(this).serializeArray().map(function(x) {
        credentials[x.name] = x.value;
    });

    $.ajax({
        url: 'http://mundistoner.localhost:8080/v1/merchant',
        type: 'GET',
        dataType: 'json',
        data: JSON.stringify(credentials),
        success: function(data, status) {
            // atualiza cookie com o token da loja
        },
        error: function(xhr, desc, err) {
            // mostra mensagem de erro
        }
    });

    console.log(JSON.stringify(credentials));
    e.preventDefault();
});

