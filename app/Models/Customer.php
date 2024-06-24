<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    // definisikan nama tabel
    protected $table = 'pelanggan';

    // menjadikan primaryKey
    protected $primaryKey = 'id_pelanggan';
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
        'id_pelanggan',
    ];

    public function sales(): HasMany
    {
        return $this->hasMany(Sales::class);
    }
}
