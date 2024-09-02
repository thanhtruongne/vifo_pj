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
        Schema::create('profile', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('code', 150)->unique();
            $table->bigInteger('user_id')->unique()->index();
            $table->string('firstname')->comment('Tên người dùng');
            $table->string('lastname')->comment('Họ người dùng');
            $table->dateTime('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('identity_card')->nullable()->comment('Số CMND');
            $table->dateTime('date_range')->nullable()->comment('Ngày cấp');
            $table->string('issued_by')->nullable()->comment('Nơi cấp');
            $table->integer('gender')->default(1)->comment('1:Nam, 0:Nữ');
            $table->string('phone', 50)->nullable();
            $table->integer('status')->default(1)->comment('0: Nghỉ việc, 1: Đang làm, 2, 3: Nghỉ hưu');
            $table->string('avatar',255)->nullable();
            $table->string('id_code', 150)->index()->nullable()->comment('Mã định danh');
            $table->string('referer', 150)->index()->nullable()->comment('Mã người giới thiệu');
            $table->integer('role')->nullable();
            $table->tinyInteger('marriage')->nullable()->comment('tình trạng hôn nhân --> 1: độc thận , 2:đã kết hôn');
            $table->bigInteger('created_by')->nullable()->index();
            $table->bigInteger('updated_by')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
