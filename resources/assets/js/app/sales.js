$(function () {

    var converter = require('number-to-words');
    //variables
    $alert = $('.alert');
    $hidden_info = $('#hidden-data');
    $repaymentperiod = $('#repaymentperiod');
    $amount = $('#amount');
    $totalpay = $('#totalpay');
    $monthlypay = $('#monthlypay');
    $purpose = $('#purpose');
    $client = $('#client_set');
    $savings_balance = $('#savings_balance');
    $accno = $('#accno');
    $amountinwords = $('#amountinwords');
    
    //On fresh reload
    validate();
    
    
    //If we come from validation error
    calculateRepayment($repaymentperiod.val(), $amount.val());
    
    
    //
    $purpose.on('keyup',function(){
        validate();
    });
    //Set the amount in words when amount changes or is not null
    $amount.on('keyup',function(){
        $this= $(this);
        if ($this.val()) {
            $amountinwords.val(converter.toWords($amount.val()) + " Ghana cedis");
        } else {
            $amountinwords.val("Check the amount");
        }
        
        calculateRepayment($repaymentperiod.val(), $this.val());
        
        //Enable submit button if ready
        validate();
    });
    
    
    //Set values and errors based on the selected member
    $client.on('change',function(){
        $this = $(this);
        if($this.val()){
            // console.log($this.val())
            $.get($hidden_info.data('url'), { accountid:$this.val() },function(data){
                
                if(data.loan){
                    $alert.show();
                    $('#error').text("User has unpaid loan in progress")
                }
                console.log(data);
                $savings_balance.val(data.balance);
            })
        }else{
            //Hide the error div
            $alert.hide();
        }
        //Enable submit button if ready
        validate();
    });
    
    
    //calculate of repayment 
    $repaymentperiod.on('change',function(){
        $this= $(this);
        calculateRepayment($this.val(),$amount.val());
        
        //Enable submit button if ready
        validate();
    })
    
    function calculateRepayment(period,amount){
        $interest = parseFloat(amount) * .20;
        console.log($interest);
        $total = (parseFloat(amount) + $interest).toFixed(2);
        $totalpay.val($total);
        if (period == '6months') {
            $monthlypay.val($total / 6);
        }
        else if (period == '1year') {
            $monthlypay.val($total / 12);
        }
    }
    function validate(){
        if ($amount.val() && $client.val() && $purpose.val() && $repaymentperiod.val()){
            $('#submitit').attr('disabled',false);
            
            $amountinwords.val(converter.toWords($amount.val()) + " Ghana cedis");
        } 
    }
    
    
    //Check guarantor
    
    
    
    
    //TRANSACTION Handling
    $members = $('#members');
    $transactions = $('#transactions');
    $acc_balance = $('#acc_balance');
    $loan_balance = $('#loan_balance');
    if(!$members.val()){
        AccountLoanbalance($members.val());
    }else{
        AccountLoanbalance($members.val());
    }
    //ON member change, let's update the account balance and the loan balance
    $members.on('change',function(){
        $this =  $(this);
        // console.log($hidden_info.data('loan-url'));
        AccountLoanbalance($this.val());
        
    });
    $transactions.on('change',function(){

        console.log("Change of transactions");
    });


    function AccountLoanbalance(accountid){
        if (accountid) {
            $.get($hidden_info.data('loan-url'), { accountid: accountid }, function (data) {
                console.log(data)
                $acc_balance.val(data.account_bal);
                if (!data.loan_bal) {
                    $loan_balance.val(0);
                } else {
                    $loan_balance.val(data.loan_bal);
                }
            })
        } else {

        }
    } // End of function

    function checkWithdrawalState(){
        
    }

});