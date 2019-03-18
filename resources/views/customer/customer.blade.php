@extends('layout.app')

@section('content')


    @include('supplier.inc.sidebar')

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <!-- / .main-navbar -->
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Customer</h3>
                </div>
            </div>
            <div class="collapse my-4" id="collapseExample">
                <div class="card edit-user-details">
                    <div class="card-body p-0">
                        <form method="post" class="py-4" id="upload_form" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-row mx-4">
                                <div class="col mb-3">
                                    <p class="form-text text-muted m-0">Enter Company Information:</p>
                                </div>
                            </div>
                            <div class="form-row mx-4">
                                <div class="col-lg-4">
                                    <div class="edit-user-details__avatar m-auto">
                                        <img src="" class="img-fluid rounded"
                                             style="height: 150px;width: 150px;display: none"
                                             id="previewLogo">
                                    </div>
                                    <input type="file" name="ProductPic" class="d-none" id="ImageUpload">
                                    <button type="button" class="btn btn-sm btn-white d-table mx-auto mt-4"
                                            onclick="chooseFile()"><i class="material-icons"></i> Upload Company Logo
                                    </button>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="firstName">Name</label>
                                            <input type="text" class="form-control" name="company_name" id="company_name"
                                                   placeholder="Enter Company Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="phoneNumber">Company Phone Number</label>
                                            <div class="input-group input-group-seamless">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="material-icons"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="company_phone"
                                                       id="company_phone" placeholder="+40 1234 567 890">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="userLocation">Company Location</label>
                                            <div class="input-group input-group-seamless mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="material-icons"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="company_location" id="company_location" class="form-control"
                                                       placeholder="Enter location">
                                            </div>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="emailAddress">Email</label>
                                            <div class="input-group input-group-seamless">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="material-icons"></i>
                                                    </div>
                                                </div>
                                                <input type="email" class="form-control" name="company_email"
                                                       id="company_email" placeholder="Enter Company Email">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="userLocation">Company Registration Number</label>
                                            <div class="input-group input-group-seamless mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="material-icons"></i>
                                                    </div>
                                                </div>
                                                <input type="number" name="company_reg_no" id="company_reg_no" class="form-control"
                                                       placeholder="845674">
                                            </div>

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="emailAddress">No of Employ</label>
                                            <div class="input-group input-group-seamless">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="material-icons"></i>
                                                    </div>
                                                </div>
                                                <input type="email" class="form-control" name="total_employ" id="total_employ"
                                                       placeholder="No of Employ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><hr>
                            <div class="form-row mx-4">
                                <div class="col mb-3">
                                    <p class="form-text text-muted m-0">Accountant Details:</p>
                                </div>
                            </div>
                            <div class="form-row mx-4">
                                <div class="form-group col-md-4">
                                    <label for="firstName">Accountant Name</label>
                                    <input type="text" class="form-control" name="accountant_name" id="accountant_name"
                                           placeholder="Enter Accountant Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="firstName">Address</label>
                                    <input type="text" class="form-control" name="accountant_address" id="accountant_address"
                                           placeholder="Enter Address">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="firstName">Phone Number</label>
                                    <input type="text" class="form-control" name="accountant_phone" id="accountant_phone"
                                           placeholder="Enter Phone Number">
                                </div>
                            </div><hr>
                            <div class="form-row mx-4">
                                <div class="col mb-3">
                                    <p class="form-text text-muted m-0">Bank Details:</p>
                                </div>
                            </div>
                            <div class="form-row mx-4">
                                <div class="form-group col-md-4">
                                    <label for="firstName">Name of Bank</label>
                                    <input type="text" class="form-control" name="bank_name" id="bank_name"
                                           placeholder="Enter Name of Bank">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="firstName">Branch Address</label>
                                    <input type="text" class="form-control" name="bank_address" id="bank_address"
                                           placeholder="Enter Branch Address">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="firstName">Account Number</label>
                                    <input type="text" class="form-control" name="account_no" id="account_no"
                                           placeholder="Enter Account Number">
                                </div>
                            </div><hr>
                            <div class="form-row mx-4">
                                <div class="col mb-3">
                                    <p class="form-text text-muted m-0">Private Address Of Partners / Directors:</p>
                                </div>
                            </div>
                            <div class="form-row mx-4">
                                <div class="form-group col-md-4">
                                    <label for="firstName">Name</label>
                                    <input type="text" class="form-control" name="director_name" id="director_name"
                                           placeholder="Enter Name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="firstName">D.O.B</label>
                                    <input type="text" class="form-control" name="director_dob" id="director_dob"
                                           placeholder="D.O.B">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="firstName">Address</label>
                                    <input type="text" class="form-control" name="director_address" id="director_address"
                                           placeholder="Enter Address">
                                </div>
                            </div>

                            <div class="form-row mt-3">
                                <button type="submit" class="btn btn-sm btn-accent ml-auto mr-3 w-25">Submit</button>
                                <button type="button" class="btn btn-sm btn-warning ml-auto mr-3 closer">Close</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <button class="btn btn-primary float-right add"><i class="fa-1x fas fa-plus"></i> Add
                                Supplier
                            </button>
                        </div>
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">id</th>
                                    <th scope="col" class="border-0">Customer Id</th>
                                    <th scope="col" class="border-0">Customer Name</th>
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
                $('.collapse').collapse('show');
            });
            $(document).on('click', '.closer', function () {
                $('.collapse').collapse('hide');
            });
            $('#upload_form').on('submit', function () {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('add.customer') }}",
                    method: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    success: function (data) {
                        if(data == 1){
                            Swal.fire(
                                'New Customer add successfully!',
                                'success'
                            )
                        }else {
                            Swal.fire({
                                title: 'Customer Submit Error!',
                                html: data,
                            })
                        }
                        $('.collapse').collapse('hide');
                        table.ajax.reload();
                    }

                })
            });
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('view.customer') }}",
                columns: [
                    {data: 'id'},
                    {data: 'customer_id'},
                    {data: 'company_name'},
                    {data: 'company_phone'},
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
                            url: "{{ route('delete.customer') }}",
                            type: 'get',
                            data: {id: id,},
                            success: function (response) {
                                if (response == 1) {
                                    table.ajax.reload();
                                    Swal.fire(
                                        'Deleted!',
                                        'This Customer has been deleted.',
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
