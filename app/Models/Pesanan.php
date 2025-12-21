<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'produk_items',
        'quantity',
        'sub_total',
        'total',
        'status',
    ];
    protected $casts = [
        'order_id' => 'string',
        'produk_items' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produkItems()
    {
        return $this->hasMany(Keranjang::class);
    }
}
