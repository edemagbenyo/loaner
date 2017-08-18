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

});