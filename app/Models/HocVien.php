<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HocVien extends Model
{
    protected $table = 'hoc_viens'; // Tên bảng

    protected $primaryKey = 'MSSV'; // Khóa chính
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'MSSV' => 'string',
        'MA_LH' => 'string'
    ];

    protected $fillable = ['MSSV', 'ho', 'ten', 'ngaysinh', 'gioitinh', 'Avatar', 'MA_LH'];
    // Các trường có thể được gán hàng loạt

    public function classroom()
    {
        return $this->belongsTo(LopHoc::class, 'MA_LH'); // Mối quan hệ nhiều-một với bảng Classroom
    }
}
