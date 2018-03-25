/**
 * Created by Edem on 8/16/2017.
 */
$(function () {
//This refused to work because is ommitted the dollar sign in front of the (function(){})


    //Calculate the square
    $square = 0;
    $width = $('#width');
    $height = $('#height');
    $size = $('#size');
    $mesure = $('.measure');
    $unit = $('.unit');

    $('#width,#height ').keyup(function (e) {
        sq = calculateSquare($width.val(), $height.val());
        $size.val(sq);
        $unit.text($mesure.val());
    });

    $('.measure').on('change', function (e) {
        sq = calculateSquare($width.val(), $height.val());
        $size.val(sq);

        $unit.text($mesure.val());
    });


    function calculateSquare(width, height) {
        return width * height;
    }

    //End of square calculation

    //Make calls

    //Populate the name and the contact field of the user
    $('.client_id').on('change',function(){
        $this = $(this);
        if($this.val()){
            $('#name').attr('readonly',true);
            $('#contact').attr('readonly',true);
        }else{
            $('#name').attr('readonly',false);
            $('#contact').attr('readonly',false);
        }
        $.get($this.data('url'),{id:$this.val()},function(data){
            $('#name').val(data.name);
            $('#contact').val(data.contact);
        })
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });

    //Get the post url
    myForm = $('#callForm');
    url = myForm.attr('action');

    $('.save-call').on('click', function (e) {
        if($('#name').val() === '' || $('#contact').val() === ''){
            alert('Name and Contact cannot be empty');
            return;
        }
        $.post(url, {
            name:$('#name').val(),
            enquiry:$('#enquiry').val(),
            action:$('#action').val(),
            result:$('#result').val(),
            contact:$('#contact').val(),
            call_date_time:$('.call-date').val(),
            client_id:$('.client_id').val(),
        }, function (data) {
            $('#result').after('<p class="alert alert-success"> Your call has been recorded successfully</p>');
            $("input[type=text], textarea").val("");
        });
        e.preventDefault()
    });



    //Calculate closing balance for cashbook
    $transact = $('#transact');
    $open = $('#open').val();
    $close= $('#close');
    $transact.on('change',function(){
        balance = closingBalance($(this).val(),$('#amount').val())
        $close.val(balance);
    });

    $('#asmount').on('keyup',function(){
        balance = closingBalance($transact.val(),$(this).val())
        $close.val(balance);
    });

    function closingBalance($transact, $amount){

        if($transact == 'c'){
            balance =  parseFloat($open) + parseFloat($amount);
        }else if($transact == 'd'){
            balance =  parseFloat($open) - parseFloat($amount);
        }
        return balance;
    }

});
