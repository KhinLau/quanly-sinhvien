@extends('partials.layout')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách tất cả sinh viên</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>MSSV</th>
                            <th>Họ</th>
                            <th>Tên</th>
                            <th>Giới Tính</th>
                            <th>Ngày Sinh</th>
                            <th>Mã Lớp</th>
                            <th>Sửa</th>
                            <th>Xoá</th>
                            <th>Xem Thêm</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($hocvien as $hv)
                            <tr>
                                <td>{{ $hv->MSSV }}</td>
                                <td>{{ $hv->ho }}</td>
                                <td>{{ $hv->ten }}</td>
                                <td>{{ $hv->ngaysinh }}</td>
                                <td>{{ $hv->gioitinh }}</td>
                                <td>{{ $hv->MA_LH }}</td>
                                <td><a class="btn btn-success" href="{{ route('hocvien.edit', $hv->MSSV) }}">Sửa</a>
                                </td>
                                <td>
                                    <form action="{{ route('hocvien.destroy', $hv->MSSV) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                </td>
                                <td><a class="btn btn-success" href="{{ route('hocvien.show', $hv->MSSV) }}">Xem
                                        thêm</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" align="center">Chưa có học viên nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('libs/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush
@push('scripts')
    <!-- Page level plugins -->
    {{-- <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script> --}}
    <script src="{{ asset('libs/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('libs/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('libs/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('libs/js/demo/chart-pie-demo.js') }}"></script>
@endpush
