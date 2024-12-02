<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class kategori_controller extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori Surat',
            'list' => ['Home', 'Kategori']
        ];
        $page = (object) [
            'title' => 'Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat. Klik "Tambah" untuk menambahkan kategori baru.',
        ];
        $activeMenu = 'kategori';
        return view('kategori.kategori', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request){
        $kategori = kategori::select('id_kategori', 'nama_kategori', 'keterangan', 'created_at', 'updated_at');
        //filter
        if ($request->id_kategori) {
            $p = strval($request->id_kategori);
            $kategori->where('kode_kategori', $p);
        }
        return DataTables::of($kategori)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($kategori) { // menambahkan kolom aksi
                $btn  = '<form class="d-inline-block" method="POST" action="'.url('/kategori/'.$kategori->id_kategori).'" id="delete_'.$kategori->id_kategori.'">'. csrf_field() . method_field('DELETE') .'<button type="" class="btn btn-danger btn-sm" onclick="return deleteConfirm(\''.$kategori->id_kategori.'\');">Hapus <i class="fas fa-trash-alt"></i></button></form>';
                $btn .= '<a href="'.url('/kategori/' . $kategori->id_kategori . '/edit').'" class="btn btn-warning btn-sm ml-2">Edit <i class="fas fa-edit"></i></a> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create(Request $request) {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah Kategori baru'
        ];
        $activeMenu = "kategori";
        return view('kategori.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request) {
        $request->validate([
            // 'id_kategori'   => 'required|integer',
            'nama_kategori' => 'required|string|max:50',
            'keterangan'    => 'required|string|max:200'
        ]);
        kategori::create([
            // 'id_kategori'   => $request->id_kategori,
            'nama_kategori' => $request->nama_kategori,
            'keterangan'    => $request->keterangan
        ]);
        return redirect('/kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show (String $id) {
        $kategori = kategori::find($id);
        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];
        $page = (object) [
            'title' => 'Detail Kategori'
        ];
        $activeMenu = "kategori";
        return view('kategori.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function edit (String $id) {
        $kategori = kategori::find($id);
        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];
        $page = (object) [
            'title' => 'Edit Kategori'
        ];
        $activeMenu = "kategori";
        return view('kategori.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function update (Request $request, String $id) {
        $request->validate([
            // 'id_kategori'   => 'required|integer',
            'nama_kategori' => 'required|string|max:50',
            'keterangan'    => 'required|string|max:200'
        ]);
        kategori::where('id_kategori', $id)->update([
            // 'id_kategori'   => $request->id_kategori,
            'nama_kategori' => $request->nama_kategori,
            'keterangan'    => $request->keterangan
        ]);
        return redirect('/kategori')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(String $id) {
        $check = kategori::find($id);
        if (!$check) {
            // return redirect('/arsip')->with('error', 'Data arsip tidak ditemukan');
            return '';
        }
        try {
            kategori::destroy($id);
            // return redirect('/arsip');
            return response()->json(['success' => true]);
        } catch (\Illuminate\Database\QueryException $te) {
            // return redirect('/arsip')->with('error', 'Data arsip gagal di hapus karena masih terdapat table lain terkait dengan data ini');
            return response()->json(['success' => false, 'error' => 'Data arsip gagal di hapus karena masih terdapat table lain terkait dengan data ini']);
        }
        return view('arsip.delete', ['id' => $id]);
    }
}
