<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Exports\OrderParameterExport;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_month = Carbon::now()->format('m');
        $carts = Cart::all();
        $product = Product::all();
        $orders = Order::select("*")
            ->where('status', '=', 'PAID')
            ->where('resi', '!=', null)
            ->where('order_notes', '!=', null)
            ->whereMonth('order_date', $current_month)
            ->orderBy('created_at', 'desc')
            ->get();
        $data = false;
        if ($orders->count()) {
            $data = true;
        }
        $fromDates = Carbon::parse(date(request('from_date')))->format('Y-m-d');
        $toDates = Carbon::parse(date(request('to_date')))->format('Y-m-d');
        $found = true;
        if (request('from_date') && request('to_date')) {
            $orders = Order::where('order_date', '>=', $fromDates)
                ->where('order_date', '<=', $toDates)
                ->where('status', '=', 'PAID')
                ->where('resi', '!=', null)
                ->where('order_notes', '!=', null)
                ->orderBy('created_at', 'desc')
                ->get();
            $data = false;
            if ($orders->count()) {
                $data = true;
            }
        }
        return view('section.report', compact('orders', 'carts', 'product','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function export_excel()
    {
        $filename = Carbon::now()->isoFormat('MMMM YYYY');
        return Excel::download(new OrderExport, 'Laporan Penjualan ' . $filename . '.xlsx');
    }

    public function filter(Request $request)
    {
        $result = Order::where('created_at', $request->filter)->get();
    }

    public function export_excel_parameter()
    {
        $fromDates = Carbon::parse(date(request('fromDate')))->format('Y-m-d');
        $toDates = Carbon::parse(date(request('toDate')))->format('Y-m-d');
        $filename1 = Carbon::parse(request('fromDate'))->isoFormat('DD MMMM YYYY');
        $filename2 = Carbon::parse(request('toDate'))->isoFormat('DD MMMM YYYY');
        return Excel::download(new OrderParameterExport($fromDates, $toDates), 'Laporan Penjualan per ' . $filename1 . ' - ' . $filename2 . '.xlsx');
    }
}