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
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('contact',255);
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->string('email')->nullable();
            $table->string('organization')->nullable();
            $table->string('residence')->nullable();
            $table->string('house')->nullable();
            $table->integer('user_id');
            $table->softDeletes();
            $table->timestamps();
        });

        /*
         * Create suppliers table
         */
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('contact',255);
            $table->string('address',255);
            $table->string('location',255);
            $table->string('email')->nullable();
            $table->string('organization')->nullable();
            $table->string('residence')->nullable();
            $table->string('house')->nullable();
            $table->integer('user_id');
            $table->softDeletes();
            $table->timestamps();
        });


        /*
         * Create lands table
         */
        Schema::create('lands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->decimal('price',20,2);
            $table->string('location',255);
            $table->date('date_purchased');
            $table->enum('measure',['sqt','sqm']);
            $table->decimal('size',20,2);
            $table->text('description')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->enum('currency', ['g', 'u', 'e']);
            $table->integer('user_id');
            $table->softDeletes();
            $table->timestamps();
        });

        /*
         * Create lands table
         */
        Schema::create('calls', function (Blueprint $table) {
            $table->increments('id');
            $table->text('enquiry')->nullable();
            $table->text('action')->nullable();
            $table->text('result')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('name',255)->nullable();
            $table->string('contact')->nullable();
            $table->timestamp('call_date_time')->nullable();
            $table->enum('status',[1,2,3,4,5])->nullable();
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
        Schema::dropIfExists('clients');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('lands');
        Schema::dropIfExists('calls');
    }
}
