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
        Schema::create('saleman_manager', function (Blueprint $table) {
            $table->increments('id');
            $table->string('saleman_code', 50)->index();    
            $table->string('user_code', 50)->index();
            $table->integer('saleman_id');
            $table->integer('user_id');
            $table->integer('type')->default(2)->comment('1: tạo và ủy quyền từ admin , 2: khác');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saleman_manager');
    }
};
