<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'kategori_id',
        'name',
        'harga',
    ];
    public function kategori(){
        return $this->hasOne(Kategori::class, 'id', 'kategori_id');
    }
    public function stock(){
        return $this->hasMany(StockBarang::class, 'barang_id', 'id');
    }
}
