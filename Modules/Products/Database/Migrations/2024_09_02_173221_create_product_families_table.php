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
        Schema::create('product_families', function (Blueprint $table) {
            $table->id();
            $table->string('code',50)->index()->nullable();
            $table->string('logo')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_vn')->nullable();
            $table->text('desc')->nullable();
            $table->string('slug_en')->nullable();
            $table->string('slug_vn')->nullable();
            $table->text('promotion_text_vn')->nullable();
            $table->text('promotion_text_en')->nullable();
            $table->unsignedBigInteger('catalog_id')->nullable();
            $table->integer('valid_after')->nullable()->comment('Điều hợp lệ'); 
            $table->string('position')->nullable();
            $table->string('product_family_banner')->nullable();
            $table->string('product_family_banner_promotion')->nullable();
            $table->string('order_template_upload')->nullable();
            $table->tinyInteger('has_beneficiary')->default(1)->comment('Người thụ hưởng');
            $table->tinyInteger('is_allow_send_sms')->default(1)->comment('Access gửi tin nhắn');
            $table->tinyInteger('is_disable_reminder')->default(1)->comment('Lời nhắc');
            $table->text('sms_content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_families');
    }
};
