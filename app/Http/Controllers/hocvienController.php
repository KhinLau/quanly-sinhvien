<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Giả sử model của bạn là User
use App\Models\LopHoc;
use App\Models\HocVien;

class UserController extends Controller
{
    /**
     * Hiển thị danh sách tài nguyên. (GET /users)
     */
    public function index()
    {
        // Trả về danh sách người dùng
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Hiển thị form tạo tài nguyên mới. (GET /users/create)
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Lưu trữ tài nguyên mới được tạo vào bộ nhớ. (POST /users)
     */
    public function store(Request $request)
    {
        // Logic xác thực và lưu dữ liệu người dùng mới
    }

    /**
     * Hiển thị tài nguyên đã chỉ định. (GET /users/{user})
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Hiển thị form chỉnh sửa tài nguyên đã chỉ định. (GET /users/{user}/edit)
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Cập nhật tài nguyên đã chỉ định trong bộ nhớ. (PUT/PATCH /users/{user})
     */
    public function update(Request $request, User $user)
    {
        // Logic xác thực và cập nhật dữ liệu người dùng
    }

    /**
     * Xóa tài nguyên đã chỉ định khỏi bộ nhớ. (DELETE /users/{user})
     */
    public function destroy(User $user)
    {
        // Logic xóa người dùng
    }
}