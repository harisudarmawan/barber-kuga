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
        Schema::create('special_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->json('features');
            $table->boolean('is_popular')->default(false);
            $table->integer('sort_order')->default(0);
            $table->string('period')->default('Per Kunjungan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_packages');
    }
};
