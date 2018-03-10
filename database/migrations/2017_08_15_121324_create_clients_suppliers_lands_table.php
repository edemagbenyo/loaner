<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsSuppliersLandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*
         * Create accounts table
         */
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('accountid')->unique();
            $table->string('accountno');
            $table->double('balance',20,5);
            $table->enum('type',['saving','current','credit','debit','other']);
            $table->double('previous_balance',20,5);
            $table->string('column1')->nullable();
            $table->string('column2')->nullable();
            $table->string('column3')->nullable();
            $table->string('column4')->nullable();
            $table->string('column5')->nullable();

            $table->string('user_id');
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('user_id')->references('userid')->on('users')->onDelete('NO ACTION');
            
        });
        
        
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clientid')->unique();
            $table->string('account_id');
            $table->string('lname',255);
            $table->string('fname',255);
            $table->string('telephone1',255);
            $table->string('telephone2',255)->nullable();
            $table->string('paddress');
            $table->string('raddress');
            $table->string('pob')->nullable();
            $table->date('dob')->nullable();
            $table->enum('sex',['m','f','o']);
            $table->enum('marital',['m','s','d','w','o']);
            $table->string('profession')->nullable();
            $table->string('spousename')->nullable();
            $table->string('spousetel')->nullable();
            $table->string('column1')->nullable();
            $table->string('column2')->nullable();
            $table->string('column3')->nullable();
            $table->string('column4')->nullable();
            $table->string('column5')->nullable();
            
            $table->string('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('userid')->on('users')->onDelete('NO ACTION');
            $table->foreign('account_id')->references('accountid')->on('accounts')->onDelete('NO ACTION');
        });
        
        /*
         * Create nextofkins table
         */
        Schema::create('nextofkins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nextofkin')->unique();
            $table->string('client_id',255);
            $table->string('name',255);
            $table->string('telephone1',255);
            $table->string('telephone2',255)->nullable();
            $table->string('address',255);
            $table->string('relationship',255);
            $table->string('column1')->nullable();
            $table->string('column2')->nullable();
            $table->string('column3')->nullable();
            $table->string('column4')->nullable();
            $table->string('column5')->nullable();

            $table->string('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('userid')->on('users')->onDelete('NO ACTION');
            $table->foreign('client_id')->references('clientid')->on('clients')->onDelete('NO ACTION');
        });
        
        
        /*
        * Create transactions
        */
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transactionid')->unique();
            $table->string('client_id');
            $table->string('account_id');
            $table->double('amount',20,5);
            $table->double('balance',20,5);
            $table->double('previous_balance',20,5);
            $table->enum('type',['deposit','withdrawal','other','lcredit','ldebit']);
            $table->string('typedetails');
            $table->text('details');
            $table->string('column1')->nullable();
            $table->string('column2')->nullable();
            $table->string('column3')->nullable();
            $table->string('column4')->nullable();
            $table->string('column5')->nullable();
            
            $table->string('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('userid')->on('users')->onDelete('NO ACTION');
            $table->foreign('client_id')->references('clientid')->on('clients')->onDelete('NO ACTION');
            $table->foreign('account_id')->references('accountid')->on('accounts')->onDelete('NO ACTION');
        });
        
        /*
        * Create applications table
        */
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('applicationid')->unique();
            $table->string('client_id');
            $table->string('account_id');
            $table->string('telephone');
            $table->decimal('amount',20,2);
            $table->string('amountstring');
            $table->text('purpose');
            $table->enum('repaymentperiod',['5years','4years','3years','2years','1year','6months','3months','1month','others']);
            $table->string('repaymentperiod2');
            $table->enum('status',['submitted','pending','approved','denied']);
            $table->string('column1')->nullable();
            $table->string('column2')->nullable();
            $table->string('column3')->nullable();
            $table->string('column4')->nullable();
            $table->string('column5')->nullable();
            
            $table->string('user_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('userid')->on('users')->onDelete('NO ACTION');
            $table->foreign('client_id')->references('clientid')->on('clients')->onDelete('NO ACTION');
            $table->foreign('account_id')->references('accountid')->on('accounts')->onDelete('NO ACTION');
        });
        
        /*
         * Create lands table
         */
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('loanid')->unique();
            $table->string('client_id');
            $table->string('account_id');
            $table->string('application_id');
            $table->decimal('interestrate',2,2);
            $table->decimal('granted',20,2);
            $table->decimal('loaned',20,2);
            $table->decimal('principal',20,2);
            $table->decimal('interest',20,2);
            $table->decimal('total',20,2);
            $table->string('amountstring');
            $table->enum('status',['oncourse','pending','paid','cancelled']);
            $table->string('column1')->nullable();
            $table->string('column2')->nullable();
            $table->string('column3')->nullable();
            $table->string('column4')->nullable();
            $table->string('column5')->nullable();
            
            $table->string('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('userid')->on('users')->onDelete('NO ACTION');
            $table->foreign('client_id')->references('clientid')->on('clients')->onDelete('NO ACTION');
            $table->foreign('account_id')->references('accountid')->on('accounts')->onDelete('NO ACTION');
            $table->foreign('application_id')->references('applicationid')->on('applications')->onDelete('NO ACTION');
        });
        /*
        * Create lands table
        */
        Schema::create('guarantors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('guarantorid')->unique();
            $table->string('application_id');
            $table->decimal('amount',20,2);
            $table->date('date');
            $table->string('column1')->nullable();
            $table->string('column2')->nullable();
            $table->string('column3')->nullable();
            $table->string('column4')->nullable();
            $table->string('column5')->nullable();
            
            $table->string('user_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('userid')->on('users')->onDelete('NO ACTION');
            $table->foreign('application_id')->references('applicationid')->on('applications')->onDelete('NO ACTION');
        });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['account_id']);
        });
        Schema::table('nextofkins', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['client_id']);
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['client_id']);
            $table->dropForeign(['account_id']);
        });
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['client_id']);
            $table->dropForeign(['account_id']);
        });
        Schema::table('loans', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['client_id']);
            $table->dropForeign(['account_id']);
            $table->dropForeign(['application_id']);
        });
        Schema::table('guarantors', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['application_id']);
        });




        Schema::dropIfExists('accounts');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('nextofkins');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('applications');
        Schema::dropIfExists('loans');
        Schema::dropIfExists('guarantors');


    }
}
