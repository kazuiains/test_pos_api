<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    // definisikan nama tabel
    protected $table = 'barang';

    // menjadikan primaryKey
    protected $primaryKey = 'kode';
    // jika false tidak akan menjadikan increment
    public $incrementing = false;
    // jika primaryKey bukan int harus didefinisikan type datanya
    protected $keyType = 'string';

    // menonaktifkan time stamps
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'kode',
    ];

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }
}
