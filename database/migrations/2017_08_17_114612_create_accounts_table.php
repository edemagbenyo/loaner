<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Sales
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('land_id');
            $table->decimal('dimension', 20, 5);
            $table->decimal('price', 20, 2);
            $table->decimal('payment', 20, 2);
            $table->decimal('balance', 20, 2);
            $table->text('details');
            $table->enum('currency', ['g', 'u', 'e']);
            $table->integer('user_id');
            $table->softDeletes();
            $table->timestamps();
        });

        //Sales
        Schema::create('cashbook', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->nullable();
            $table->decimal('amount', 20, 2);
            $table->decimal('open', 20, 2);
            $table->decimal('close', 20, 2);
            $table->text('details');
            $table->enum('type', ['c', 'd', 'r']);
            $table->enum('currency', ['g', 'u', 'e']);
            $table->integer('user_id');
            $table->softDeletes();
            $table->timestamps();
        });
        //Sales
        Schema::create('client_account', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('land_id');
            $table->decimal('amount', 20, 2);
            $table->text('details');
            $table->enum('type', ['c', 'd']);
            $table->enum('currency', ['g', 'u', 'e']);
            $table->integer('user_id');
            $table->softDeletes();
            $table->timestamps();
        });

        //Sales
        Schema::create('supplier_account', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id');
            $table->integer('land_id');
            $table->decimal('amount', 20, 2);
            $table->text('details');
            $table->enum('type', ['c', 'd']);
            $table->enum('currency', ['g', 'u', 'e']);
            $table->integer('user_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('sales');
        Schema::dropIfExists('cashbook');
        Schema::dropIfExists('client_account');
        Schema::dropIfExists('supplier_account');
    }
}
