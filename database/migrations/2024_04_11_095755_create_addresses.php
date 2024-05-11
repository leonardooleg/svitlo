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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id()->autoIncrement()->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('name');
            $table->string('ip_address', 45)->nullable();
            $table->string('url_address', 45)->nullable();
            $table->integer('public')->default(0);
            $table->string('link', 45)->nullable();
        });

        Schema::create('pings', function (Blueprint $table) {
            $table->id()->autoIncrement()->primary();
            $table->foreignId('address_id')->index();
            $table->integer('ping')->nullable();
            $table->string('last_activity')->nullable();
            $table->string('last_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('ping');
    }
};
