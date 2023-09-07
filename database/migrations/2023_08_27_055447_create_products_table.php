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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('ten_san_pham');
            $table->integer('gioi_tinh_id')->comment('0: nam, 1: nữ');
            $table->integer('gia');
            $table->string('hinh_anh');
            $table->longText('mo_ta');
            $table->string('danh_muc_id');
            $table->integer('thuong_hieu_id');
            $table->integer('luot_xem')->default(0);
            $table->integer('tinh_trang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
