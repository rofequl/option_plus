@extends('layout.app')

@section('content')


    @include('product.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Category</h3>
                </div>
            </div>
            <div class="collapse my-4" id="collapseExample">
                <div class="card">
                    <div class="card-header border-bottom">Update Category</div>
                    <div class="card-body">
                        <form class="form-inline">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="inputCategory" class="sr-only">Category Name</label>
                                <input type="text" class="form-control" id="inputCategory">
                                <input type="text" class="form-control d-none" id="inputCategoryId">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2 UpdateCategory">Update</button>
                            <button type="button" class="btn btn-success mx-3 mb-2 closer">Close</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <div class="input-group col-md-6 col-lg-4 ml-auto">
                                <input type="text" class="form-control border" placeholder="New category"
                                       aria-label="Add new category" id="Category" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary shadow-none px-2" id="AddCategory" type="submit">
                                        <i class="material-icons">add</i>
                                    </button>
                                </div>
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
        </div>
    </main>

    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {
            $(document).on('click', '.closer', function () {
                $('.collapse').collapse('hide');
            });
            $('#AddCategory').click(function () {
                let category = $('#Category').val();
                if (category != '') {
                    $.ajax({
                        url: 'add-category',
                        type: 'post',
                        data: {_token: CSRF_TOKEN, category: category,},
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
                                    title: 'Category Insert successfully'
                                })
                                $('#Category').val('');
                                table.ajax.reload();
                            } else if (response == 0) {
                                Swal.fire(
                                    'This name already in use.',
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
                        }
                    });
                } else {
                    Swal.fire('Input field empty')
                }
            });
            $(function () {
                table.ajax.reload();
            });
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('view-category') }}",
                columns: [
                    {data: 'id'},
                    {data: 'category_name'},
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
                            url: "{{ url('delete-category') }}",
                            type: 'get',
                            data: {id: id,},
                            success: function (response) {
                                if (response == 1) {
                                    table.ajax.reload();
                                    Swal.fire(
                                        'Deleted!',
                                        'This category has been deleted.',
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
                    url: "{{ url('view-edit-category') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (data) {
                        $('#inputCategory').val(data.category_name);
                        $('#inputCategoryId').val(data.id);
                    }
                });
            });

            $(document).on('click', '.UpdateCategory', function () {
                event.preventDefault();
                $('.collapse').collapse('show');
                let category = $('#inputCategory').val(), id = $('#inputCategoryId').val();
                if (category != '') {
                    $.ajax({
                        url: "{{ url('update-category') }}",
                        type: 'post',
                        data: {_token: CSRF_TOKEN, category: category, id: id},
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
                                    title: 'Category Update successfully'
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
                    Swal.fire('Update input field empty')
                }
            });

        });
    </script>

@endsection
