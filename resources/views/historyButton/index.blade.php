@extends("layouts.main")

@section("content")
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold mb-4"><span class="text-muted fw-light">Histori /</span> Histori Button</h4>
        <!-- Column Search -->
        <div class="card">
            <div class="card-datatable table-responsive text-nowrap">
                <table class="dt-column-search table table-bordered">
                    <thead>
                    <tr>
                        <th>GUID</th>
                        <th>Nama Blok</th>
                        <th>Nomor Rumah</th>
                        <th>State</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Column Search -->
    </div>
@endsection
@push("my-scripts")
    <script src="{{asset('javascripts/historyButton/global.js')}}"></script>
@endpush