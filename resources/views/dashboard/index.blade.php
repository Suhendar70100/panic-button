@extends("layouts.main")

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row gy-4 mb-4">
                <!-- Sales Overview-->
                <div class="col-lg-4">
                    <div class="card h-100">
                      <div class="card-header">
                        <div class="d-flex justify-content-between">
                          <h4 class="mb-2">Data Perumahan</h4>
                        </div>
                        <div class="d-flex align-items-center">
                            <small class="me-2">Total keseluruhan perumahan dan blok</small>
                        </div>
                      </div>
                      <div class="card-body d-flex justify-content-between flex-wrap gap-3">
                        <div class="d-flex gap-3">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-danger rounded">
                                    <i class="mdi mdi-city mdi-24px"></i>
                                </div>
                            </div>
                            <div class="card-info">
                                <h4 class="mb-0">{{ $residentialCount }}</h4>
                                <small class="text-muted">Perumahan</small>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-info rounded">
                                    <i class="mdi mdi-format-bold mdi-24px"></i>
                                </div>
                            </div>
                            <div class="card-info">
                                <h4 class="mb-0">{{ $residentialBlockCount }}</h4>
                                <small class="text-muted">Blok Perumahan</small>
                            </div>
                        </div>
                    </div>
                    </div>
                  </div>
                  <!--/ Sales Overview-->
<!-- Total Visits -->
<div class="col-lg-4 col-sm-6">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between flex-wrap gap-2">
          <p class="d-block mb-2 text-muted">Total Perangkat</p>
        </div>
        <h4 class="mb-1">{{ $deviceCount->total_count }}</h4>
      </div>
      <div class="card-body">
        <div class="row mt-3">
          <div class="col-4">
            <div class="d-flex gap-2 align-items-center mb-2">
              <div class="avatar avatar-xs flex-shrink-0">
                <div class="avatar-initial rounded bg-label-warning">
                  <i class="mdi mdi-checkbox-marked mdi-14px"></i>
                </div>
              </div>
              <p class="mb-0 text-muted">Dibebaskan</p>
            </div>
            <h4 class="mb-0 pt-1 text-nowrap">{{ $deviceCount->active_count }}</h4>
          </div>
          <div class="col-4">
            <div class="divider divider-vertical">
              <div class="divider-text">
                <span class="bg-label-white">VS</span>
              </div>
            </div>
          </div>
          <div class="col-4 text-end pe-lg-0 pe-xl-2">
            <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
              <p class="mb-0 text-muted">Dibatasi</p>
              <div class="avatar avatar-xs flex-shrink-0">
                <div class="avatar-initial rounded bg-label-primary">
                  <i class="mdi mdi-close-box mdi-14px"></i>
                </div>
              </div>
            </div>
            <h4 class="mb-0 pt-1 text-nowrap">{{ $deviceCount->inactive_count }}</h4>
          </div>
        </div>
        <div class="d-flex align-items-center mt-2 pt-1">
          <div class="progress w-100 rounded" style="height: 10px">
            <div
              class="progress-bar bg-warning"
              style="width: {{ $deviceActivePercentage }}%"
              role="progressbar"
              aria-valuenow="20"
              aria-valuemin="0"
              aria-valuemax="100"></div>
            <div
              class="progress-bar bg-danger"
              role="progressbar"
              style="width: {{ $deviceInactivePercentage }}%"
              aria-valuenow="80"
              aria-valuemin="0"
              aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Total Visits -->

<!-- Total Visits -->
<div class="col-lg-4 col-sm-6">
    <div class="card">
      <div class="card-header pb-0">
        <div class="d-flex justify-content-between flex-wrap gap-2">
          <p class="d-block mb-2 text-muted">Total User</p>
        </div>
        <h4 class="mb-1">{{ $userCount->total_count }}</h4>
      </div>
      <div class="card-body">
        <div class="row mt-3">
          <div class="col-4">
            <div class="d-flex gap-2 align-items-center mb-2">
              <div class="avatar avatar-xs flex-shrink-0">
                <div class="avatar-initial rounded bg-label-warning">
                  <i class="mdi mdi-account-check mdi-14px"></i>
                </div>
              </div>
              <p class="mb-0 text-muted">Dibebaskan</p>
            </div>
            <h4 class="mb-0 pt-1 text-nowrap">{{ $userCount->active_count }}</h4>
          </div>
          <div class="col-4">
            <div class="divider divider-vertical">
              <div class="divider-text">
                <span class="bg-label-white">VS</span>
              </div>
            </div>
          </div>
          <div class="col-4 text-end pe-lg-0 pe-xl-2">
            <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
              <p class="mb-0 text-muted">Dibatasi</p>
              <div class="avatar avatar-xs flex-shrink-0">
                <div class="avatar-initial rounded bg-label-primary">
                  <i class="mdi mdi-account-remove mdi-14px"></i>
                </div>
              </div>
            </div>
            <h4 class="mb-0 pt-1 text-nowrap">{{ $userCount->inactive_count }}</</h4>
          </div>
        </div>
        <div class="d-flex align-items-center mt-2 pt-1">
          <div class="progress w-100 rounded" style="height: 10px">
            <div
              class="progress-bar bg-warning"
              style="width: {{ $userActivePercentage }}%"
              role="progressbar"
              aria-valuenow="{{ $userCount->active_count }}"
              aria-valuemin="0"
              aria-valuemax="{{ $userCount->total_count }}"></div>
            <div
              class="progress-bar bg-danger"
              role="progressbar"
              style="width: {{ $userInactivePercentage }}%"
              aria-valuenow="{{ $userCount->inactive_count }}"
              aria-valuemin="0"
              aria-valuemax="{{ $userCount->total_count }}"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Total Visits -->
                  <!-- Roles Datatables -->
                  <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                              <h4 class="mb-2">Daftar Keadaan Darurat</h4>
                            </div>
                          </div>
                      <div class="table-responsive rounded-3">
                        <table class="datatables-ecommerce table table-sm">
                          <thead class="table-light">
                            <tr>
                              <th class="py-3">No</th>
                              <th class="py-3">Nama</th>
                              <th class="py-3">Lokasi</th>
                              <th class="py-3">Telepon</th>
                              <th class="py-3">Waktu</th>
                              <th class="py-3">Status</th>
                            </tr>
                          </thead>
                          @foreach ($emergencyState as $item)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $item->device->owner_device }}</td>
                              <td>{{ $item->device->residentialBlock->residential->name }} - {{ $item->device->residentialBlock->name_block }} No {{ $item->device->house_number }}</td>
                              <td>{{ $item->device->phone }}</td>
                              <td>{{ $item->created_at }}</td>
                              <td>{{ $item->status }}</td>
                          </tr>
                          @endforeach
                        </table>
                      </div>
                    </div>
                  </div>
                  <!--/ Roles Datatables -->
    </div>
  </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-statistics.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-analytics.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" type="text/css" />
@endpush

@push('my-scripts')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards-crm.js') }}"></script>
@endpush
