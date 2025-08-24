@extends('layout.popups')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3> Create Sale </h3>
                                </div>
                                <div class="col-6 d-flex flex-row-reverse"><button onclick="window.close()"
                                        class="btn btn-danger">Close</button></div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
                <div class="card-body">
                    <form action="{{ route('sale.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <h4>Cars</h4>
                            </div>
                            <div class="col-6 d-flex flex-row-reverse"><button type="button" onclick="addCar()"
                                    class="btn btn-primary">Add Car (Tab)</button></div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="product">Cars</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <th width="200px">Customer</th>
                                            <th width="">Chassis</th>
                                            <th width="">Description</th>
                                            <th width="" class="text-center">Price (PKR)</th>
                                            <th width="" class="text-center">Conversion Rate</th>
                                            <th width="" class="text-center">Price (AFG)</th>
                                            <th class="text-center">Remarks</th>
                                            <th></th>
                                        </thead>
                                        <tbody id="cars_list">

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3" class="text-end">Total</th>
                                                <th class="text-end" id="totalCarPrice">0.00</th>
                                                <th></th>
                                                <th class="text-end" id="totalCarAfg">0.00</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h4>Parts</h4>
                            </div>
                            <div class="col-6 d-flex flex-row-reverse"><button type="button" onclick="addParts()"
                                    class="btn btn-primary">Add Parts (Alt)</button></div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="product">Parts</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <th width="200px">Customer</th>
                                            <th width="">Description</th>
                                            <th width="">Quantity</th>
                                            <th width="" class="text-center">Amount (PKR)</th>
                                            <th width="" class="text-center">Conversion Rate</th>
                                            <th width="" class="text-center">Amount (AFG)</th>
                                            <th></th>
                                        </thead>
                                        <tbody id="parts_list">

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3" class="text-end">Total</th>
                                                <th class="text-end" id="totalPartsPrice">0.00</th>
                                                <th></th>
                                                <th class="text-end" id="totalPartsAfg">0.00</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-2">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Container #</p>
                                    <h5 class="fs-14 mb-0">{{$purchase->c_no}}</h5>
                                </div>
                                <div class="col-2">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">BL #</p>
                                    <h5 class="fs-14 mb-0">{{$purchase->bl_no}}</h5>
                                </div>
                                <div class="col-2">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Total Cost</p>
                                    <h5 class="fs-14 mb-0">{{number_format($purchase->net_pkr, 0)}}</h5>
                                </div>
                                <div class="col-2">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Total</p>
                                    <h5 class="fs-14 mb-0" id="total">0</h5>
                                </div>
                                <div class="col-2">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Profit / Loose</p>
                                    <h5 class="fs-14 mb-0" id="profit_loose">0</h5>
                                </div>
                            </div>
                        </div>

                       <div class="row">
                        <div class="col-3 mt-2">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" required name="date"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-3 mt-2">
                            <div class="form-group">
                                <label for="other_expenses">Other Expenses</label>
                                <input type="number" step="any" class="form-control" id="other_expenses" oninput="calculateTotal()" name="other_expenses" value="0">
                            </div>
                        </div>
                        <div class="col-6 mt-2">
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <input type="text" class="form-control" required name="notes">
                            </div>
                        </div>

                       </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary w-100">Create Sale</button>
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
@endsection
@section('page-js')
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script>
        var $customers = {!! json_encode($customers) !!};

        $(document).ready(function() {
            // Initialize any existing select elements on page load
            $('select.selectize').selectize();

            $(document).keydown(function(e) {
                if (e.key === 'Tab') {
                    e.preventDefault();
                    addCar();
                }
            });
            
            $(document).keydown(function(e) {
                if (e.key === 'Alt') {
                    e.preventDefault();
                    addParts();
                }
            });
        });
        var car_id = 0;
        var lastSelectedCustomer = '';

        function addCar() {
            // Get the last selected customer if any row exists
            if ($('#cars_list tr').length > 0) {
                lastSelectedCustomer = $('#cars_list tr:last select[name="customer[]"]').val();
            }

            var car_id = Date.now(); // Use timestamp for unique ID
            var options = '';

            // Use Array.prototype.map on the customers array
            if (Array.isArray($customers)) {
                options = $customers.map(function(customer) {
                    var selected = (lastSelectedCustomer && customer.id == lastSelectedCustomer) ? 'selected' : '';
                    return '<option value="' + customer.id + '" ' + selected + '>' + customer.title + ' | ' + customer.currency + '</option>';
                }).join('');
            }

            var $newRow = $('<tr id="row_' + car_id + '">' +
                '<td><select name="customer[]" required id="customer_' + car_id + '">' + options + '</select></td>' +
                '<td><input type="text" name="chassis_no[]" required class="form-control"></td>' +
                '<td><input type="text" name="desc[]" class="form-control"></td>' +
                '<td><input type="number" name="car_price[]" required step="any" id="price_' + car_id +
                '" oninput="coverToAfg(' + car_id + ')")" class="form-control text-center"></td>' +
                '<td><input type="number" name="car_rate[]" value="1" required step="any" id="car_rate_' + car_id +
                '" oninput="coverToAfg(' + car_id + ')")" class="form-control text-center"></td>' +
                '<td><input type="number" name="car_afg[]" required step="any" id="car_afg_' + car_id +
                '" readonly class="form-control text-center"></td>' +
                '<td><input type="text" name="remarks[]" class="form-control"></td>' +
                '<td><span class="btn btn-sm btn-danger" onclick="deleteCar(' + car_id + ')">X</span></td>' +
                '</tr>');

            // Append the new row
            $("#cars_list").append($newRow);

            // Initialize selectize only for the new select element
            $('#customer_' + car_id).selectize({
                create: false,
                sortField: 'text'
            });
        }

        function deleteCar(id) {
            $('#row_' + id).remove();
        }

        function calculateTotal() {

            var totalCarPrice = 0;
            $('#cars_list tr').each(function() {
                var price = parseFloat($(this).find('input[name="car_price[]"]').val());
                if (!isNaN(price)) {
                    totalCarPrice += price;
                }
            });
            $('#totalCarPrice').text(totalCarPrice.toFixed(2));

            var totalCarAfg = 0;
            $('#cars_list tr').each(function() {
                var price = parseFloat($(this).find('input[name="car_afg[]"]').val());
                if (!isNaN(price)) {
                    totalCarAfg += price;
                }
            });
            $('#totalCarAfg').text(totalCarAfg.toFixed(2));

            var totalPartsPrice = 0;
            $('#parts_list tr').each(function() {
                var price = parseFloat($(this).find('input[name="part_price[]"]').val());
                if (!isNaN(price)) {
                    totalPartsPrice += price;
                }
            });
            $('#totalPartsPrice').text(totalPartsPrice.toFixed(2));

            var totalPartsAfg = 0;
            $('#parts_list tr').each(function() {
                var price = parseFloat($(this).find('input[name="part_afg[]"]').val());
                if (!isNaN(price)) {
                    totalPartsAfg += price;
                }
            });
            $('#totalPartsAfg').text(totalPartsAfg.toFixed(2));

            var total = totalCarPrice + totalPartsPrice;
            $('#total').text(total.toFixed(0));
            var other_expenses = parseFloat($('#other_expenses').val());
            var profit_loose = total - ({{$purchase->net_pkr}} + other_expenses);
            $('#profit_loose').text(profit_loose.toFixed(0));

        }


        function coverToAfg(id) {
            var price = parseFloat($('#price_' + id).val());
            var rate = parseFloat($('#car_rate_' + id).val());
            var afg = price * rate;
            $('#car_afg_' + id).val(afg.toFixed(2));

            calculateTotal();
        }

        function addParts() {
            // Get the last selected customer if any row exists
            if ($('#parts_list tr').length > 0) {
                lastSelectedCustomer = $('#parts_list tr:last select[name="customer[]"]').val();
            }

            var part_id = Date.now(); // Use timestamp for unique ID
            var options = '';

            // Use Array.prototype.map on the customers array
            if (Array.isArray($customers)) {
                options = $customers.map(function(customer) {
                    var selected = (lastSelectedCustomer && customer.id == lastSelectedCustomer) ? 'selected' : '';
                    return '<option value="' + customer.id + '" ' + selected + '>' + customer.title + ' | ' + customer.currency +'</option>';
                }).join('');
            }

            var $newRow = $('<tr id="row_' + part_id + '">' +
                '<td><select name="part_customer[]" required id="part_customer_' + part_id + '">' + options + '</select></td>' +
                '<td><input type="text" name="part_desc[]" class="form-control"></td>' +
                '<td><input type="number" name="qty[]" required value="1" class="form-control"></td>' +
                '<td><input type="number" name="part_price[]" required step="any" id="part_price_' + part_id +
                '" oninput="coverToAfgPart(' + part_id + ')")" class="form-control text-center"></td>' +
                '<td><input type="number" name="part_rate[]" value="1" required step="any" id="part_rate_' + part_id +
                '" oninput="coverToAfgPart(' + part_id + ')")" class="form-control text-center"></td>' +
                '<td><input type="number" name="part_afg[]" required step="any" id="part_afg_' + part_id +
                '" readonly class="form-control text-center"></td>' +
                '<td><span class="btn btn-sm btn-danger" onclick="deleteParts(' + part_id + ')">X</span></td>' +
                '</tr>');

            // Append the new row
            $("#parts_list").append($newRow);

            // Initialize selectize only for the new select element
            $('#part_customer_' + part_id).selectize({
                create: false,
                sortField: 'text'
            });
        }

        function coverToAfgPart(id) {
            var price = parseFloat($('#part_price_' + id).val());
            var rate = parseFloat($('#part_rate_' + id).val());
            var afg = price * rate;
            $('#part_afg_' + id).val(afg.toFixed(2));

            calculateTotal();
        }
    </script>
@endsection
