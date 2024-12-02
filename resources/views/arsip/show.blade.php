@extends('layouts.template')
@section('content')
    <div class="card">
        {{-- <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div> --}}
        <div class="card-body">
            @empty($arsip)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
            </div>
            @else
            <table class="table table-bordered table-sm">
                <tr>
                    <th style="width: 20%">Nomor Surat</th>
                    <td style="padding-left: 0.5em">{{ $arsip->nomor_surat }}</td>
                </tr>
                <tr>
                    <th style="width: 20%">Kategori</th>
                    <td style="padding-left: 0.5em">{{ $arsip->kategori->nama_kategori }}</td>
                </tr>
                <tr>
                    <th style="width: 20%">Judul Surat</th>
                    <td style="padding-left: 0.5em">{{ $arsip->judul_surat }}</td>
                </tr>
                <tr>
                    <th style="width: 20%">Waktu Unggah</th>
                    <td style="padding-left: 0.5em">{{ $arsip->created_at }}</td>
                </tr>
                {{-- <tr>
                    <th>File</th>
                    <td>
                        <iframe src="{{ asset('storage/'.$arsip->file_surat) }}" frameborder="0"></iframe>
                    </td>
                </tr> --}}
                <tr>
                    <td class="text-center" colspan="2">
                        <iframe src="{{ asset('storage/'.$arsip->file_surat) }}" frameborder="1" width="100%" height="500px"></iframe>
                    </td>
                </tr>
            </table>
            <a href="{{ url('arsip') }}" class="btn btn-warning mt-3"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
            <a href="{{ url("/arsip/{$arsip->id_surat}/download") }}" class="btn btn-success mt-3 ml-2"><i class="fas fa-download"></i> Unduh</a>
            <a href="{{ url("/arsip/{$arsip->id_surat}/edit") }}" class="btn btn-danger mt-3 ml-2"><i class="fas fa-edit"></i> Edit/Ganti File</a>
            @endempty
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush