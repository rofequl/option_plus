<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('requisition_no')->nullable();
            $table->string('date');
            $table->string('order_no')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('supplier_id');
            $table->string('warehouse_no');
            $table->string('country_no');
            $table->integer('subtotal');
            $table->integer('freight')->nullable();
            $table->integer('total');
            $table->string('remarks',999)->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('purchases');
    }
}
