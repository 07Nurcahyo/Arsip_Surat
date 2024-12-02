@extends('layouts.template')
@section('content')
    <div class="card">
        {{-- <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div> --}}
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $item)
                    <p>{{ $item }}</p>
                @endforeach
            @endif
            @empty($arsip)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('arsip') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
                @else
                <form method="POST" enctype="multipart/form-data" action="{{ url('/arsip/'.$arsip->id_surat) }}" class="form-horizontal" id="edit_{{ $arsip->id_surat }}">
                    @csrf
                    {!! method_field('PUT') !!} <!-- tambahkan baris ini untuk proses edit yang butuh method PUT -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Surat</label>
                                <div>
                                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat', $arsip->nomor_surat) }}" required>
                                    @error('nomor_surat')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <div>
                                    <select class="form-control" id="id_kategori" name="kode_kategori" required>
                                        <option value="">- Pilih Kategori -</option>
                                        @foreach($kategori as $item)
                                            <option value="{{ $item->id_kategori }}" @if ($item->id_kategori == $arsip->kode_kategori) selected @endif>{{ $item->nama_kategori}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kategori')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Judul Surat</label>
                                <div>
                                    <input type="text" class="form-control" id="judul_surat" name="judul_surat" value="{{ old('judul_surat', $arsip->judul_surat) }}" required>
                                    @error('judul_surat')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>File Surat (PDF)</label>
                                <input type="file" class="form-control" id="file_surat" name="file_surat" value="{{ old('file_surat', $arsip->file_surat) }}" data-default-file="{{ asset('storage/'.$arsip->file_surat) }}" required>
                                @error('file_surat')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 d-flex flex-column">
                            <div class="form-group m-0">
                                <label for="">Surat Sebelumnya</label><br>
                            </div>
                            <div class="form-group flex-fill">
                                <iframe class="form-control h-100 p-0 m-0" src="{{ asset('storage/'.$arsip->file_surat) }}" frameborder="1"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-success" style="color: black" onclick="updateConfirm({{ $arsip->id_surat }}, 'Berhasil mengubah data arsip!🗿')"><i class="fas fa-save"></i> Simpan</button>
                            {{-- <a class="btn btn-warning ml-1" href="{{ url('arsip')}}"><i class="fas fa-chevron-circle-left"></i> Kembali</a> --}}
                            <a href="{{ url('/arsip/' . $arsip->id_surat) }}" class="btn btn-info"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
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
<script>
    $(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                'default': 'Klik atau drag & drop file buku disini',
                'replace': 'Klik atau drag & drop file buku disini',
                'remove':  'Hapus',
                'error':   'Ooops, something wrong happended.'
            }
        });
    })
</script>
@endpush