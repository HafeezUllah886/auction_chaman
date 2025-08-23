<?php

namespace App\Http\Controllers;

use App\Models\sales;
use App\Http\Controllers\Controller;
use App\Models\accounts;
use App\Models\purchase;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $from = $request->from ?? firstDayOfMonth();
        $to = $request->to ?? now()->toDateString();

        $purchases = purchase::where('sale_id', null)->get();

        $sales = sales::whereBetween('date', [$from, $to])->get();

        return view('sales.index', compact('purchases', 'sales', 'from', 'to'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $purchase = purchase::find($request->purchase_id);
        $customers = accounts::customer()->get();
        return view('sales.create', compact('purchase', 'customers'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sales $sales)
    {
        //
    }
}
