<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('supplier_id');
            $table->string('company_name');
            $table->string('company_phone');
            $table->string('company_location');
            $table->string('company_email');
            $table->string('company_reg_no');
            $table->string('company_logo');
            $table->string('total_employ');
            $table->string('accountant_name');
            $table->string('accountant_address');
            $table->string('accountant_phone');
            $table->string('bank_name');
            $table->string('bank_address');
            $table->string('account_no');
            $table->string('director_name');
            $table->string('director_dob');
            $table->string('director_address');
            $table->string('Company_id');
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
        Schema::dropIfExists('suppliers');
    }
}
