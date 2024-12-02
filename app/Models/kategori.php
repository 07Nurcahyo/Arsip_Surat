<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $keyType = 'string';
    public $incrementing = false;
    // public $timestamps = true;

    protected $fillable = [
        'id_kategori',
        'nama_kategori',
        'keterangan',
        'created_at',
        'updated_at'
    ];

    public function surat(): HasMany{
        return $this->hasMany(surat::class, 'kode_kategori', 'id_kategori');
    }

    // public function surat(): HasMany{
    //     return $this->hasMany(surat::class, 'id_surat', 'id_surat');
    // }
}
