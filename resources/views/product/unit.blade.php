@extends('layout.app')

@section('content')


    @include('product.inc.sidebar')
    <div class="se-pre-con"></div>

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Unit</h3>
                </div>
            </div>
            <div class="collapse my-4" id="collapseExample">
                <div class="card">
                    <div class="card-header border-bottom inputheader">Add Unit</div>
                    <div class="card-body">
                        <form class="form-inline">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="inputCategory" class="sr-only"> Name</label>
                                <input type="text" class="form-control" placeholder="Enter Unit Name" id="unitName">
                                <input type="text" class="form-control d-none" id="inputUnitId">
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
                            <button class="btn btn-primary float-right add"><i class="fa-1x fas fa-plus"></i> Add Unit
                            </button>
                        </div>
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">id</th>
                                    <th scope="col" class="border-0">Name</th>
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
            $(function () {
                table.ajax.reload();
            });
            $(document).on('click', '.add', function () {
                $('.inputheader').html('Add Unit');
                $('#unitName').val('');
                $('#inputUnitId').val('');
                $('.inputButton').html('<div id="inputButton"><button type="button" class="btn btn-primary mb-2 addUnit">Save</button></div>\n');
                $('.collapse').collapse('show');
            });
            $(document).on('click', '.closer', function () {
                $('.collapse').collapse('hide');
            });
            $(document).on('click', '.addUnit', function () {
                let name = $('#unitName').val();
                if (name != '') {
                    $.ajax({
                        url: 'add-unit',
                        type: 'post',
                        data: {_token: CSRF_TOKEN, name: name},
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
                                    title: 'Unit Insert successfully'
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
                            $('#inputPrice').val('');
                            $('#ItemNameId').val('');
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
                ajax: "{{ url('view-unit') }}",
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'created_at'},
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
                            url: "{{ url('delete-unit') }}",
                            type: 'get',
                            data: {id: id,},
                            success: function (response) {
                                if (response == 1) {
                                    table.ajax.reload();
                                    Swal.fire(
                                        'Deleted!',
                                        'This Unit has been deleted.',
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
