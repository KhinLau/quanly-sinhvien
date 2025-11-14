<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LopHoc extends Model
{
    use HasFactory;

    protected $table = 'lop_hocs'; // Tên bảng

    protected $primaryKey = 'MA_LH'; // Khóa chính
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'MA_LH' => 'string',
    ];

    protected $fillable = ['MA_LH', 'ten_lop', 'ghichu']; // Các trường có thể được gán hàng loạt

    public function hocviens()
    {
        return $this->hasMany(HocVien::class, 'MA_LH'); // Mối quan hệ một-nhiều với bảng Student
    }
}
