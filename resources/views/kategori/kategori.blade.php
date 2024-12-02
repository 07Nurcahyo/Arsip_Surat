@extends('layouts.template')
@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat. <br>Klik "Tambah" untuk menambahkan kategori baru.</h3>
            <div class="card-tools">
                <a class="btn btn-success mt-1" href="{{ url('kategori/create')}}"><i class="fas fa-plus-square"></i> Tambah Kategori Baru</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Keterangan</th>
                        {{-- <th>Waktu Pembuatan</th> --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
<script>
    $(document).ready(function() {
        var dataKategori = $('#table_kategori').DataTable({
            serverSide: false, // serverSide: true, jika ingin menggunakan server side processing
            ajax: {
                url: "{{ url('kategori/list') }}",
                dataType: "json",
                type: "POST"
            },
            columns: [
                {
                    data: "id_kategori",
                    className: "",
                    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                },
                {
                    data: "nama_kategori",
                    className: "",
                    orderable: false,
                    searchable: true
                },
                {
                    data: "keterangan",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                // {
                //     data: "created_at",
                //     className: "",
                //     orderable: true,
                //     searchable: true
                // },
                {
                    data: "aksi",
                    className: "",
                    orderable: false, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: false // searchable: true, jika ingin kolom ini bisa dicari
                }
            ],
            responsive: true, // Make the table responsive
            lengthChange: true, // Hide the length change dropdown
            autoWidth: false, // Disable auto width calculation
            paging: true, // Enable pagination
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        });

        deleteConfirm = function(id) {
            event.preventDefault(); // mencegah form submit
            // console.log("buku"+id);
            Swal.fire({
                // title: "Apakah Anda yakin ingin menghapus arsip surat ini?",
                // text: "Data dengan id " +id+ " akan dihapus!",
                html: "<b>Apakah Anda yakin ingin menghapus kategori surat ini?</b>",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'api/destroyKategori/' + id,
                        type: 'DELETE',
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire({
                                    title: "Terhapus!",
                                    text: "Data kategori telah terhapus!",
                                    icon: "success"
                                }).then((result) => {
                                    dataKategori.ajax.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Gagal Terhapus!",
                                    text: "Data gagal terhapus karena masih ada hubungan di tabel yang lain",
                                    // icon: "error"
                                    imageUrl: "https://i.gifer.com/XwI7.gif",
                                    // imageUrl: "https://media.tenor.com/R1fzxKoz4kwAAAAM/sonic-sonic-exe.gif",
                                });
                            }
                        }
                    });
                }
            });
        }
    });
</script>
@endpush