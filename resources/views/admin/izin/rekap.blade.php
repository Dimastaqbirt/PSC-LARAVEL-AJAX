@extends('layouts.pdf')

@section('title', 'Rekap Izin')

@push('style')
@endpush

@section('main')
    <div>
        <table width="100%" border="1" cellpadding="2.5" cellspacing="0">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama</th>
                    <th style="">Tanggal</th>
                    <th width="10%" >Tipe</th>
                    <th style="">Alasan</th>
                </tr>
            </thead>    
            <tbody valign="top">
                @foreach($izins as $izin)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td>{{ $izin->user->nama }}</td>
                    <td style="text-align: center;">{{ ($izin->tanggal_selesai == null) ? formatTanggal($izin->tanggal_mulai) : formatTanggal($izin->tanggal_mulai) . ' - ' . formatTanggal($izin->tanggal_selesai) }}</td>
                    <td style="text-align: center;">{{ $izin->tipe }}</td>
                    <td>{{ $izin->alasan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
@endpush