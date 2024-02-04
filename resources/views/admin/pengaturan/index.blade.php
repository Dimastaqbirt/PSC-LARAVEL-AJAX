@extends('layouts.admin')

@section('title', 'Pengaturan')

@push('style')
    <link rel='stylesheet' href={{ asset('library/leaflet/leaflet.css') }} /> 
    <link rel="stylesheet" href="{{ asset('library/leaflet-search/src/leaflet-search.css') }}" />
    <link rel="stylesheet" href="{{ asset('library/leaflet/geosearch.css') }}" />
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>@yield('title')</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/admin">Dashboard</a></div>
                    <div class="breadcrumb-item">@yield('title')</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-dark">Data @yield('title')</h4>
                            </div>
                            <div class="card-body">
                                <form id="updateData">
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="longitude" class="form-label">Longitude <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $pengaturan->longitude }}">
                                        <small class="invalid-feedback" id="errorlongitude"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="latitude" class="form-label">Latitude <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $pengaturan->latitude }}">
                                        <small class="invalid-feedback" id="errorlatitude"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="radius" class="form-label">Radius <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="radius" name="radius" value="{{ $pengaturan->radius }}">
                                        <small class="invalid-feedback" id="errorradius"></small>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div id="map" class="rounded-lg mx-0" style="height: 450px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('library/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('library/leaflet-search/src/leaflet-search.js') }}"></script>
    <script src="{{ asset('library/leaflet/Control.Geocoder.js') }}"></script>

    <script>
        $(document).ready(function() {
            let map;

            showPositionPengaturan();

            $("#updateData").submit(function (e) {
                setButtonLoadingState("#updateData .btn.btn-success", true);
                e.preventDefault();
                const url = `{{ route('admin.pengaturan')}}`;
                const data = new FormData(this);

                const successCallback = function (response) {
                    setButtonLoadingState("#updateData .btn.btn-success", false);  
                    handleSuccess(response, null, null, "no");
                    clearMap();
                    showPositionPengaturan(); 
                };

                const errorCallback = function (error) {
                    setButtonLoadingState("#updateData .btn.btn-success", false);
                    handleValidationErrors(error, "updateData", ["nama", "longitude", "latitude", "radius"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush