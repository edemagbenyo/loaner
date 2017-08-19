$(function () {

    var price = $('#price');
    var payment = $('#payment');
    var balance = $('#balance');

    price.on('keyup',function(){
        balance.val(calculateBalance($(this).val(),payment.val()))
    });

    payment.on('keyup',function(){
       balance.val(calculateBalance(price.val(),$(this).val()));
    });


    function calculateBalance(price, payment){
        var balance = parseFloat(price) - parseFloat(payment);
        return balance;
    }

    $hidden_info = $('#hidden-data');
    $open = $('#open');
    $current = $('#current');
    $.get($hidden_info.data('url'),{info_data:$hidden_info.data('date')},function(data){
        $open.text(data.opening);
        $current.text(data.current);
    })

});