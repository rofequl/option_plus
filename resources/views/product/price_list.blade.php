@extends('layout.app')

@section('content')


    @include('product.inc.sidebar')
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-right"></i>
        </div>
        <div class="sidebar-header p-1 px-2">
            <h3 id="InputHeader">Product price set</h3>
        </div>
        <hr class="my-0">

        <form method="post" id="upload_form" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="p-3 h-100 overflow-auto">
                <input type="hidden" id="priceId" name="priceId">
                <div class="row my-3">
                    <div class="col-6">
                        <select class="selectpicker border rounded form-control" name="CountryId" id="CountryId"
                                data-live-search="true">
                            <option value="">Select Contry</option>
                            @foreach($country as $countries)
                                <option value="{{ $countries->id }}">{{ $countries->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <select class="selectpicker border rounded form-control" name="ItemId" id="ItemId"
                                data-live-search="true">
                            <option value="">Select Item</option>
                            @foreach($item as $items)
                                <option value="{{ $items->id }}">{{ $items->item_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row px-0 mx-0 my-2">
                    <div class="input-group input-group-seamless">
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="">
                        <span class="input-group-append">
                              <span class="input-group-text" id="currency">
                                $
                              </span>
                            </span>
                    </div>
                </div>
                <div class="row px-0 mx-0 my-2">
                    <div class="col-6 pl-0">
                        <div class="input-group input-group-seamless">
                            <input type="text" class="form-control" id="vat" name="vat" placeholder="VAT" value="">
                            <span class="input-group-append">
                              <span class="input-group-text">
                                %
                              </span>
                            </span>
                        </div>
                    </div>
                    <div class="col-6 pr-0">
                        <div class="input-group mb-3">
                            <div class="input-group input-group-seamless">
                                <input type="text" class="form-control" id="tax" name="tax" placeholder="TAX" value="">
                                <span class="input-group-append">
                              <span class="input-group-text">
                                %
                              </span>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row px-0 mx-0 my-2">
                    <div class="col-6 pl-0">
                        <div class="input-group input-group-seamless">
                            <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" value="">
                            <span class="input-group-append">
                              <span class="input-group-text">
                                %
                              </span>
                            </span>
                        </div>
                    </div>
                    <div class="col-6 pr-0">
                        <div class="input-group mb-3">
                            <div class="input-group input-group-seamless">
                                <input type="text" class="form-control" id="ait" name="ait" placeholder="AIT" value="">
                                <span class="input-group-append">
                              <span class="input-group-text">
                                %
                              </span>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row border-top" id="InputButton">
                <button type="submit" class="btn btn-primary w-75 mx-auto mt-4 addProduct">Save</button>
            </div>
        </form>
    </nav>

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Product Price</h3>
                </div>
            </div>
            <div class="collapse my-4" id="collapseExample">
                <div class="card">
                    <div class="card-header border-bottom inputheader">Add Product Price</div>
                    <div class="card-body">
                        <form class="form-inline">
                            <select class="selectpicker border rounded" id="ItemNameId" data-live-search="true">
                                <option value="">Select Item</option>
                                @foreach($item as $items)
                                    <option value="{{ $items->id }}">{{ $items->item_name}}</option>
                                @endforeach
                            </select>
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="inputCategory" class="sr-only">Category Name</label>
                                <input type="text" class="form-control" id="inputPrice">
                                <input type="text" class="form-control d-none" id="inputpriceId">
                            </div>
                            <div class="inputButton">
                                <button type="button" class="btn btn-primary mb-2 UpdateCategory">Update</button>
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
                            <button id="sidebarCollapse" class="btn btn-primary float-right"><i class="fa-1x fas fa-plus"></i> Add Price
                            </button>
                        </div>
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">id</th>
                                    <th scope="col" class="border-0">Country</th>
                                    <th scope="col" class="border-0">Product Name</th>
                                    <th scope="col" class="border-0">Price</th>
                                    <th scope="col" class="border-0">VAT</th>
                                    <th scope="col" class="border-0">TAX</th>
                                    <th scope="col" class="border-0">Discount</th>
                                    <th scope="col" class="border-0">AIT</th>
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
            $(function () {
                table.ajax.reload();
            });
            $('#sidebarCollapse').on('click', function () {
                input();
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                $('#InputHeader').html('Insert Item Price');
            });
            $('#CountryId').change(function () {
                let id = $(this).val();
                $.ajax({
                    url: "{{ url('currency-country-id') }}",
                    type: 'post',
                    data: {_token: CSRF_TOKEN, id: id},
                    success: function (data) {
                        $('#currency').html(data);

                    }
                });
            });
            $('#upload_form').on('submit', function () {
                event.preventDefault();
                let country = $('#CountryId').val();
                let item = $('#ItemId').val();
                let price = $('#price').val();
                let vat = $('#vat').val();
                let tax = $('#tax').val();
                let discount = $('#discount').val();
                let ait = $('#ait').val();
                if (country == '' && item == '' && price == '' && vat == '' && tax == ''  && discount == '' && ait == '') {
                    Swal.fire('Input field empty');
                } else {
                    if(isNaN(price) || isNaN(vat)){
                        Swal.fire('not number');
                    }else{
                        $.ajax({
                            url: "{{ url('add-price-list') }}",
                            method: "POST",
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: new FormData(this),
                            success: function (data) {
                                if(data == 1){
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Insert',
                                        text: 'This Product add Successfully',
                                        animation: false,
                                        customClass: 'animated tada'
                                    });
                                }else{
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Insert',
                                        text: 'This Product add Successfully',
                                        animation: false,
                                        customClass: 'animated tada'
                                    });
                                }

                                table.ajax.reload();
                                $('#sidebar').removeClass('active');
                                $('.overlay').removeClass('active');
                            }

                        });
                    }
                }
            });
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('view-price-list') }}",
                columns: [
                    {data: 'id'},
                    {data: 'country'},
                    {data: 'item'},
                    {data: 'price'},
                    {data: 'vat'},
                    {data: 'tax'},
                    {data: 'discount'},
                    {data: 'ait'},
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
                    animation: false,
                    customClass: 'animated tada',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('delete-price-list') }}",
                            type: 'get',
                            data: {id: id,},
                            success: function (response) {
                                if (response == 1) {
                                    table.ajax.reload();
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Deleted',
                                        text: 'This Price List has been deleted.',
                                        animation: false,
                                        customClass: 'animated tada'
                                    })
                                } else {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Deleted',
                                        text: 'Something Wrong',
                                        animation: false,
                                        customClass: 'animated jello'
                                    })
                                }

                            }
                        });
                    }
                })
            });
            $(document).on('click', '.edit', function () {

                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ url('view-edit-price-list') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (data) {
                        $('#sidebar').addClass('active');
                        $('.overlay').addClass('active');
                        $('.collapse.in').toggleClass('in');
                        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                        $('#InputHeader').html('Update Item Price');
                        input(data.country,data.item,data.price,data.vat,data.tax,data.discount,data.ait);
                    }
                });
            });
            
            function input(data='',data1='',data2='',data3='',data4='',data5='',data6='') {
                $('#CountryId').val(data);
                $('#ItemId').val(data1);
                $('#price').val(data2);
                $('#vat').val(data3);
                $('#tax').val(data4);
                $('#discount').val(data5);
                $('#ait').val(data6);
                $('.selectpicker').selectpicker('refresh');
            }
            
        });
    </script>

@endsection
