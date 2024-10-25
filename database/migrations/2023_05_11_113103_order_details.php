<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details',function (Blueprint $table) {
            $table->id('id');
            $table->integer('order_id');
            $table->integer('user_id');
            $table->integer('address_id');
            $table->date('order_date');
            $table->integer('Total_Products')->nullable();
            $table->integer('Total_Price')->nullable();
            $table->string('status')->nullable()->default('pending');
            $table->string('Payment_Method')->nullable();
            $table->string('reason')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        //
    }
};
