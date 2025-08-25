@extends('layout.popups')
@section('content')
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card" id="demo">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end d-print-none p-2 mt-4">
                                <a href="javascript:window.print()" class="btn btn-success ml-4"><i class="ri-printer-line mr-4"></i> Print</a>
                            </div>
                            <div class="card-header border-bottom-dashed p-4">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h1>JAN TRADING COMPANY</h1>
                                    </div>
                                    <div class="flex-shrink-0 mt-sm-0 mt-3">
                                        <h3>Sales Report</h3>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Sale Date</p>
                                        <h5 class="fs-14 mb-0">{{ date('d M Y', strtotime($sale->date)) }}</h5>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Sale #</p>
                                        <h5 class="fs-14 mb-0">{{ $sale->id }}</h5>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Container #</p>
                                        <h5 class="fs-14 mb-0">{{ $sale->purchase->c_no }}</h5>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">BL #</p>
                                        <h5 class="fs-14 mb-0">{{ $sale->purchase->bl_no }}</h5>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Cost</p>
                                        <h5 class="fs-14 mb-0">{{ $sale->purchase->net_pkr }}</h5>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Other Expenses</p>
                                        <h5 class="fs-14 mb-0">{{ $sale->other_expenses }}</h5>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Sale Amount</p>
                                        <h5 class="fs-14 mb-0">{{ $sale->amount }}</h5>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Profit / Loose</p>
                                        <h5 class="fs-14 mb-0">{{ $sale->amount - $sale->purchase->net_pkr - $sale->other_expenses }}</h5>
                                    </div>
                                   
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">

                            <div class="card-body p-4">
                                <h3>Cars</h3>
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0" >
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col" style="width: 50px;">#</th>
                                                <th scope="col" class="text-start">Customer</th>
                                                <th scope="col" class="text-start">Chassis No</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Price (PKR)</th>
                                                <th scope="col">Conversion Rate</th>
                                                <th scope="col">Price (AFG)</th>
                                                <th scope="col">Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @php
                                               
                                                $total_afg = 0;
                                            @endphp

                                        @foreach ($sale->cars as $key => $item)
                                        @php
                                            if($item->customer->currency == 'AFG'){
                                                $total_afg += $item->price_afg;
                                            }
                                        @endphp
                                            <tr>
                                                <td>{{ $item->id}}</td>
                                                <td class="text-start">{{ $item->customer->title }} ({{ $item->customer->currency }})</td>
                                                <td class="text-start">{{ $item->chassis_no }}</td>
                                                <td>{{ $item->desc }}</td>
                                                <td class="text-end">{{ number_format($item->price_pkr, 2) }}</td>
                                                <td class="text-end">@if($item->customer->currency == 'PKR') - @else {{ number_format($item->conversion_rate, 2) }} @endif</td>
                                                <td class="text-end">@if($item->customer->currency == 'PKR') - @else {{ number_format($item->price_afg, 2) }} @endif</td>
                                                <td class="text-start">{{ $item->remarks }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" class="text-end">Total</th>
                                                <th class="text-end">{{number_format($sale->cars->sum('price_pkr'), 2)}}</th>
                                                <th></th>
                                                <th class="text-end">{{number_format($total_afg, 2)}}</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table><!--end table-->
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h3>Parts</h3>
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0" >
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col" style="width: 50px;">#</th>
                                                <th scope="col" class="text-start">Customer</th>
                                                <th scope="col" class="text-start">Description</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Price (PKR)</th>
                                                <th scope="col">Conversion Rate</th>
                                                <th scope="col">Price (AFG)</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @php
                                               
                                                $total_Parts_afg = 0;
                                            @endphp

                                        @foreach ($sale->parts as $key => $item)
                                        @php
                                            if($item->customer->currency == 'AFG'){
                                                $total_Parts_afg += $item->price_afg;
                                            }
                                        @endphp
                                            <tr>
                                                <td>{{ $item->id}}</td>
                                                <td class="text-start">{{ $item->customer->title }} ({{ $item->customer->currency }})</td>
                                                <td class="text-start">{{ $item->description }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td class="text-end">{{ number_format($item->price_pkr, 2) }}</td>
                                                <td class="text-end">@if($item->customer->currency == 'PKR') - @else {{ number_format($item->conversion_rate, 2) }} @endif</td>
                                                <td class="text-end">@if($item->customer->currency == 'PKR') - @else {{ number_format($item->price_afg, 2) }} @endif</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" class="text-end">Total</th>
                                                <th class="text-end">{{number_format($sale->parts->sum('price_pkr'), 2)}}</th>
                                                <th></th>
                                                <th class="text-end">{{number_format($total_Parts_afg, 2)}}</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table><!--end table-->
                                </div>
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
@endsection
@section('page-css')

@endsection
@section('page-js')

@endsection


