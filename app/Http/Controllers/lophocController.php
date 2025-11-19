<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HocVien;
use App\Models\LopHoc;
use App\Rules\NoVietnameseCharacters;


class LopHocController extends Controller
{

    // Hiển thị danh sách lớp học
    public function index()
    {
        $lophocs = LopHoc::withCount('hoc_viens')->get(); // Sử dụng withCount để lấy số lượng sinh viên

        return view('lophoc.index', compact('lophocs'));
    }

    // Hiển thị form tạo lớp học
    public function create()
    {
        return view('lophoc.create');
    }

     // Lưu lớp học mới
    public function store(Request $request)
    {
        
        $request->validate([
            'MA_LH' => ['required', new NoVietnameseCharacters],
            'ten_lop' => 'required|string|max:255',
            'ghichu' => 'nullable|string',
        ]);
        //dd('Xác thực thành công và code tiếp tục chạy!');
        LopHoc::create($request->all()); // Tạo lớp học mới
        return redirect()->route('lophoc.index')->with('success', 'Lớp học đã được tạo thành công.');
    }

    // Hiển thị form sửa lớp học
    public function edit(LopHoc $lophoc)
    {
        return view('lophoc.edit', compact('lophoc'));
    }

    // Cập nhật lớp học
    public function update(Request $request, Lophoc $lophoc)
    {
        $request->validate([
            'ten_lop' => 'required|string|max:255',
            'ghichu' => 'nullable|string',
        ]);

        $lophoc->update($request->all()); // Cập nhật thông tin lớp học
        return redirect()->route('lophoc.index')->with('success', 'Lớp học đã được cập nhật thành công.');
    }

    // Xóa lớp học
    public function destroy(LopHoc $lophoc)
    {
        if ($lophoc->hoc_viens()->count() > 0) {
            // Nếu lớp học có sinh viên, xóa tất cả sinh viên trước
            $lophoc->hoc_viens()->delete();
        }

        $lophoc->delete(); // Xóa lớp học
        return redirect()->route('lophoc.index')->with('success', 'Lớp học đã được xóa thành công.');
    }
    // Hiển thị sinh viên theo class
    public function show($id)
    {
        // Lấy lớp học theo IdClass
        $classroom = LopHoc::findOrFail($id);
        // Lấy sinh viên theo IdClass
        $students = HocVien::where('MA_LH', $classroom->MA_LH)->get();

        return view('lophoc.getStudent', compact('students', 'classroom')); // Truyền danh sách sinh viên và lớp học vào view
    }

}
