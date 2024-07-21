@extends("layouts.main")

@section("content")
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Pengaturan /</span> Perangkat</h4>
        <!-- Column Search -->
        <div class="card">
            <div class="d-flex justify-content-between me-3 align-items-center">
                <h5 class="card-header">Daftar Perangkat</h5>
                <button type="button"
                class="btn btn-danger" id="buttonAdd"><i class="mdi mdi-plus"></i>Tambah
                </button>
            </div>
            <div class="card-datatable table-responsive">
                <table class="table table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>NO.</th>
                        <th>Kode Perangkat</th>
                        <th>Pemilik Perangkat</th>
                        <th>Nama Perumahan</th>
                        <th>Nama Blok</th>
                        <th>Nomor Rumah</th>
                        <th>Akses</th>
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
    @include('device.modal')
@endsection
@push("my-scripts")
    <script src="{{asset('javascripts/device/global.js')}}"></script>
@endpush
