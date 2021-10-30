<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class TripayController extends Controller
{
    public function getPaymentChannels()
    {



        $apiKey = config('tripay.api_key');


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT     => true,
            CURLOPT_URL               => "https://tripay.co.id/api-sandbox/merchant/payment-channel?",
            CURLOPT_RETURNTRANSFER    => true,
            CURLOPT_HEADER            => false,
            CURLOPT_HTTPHEADER        => array(
                "Authorization: Bearer " . $apiKey
            ),
            CURLOPT_FAILONERROR       => false
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response)->data;
        return $response ? $response : $err;
    }
    
    public function requestTransaction( $method, $product)
    {
        $user = auth()->user();
        $apiKey = config('tripay.api_key');
        $privateKey = config('tripay.private_key');
        $merchantCode = config('tripay.merchant_code');
        $merchantRef = 'KK-' . time();

        $data = [
            'method'            => $method,
            'merchant_ref'      => $merchantRef,
            'amount'            => $product->harga,
            'customer_name'     => "sa",
            'customer_email'    => "sasaasa@gmail.com",
            'customer_phone'    => "089670979788",
            'order_items'       => [
                [
                    'name'      => $product->nama,
                    'price'     => $product->harga,
                    'quantity'  => 80,
                ]
            ],
            'expired_time'      => (time() + (24 * 60 * 60)), // 24 jam
            'signature'         => hash_hmac('sha256', $merchantCode . $merchantRef . $product->harga, $privateKey)
        ];
        
        dd($data);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT     => true,
            CURLOPT_URL               => "https://tripay.co.id/api-sandbox/transaction/create",
            CURLOPT_RETURNTRANSFER    => true,
            CURLOPT_HEADER            => false,
            CURLOPT_HTTPHEADER        => array(
                "Authorization: Bearer " . $apiKey
            ),
            CURLOPT_FAILONERROR       => false,
            CURLOPT_POST              => true,
            CURLOPT_POSTFIELDS        => http_build_query($data)
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        dd($response);

        return $response ?: $err;
    }
}
