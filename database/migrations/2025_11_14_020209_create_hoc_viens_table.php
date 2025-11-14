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
        Schema::create('hoc_viens', function (Blueprint $table) {
            $table->string("MSSV")->primary(); // Khóa chính
            $table->string("ho"); // Họ
            $table->string("ten"); // Tên
            $table->date("ngaysinh"); // Ngày sinh
            $table->enum("gioitinh", ['Nam', 'Nữ']); // Giới tính
            $table->string("Avatar")->nullable(); // Đường dẫn ảnh đại diện
            $table->string("MA_LH"); // Khóa ngoại liên kết với bảng lophocs
            $table->foreign("MA_LH")->references("MA_LH")->on("lop_hocs")->onDelete("cascade"); // Khóa ngoại
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoc_viens');
    }
};
