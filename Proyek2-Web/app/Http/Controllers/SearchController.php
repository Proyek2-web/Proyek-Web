<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchRef(Request $request)
    {
    }

    // public function index(Request $request)
    // {
    //     if($request->ajax()) {

    //         $data = Order::where('reference', $request->search)
    //             ->get();

    //         $output = '';

    //         if ($data->count()) {

    //             // $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';

    //             foreach ($data as $row){

    //                 $output .= '<li class="list-group-item">'.$row->nama.'</li>';
    //             }

    //             $output .= '</ul>';
    //         }
    //         else {

    //             $output .= '<li class="list-group-item">'.'No results'.'</li>';
    //         }

    //         return $output;
    //     }
    //     return view('layouts.search');
    // }
    public function index()
    {
        $data = Order::where('reference', request('search'))->first();
        if ($data !== null) {
            if (request('search')) {
                    $data = Order::where('reference', request('search'))->first();
                    return view('layouts.search', compact('data'))->with('success', 'Data Ditemukan');
            } else {
                return view('layouts.search');
            }
        } else {
            return view('layouts.search',compact('data'))->with('failed', 'Data Ditemukan');
        }
    }
}