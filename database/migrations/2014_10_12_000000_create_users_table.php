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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('auth', 50)->default('manual');
            $table->string('code',30)->index()->nullable();
            $table->string('username', 150)->index()->unique();
            $table->string('password');
            $table->string('firstname', 150);
            $table->string('lastname', 150);
            $table->string('email', 200)->nullable();
            $table->dateTime('last_online')->nullable();
            // $table->string('remember_token')->nullable();
            $table->boolean('re_login')->default(0)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
