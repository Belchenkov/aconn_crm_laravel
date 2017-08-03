<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('contractor_id');
            $table->integer('region_id');
            $table->integer('inn')->unique();
            $table->string('phone');
            $table->string('ur_address');
            $table->string('email');
            $table->string('site_company');
            $table->string('contacts');
            $table->string('delivery_address');
            $table->string('what_work_id');
            $table->string('take_amount');
            $table->string('periodicity_id');
            $table->string('contract_exist');
            $table->integer('contract_number');
            $table->string('delivery');
            $table->string('packing_id');
            $table->text('comments');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('contractor_id')->references('id')->on('contractor_status');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('what_work')->references('id')->on('what_work');
            $table->foreign('periodicity_id')->references('id')->on('periodicity');
            $table->foreign('packing_id')->references('id')->on('packing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contractors');
    }
}
