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
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->integer('tong_tien');
            $table->string('ten_nguoi_nhan');
            $table->string('dia_chi');
            $table->string('so_dien_thoai');
            $table->integer('hinh_thuc_thanh_toan')->comment('1: thanh toán khi nhân hàng, 2: Chuyển khoản');
            $table->integer('trang_thai')->comment('1: đang xử lý, 2: đang giao, 3: đã giao, 0: đã hủy');
            $table->timestamps();
        });
    }

   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
