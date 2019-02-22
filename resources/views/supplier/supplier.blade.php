@extends('layout.app')

@section('content')


    @include('supplier.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Supplier</h3>
                </div>
            </div>
            <div class="collapse my-4" id="collapseExample">
                <div class="card">
                    <div class="card-header border-bottom inputheader">Add New Supplier</div>
                    <div class="card-body">
                        <form method="post" id="upload_form" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <div class="form-row mx-4">
                            <div class="col-lg-4">
                                <label for="userProfilePicture" class="text-center w-100 mb-4">Profile Picture</label>
                                <div class="edit-user-details__avatar m-auto">
                                    <img src="images/avatars/0.jpg" id="previewLogo" alt="User Avatar shadow">
                                </div>
                                <input type="file" name="ProductPic" class="d-none" id="ImageUpload">
                                <button type="button" class="btn btn-sm btn-white d-table mx-auto mt-4" onclick="chooseFile()"><i class="material-icons"></i> Upload Image</button>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="firstName">Name</label>
                                        <input type="text" class="form-control" name="name" id="firstName" placeholder="Enter Supplier Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phoneNumber">Phone Number</label>
                                        <div class="input-group input-group-seamless">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="material-icons"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="+40 1234 567 890">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="userLocation">Location</label>
                                        <div class="input-group input-group-seamless mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="material-icons"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="location" class="form-control" placeholder="Enter location">
                                        </div>
                                        <label for="emailAddress">Email</label>
                                        <div class="input-group input-group-seamless">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="material-icons"></i>
                                                </div>
                                            </div>
                                            <input type="email" class="form-control" name="emailAddress" id="emailAddress" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                            <label for="userBio">Details</label>
                                            <textarea style="min-height: 108px;" id="userBio" name="userBio" class="form-control" placeholder="Supplier Information"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning float-right mx-2 closer">Close</button>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <button class="btn btn-primary float-right add"><i class="fa-1x fas fa-plus"></i> Add Supplier
                            </button>
                        </div>
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">id</th>
                                    <th scope="col" class="border-0">Supplier Id</th>
                                    <th scope="col" class="border-0">Supplier Name</th>
                                    <th scope="col" class="border-0">Phone</th>
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

        function chooseFile() {
            $("#ImageUpload").click();
        }

        $(function () {
            $("#ImageUpload").change(function () {
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                    alert("only jpeg, jpg and png Images type allowed");
                    return false;
                } else {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        function imageIsLoaded(e) {
            $('#previewLogo').attr('src', e.target.result);
        }

        $(document).ready(function () {
            $(function () {
                table.ajax.reload();
            });
            $(document).on('click', '.add', function () {
                $('.inputheader').html('Add Product Price');
                $('#inputPrice').val('');
                $('#ItemNameId').val('');
                $('.selectpicker').selectpicker('refresh');
                $('.inputButton').html('<div id="inputButton"><button type="button" class="btn btn-primary mb-2 addPrice">Save</button></div>\n');
                $('.collapse').collapse('show');
            });
            $(document).on('click', '.closer', function () {
                $('.collapse').collapse('hide');
            });
            $('#upload_form').on('submit', function () {
                event.preventDefault();
                $.ajax({
                    url: "{{ url('add-supplier') }}",
                    method: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    success: function (data) {
                        Swal.fire({
                            title: 'Product Submit Error!',
                            html: data,
                        })
                    }

                })
            });
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('view-supplier') }}",
                columns: [
                    {data: 'id'},
                    {data: 'supplier_id'},
                    {data: 'name'},
                    {data: 'phone'},
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
                            url: "{{ url('delete-supplier') }}",
                            type: 'get',
                            data: {id: id,},
                            success: function (response) {
                                if (response == 1) {
                                    table.ajax.reload();
                                    Swal.fire(
                                        'Deleted!',
                                        'This Price List has been deleted.',
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
            $(document).on('click', '.view', function () {
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ url('tracking') }}",
                    type: 'get',
                    data: {id: id,},
                    success: function (data) {
                        window.location.href = data;
                    }
                });
            });
        });
    </script>

@endsection
