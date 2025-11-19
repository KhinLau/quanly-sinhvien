@extends('partials.layout')

@section('content')
    <div class="card">
        <div class="card-header bg-secondary text-white text-center">
            <h3>Sửa thông tin Lớp</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('lophoc.update',['lophoc' => $lophoc->MA_LH]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="categoryName">Mã Lớp: </label>
                    <input type="text" class="form-control" name="MA_LH" value="{{ $lophoc->MA_LH }}" readonly>
                </div>
                <div class="form-group">
                    <label for="categoryName">Tên Lớp: </label>
                    <input type="text" class="form-control" name="ten_lop" value="{{ $lophoc->ten_lop }}">
                </div>
                <div class="form-group">
                    <label for="categoryName">Ghi Chú </label>
                    <input type="text" class="form-control" name="ghichu" value="{{ $lophoc->ghichu }}">
                </div>
                <div class="form-group">
                    <input class="btn btn-sm btn-success" type="submit" name="add" value="Save">
                    <a href="{{ route('lophoc.index') }}" class="btn btn-sm btn-primary">Previous</a>
                </div>
            </form>
        </div>
    </div>
@endsection
