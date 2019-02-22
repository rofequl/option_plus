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
            $table->string('name');
            $table->string('phone');
            $table->string('location')->nullable();
            $table->string('email')->nullable();
            $table->string('details',999)->nullable();
            $table->string('image')->nullable();
            $table->string('point')->nullable();
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
