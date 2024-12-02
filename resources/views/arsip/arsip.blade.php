@extends('layouts.template')
@section('content')
    <div class="card card-secondary" >
        <div class="card-header">
            <h6 class="card-title pt-1">Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.<br>Tekan "Lihat" pada kolom aksi untuk menampilkan surat.</h6>
            <div class="card-tools">
                {{-- <a class="btn btn-success mt-1" href="{{ url('arsip/create')}}"><i class="fas fa-archive"></i> Arsipkan Surat</a> --}}
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm" id="table_arsip">
                <thead>
                    <tr>
                        <th>Nomor Surat</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Waktu Pengarsipan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="card-footer">
            <a class="btn btn-success mt-1" href="{{ url('arsip/create') }}"><i class="fas fa-archive"></i> Arsipkan Surat</a>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script>
    $(document).ready(function() {
        var dataArsip = $('#table_arsip').DataTable({
            serverSide: false, // serverSide: true, jika ingin menggunakan server side processing
            ajax: {
                url: "{{ url('arsip/list') }}",
                dataType: "json",
                type: "POST"
            },
            columns: [
                {
                    data: "nomor_surat",
                    className: "",
                    orderable: true, // orderable: true, jika ingin kolom ini bisa diurutkan
                    searchable: true // searchable: true, jika ingin kolom ini bisa dicari
                },
                {
                    data: "kategori.nama_kategori",
                    className: "",
                    orderable: false,
                    searchable: true
                },
                {
                    data: "judul_surat",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "created_at",
                    className: "",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        return moment(data).format('YYYY-MM-DD HH:mm');
                    }
                },
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
                html: "<b>Apakah Anda yakin ingin menghapus arsip surat ini?</b>",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'api/destroyArsip/' + id,
                        type: 'DELETE',
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire({
                                    title: "Terhapus!",
                                    text: "Data arsip telah terhapus!",
                                    icon: "success"
                                }).then((result) => {
                                    dataArsip.ajax.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Gagal Terhapus!",
                                    text: response.error,
                                    // icon: "error"
                                    imageUrl: "https://i.gifer.com/XwI7.gif",
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