@extends('layouts.app')

@section('title', 'Unit')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-dark">Data @yield('title')</h4>
                            <div class="ml-auto">
                                <button class="btn btn-success" onclick="getModal('createModal')"><i class="fas fa-plus mr-2"></i>Tambah</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="unitTable">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="5%">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col" width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('admin.unit.create')
@include('admin.unit.edit')
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            datatableCall('unitTable', '{{ route('admin.unit.index') }}', [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nama', name: 'nama' },
                { data: 'aksi', name: 'aksi' },
            ]);

            $("#saveData").submit(function (e) {
                e.preventDefault();
                const url = "{{ route('admin.unit.store') }}";
                const data = new FormData(this);

                const successCallback = function (response) {
                    handleSuccess(response, "unitTable", "createModal");
                };

                const errorCallback = function (error) {
                    handleValidationErrors(error, "saveData", ["nama"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });

            $("#updateData").submit(function (e) {
                e.preventDefault();
                const kode = $("#updateData #id").val();
                const url = `/admin/unit/${kode}`;
                const data = new FormData(this);

                const successCallback = function (response) {
                    handleSuccess(response, "unitTable", "editModal");
                };

                const errorCallback = function (error) {
                    handleValidationErrors(error, "updateData", ["nama"]);
                };

                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
        });
    </script>
@endpush