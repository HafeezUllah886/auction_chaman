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
                            <div class="col-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Cost</th>
                                            <th>Sale Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="items">
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-active">
                                            <td class="text-end">Total</td>
                                            <td class="text-end"><span id="total_cost">0</span></td>
                                            <td class="text-end"><span id="total_value">0</span></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-10">
                                   
                                </div>
                                <div class="col-2">
                                    <div class="form-group mt-2">
                                        <button type="button" onclick="addItem()" class="btn btn-success w-100">Add Item (Alt)</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="transporter">Date</label>
                                    <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}" required class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="transporter">Transporter</label>
                                    <select name="transporter" id="transporter" required class="form-control">
                                        <option value="">Select Transporter</option>
                                        @foreach ($transporters as $transporter)
                                            <option value="{{ $transporter->id }}" @selected(old('transporter') == $transporter->id)>{{ $transporter->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group mt-2">
                                    <label for="container_no">Container No</label>
                                    <input type="text" name="container_no" id="container_no" required class="form-control">
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
        
        function addItem() {
           var html = '';
           html += '<tr>';
           html += '<td style="width: 50%;"><input type="text" name="item[]" class="form-control"></td>';
           html += '<td><input type="number" name="cost[]" oninput="updateTotal()" class="form-control"></td>';
           html += '<td><input type="number" name="sale_price[]" oninput="updateTotal()" class="form-control"></td>';
           html += '<td><button type="button" class="btn btn-danger w-100" onclick="removeItem(this)">Delete</button></td>';
           html += '</tr>';
           $('#items').append(html);
           $('#items tr:last-child input[name="item[]"]').focus();
           updateTotal();
        }

        function updateTotal() {
            var total_cost = 0;
            var total_sale_price = 0;
            $('#items tr').each(function() {
                var cost = parseFloat($(this).find('input[name="cost[]"]').val()) || 0;
                var sale_price = parseFloat($(this).find('input[name="sale_price[]"]').val()) || 0;
                total_cost += cost;
                total_sale_price += sale_price;
            });
            $('#total_cost').text(total_cost.toFixed(0));
            $('#total_value').text(total_sale_price.toFixed(0));
        }

        function removeItem(button) {
            $(button).parent().parent().remove();
        }

        //create keyboard short for add item
        $(document).keydown(function(e) {
            if (e.key === 'Alt') {
                addItem();
            }
        });
    
    </script>
@endsection
