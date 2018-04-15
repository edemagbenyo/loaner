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
    $js_message = $('.js_message').hide();
    
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
    $members = $('#members'); //Get the member we are editing
    $transactions = $('#transactions'); //Transaction type we are perfoming
    $acc_balance = $('#acc_balance');
    $loan_balance = $('#loan_balance');
    $message = $('.js_message p.js_message_content');
    $submit_transact = $('#submit_transact');
    if(!$members.val()){
        AccountLoanbalance($members.val());
    }else{
        AccountLoanbalance($members.val());
    }

    //ON member change, let's update the account balance and the loan balance
    selected_member = $members.on('change',function(){
    
        $transactions.val(''); //Reset the transaction type when a member is selected.
        $js_message.hide(); //Remove all message
        
        $this =  $(this); //Get an instance of the current element.

        if($this.val()){
            AccountLoanbalance($this.val());
        }else{
            //TODO: work on displaying a message when no member is selected
            console.log("Shelect a member");
        }
    });

    $transactions.on('change',function(){
        $this = $(this);
        if ($this.val() === 'withdrawal'){
             $accountid = selected_member.val();
            checkWithdrawalState($accountid,$amount.val()); //Check state

            $amount.on('keyup', function () {
                $accountid = selected_member.val();
                checkWithdrawalState($accountid, $amount.val());
            });
        } else if ($this.val() === 'deposit'){
            checkDepositState();
        }else if($this.val()==='lcredit'){
            $accountid = selected_member.val();
            checkLoanState($accountid, $amount.val());
            $amount.on('keyup', function () {
                $accountid = selected_member.val();
                checkLoanState($accountid, $amount.val());
            });
        }else if($this.val()=='dcredit'){
            $accountid = selected_member.val();
            checkLoanWithdrawalState($accountid, $amount.val());
            $amount.on('keyup', function () {
                $accountid = selected_member.val();
                checkLoanWithdrawalState($accountid, $amount.val());
            });
        }
       
    });
    


    function AccountLoanbalance(accountid){
        if (accountid) {
            $.get($hidden_info.data('loan-url'), { accountid: accountid }, function (data) {
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

    //Check if the user in in the state of redrawing
    //1.Has enough balance
    //2.Has no outstanding loan
    //3. Member has not been blocked
    function checkWithdrawalState(accountid,amount){
        if (accountid) {
            $.get($hidden_info.data('withdrawstate'), { accountid: accountid,amount:amount }, function (data) {
               
                if(data.status == 'loan_active'){
                    $message.text(data.message);
                    $js_message.show();
                    $submit_transact.attr('disabled', true);
                } else if(data.status == 'balance_insufficient'){
                    $message.text(data.message);
                    $js_message.show();
                    $submit_transact.attr('disabled', true);
                }else if(data.status == 'ok'){
                    $js_message.hide();
                    $submit_transact.attr('disabled', false);
                }
                
                
            })
        } else {

        }
    }

    /**
     * 
     * @param {accountid} accountid 
     * @param {Amount getting} amount 
     */
    function checkLoanWithdrawalState(accountid,amount) {
        if (accountid) {
            $.get($hidden_info.data('loan-url'), { accountid: accountid }, function (data) {
                if (data.loan_bal && data.loan_bal<amount) {
                    $message.text("The amount you are trying to redraw is more than the loan balance!");
                    $js_message.show();
                    $submit_transact.attr('disabled', true);
                } else {
                    $js_message.hide();
                    $submit_transact.attr('disabled', false);
                    // $loan_balance.val(data.loan_bal);
                }
            })
        } else {

        }
    } // End of function



    /**
     * Check deposit state
     */
    function checkDepositState(){
        $js_message.hide();
        $submit_transact.attr('disabled', false);
    }
    /**
     * Check deposit state
     */
    function checkLoanState(accountid,amount){
        $js_message.hide();
        $submit_transact.attr('disabled', false);

        if (accountid) {
            $.get($hidden_info.data('loanstate'), { accountid: accountid, amount: amount }, function (data) {
                if(data.status=='no_loan'){
                   $message.text(data.message);
                   $js_message.show();
               }
            })
        } else {

        }

    }

});