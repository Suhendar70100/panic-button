@extends("layouts.main")

@section("content")
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Keadaan Darurat /</span> Laporan</h4>
    <!-- Column Search -->
    <div class="card">
        <div class="d-flex justify-content-between me-3 align-items-center">
            <h5 class="card-header">Daftar Laporan Keadaan Darurat</h5>
                <button type="button"
                class="btn btn-danger" id="buttonAdd"><i class="mdi mdi-plus"></i>Tambah
                </button>
        </div>
        <div class="card-datatable table-responsive">
            <table class="table table-bordered dataTable">
                <thead>
                <tr>
                    <th>ID LAPORAN</th>
                    <th>Nama</th>
                    <th>lokasi</th>
                    <th>Deskripsi</th>
                    <th>Waktu Laporan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Column Search -->
</div>
@include('emergencyReport.modal')
@endsection
@push("my-scripts")
    <script src="{{asset('javascripts/emergencyReport/global.js')}}"></script>
@endpush

