@extends('layout.popups')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6"><h3> Create Purchase </h3></div>
                                <div class="col-6 d-flex flex-row-reverse"><button onclick="window.close()" class="btn btn-danger">Close</button></div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="card-body">
                   
                    <form action="{{ route('purchase.store') }}" method="post">
                        @csrf
                        <div class="row">
                           
                            <div class="col-12 col-md-4">
                                <div class="form-group mt-2">
                                    <label for="transporter">Date</label>
                                    <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}" required class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group mt-2">
                                    <label for="container_no">Container No</label>
                                    <input type="text" name="container_no" id="container_no" required class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group mt-2">
                                    <label for="bl_no">BL No</label>
                                    <input type="text" name="bl_no" id="bl_no" required class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group mt-2">
                                    <label for="bl_amount">BL Amount</label>
                                    <input type="number" name="bl_amount" id="bl_amount" oninput="totalAmount()" value="0" required class="form-control">
                                </div>
                            </div>
                           
                            <div class="col-12 col-md-4">
                                <div class="form-group mt-2">
                                    <label for="container_amount">Container Amount</label>
                                    <input type="number" name="container_amount" id="container_amount" oninput="totalAmount()" value="0" required class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group mt-2">
                                    <label for="net_amount">Net Amount</label>
                                    <input type="number" name="net_amount" id="net_amount" readonly value="0" required class="form-control">
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group mt-2">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes" id="notes" class="form-control" cols="30" rows="5">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-primary w-100">Create Purchase</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
    </div>
    <!--end row-->
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/libs/selectize/selectize.min.css') }}">
    <style>
        .no-padding {
            padding: 5px 5px !important;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script>
        
       function totalAmount() {

        console.log('totalAmount');
           var total = 0;
           var bl_amount = $('#bl_amount').val();
           var container_amount = $('#container_amount').val();
           total = parseFloat(bl_amount) + parseFloat(container_amount);
           $('#net_amount').val(total);
       }
    
    </script>
@endsection
