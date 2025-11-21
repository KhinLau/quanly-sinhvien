@extends('partials.layout')

@section('content')
    <div class="card">
        <div class="card-header bg-secondary text-white text-center">
            <h3>Cập Nhật Thông Tin Sinh Viên</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('hocvien.update', $hocvien) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="studentId">MSSV</label>
                    <input type="text" class="form-control" name="MSSV" value="{{ $hocvien->MSSV }}" readonly>
                </div>
                <input type="hidden" name="MSSV" value="{{ $hocvien->MSSV }}"> <!-- Keep the MSSV for submission -->

                <div class="form-group">
                    <label for="firstName">Họ</label>
                    <input type="text" class="form-control" name="ho" value="{{ $hocvien->ho }}">
                </div>
                <div class="form-group">
                    <label for="lastName">Tên</label>
                    <input type="text" class="form-control" name="ten" value="{{ $hocvien->ten }}">
                </div>
                <div class="form-group">
                    <label for="birthDate">Ngày Sinh</label>
                    <input type="date" class="form-control" name="ngaysinh" value="{{ $hocvien->ngaysinh }}">
                </div>
                <div class="form-group">
                    <label for="Gender">Giới tính</label>
                    <select name="gioitinh" id="gioitinh" class="form-control">
                        <option value="">Chọn giới tính</option>
                        <option value="Nam" {{ old('gioitinh', $hocvien->gioitinh) == 'Nam' ? 'selected' : '' }}>Nam
                        </option>
                        <option value="Nữ" {{ old('gioitinh', $hocvien->gioitinh) == 'Nữ' ? 'selected' : '' }}>Nữ
                        </option>
                    </select>
                    @if ($errors->has('gioitinh'))
                        <span class="text-danger">{{ $errors->first('gioitinh') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="image">Chọn file hình ảnh</label>
                    <input type="file" class="form-control-file" name="Avatar" value="{{ $hocvien->Avatar }}">
                </div>
                <div class="form-group">
                    <label for="IdClass">Lớp</label>
                    <select name="MA_LH" id="MA_LH" class="form-control">
                        <option value="">Chọn lớp</option>
                        @foreach ($lophoc as $lh)
                            <option value="{{ $lh->MA_LH }}"
                                {{ old('MA_LH', $hocvien->MA_LH) == $lh->MA_LH ? 'selected' : '' }}>
                                {{ $lh->ten_lop }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('MA+LH'))
                        <span class="text-danger">{{ $errors->first('MA_LH') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success"
                        onclick="return confirm('Are you sure you want to update?')">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
