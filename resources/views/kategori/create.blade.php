@extends('layouts.template')
@section('content')
    <div class="card">
        <div class="card-header bg-secondary">
            {{-- <h3 class="card-title">{{ $page->title }}</h3> --}}
            <div class="card-title">Tambahkan data kategori. Jika sudah selesai, jangan lupa untuk menekan tombol "Simpan"</div>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $item)
                    <p>{{ $item }}</p>
                @endforeach
            @endif
            <form method="POST" action="{{ url('kategori') }}" class="form-horizontal" id="tambah_">
                @csrf
                <div class="form-group">
                    <label>ID Kategori</label>
                    <div>
                        <input type="text" class="form-control" id="id_kategori" name="id_kategori" value="{{ old('id_kategori') }}">
                        @error('id_kategori')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <div>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}" required>
                        @error('nama_kategori')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Judul</label>
                    <div>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan') }}" required>
                        @error('keterangan')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <a class="btn btn-warning ml-1" href="{{ url('kategori')}}"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-success" style="color: black" onclick="tambahConfirm('Berhasil menambahkan data kategori!🗿')"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush