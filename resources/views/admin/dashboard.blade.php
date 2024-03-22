@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card overflow-hidden bg-primary text-white">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold text-white">Visitor Hari Ini</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="fw-semibold mb-3 text-white"></h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <i class="ti ti-user-check" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card overflow-hidden bg-danger text-white">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold text-white">Visitor Hari Ini</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="fw-semibold mb-3 text-white"></h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <i class="ti ti-user-check" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card overflow-hidden bg-success text-white">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold text-white">Jumlah Berita</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="fw-semibold mb-3 text-white"></h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <i class="ti ti-edit" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card overflow-hidden bg-warning text-white">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold text-white">Jumlah Produk UMKM</h5>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h4 class="fw-semibold mb-3 text-white"></h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-center">
                                <i class="ti ti-building-store" style="font-size: 2rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
