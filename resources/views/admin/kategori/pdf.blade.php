@extends('layouts.pdf')

@section('title', 'Kategori')

@push('style')
    <div>
        <table width="100%" border="1" cellpadding="2.5" cellspacing="0">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Nama</th>
                    <th style="">Deskripsi</th>
                </tr>
            </thead>    
            <tbody valign="top">
                @foreach($kategoris as $kategori)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td>{{ $kategori->deskripsi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endpush

@section('main')
@endsection

@push('scripts')
@endpush