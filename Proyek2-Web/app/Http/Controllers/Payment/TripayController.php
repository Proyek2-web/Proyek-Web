<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function requestTransaction($method, $orders)
    {

        $apiKey = config('tripay.api_key');
        $privateKey = config('tripay.private_key');
        $merchantCode = config('tripay.merchant_code');
        $merchantRef = 'KK-' . time();
        // $total = ($orders->qty * $orders->product->harga)+$orders->delivery->harga;
        // $total->save();
        
        $total = $orders->quantity * $orders->product->harga;
        $delivery = $orders->delivery->harga;
        $amount = $total + $delivery;

        $data = [
            'method'            => $method,
            'merchant_ref'      => $merchantRef,
            'amount'            => $amount,
            'customer_name'     => $orders->nama,
            'customer_email'    => $orders->email,
            'customer_phone'    => $orders->phone_number,
            'order_items'       => [
                [
                    'name'      => $orders->product->nama,
                    'price'     => $orders->product->harga,
                    'quantity'  => $orders->quantity,
                ],
                [
                    'name'      => $orders->delivery->nama,
                    'price'     => $orders->delivery->harga,
                    'quantity'  => 1,
                ],
            ],
            'expired_time'      => (time() + (24 * 60 * 60)), // 24 jam
            'signature'         => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
        ];
        // dd($data);

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

        $response = json_decode($response);
        // $responses = response()->json($data,Response::HTTP_OK);

        return $response ?: $err;
        // return $data ?: $err;
    }

    public function detailTransaksi($reference)

    {

        $apiKey = config('tripay.api_key');
        $payload = [
            'reference'    => $reference
        ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT     => true,
            CURLOPT_URL               => "https://tripay.co.id/api-sandbox/transaction/detail?" . http_build_query($payload),
            CURLOPT_RETURNTRANSFER    => true,
            CURLOPT_HEADER            => false,
            CURLOPT_HTTPHEADER        => array(
                "Authorization: Bearer " . $apiKey
            ),
            CURLOPT_FAILONERROR       => false,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;
        // $responses = response()->json($payload);
        // dd($response);
        return $response ?: $err;
    }
}