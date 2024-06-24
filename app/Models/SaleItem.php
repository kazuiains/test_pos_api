<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleItem extends Model
{
    use HasFactory;

    // definisikan nama tabel
    protected $table = 'item_penjualan';

    // menghapus primary key
    protected $primaryKey = null;
    // jika false tidak akan menjadikan increment
    public $incrementing = false;
    
    // menonaktifkan time stamps
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nota',
        'kode_barang',
        'quantity',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sales::class);
    }

}
