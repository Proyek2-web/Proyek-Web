<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\Controller;

class CallbackController extends Controller
{
    protected $privateKey = 'private_key_anda';

    public function handle(Request $request)
    {
        // ambil callback signature
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE') ?? '';

        // ambil data JSON
        $json = $request->getContent();

        // generate signature untuk dicocokkan dengan X-Callback-Signature
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        // validasi signature
        if ($callbackSignature !== $signature) {
            return "Invalid Signature"; // signature tidak valid, hentikan proses
        }

        $data = json_decode($json);
        $event = $request->server('HTTP_X_CALLBACK_EVENT');

        if ($event == 'payment_status') {
            $merchantRef = $data->merchant_ref;

            // pembayaran sukses, lanjutkan proses sesuai sistem Anda, contoh:
            $order = Order::where('id', $merchantRef)
                ->where('status', 'UNPAID')
                ->first();

            if (!$order) {
                return "Order not found or current status is not UNPAID";
            }

            // Lakukan validasi nominal
            if (intval($data->total_amount) !== intval($order->total_amount)) {
                return "Invalid amount";
            }

            if ($data->status == 'PAID') // handle status PAID
            {
                $order->update([
                    'status'    => 'PAID'
                ]);

                return response()->json([
                    'success' => true
                ]);
            } elseif ($data->status == 'EXPIRED') // handle status EXPIRED
            {
                $order->update([
                    'status'    => 'CANCELED'
                ]);

                return response()->json([
                    'success' => true
                ]);
            } elseif ($data->status == 'FAILED') // handle status FAILED
            {
                $order->update([
                    'status'    => 'CANCELED'
                ]);

                return response()->json([
                    'success' => true
                ]);
            }
        }

        return "No action was taken";
    }
}
