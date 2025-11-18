@extends('partials.layout')

@section('content')

        <!-- DataTales Example -->
        <div class="card">
            <div class="card-header bg-secondary text-white text-center">
                <h3>Thêm Lớp</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('lophoc.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="categoryName">Mã Lớp:</label>
                        <input type="text" class="form-control" name="MA_LH" placeholder="Nhập mã lớp" required>
                        @if ($errors->has('MA_LH'))
                            <span class="text-danger">{{ $errors->first('MA_LH') }}</span> <!-- Hiển thị thông báo lỗi -->
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Tên Lớp:</label>
                        <input type="text" class="form-control" name="ten_lop" placeholder="Nhập tên lớp" required>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Ghi Chú:</label>
                        <input type="text" class="form-control" name="ghichu" placeholder="Nhập ghi chú" required>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-sm btn-success" type="submit" name="add" value="Save">
                        <a href="{{ route('lophoc.index') }}" class="btn btn-sm btn-primary">Previous</a>
                    </div>
                </form>
            </div>
        </div>

   
@endsection

@push('scripts')
    <script src="{{ asset('libs/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('libs/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('libs/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('libs/js/demo/chart-pie-demo.js') }}"></script>
@endpush
