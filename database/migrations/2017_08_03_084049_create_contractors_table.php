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
            $table->integer('user_id')->unsigned()->index('user_id');
            $table->string('name');
            $table->integer('assign_manager');
            $table->integer('contractor_status_id')->unsigned()->index('contractor_status_id');
            $table->integer('region_id')->unsigned()->index('region_id');
            $table->integer('inn')->unique();
            $table->string('phone');
            $table->string('ur_address');
            $table->string('email');
            $table->string('site_company');
            $table->string('contacts');
            $table->string('delivery_address');
            $table->integer('what_work_id')->unsigned()->index('what_work_id');
            $table->string('take_amount')->index('take_amount');
            $table->integer('periodicity_id')->unsigned();
            $table->integer('contract_exist');
            $table->integer('contract_number');
            $table->string('delivery');
            $table->integer('packing_id')->unsigned();
            $table->text('comments');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('contractor_status_id')->references('id')->on('contractor_statuses');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('packing_id')->references('id')->on('packings');
            $table->foreign('periodicity_id')->references('id')->on('periodicities');
            $table->foreign('what_work_id')->references('id')->on('what_works');
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
