<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $fillable = ['nama', 'phone_number', 'custom', 'email', 'product_id','category_id', 'reference', 'merchant_ref', 'amount', 'status', 'quantity', 'delivery_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public static function getOrder()
    {
        $current_month = Carbon::now()->format('m');
        // dd($current_month);
        $record = DB::table('orders')
            ->leftJoin('carts', 'orders.id', '=', 'carts.order_id')
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->select(
                'orders.id as id',
                'orders.nama as nama',
                'orders.merchant_ref as merchant_ref',
                'orders.alamat as alamat',
                'orders.phone_number as phone_number',
                'orders.created_at as created_at',
                'orders.resi as resi',
                'products.nama as nama_product',
                'orders.delivery as delivery',
                'orders.amount as amount',
                'orders.day as day'
            )
            ->where('orders.status', '=', 'PAID')
            ->where('resi', '!=', null)
            ->where('order_notes', '!=', null)
            ->whereMonth('orders.created_at', $current_month)
            ->get()->toArray();
        return $record;
    }
    public static function getDate()
    {
        $current_month = Carbon::now()->format('m');
        // dd($current_month);
        $record = DB::table('orders')
        ->select('*')
            ->where('status', '=', 'PAID')
            ->where('resi', '!=', null)
            ->where('order_notes', '!=', null)
            ->whereMonth('created_at', $current_month)
            ->get()->toArray();
        return $record;
    }

    public static function getOrderPerDate($date)
    {
        // dd($current_month);
        $record = DB::table('orders')
            ->leftJoin('carts', 'orders.id', '=', 'carts.order_id')
            ->leftJoin('products', 'carts.product_id', '=', 'products.id')
            ->select(
                'orders.id as id',
                'orders.nama as nama',
                'orders.merchant_ref as merchant_ref',
                'orders.alamat as alamat',
                'orders.phone_number as phone_number',
                'orders.created_at as created_at',
                'orders.resi as resi',
                'carts.qty as qty',
                'products.nama as nama_product',
                'orders.delivery as delivery',
                'orders.amount as amount',
                'orders.day as day',
                'orders.status as status',
                'orders.order_notes as order_notes',
            )
            ->where('orders.status', '=', 'PAID')
            ->where('resi', '!=', null)
            ->where('order_notes', '!=', null)
            ->where('orders.created_at', $date)
            ->get()->toArray();
        return $record;
    }
    public static function getOrderProduct($id)
    {
        $records = DB::table('orders')
        ->join('carts', 'orders.id', '=', 'carts.order_id')
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->select(
            'orders.id as id',
            'orders.nama as nama',
            'orders.merchant_ref as merchant_ref',
            'orders.alamat as alamat',
            'orders.phone_number as phone_number',
            'orders.created_at as created_at',
            'orders.resi as resi',
            'carts.qty as qty',
            'products.nama as nama_product',
            'orders.delivery as delivery',
            'orders.amount as amount',
            'orders.day as day'
        )
        ->where('orders.status', '=', 'PAID')
        ->where('resi', '!=', null)
        ->where('order_notes', '!=', null)
        ->where('orders.id', $id)->get()->toArray();
        foreach ($records as $record) {
            $recordData[] = $record->nama_product;
        }
        return $recordData;
    }
}