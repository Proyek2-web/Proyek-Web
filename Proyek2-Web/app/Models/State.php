<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'states';
    protected $guarded = ['id'];
    
    public function order()
    {
        return $this->hasMany(Order::class);
    }
}