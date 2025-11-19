@extends('partials.layout')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách tất cả lớp</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã Lớp</th>
                            <th>Tên Lớp</th>
                            <th>Ghi chú</th>
                            <th>Số lượng thành viên</th>
                            <th>Sửa</th>
                            <th>Xoá</th>
                            <th>Xem Sinh Viên</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lophocs as $classroom)
                            <tr>
                                <td>{{ $classroom->MA_LH }}</td>
                                <td>{{ $classroom->ten_lop }}</td>
                                <td>{{ $classroom->ghichu }}</td>
                                <td>{{ $classroom->students_count }}</td>
                                <td><a class="btn btn-success" href="{{ route('lophoc.edit', ['lophoc' => $classroom->MA_LH]) }}">Sửa</a> 
                                </td>
                                <td>
                                    <form action="{{ route('lophoc.destroy', $classroom->MA_LH) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                </td>
                                <td><a class="btn btn-success" href="{{ route('lophoc.show', $classroom->MA_LH) }}">Xem
                                        Sinh
                                        Viên</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" align="center">Chưa có lớp nào</td>
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
</body>

</html>
