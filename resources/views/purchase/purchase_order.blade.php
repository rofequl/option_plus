@extends('layout.app')

@section('content')


    @include('purchase.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Purchase Order</h3>
                </div>
            </div>
            <div class="row PurchaseRequisitionList">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <div class="input-group col-md-6 col-lg-4 ml-auto">
                                <button class="btn btn-primary AddNewPurchaseRequisition shadow-none ml-auto"
                                        id="AddCategory" type="submit">
                                    <i class="material-icons">add</i> Add New
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table table123 mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">Sl.</th>
                                    <th scope="col" class="border-0">Order No</th>
                                    <th scope="col" class="border-0">Supplier Name</th>
                                    <th scope="col" class="border-0">Warehouse</th>
                                    <th scope="col" class="border-0">Total Amount</th>
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
                            <i class="fas fa-hand-point-left"></i> Go back
                        </div>
                        <div class="card-body p-0 text-center">
                            <form method="post" id="upload_form" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row p-3">
                                    <div class="col-7">
                                        <div class="row">
                                            <div class="col-4 text-right">Supplier</div>
                                            <div class="col-4">
                                                <select class="selectpicker border rounded" name="supplier" id="SelectSupplier"
                                                        data-live-search="true">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-4 text-right">Select Warehouse</div>
                                            <div class="col-4">
                                                <select class="selectpicker border rounded" name="wearehouse" id="SelectWarehouse"
                                                        data-live-search="true">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-4 text-right">Select Country</div>
                                            <div class="col-4">
                                                <select class="selectpicker border rounded" name="country" id="SelectCountry"
                                                        data-live-search="true">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="col-6 text-right">Purchase Order No.</div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" name="requisition" value="" readonly>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6 text-right">Current Date</div>
                                            <div class="col-6">
                                                <input type="text" class="input-sm form-control" name="date"
                                                       placeholder="Start Date" id="datepicker">
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
                                        <td><input type="text" name="product_code[]" class="form-control"></td>
                                        <td><select id="SelectProduct1" name="product[]" class="selectpicker form-control border rounded"
                                                    onchange="SelectProduct(this)"
                                                    data-live-search="true">
                                            </select></td>
                                        <td><input id="ProductPrice1" name="price[]" type="text" class="form-control ProductEdit"></td>
                                        <td><input id="ProductQuantity1" name="quantity[]" type="text" class="form-control ProductEdit">
                                        </td>
                                        <td><input id="ProductVAT1" type="text" name="vat[]" class="form-control ProductEdit"></td>
                                        <td><input id="ProductTAX1" type="text" name="tax[]" class="form-control ProductEdit"></td>
                                        <td><input id="ProductDiscount1" type="text" name="discount[]" class="form-control ProductEdit">
                                        </td>
                                        <td><input id="ProductAIT1" type="text" name="ait[]" class="form-control ProductEdit"></td>
                                        <td><input id="ProductTotal1" type="text" name="prototal[]" class="form-control" readonly></td>
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
                                                <textarea name="remarks" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6 text-right">
                                                Subtotal:
                                            </div>
                                            <div class="col-6">
                                                <input id="SubTotal" name="subtotal" type="text" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6 text-right">
                                                Freight:
                                            </div>
                                            <div class="col-6">
                                                <input id="PurchaseFright" name="freight" type="text" class="form-control ProductEdit">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6 text-right">
                                                Total:
                                            </div>
                                            <div class="col-6">
                                                <input id="PurchaseTotal" name="total" type="text" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6 text-right">
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-primary float-left px-5 mr-2">Save</button>
                                                <button type="button" class="btn btn-secondary float-left px-4 RemoveNewPurchaseRequisition">Close</button>
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

            $(document).on('click', '.RemoveNewPurchaseRequisition', function () {
                RemovePurchaseRequisition();
            });

            $(function () {
                table.ajax.reload();
            });
            let table = $('.table123').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('view.purchase.order')}}",
                columns: [
                    {data: 'id'},
                    {data: 'order_no'},
                    {data: 'supplier'},
                    {data: 'warehouse'},
                    {data: 'total'},
                    {data: 'date'},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });

            $(document).on('click', '.AddProduct', function () {
                let count = parseInt($(".AddPurchaseDiv tr .Sl").last().text()) + 1;
                let product = '<tr class="AddPurchaseTr' + count + '">\n' +
                    '                                        <td class="Sl">' + count + '</td>\n' +
                    '                                        <td><input type="text" name="product_code[]" class="form-control"></td>\n' +
                    '                                        <td><select name="product[]"  id="SelectProduct' + count + '" class="selectpicker form-control border rounded SelectProduct"\n' +
                    '                                                    data-live-search="true" onchange="SelectProduct(this)">\n' +
                    '                                            </select></td>\n' +
                    '                                        <td><input name="price[]" id="ProductPrice' + count + '" type="text" class="form-control ProductEdit"></td>\n' +
                    '                                        <td><input name="quantity[]" id="ProductQuantity' + count + '" type="text" class="form-control ProductEdit"></td>\n' +
                    '                                        <td><input name="vat[]" id="ProductVAT' + count + '" type="text" class="form-control ProductEdit"></td>\n' +
                    '                                        <td><input name="tax[]" id="ProductTAX' + count + '" type="text" class="form-control ProductEdit"></td>\n' +
                    '                                        <td><input name="discount[]" id="ProductDiscount' + count + '" type="text" class="form-control ProductEdit"></td>\n' +
                    '                                        <td><input name="ait[]" id="ProductAIT' + count + '" type="text" class="form-control ProductEdit"></td>\n' +
                    '                                        <td><input name="prototal[]" id="ProductTotal' + count + '" type="text" class="form-control" readonly></td>\n' +
                    '                                        <td><button type="button" class="btn btn-danger shadow-none px-2" onclick="AddPurchaseDivRemove(\'AddPurchaseTr' + count + '\')" title="Remove Input"><i class="fas fa-1x fa-minus-circle"></i></button></td>\n' +
                    '                                    </tr>';
                $(".AddPurchaseDiv").append(product);

                AddSelectProduct('SelectProduct' + count);
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
            $(function () {
                $("#datepicker").datepicker({dateFormat: 'yy-mm-dd'}).datepicker("setDate", new Date()).val();
            });

            $('#upload_form').on('submit', function () {
                event.preventDefault();
                $.ajax({
                    url: "{{route('add.purchase.order')}}",
                    method: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    success: function (data) {
                        RemovePurchaseRequisition();
                    }

                })
            });

        });

        $(document).on('keyup', '.ProductEdit', function () {
            if (/\D/g.test(this.value))
                this.value = this.value.replace(/\D/g, '');
            calculation();
        });

        function RemovePurchaseRequisition() {
            $('.NewPurchaseRequisition').hide("slow");
            $('.PurchaseRequisitionList').show("slow");
            table.ajax.reload();
        }

        function AddPurchaseRequisition() {
            $('.PurchaseRequisitionList').hide( "slow" );
            $('.NewPurchaseRequisition').show("slow");
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
                    $('#' + clas).html('');
                    $('#' + clas).append('<option value="" hidden selected disabled>Please select</option>');
                    data.forEach(function (element) {
                        $('#' + clas).append($('<option>', {value: element.id, text: element.item_name}));
                    });
                    $('#' + clas).selectpicker('refresh');
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
                    $('#' + clas).html('');
                    $('#' + clas).append('<option value="" hidden selected disabled>Please select</option>');
                    data.forEach(function (element) {
                        $('#' + clas).append($('<option>', {value: element.id, text: element.company_name}));
                    });
                    $('#' + clas).selectpicker('refresh');
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
                    $('#' + clas).html('');
                    $('#' + clas).append('<option value="" hidden selected disabled>Please select</option>');
                    data.forEach(function (element) {
                        $('#' + clas).append($('<option>', {value: element.id, text: element.name}));
                    });
                    $('#' + clas).selectpicker('refresh');
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
                    $('#' + clas).html('');
                    data.forEach(function (element) {
                        $('#' + clas).append('<option value="" hidden selected disabled>Please select</option>');
                        $('#' + clas).append($('<option>', {value: element.id, text: element.name}));
                    });
                    $('#' + clas).selectpicker('refresh');
                }
            });
        }

        function AddPurchaseDivRemove(data) {
            $('.' + data).remove();
            calculation();
        }

        function SelectProduct(select) {
            let productId = $(select).val(), countryId = $('#SelectCountry').val(), id = $(select).attr('id');
            id = remove_character('SelectProduct', id);
            if (countryId == null) {
                Swal.fire({
                    type: 'warning',
                    title: 'Error',
                    text: 'Select your country',
                    animation: false,
                    customClass: 'animated tada'
                });
                $(select).val('');
                $(select).selectpicker('refresh');
                return;
            }
            $.ajax({
                url: "{{ route('all.product.price.list.select') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN, productId: productId, countryId: countryId},
                dataType: 'json',
                success: function (data) {
                    if (data.status == 5) {
                        $('#ProductPrice' + id).val(0).prop('readonly', false);
                        $('#ProductQuantity' + id).val(1);
                        $('#ProductVAT' + id).val(0).prop('readonly', false);
                        $('#ProductTAX' + id).val(0).prop('readonly', false);
                        $('#ProductDiscount' + id).val(0).prop('readonly', false);
                        $('#ProductAIT' + id).val(0).prop('readonly', false);
                    } else {
                        $('#ProductPrice' + id).val(data.price).prop('readonly', true);
                        $('#ProductQuantity' + id).val(1);
                        $('#ProductVAT' + id).val(data.vat).prop('readonly', true);
                        $('#ProductTAX' + id).val(data.tax).prop('readonly', true);
                        $('#ProductDiscount' + id).val(data.discount).prop('readonly', true);
                        $('#ProductAIT' + id).val(data.ait).prop('readonly', true);
                    }
                    calculation();
                }
            });
        }

        function calculation() {
            let AllClass = $(".AddPurchaseDiv tr .Sl"), subtotal = 0;
            for (let i = 0; i < AllClass.length; i++) {
                let id = parseInt($(AllClass[i]).text());
                productId = $('#SelectProduct' + id).val();
                if (productId != null) {
                    let price = $("#ProductPrice" + id).val() * $("#ProductQuantity" + id).val();
                    price += (price * $("#ProductVAT" + id).val()) / 100;
                    price -= (price * $("#ProductDiscount" + id).val()) / 100;
                    price += (price * $("#ProductTAX" + id).val()) / 100;
                    price += (price * $("#ProductAIT" + id).val()) / 100;
                    subtotal += Math.trunc(price);
                    $("#ProductTotal" + id).val(Math.trunc(price));
                }
            }
            $('#SubTotal').val(subtotal);
            subtotal += +$("#PurchaseFright").val();
            $('#PurchaseTotal').val(subtotal);
        }

        function remove_character(str_to_remove, str) {
            let reg = new RegExp(str_to_remove)
            return str.replace(reg, '')
        }

    </script>

@endsection
