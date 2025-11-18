<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HocVien;
use App\Models\LopHoc;
use App\Rules\NoVietnameseCharacters;


class LopHocController extends Controller
{
    public function __construct()
    {
        // Áp dụng Middleware 'auth' cho TẤT CẢ phương thức TRỪ index và show.
        $this->middleware('auth')->except(['index', 'show']); 
        
        // HOẶC: Chỉ áp dụng cho store, update, destroy
        // $this->middleware('auth')->only(['store', 'update', 'destroy']);
    }

    // Hiển thị danh sách lớp học
    public function index()
    {
        $lophocs = LopHoc::withCount('hocviens')->get(); // Sử dụng withCount để lấy số lượng sinh viên

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
            'tenlop' => 'required|string|max:255',
            'ghichu' => 'nullable|string',
        ]);

        LopHoc::create($request->all()); // Tạo lớp học mới
        return redirect()->route('lophoc.index')->with('success', 'Lớp học đã được tạo thành công.');
    }

    // Hiển thị form sửa lớp học
    public function edit(LopHoc $classroom)
    {
        return view('lophoc.edit', compact('classroom'));
    }

    // Cập nhật lớp học
    public function update(Request $request, Lophoc $classroom)
    {
        $request->validate([
            'NameClass' => 'required|string|max:255',
            'Note' => 'nullable|string',
        ]);

        $classroom->update($request->all()); // Cập nhật thông tin lớp học
        return redirect()->route('lophoc.index')->with('success', 'Lớp học đã được cập nhật thành công.');
    }

    // Xóa lớp học
    public function destroy(LopHoc $classroom)
    {
        if ($classroom->hoc_viens()->count() > 0) {
            // Nếu lớp học có sinh viên, xóa tất cả sinh viên trước
            $classroom->hoc_viens()->delete();
        }

        $classroom->delete(); // Xóa lớp học
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
