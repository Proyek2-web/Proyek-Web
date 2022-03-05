<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $fillable = ['nama', 'phone_number', 'custom', 'email', 'product_id','category_id', 'reference', 'merchant_ref', 'amount', 'status', 'quantity', 'delivery_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

}