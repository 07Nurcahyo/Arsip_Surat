@extends('layouts.template')
@section('content')
    <div class="card">
        {{-- <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div> --}}
        <div class="card-body">
            @empty($kategori)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('kategori') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
                @else
                <form method="POST" action="{{ url('/kategori/'.$kategori->id_kategori) }}" class="form-horizontal" id="edit_{{ $kategori->id_kategori }}">
                    @csrf
                    {!! method_field('PUT') !!} <!-- tambahkan baris ini untuk proses edit yang butuh method PUT -->
                    <div class="form-group">
                        <label>ID Kategori</label>
                        <div>
                            <input type="text" class="form-control" id="id_kategori" name="id_kategori" value="{{ old('id_kategori', $kategori->id_kategori) }}" required>
                            @error('id_kategori')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <div>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                            @error('nama_kategori')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <div>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan', $kategori->keterangan) }}" required>
                            @error('keterangan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-success" style="color: black" onclick="updateConfirm('{{ $kategori->id_kategori }}', 'Berhasil mengubah data kategori!🗿')"><i class="fas fa-save"></i> Simpan</button>
                            <a class="btn btn-warning ml-1" href="{{ url('kategori')}}"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush