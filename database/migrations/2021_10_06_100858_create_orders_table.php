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
            $table->decimal('cost', 10, 2)->nullable();
            $table->foreignId('department_id')->constrained()->default(1);
            $table->foreignId('document_type_id')->constrained()->default(1);
            $table->foreignId('status_id')->constrained()->default(1);
            $table->string('or_no');
            $table->dateTime('expiration_time')->nullable();
            $table->timestamp('date_received')->nullable();
            $table->timestamp('date_finished')->nullable();
            $table->string('appeals')->nullable();
            $table->string('remarks')->nullable();
            $table->string('claimedBy')->nullable();
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
