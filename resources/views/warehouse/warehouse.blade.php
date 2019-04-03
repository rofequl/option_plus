@extends('layout.app')

@section('content')


    @include('expenses.inc.sidebar')
    <div class="se-pre-con"></div>

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Warehouse</h3>
                </div>
            </div>
            <div class="collapse my-4" id="collapseExample">
                <div class="card">
                    <div class="card-header border-bottom inputheader">Add Warehouse</div>
                    <div class="card-body">
                        <div class="form-inline">
                            <div class="form-group mx-sm-3 mb-2" style="width: 25%">
                                <label for="inputCategory" class="sr-only"></label>
                                <input type="text" class="form-control w-100" placeholder="Enter Warehouse Name"
                                       id="WarehouseName">
                            </div>
                            <div class="form-group mx-sm-3 mb-2" style="width: 25%">
                                <label for="inputCategory" class="sr-only"></label>
                                <input type="text" class="form-control w-100" placeholder="Enter Warehouse Phone number"
                                       id="WarehousePhone">
                            </div>
                            <div class="form-group mx-sm-3 mb-2" style="width: 25%">
                                <label for="inputCategory" class="sr-only"></label>
                                <input type="text" class="form-control w-100" placeholder="Enter Warehouse Email Id"
                                       id="WarehouseEmail">
                            </div>
                        </div>
                        <div class="form-inline">
                            <div class="form-group mx-sm-3 mb-2" style="width: 25%">
                                <select class="selectpicker border rounded form-control" name="CountryId" id="CountryId"
                                        data-live-search="true">
                                    <option value="">Select Contry</option>
                                    @foreach($country as $countries)
                                        <option value="{{ $countries->id }}">{{ $countries->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mx-sm-3 mb-2" style="width: 37%">
                                <label for="inputCategory" class="sr-only"></label>
                                <textarea placeholder="Enter Warehouse Address" class="form-control w-100"
                                          id="WarehouseAddress" rows="3"></textarea>
                            </div>
                            <input type="text" class="form-control d-none" id="inputWarehouseId">
                            <div class="inputButton">
                                <button type="button" class="btn btn-primary mb-2 UpdateExpenses">Update</button>
                            </div>
                            <button type="button" class="btn btn-success mx-3 mb-2 closer">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <button class="btn btn-primary float-right add"><i class="fa-1x fas fa-plus"></i> Add
                                Warehouse
                            </button>
                        </div>
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">id</th>
                                    <th scope="col" class="border-0">Warehouse Id</th>
                                    <th scope="col" class="border-0">Name</th>
                                    <th scope="col" class="border-0">Phone</th>
                                    <th scope="col" class="border-0">Email</th>
                                    <th scope="col" class="border-0">Country</th>
                                    <th scope="col" class="border-0">Address</th>
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

            function clear() {
                $('#WarehouseName').val('');
                $('#WarehousePhone').val('');
                $('#WarehouseEmail').val('');
                $('#WarehouseAddress').val('');
                $('#inputWarehouseId').val('');
            }

            $(document).on('click', '.add', function () {
                clear();
                $('.inputheader').html('Add Warehouse');
                $('.inputButton').html('<div id="inputButton"><button type="button" class="btn btn-primary mb-2 addWarehouse">Save</button></div>\n');
                $('.collapse').collapse('show');
            });
            $(document).on('click', '.closer', function () {
                clear();
                $('.collapse').collapse('hide');
            });
            $(document).on('click', '.addWarehouse', function () {
                let name = $('#WarehouseName').val(),
                    phone = $('#WarehousePhone').val(),
                    email = $('#WarehouseEmail').val(),
                    country = $('#CountryId').val(),
                    address = $('#WarehouseAddress').val();
                if (name != '' && phone != '' && email != '' && address != '' && country != '') {
                    $.ajax({
                        url: 'add-warehouses',
                        type: 'post',
                        data: {
                            _token: CSRF_TOKEN,
                            name: name,
                            phone: phone,
                            email: email,
                            address: address,
                            country: country
                        },
                        success: function (response) {
                            if (response == 1) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });

                                Toast.fire({
                                    type: 'success',
                                    title: 'New warehouse add successfully'
                                })
                                table.ajax.reload();
                            } else if (response == 0) {
                                Swal.fire(
                                    'This name already use',
                                    '',
                                    'warning'
                                )
                            } else {
                                Swal.fire(
                                    response,
                                    'Something wrong, please contact administrator.',
                                    'error'
                                )
                            }
                            clear();
                            $('.collapse').collapse('hide');
                        }
                    });
                } else {
                    Swal.fire('Input field empty')
                }
            });
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('view.warehouses') }}",
                columns: [
                    {data: 'id'},
                    {data: 'warehouse_id'},
                    {data: 'name'},
                    {data: 'phone'},
                    {data: 'email'},
                    {data: 'country'},
                    {data: 'address'},
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
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ route('delete.warehouses') }}",
                            type: 'get',
                            data: {id: id,},
                            success: function (response) {
                                if (response == 1) {
                                    table.ajax.reload();
                                    Swal.fire(
                                        'Deleted!',
                                        'This Warehouse has been deleted.',
                                        'success'
                                    )
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
                    url: "{{ route('view.edit.warehouses') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (data) {
                        $('.inputheader').html('Update Warehouse Information');
                        $('#WarehouseName').val(data.name);
                        $('#WarehousePhone').val(data.phone);
                        $('#WarehouseEmail').val(data.email);
                        $('#WarehouseAddress').val(data.address);
                        $('#inputWarehouseId').val(data.id);
                        $('#CountryId').val(data.country);
                        $('.selectpicker').selectpicker('refresh');
                        $('.inputButton').html('<div id="inputButton"><button type="button" class="btn btn-primary mb-2 UpdateWarehouse">Update</button></div>\n');
                    }
                });
            });

            $(document).on('click', '.UpdateWarehouse', function () {
                let name = $('#WarehouseName').val(),
                    phone = $('#WarehousePhone').val(),
                    email = $('#WarehouseEmail').val(),
                    address = $('#WarehouseAddress').val(),
                    country = $('#CountryId').val(),
                    id = $('#inputWarehouseId').val();
                if (name != '' && phone != '' && email != '' && address != '' && country != '') {
                    $.ajax({
                        url: "{{route('update.warehouses')}}",
                        type: 'post',
                        data: {_token: CSRF_TOKEN, name: name, phone: phone, email: email,country: country, address: address, id: id},
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
                                    title: 'Warehouse Information Update successfully'
                                })
                                $('.collapse').collapse('hide');
                                clear();
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
