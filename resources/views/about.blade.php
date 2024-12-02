@extends('layouts.template')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <!-- Kolom Kiri: Foto -->
            <div class="col-md-6 text-center mb-4 mb-md-0">
                <img src="{{asset('img/me.png')}}" alt="Foto Saya" class="rounded-circle shadow-lg" style="max-width: 60%; border: 5px solid #ddd;">
            </div>

            <!-- Kolom Kanan: Identitas -->
            <div class="col-md-6 identitas">
                <h3 class="font-weight-bold text-primary mb-3">Aplikasi ini dibuat oleh:</h3>
                <p><strong>Nama:</strong> Bagus Nurcahyo</p>
                <p><strong>Prodi:</strong> D-IV Sistem Informasi Bisnis</p>
                <p><strong>NIM:</strong> 2141762120</p>
                <p><strong>Tanggal Lahir:</strong> 29 November 2003</p>
                <p><strong>Alamat:</strong> Jl. Flamboyan No. 25, Kec. Pakisaji, Kota Malang</p>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        /* Styling tambahan */
        .container {
            max-width: 960px;
        }
        .rounded-circle {
            border-radius: 50%;
        }
        .shadow-lg {
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }
        h3 {
            /* color: #007bff; */
        }
        .identitas.p {
            font-size: 1.1rem;
            /* color: #333; */
        }
    </style>
@endpush

@push('js')
<script>
    // JavaScript tambahan jika diperlukan
</script>
@endpush
