@extends('partials.layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- Kiểm tra xem có lỗi nào tồn tại không --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- DataTales Example -->
        <div class="card">
            <div class="card-header bg-secondary text-white text-center">
                <h3>Thêm Sinh Viên Mới</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('hocvien.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="mssv">Mã Sinh Viên</label>
                        <input type="text" class="form-control @error('MSSV') is-invalid @enderror" id="mssv"
                            name="MSSV" placeholder="Nhập mã sinh viên" value="{{ old('MSSV') }}" required>
                        @error('MSSV')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="lastname">Họ</label>
                        <input type="text" class="form-control @error('LastName') is-invalid @enderror" id="lastname"
                            name="ho" placeholder="Nhập họ sinh viên" value="{{ old('ho') }}" required>
                        @error('ho')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="firstname">Tên</label>
                        <input type="text" class="form-control @error('FirstName') is-invalid @enderror" id="firstname"
                            name="ten" placeholder="Nhập tên sinh viên" value="{{ old('ten') }}" required>
                        @error('ten')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="birthday">Ngày sinh</label>
                        <input type="date" class="form-control @error('BirthDay') is-invalid @enderror" id="birthday"
                            name="ngaysinh" value="{{ old('ngaysinh') }}" required>
                        @error('ngaysinh')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="gender">Giới tính</label>
                        <select class="form-control @error('gioitinh') is-invalid @enderror" id="gioitinh" name="gioitinh"
                            required>
                            <option value="Nam" {{ old('gioitinh') == 'Nam' ? 'selected' : '' }}>Nam</option>
                            <option value="Nữ" {{ old('gioitinh') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        </select>
                        @error('gioitinh')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Chọn file hình ảnh</label>
                        <input type="file" class="form-control-file" name="Avatar">
                    </div>

                    <div class="form-group">
                        <label for="classroom">Lớp</label>
                        <select class="form-control @error('MA_LH') is-invalid @enderror" name="MA_LH" required>
                            @foreach ($lophoc as $lh)
                                <option value="{{ $lh->MA_LH }}" {{ old('MA_LH') == $lh->MA_LH ? 'selected' : '' }}>
                                    {{ $lh->MA_LH }}
                                </option>
                            @endforeach
                        </select>
                        @error('MA_LH')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input class="btn btn-sm btn-success" type="submit" name="add" value="Lưu">
                        <a href="{{ route('hocvien.index') }}" class="btn btn-sm btn-primary">Trở lại</a>
                    </div>
                </form>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
