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
        Schema::create('category_details',function (Blueprint $table) {
            $table->id('cat_id');
            $table->integer('user_id');
            $table->string('cat_name')->nullable();
            $table->string('cat_description')->nullable();
            $table->string('cat_image')->nullable();

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
