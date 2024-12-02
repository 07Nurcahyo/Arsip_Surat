<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\surat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class arsip_main_controller extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Arsip Surat',
            'list' => ['Home', 'Arsip']
        ];
        $page = (object) [
            'title' => 'Daftar surat yang terdaftar dalam sistem',
        ];
        $activeMenu = 'arsip';
        $kategori = kategori::all();
        return view('arsip.arsip', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
    }

    public function list(Request $request){
        $surat = surat::select('id_surat', 'nomor_surat', 'judul_surat', 'file_surat', 'kode_kategori', 'created_at', 'updated_at')->with('kategori');
        //filter
        if ($request->id_kategori) {
            $p = strval($request->id_kategori);
            $surat->where('kode_kategori', $p);
        }
        return DataTables::of($surat)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($surat) { // menambahkan kolom aksi
                $btn = '<a href="'.url('/arsip/' . $surat->id_surat).'" class="btn btn-info btn-sm">Lihat <i class="fas fa-eye"></i></a> ';
                $btn .= '<a href="'.url('/arsip/' . $surat->id_surat . '/download').'" class="btn btn-warning btn-sm">Unduh <i class="fas fa-download"></i></a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('/arsip/'.$surat->id_surat).'" id="delete_'.$surat->id_surat.'">'. csrf_field() . method_field('DELETE') .'<button type="" class="btn btn-danger btn-sm" onclick="return deleteConfirm(\''.$surat->id_surat.'\');">Hapus <i class="fas fa-trash-alt"></i></button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create() {
        $breadcrumb = (object) [
            'title' => 'Unggah Arsip',
            'list' => ['Home', 'Arsip', 'Unggah']
        ];
        $page = (object) [
            'title' => ''
        ];
        $activeMenu = "arsip";
        $kategori = kategori::all();
        return view('arsip.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
    }

    public function store(Request $request) {
        $request->validate([
            'nomor_surat' => 'required|string|max:20',
            'judul_surat' => 'required|string|max:200',
            'file_surat'  => 'required|file|mimes:pdf',
            // 'kode_kategori' => 'required|integer|exists:kategori,id_kategori'
            'kode_kategori' => 'required|integer|exists:kategori,id_kategori'
        ]);
        surat::create([
            'nomor_surat' => $request->nomor_surat,
            'judul_surat' => $request->judul_surat,
            'file_surat'  => $request->file('file_surat')->store('/', 'public'),
            'kode_kategori' => $request->kode_kategori
        ]);
        // $request->file('file_surat')->store('/file_surat');
        // \Log::info($request->file('file_surat')->store('/file_surat'));
        return redirect('/arsip');
    }

    public function show (String $id) {
        $arsip = surat::with('kategori')->find($id);
        $breadcrumb = (object) [
            'title' => 'Detail Arsip',
            'list' => ['Home', 'Arsip', 'Detail']
        ];
        $page = (object) [
            'title' => ''
        ];
        $activeMenu = "arsip";
        // \Log::info($arsip);
        return view('arsip.show',['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'arsip' => $arsip]);
    }

    public function edit (String $id) {
        $arsip = surat::find($id);
        $breadcrumb = (object) [
            'title' => 'Edit Arsip',
            'list' => ['Home', 'Arsip', 'Edit']
        ];
        $page = (object) [
            'title' => ''
        ];
        $activeMenu = 'arsip';
        $kategori = kategori::all();
        return view('arsip.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'arsip' => $arsip, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
    }

    public function download(String $id) {
        $arsip = surat::find($id);

        if (!$arsip) {
            return redirect('/arsip')->with('error', 'Data arsip tidak ditemukan');
        }

        $filePath = storage_path('app/public/' . $arsip->file_surat);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        return response()->download($filePath);
    }

    public function update(Request $request, String $id){
        $request->validate([
            'nomor_surat' => 'required|string|max:20',
            'judul_surat' => 'required|string|max:200',
            'file_surat'  => 'required|file|mimes:pdf',
            'kode_kategori' => 'required|integer|exists:kategori,id_kategori'
        ]);
        $arsip = surat::find($id);
        $arsip->update([
            'nomor_surat' => $request->nomor_surat,
            'judul_surat' => $request->judul_surat,
            'file_surat'  => $request->file('file_surat')->store('/', 'public'),
            // 'file_suart'  => $this->storeImage()
            'kode_kategori' => $request->kode_kategori
        ]);
        return redirect('/arsip');
    }

    public function destroy(String $id) {
        $check = surat::find($id);
        if (!$check) {
            // return redirect('/arsip')->with('error', 'Data arsip tidak ditemukan');
            return '';
        }
        try {
            surat::destroy($id);
            // return redirect('/arsip');
            return response()->json(['success' => true]);
        } catch (\Illuminate\Database\QueryException $te) {
            // return redirect('/arsip')->with('error', 'Data arsip gagal di hapus karena masih terdapat table lain terkait dengan data ini');
            return response()->json(['success' => false]);
        }
        return view('arsip.delete', ['id' => $id]);
    }

    public function about() {
        $breadcrumb = (object) [
            'title' => 'Tentang',
            'list' => ['Home', 'About']
        ];
        $page = (object) [
            'title' => 'Tentang pencipta arsip surat',
        ];
        $activeMenu = 'about';
        return view('about', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    
}
