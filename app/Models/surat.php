<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class surat extends Model
{
    use HasFactory;

    protected $table = 'surat';
    protected $primaryKey = 'id_surat';

    protected $fillable = [
        // 'id_surat',
        'nomor_surat',
        'judul_surat',
        'file_surat',
        'kode_kategori', //fk
        'created_at',
        'updated_at',
    ];

    public function kategori(): BelongsTo{
        return $this->belongsTo(kategori::class, 'kode_kategori', 'id_kategori');
    }

    public function file(): Attribute{
        return Attribute::make(
            get: fn ($file) => url('/storage/posts' . $file),
        );
    }
}
