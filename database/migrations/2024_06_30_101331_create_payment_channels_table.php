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
        Schema::create('payment_channels', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32);
            $table->string('name_en', 32)->nullable();
            $table->string('class_name', 32);
            $table->string('url',256)->nullable();
            $table->boolean('is_active')->default(false);
            $table->tinyInteger('priority')->nullable();
            $table->string('supporter_name', 128)->nullable();
            $table->string('supporter_phone', 64)->nullable();
            $table->string('supporter_email', 128)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_channels');
    }
};
