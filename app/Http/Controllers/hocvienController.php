<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Giả sử model của bạn là User
use App\Models\LopHoc;
use App\Models\HocVien;
use App\Rules\NoVietnameseCharacters;
use Illuminate\Support\Facades\Storage;

class HocVienController extends Controller
{
    /**
     * Hiển thị danh sách tài nguyên. (GET /users)
     */
    public function index()
    {
        // Trả về danh sách người dùng
         $hocvien = HocVien::with('lop_hoc')->get();
        return view('hocvien.index', compact('hocvien'));
    }

    /**
     * Hiển thị form tạo tài nguyên mới. (GET /users/create)
     */
    public function create()
    {
        $lophoc = LopHoc::all();
        return view('hocvien.create', compact('lophoc'));
    }

    /**
     * Lưu trữ tài nguyên mới được tạo vào bộ nhớ. (POST /users)
     */
    public function store(Request $request)
    {
        //dd('Chạy store!');
        $validatedData = $request->validate([
            'MSSV' =>  ['required', new NoVietnameseCharacters],
            'ho' => 'required|string|max:255',
            'ten' => 'required|string|max:255',
            'ngaysinh' => 'required|date|date_format:Y-m-d|beforeOrEqual:'.now()->subYears(18)->toDateString(),
            'gioitinh' => 'required|in:Nam,Nữ',
            'Avatar' => 'nullable|image|max:2048',
            'MA_LH' => 'required|exists:lop_hocs,MA_LH',
        ]);
        //dd('Xác thực thành công và code tiếp tục chạy!');
        if ($request->hasFile('Avatar')) {
            // Lưu tệp và lấy đường dẫn
            $avatarPath = $request->file('Avatar')->store('avatars', 'public');
            // Gán đường dẫn đúng cho Avatar
            $validatedData['Avatar'] = $avatarPath;
        } else {
            $validatedData['Avatar'] = 'avatars/profile.png'; // Ảnh mặc định
        }

        // Tạo sinh viên mới với dữ liệu đã được validate
        hocvien::create($validatedData);

        return redirect()->route('hocvien.index')->with('success', 'Sinh viên đã được tạo thành công.');
    }

    /**
     * Hiển thị tài nguyên đã chỉ định. (GET /users/{user})
     */
    public function show(User $user)
    {
        return view('hocvien.show', compact('user'));
    }

    /**
     * Hiển thị form chỉnh sửa tài nguyên đã chỉ định. (GET /users/{user}/edit)
     */
    public function edit(HocVien $hocvien)
    {
        $lophoc = LopHoc::all();
        return view('hocvien.edit', compact('hocvien','lophoc'));
    }

    /**
     * Cập nhật tài nguyên đã chỉ định trong bộ nhớ. (PUT/PATCH /users/{user})
     */
    public function update(Request $request, HocVien $hocvien)
    {
        //dd('Chạy store!');
        $validatedData = $request->validate([
            'MSSV' =>  ['required', new NoVietnameseCharacters],
            'ho' => 'required|string|max:255',
            'ten' => 'required|string|max:255',
            'ngaysinh' => 'required|date|date_format:Y-m-d|beforeOrEqual:'.now()->subYears(18)->toDateString(),
            'gioitinh' => 'required|in:Nam,Nữ',
            'Avatar' => 'nullable|image|max:2048',
            'MA_LH' => 'required|exists:lop_hocs,MA_LH',
        ]);
        //dd('Xác thực thành công và code tiếp tục chạy!',$hocvien);
        // Biến để lưu trữ đường dẫn của avatar
        $avatarPath = $hocvien->Avatar;

        if ($request->hasFile('Avatar')) {
            // Xóa avatar cũ nếu tồn tại (tùy chọn)
            if ($hocvien->Avatar) {
                Storage::disk('public')->delete($hocvien->Avatar);
            }

            // Lưu hình đại diện mới
            try {
                $avatarPath = $request->file('Avatar')->store('avatars', 'public');                
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['Avatar' => 'Có lỗi xảy ra khi tải lên hình đại diện: ' . $e->getMessage()]);
            }

        }
        // Cập nhật sinh viên với dữ liệu đã xác thực
        $updateSuccess = $hocvien->update($request->except('Avatar') + ['Avatar' => $avatarPath]);

        // Kiểm tra xem có thay đổi nào không
        if (!$updateSuccess) {
            return redirect()->back()->withErrors(['update' => 'Có lỗi xảy ra khi cập nhật thông tin sinh viên.']);
        }

        return redirect()->route('hocvien.index')->with('success', 'Sinh viên đã được cập nhật thành công.');
    }

    /**
     * Xóa tài nguyên đã chỉ định khỏi bộ nhớ. (DELETE /users/{user})
     */
    public function destroy(User $user)
    {
        // Logic xóa người dùng
    }
}