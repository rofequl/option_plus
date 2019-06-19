@extends('layout.app')

@section('content')


    @include('purchase.inc.sidebar')
    <div class="se-pre-con"></div>

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Purchase Invoice</h3>
                </div>
            </div>
            <div class="collapse my-4" id="collapseExample">
                <div class="card">
                    <div class="card-header border-bottom inputheader">Add Purchase Invoice</div>
                    <div class="card-body">
                        <form class="form-inline">
                            <div class="form-group mx-sm-3 mb-2">
                                <select class="selectpicker border rounded float-right" id="InputPurchaseType">
                                    <option value="0">Choose No.</option>
                                    <option value="1">Purchase Requisition</option>
                                    <option value="2">Purchase Order</option>
                                </select>
                            </div>
                            <div id="InputPurchaseRequisition" class="form-group mx-sm-3 mb-2" style="display: none">
                                <select class="selectpicker border rounded float-right" id="InputRequisitionType">
                                    <option value="0">Choose Requisition</option>
                                </select>
                            </div>
                            <div id="InputPurchaseOrder" class="form-group mx-sm-3 mb-2" style="display: none">
                                <select class="selectpicker border rounded float-right" id="InputOrderType">
                                    <option value="0">Choose Order</option>
                                </select>
                            </div>
                            <div class="inputButton">
                                <button type="button" class="btn btn-primary mb-2 AddPurchaseInvoice">Save</button>
                            </div>
                            <button type="button" class="btn btn-success mx-3 mb-2 closer">Close</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <button class="btn btn-primary float-right add"><i class="fa-1x fas fa-plus"></i> Add
                                Invoice
                            </button>
                        </div>
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">Sl.</th>
                                    <th scope="col" class="border-0">Invoice No</th>
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
        </div>
    </main>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function () {

            $('#InputPurchaseType').change(function () {
                let id = $(this).val();
                if (id==1){
                    $.ajax({
                        url: "{{ url('requisition-select') }}",
                        type: 'post',
                        data: {_token: CSRF_TOKEN, id: id},
                        dataType: 'json',
                        success: function (data) {
                            data.forEach(function (element) {
                                $('#InputRequisitionType').html('');
                                $('#InputRequisitionType').append('<option value="" hidden selected disabled>Please select</option>');
                                $('#InputRequisitionType').append($('<option>', {value: element.id, text: element.requisition_no}));
                            });
                            $('#InputRequisitionType').selectpicker('refresh');
                        }
                    });
                    $('#InputPurchaseRequisition').show();
                    $('#InputPurchaseOrder').hide();
                }else if (id==2){
                    $.ajax({
                        url: "{{ url('order-select') }}",
                        type: 'post',
                        data: {_token: CSRF_TOKEN, id: id},
                        dataType: 'json',
                        success: function (data) {
                            data.forEach(function (element) {
                                $('#InputOrderType').html('');
                                $('#InputOrderType').append('<option value="" hidden selected disabled>Please select</option>');
                                $('#InputOrderType').append($('<option>', {value: element.id, text: element.order_no}));
                            });
                            $('#InputOrderType').selectpicker('refresh');
                        }
                    });
                    $('#InputPurchaseOrder').show();
                    $('#InputPurchaseRequisition').hide();
                }else {
                    $('#InputPurchaseRequisition').hide();
                    $('#InputPurchaseOrder').hide();
                }
            });


            $(function () {
                table.ajax.reload();
            });
            $(document).on('click', '.add', function () {
                $('#InputPurchaseType').val(0);
                $('#InputRequisitionType').val(0);
                $('.selectpicker').selectpicker('refresh');
                $('#InputPurchaseRequisition').hide();
                $('#InputPurchaseOrder').hide();
                $('.collapse').collapse('show');
            });
            $(document).on('click', '.closer', function () {
                $('.collapse').collapse('hide');
            });
            $(document).on('click', '.AddPurchaseInvoice', function () {
                let type = $('#InputPurchaseType').val(), value;
                let requisition = $('#InputPurchaseType').val();
                if (type==1 || type==2){
                    if (type==1){value = 0;} else {value = 1;}
                    $.ajax({
                        url: '{{route('add.purchase.invoice')}}',
                        type: 'post',
                        data: {_token: CSRF_TOKEN, value: value, requisition: requisition},
                        success: function (response) {
                            console.log(response);
                        }
                    });
                }else {

                }

            });
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('view.purchase.invoice') }}",
                columns: [
                    {data: 'id'},
                    {data: 'invoice_no'},
                    {data: 'supplier'},
                    {data: 'warehouse'},
                    {data: 'total'},
                    {data: 'date'},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });
            $(document).on('click', '.delete', function () {
                let id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    animation: false,
                    customClass: 'animated bounceInDown'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('delete-unit') }}",
                            type: 'get',
                            data: {id: id,},
                            success: function (response) {
                                if (response == 1) {
                                    table.ajax.reload();
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Deleted',
                                        text: 'This Unit has been deleted.',
                                        animation: false,
                                        customClass: 'animated tada'
                                    })
                                } else {
                                    Swal.fire(
                                        'Deleted!',
                                        'Something Wrong',
                                        'error'
                                    )
                                }

                            }
                        });
                    }
                })
            });
            $(document).on('click', '.edit', function () {
                $('.collapse').collapse('show');
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ url('view-edit-unit') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (data) {
                        $('.inputheader').html('Update Unit Name');
                        $('#unitName').val(data.name);
                        $('#inputUnitId').val(data.id);
                        $('.inputButton').html('<div id="inputButton"><button type="button" class="btn btn-primary mb-2 UpdateUnit">Update</button></div>\n');
                    }
                });
            });

            $(document).on('click', '.UpdateUnit', function () {
                event.preventDefault();
                $('.collapse').collapse('show');
                let name = $('#unitName').val(),
                    id = $('#inputUnitId').val();
                if (name != '') {
                    $.ajax({
                        url: "{{ url('update-unit') }}",
                        type: 'post',
                        data: {_token: CSRF_TOKEN, name: name, id: id},
                        success: function (data) {
                            if (data == 1) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                Toast.fire({
                                    type: 'success',
                                    title: 'Unit Name Update successfully'
                                })
                                $('.collapse').collapse('hide');
                                table.ajax.reload();
                            } else {
                                Swal.fire(
                                    response,
                                    'Something wrong, please contact administrator.',
                                    'error'
                                )
                            }
                        }
                    });
                } else {
                    Swal.fire('Input field empty')
                }
            });

        });
    </script>

@endsection
