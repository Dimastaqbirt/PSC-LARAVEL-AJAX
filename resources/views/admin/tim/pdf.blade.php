@extends('layouts.pdf')

@section('title', 'Kategori')

@push('style')
@endpush

@section('main')
    <div>
        <center>
            <u>
                <h3>Data @yield('title')</h3>
            </u>
        </center>
        <br>
        <table width="100%" border="1" cellpadding="2.5" cellspacing="0">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Nama</th>
                    <th style="">Deskripsi</th>
                    <th width="20%">Anggota</th>
                </tr>
            </thead>
            <tbody valign="top">
                @if ($tims->isEmpty())
                    <tr>
                        <td colspan="4" align="center">Data @yield('title') kosong</td>
                    </tr>
                @else
                    @foreach ($tims as $tim)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $tim->nama }}</td>
                            <td>{{ $tim->deskripsi }}</td>
                            <td style="text-align: center;">{{ $tim->detail_tims_count }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
@endpush
