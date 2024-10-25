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
        Schema::create('products_details',function (Blueprint $table) {
            $table->id('prod_id');
            $table->integer('user_id');
            $table->string('prod_image')->nullable();
            $table->string('prod_name')->nullable();
            $table->string('prod_description')->nullable();
            $table->integer('prod_brand_id')->nullable();
            $table->integer('prod_quantity')->nullable();
            $table->integer('prod_price')->nullable();
            $table->integer('prod_category_id')->nullable();
            $table->integer('prod_feature_status')->default('False');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
