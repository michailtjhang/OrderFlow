<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = [
        'id_transaksi',
        'user_id',
        'total_harga',
        'tgl_beli'
    ];

    public function item()
    {
        return $this->hasMany(TransaksiItem::class, 'id_transaksi', 'id_transaksi');
    }
}
