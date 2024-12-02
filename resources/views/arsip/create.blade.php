@extends('layouts.template')
@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">
                Unggah surat yang telah terbit pada form ini untuk diarsipkan <br>
                <small>Catatan : Gunakan file berformat PDF</small>
            </h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                @foreach ($errors->all() as $item)
                    <p>{{ $item }}</p>
                @endforeach
            @endif
            <form method="POST" enctype="multipart/form-data" action="{{ url('arsip') }}" class="form-horizontal" id="tambah_">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <div>
                                <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" required>
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
                                        <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori}}</option>
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
                                <input type="text" class="form-control" id="judul_surat" name="judul_surat" value="{{ old('judul_surat') }}" required>
                                @error('judul_surat')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>File Surat (PDF)</label>
                            <div>
                                <input type="file" class="form-control" id="file_surat" name="file_surat" value="{{ old('file_surat') }}" required>
                                @error('file_surat')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label>Cover Buku</label>
                            <div>
                                <input type="file" class="form-control dropify" id="gambar" name="gambar" required>
                                @error('gambar')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <a class="btn btn-warning ml-1" href="{{ url('arsip')}}"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-success" style="color: black" onclick="tambahConfirm('Berhasil menambahkan data arsip!🗿')"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
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
                'default': '<small style="font-size: 20px">Klik atau drag & drop cover buku disini</small>',
                'replace': 'Klik atau drag & drop cover buku disini',
                'remove':  'Hapus',
                'error':   'Ooops, something wrong happended.'
            }
        });

        // tambahConfirm = function() {
        //     console.log('#tambah_');
        //     event.preventDefault();
        //     Swal.fire({
        //         title: "Tersimpan",
        //         text: "Berhasil menambahkan data buku!🗿",
        //         icon: "success"
        //     }).then((result) => {
        //         $('#tambah_').submit();
        //     });
        // }
    })
</script>
@endpush