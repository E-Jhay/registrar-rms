<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('ctr_no')->unique();
            $table->string('name');
            $table->string('mobile');
            $table->foreignId('department_id')->constrained();
            $table->foreignId('document_type_id')->constrained();
            $table->foreignId('status_id')->constrained();
            $table->string('or_no');
            $table->dateTime('expiration_time')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
