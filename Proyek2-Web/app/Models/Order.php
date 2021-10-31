<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $fillable = ['nama', 'phone_number', 'custom', 'email', 'product_id','category_id', 'reference', 'merchant_ref', 'amount', 'status', 'quantity', 'delivery_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}
