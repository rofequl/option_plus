@extends('layout.app')

@section('content')


    @include('purchase.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Purchase Requisition</h3>
                </div>
            </div>
            <div class="row PurchaseRequisitionList">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <div class="input-group col-md-6 col-lg-4 ml-auto">
                                <button class="btn btn-primary AddNewPurchaseRequisition shadow-none ml-auto" id="AddCategory" type="submit">
                                    <i class="material-icons">add</i> Add New
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">id</th>
                                    <th scope="col" class="border-0">Category Name</th>
                                    <th scope="col" class="border-0">Date</th>
                                    <th scope="col" class="border-0">Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row NewPurchaseRequisition" style="display: none">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom text-right">
                            go back
                        </div>
                        <div class="card-body p-0 text-center">
                            <form>
                                <div class="row p-3">
                                    <div class="col-7">
                                        <div class="row">
                                            <div class="col-4 text-right">Supplier</div>
                                            <div class="col-4">
                                                <select class="selectpicker border rounded" id="SelectSupplier" data-live-search="true">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-4 text-right">Select Warehouse</div>
                                            <div class="col-4">
                                                <select class="selectpicker border rounded" id="SelectWarehouse" data-live-search="true">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-4 text-right">Select Country</div>
                                            <div class="col-4">
                                                <select class="selectpicker border rounded" id="SelectCountry" data-live-search="true">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="col-6 text-right">Purchase Requisition No.</div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" value="CPR0004584" readonly>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6 text-right">Current Date</div>
                                            <div class="col-6">
                                                <input type="text" class="input-sm form-control" name="start" placeholder="Start Date" id="datepicker">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table mb-0 mt-4">
                                    <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="border-0">#</th>
                                        <th scope="col" class="border-0">Product Code</th>
                                        <th scope="col" class="border-0">Select Product</th>
                                        <th scope="col" class="border-0">Price</th>
                                        <th scope="col" class="border-0">Quantity</th>
                                        <th scope="col" class="border-0">VAT</th>
                                        <th scope="col" class="border-0">TAX</th>
                                        <th scope="col" class="border-0">Discount</th>
                                        <th scope="col" class="border-0">AIT</th>
                                        <th scope="col" class="border-0">Total Amount</th>
                                        <th scope="col" class="border-0">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="AddPurchaseDiv">
                                    <tr>
                                        <td class="Sl">1</td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><select id="SelectProduct1" class="selectpicker form-control border rounded"
                                                    data-live-search="true">
                                            </select></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="row mt-5 m-0 p-3">
                                    <div class="col-6">
                                        <div class="row">
                                            <button type="button" class="btn btn-primary AddProduct float-left">Add New
                                                Product
                                            </button>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-3 text-right">Remarks</div>
                                            <div class="col-5">
                                                <textarea class="form-control">

                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6 text-right">
                                                Subtotal:
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6 text-right">
                                                Freight:
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6 text-right">
                                                Total:
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6 text-right">
                                            </div>
                                            <div class="col-6">
                                                <button class="btn btn-primary float-left px-5 mr-2">Save</button>
                                                <button class="btn btn-secondary float-left px-4">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {
            $(document).on('click', '.AddNewPurchaseRequisition', function () {
                AddPurchaseRequisition();
            });
            $(document).on('click', '.AddProduct', function () {
                let count = parseInt($( ".AddPurchaseDiv tr .Sl").last().text()) + 1;
                let product = '<tr class="AddPurchaseTr'+count+'">\n' +
                    '                                        <td class="Sl">'+count+'</td>\n' +
                    '                                        <td><input type="text" class="form-control"></td>\n' +
                    '                                        <td><select id="SelectProduct'+count+'" class="selectpicker form-control border rounded"\n' +
                    '                                                    data-live-search="true">\n' +
                    '                                            </select></td>\n' +
                    '                                        <td><input type="text" class="form-control"></td>\n' +
                    '                                        <td><input type="text" class="form-control"></td>\n' +
                    '                                        <td><input type="text" class="form-control"></td>\n' +
                    '                                        <td><input type="text" class="form-control"></td>\n' +
                    '                                        <td><input type="text" class="form-control"></td>\n' +
                    '                                        <td><input type="text" class="form-control"></td>\n' +
                    '                                        <td><input type="text" class="form-control"></td>\n' +
                    '                                        <td><button type="button" class="btn btn-danger shadow-none px-2" onclick="AddPurchaseDivRemove(\'AddPurchaseTr'+count+'\')" title="Remove Input"><i class="fas fa-1x fa-minus-circle"></i></button></td>\n' +
                    '                                    </tr>';
                $(".AddPurchaseDiv").append(product);
                AddSelectProduct('SelectProduct'+count);
            });
            $('#SelectWarehouse').change(function () {
                let id = $(this).val();
                $.ajax({
                    url: "{{ route('view.edit.warehouses') }}",
                    type: 'get',
                    data: {id: id},
                    dataType: 'json',
                    success: function (data) {
                        $('#SelectCountry').val(data.country);
                        $('#SelectCountry').selectpicker('refresh');
                    }
                });
            });
            $( function() {
                $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).datepicker("setDate", new Date()).val();
            });
        });

        function AddPurchaseRequisition() {
            $('.PurchaseRequisitionList').hide();
            $('.NewPurchaseRequisition').show();
            AddSelectProduct('SelectProduct1');
            AddSelectsupplier('SelectSupplier');
            AddSelectCountry('SelectCountry');
            AddSelectWarehouse('SelectWarehouse');

        }

        function AddSelectProduct(clas) {
            $.ajax({
                url: "{{ route('all.product.list.select') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN},
                dataType: 'json',
                success: function (data) {
                    $('#'+clas).html('');
                    $('#'+clas).append('<option value="" hidden selected disabled>Please select</option>');
                    data.forEach(function (element) {
                        $('#'+clas).append($('<option>', {value: element.id, text: element.item_name}));
                    });
                    $('#'+clas).selectpicker('refresh');
                }
            });
        }

        function AddSelectsupplier(clas) {
            $.ajax({
                url: "{{ route('all.supplier.list.select') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN},
                dataType: 'json',
                success: function (data) {
                    $('#'+clas).html('');
                    $('#'+clas).append('<option value="" hidden selected disabled>Please select</option>');
                    data.forEach(function (element) {
                        $('#'+clas).append($('<option>', {value: element.id, text: element.company_name}));
                    });
                    $('#'+clas).selectpicker('refresh');
                }
            });
        }

        function AddSelectCountry(clas) {
            $.ajax({
                url: "{{ route('country.list.select') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN},
                dataType: 'json',
                success: function (data) {
                    $('#'+clas).html('');
                    $('#'+clas).append('<option value="" hidden selected disabled>Please select</option>');
                    data.forEach(function (element) {
                        $('#'+clas).append($('<option>', {value: element.id, text: element.name}));
                    });
                    $('#'+clas).selectpicker('refresh');
                }
            });
        }

        function AddSelectWarehouse(clas) {
            $.ajax({
                url: "{{ route('all.warehouses.list.select') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN},
                dataType: 'json',
                success: function (data) {
                    $('#'+clas).html('');
                    data.forEach(function (element) {
                        $('#'+clas).append('<option value="" hidden selected disabled>Please select</option>');
                        $('#'+clas).append($('<option>', {value: element.id, text: element.name}));
                    });
                    $('#'+clas).selectpicker('refresh');
                }
            });
        }

        function AddPurchaseDivRemove(data) {
            $('.'+data).remove();
        }
    </script>

@endsection
