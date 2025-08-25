<?php

namespace App\Http\Controllers;

use App\Models\sales;
use App\Http\Controllers\Controller;
use App\Models\accounts;
use App\Models\purchase;
use App\Models\sale_cars;
use App\Models\sale_parts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        try {
            DB::beginTransaction();

            $ref = getRef();
            
            $sale = sales::create([
                'date' => $request->date,
                'purchases_id' => $request->purchase_id,
                'other_expenses' => $request->other_expenses,
                'amount' => $request->total,
                'notes' => $request->notes,
                'refID' => $ref,
            ]);

            $cars = $request->chassis_no;
            if($cars){
                foreach ($cars as $key => $car) {
                    sale_cars::create(
                        [
                            'sales_id' => $sale->id,
                            'chassis_no' => $car,
                            'customer_id' => $request->customer[$key],
                            'desc' => $request->desc[$key],
                            'price_pkr' => $request->car_price[$key],
                            'conversion_rate' => $request->car_rate[$key],
                            'price_afg' => $request->car_afg[$key],
                            'remarks' => $request->remarks[$key],
                            'date' => $request->date,
                            'refID' => $ref,
                        ]
                    );
                }
            }

            $parts = $request->part_desc;
            if($parts){
                foreach ($parts as $key => $part) {
                    sale_parts::create(
                        [
                            'sales_id' => $sale->id,
                            'customer_id' => $request->part_customer[$key],
                            'description' => $part,
                            'qty' => $request->qty[$key],
                            'price_pkr' => $request->part_price[$key],
                            'conversion_rate' => $request->part_rate[$key],
                            'price_afg' => $request->part_afg[$key],
                            'date' => $request->date,
                            'refID' => $ref,
                        ]
                    );
                }
            }

            $purchase = purchase::find($request->purchase_id);
            $purchase->sale_id = $sale->id;
            $purchase->save();
            DB::commit();
            return redirect()->route('sale.index')->with('success', 'Sale created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sale = sales::with('cars', 'parts')->find($id);
        return view('sales.view', compact('sale'));
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
