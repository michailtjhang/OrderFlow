<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';
    protected $fillable = [
        'id_supplier',
        'name_supplier',
        'address_supplier',
        'phone_supplier',
        'email_supplier'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'id_supplier', 'id_supplier');
    }
}
