@extends('layout.app')

@section('content')

    @include('product.inc.sidebar')

    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-right"></i>
        </div>
        <div class="sidebar-header p-1 px-2">
            <h3 id="InputHeader">New Item</h3>
        </div>
        <hr class="my-0">

        <form method="post" id="upload_form" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="p-3 h-100 overflow-auto">

                <div class="image w-100 text-center" onclick="chooseFile()" id="previewImage">
                    <div class="mt-5">
                        <i class="fas fa-cloud-upload-alt fs-25"></i><br>
                        Add a product Image
                    </div>
                </div>
                <input type="file" name="ProductPic" class="ImageUpload d-none">
                <input type="text" id="itemId" name="itemId" class="d-none">
                <div class="row my-3">
                    <div class="col-6">
                        <select class="selectpicker border rounded form-control" name="CategoryId" id="CategoryId"
                                data-live-search="true">
                            <option value="">Select Category</option>
                            @foreach($category as $categories)
                                <option value="{{ $categories->id }}">{{ $categories->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <select class="selectpicker border rounded form-control" name="SubcategoryId" id="SubcategoryId"
                                data-live-search="true">
                            <option value="">Select Subcategory</option>
                        </select>
                    </div>
                </div>
                <div class="row px-0 mx-0 my-2">
                    <div class="form-group col-12 px-0 mb-2">
                        <label for="inputCategory" class="sr-only"></label>
                        <input type="text" class="form-control w-100" placeholder="Item Name" name="ItemName"
                               id="ItemName">
                    </div>
                </div>
                <textarea placeholder="Item Description" class="form-control w-100" name="description" id="description"
                          rows="4"></textarea>
                <div class="row px-0 mx-0 my-2">
                    <div class="col-6 pl-0">
                        <div class="form-group mb-2">
                            <label for="inputCategory" class="sr-only"></label>
                            <input type="text" class="form-control w-100" name="Manufacturer" id="Manufacturer"
                                   placeholder="Manufacturer">
                        </div>
                    </div>
                    <div class="col-6 pr-0">
                        <select class="selectpicker border rounded form-control" name="UnitId" id="UnitId"
                                data-live-search="true">
                            <option value="">Select Unit</option>
                            @foreach($unit as $units)
                                <option value="{{ $units->id }}">{{ $units->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <div class="row border-top" id="InputButton">
                <button type="submit" class="btn btn-primary w-75 mx-auto mt-4 addProduct">Save</button>
            </div>
        </form>
    </nav>

    <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
        <div class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <h3 class="page-title">Item</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <button type="button" id="sidebarCollapse" class="btn btn-info float-right">
                                <i class="fas fa-plus"></i>
                                <span>Add Item</span>
                            </button>
                        </div>
                        <div class="card-body p-0 text-center ReactTable">
                            <table class="table mb-0 rt-table">
                                <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">id</th>
                                    <th scope="col" class="border-0">Image</th>
                                    <th scope="col" class="border-0">Category Name</th>
                                    <th scope="col" class="border-0">Subcategory Name</th>
                                    <th scope="col" class="border-0">Item Name</th>
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




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modalText">

                </div>
            </div>
        </div>
    </div>


    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        function chooseFile() {
            $(".ImageUpload").click();
        }

        $(function () {
            $(".ImageUpload").change(function () {
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                    alert("only jpeg, jpg and png Images type allowed");
                    return false;
                } else {
                    $('#previewImage').html('<img src="" class="img-thumbnail h-100 mx-auto" id="previewLogo">');
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

        function imageIsLoaded(e) {
            $('#previewLogo').attr('src', e.target.result);
        }

        $('#CategoryId').change(function () {
            let id = $(this).val();
            $.ajax({
                url: "{{ url('subcategory-select') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN, id: id},
                dataType: 'json',
                success: function (data) {
                    $('#SubcategoryId').html('');
                    data.forEach(function (element) {
                        $('#SubcategoryId').append($('<option>', {value: element.id, text: element.subcategory_name}));
                    });
                    $('.selectpicker').selectpicker('refresh');
                }
            });
        });


        $(document).ready(function () {
            $('#upload_form').on('submit', function () {
                event.preventDefault();
                $.ajax({
                    url: "{{ url('add-product') }}",
                    method: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: new FormData(this),
                    success: function (data) {
                        if(data == 1){
                            Swal.fire(
                                'Insert!',
                                'This Product add Successfully',
                                'success'
                            )
                        }else{
                            Swal.fire({
                                title: 'Product Submit Error!',
                                html: data,
                            })
                        }

                        table.ajax.reload();
                        $('#sidebar').removeClass('active');
                        $('.overlay').removeClass('active');
                    }

                })
            });

            $(function () {
                table.ajax.reload();
            });
            let table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('view-product') }}",
                columns: [
                    {data: 'id'},
                    {data: 'image'},
                    {data: 'category'},
                    {data: 'subcategory'},
                    {data: 'item_name'},
                    {data: 'created_at'},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });

            $(document).on('click', '.view', function () {
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ url('view-single-product') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (data) {
                        $(".modalText").html('<div class="row">\n' +
                            '                        <div class="col-12 col-lg-6"><img src="storage/product/'+data.pic+'" class="mr-3 img-fluid w-100"></div>\n' +
                            '                        <div class="row col-12 col-lg-6 px-0 mx-0">\n' +
                            '                            <div class="col-6 text-right">Category : </div><div class="col-6">'+data.category+'</div>\n' +
                            '                            <div class="col-6 text-right">Subcategory : </div><div class="col-6">'+data.subcategory+'</div>\n' +
                            '                            <div class="col-6 text-right">Item Name : </div><div class="col-6">'+data.name+'</div>\n' +
                            '                            <div class="col-6 text-right">Manufacturer :</div><div class="col-6">'+data.manufacturer+'</div>\n' +
                            '                            <div class="col-6 text-right">Unit :</div><div class="col-6">'+data.unit+'</div>\n' +
                            '                            <div class="col-6 text-right">Status : </div><div class="col-6">'+data.status+'</div>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                    '+data.created.date+'\n' +
                            '                    <p>'+data.description+'</p>');
                        $('#exampleModal').modal('show');
                        console.log(data.created.date);
                    }
                });
            });

            $(document).on('click', '.delete', function () {
                let id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#ff4040',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('delete-item') }}",
                            type: 'get',
                            data: {id: id,},
                            success: function (response) {
                                if (response == 1) {
                                    table.ajax.reload();
                                    Swal.fire(
                                        'Deleted!',
                                        'This subcategory has been deleted.',
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

            $(document).on('click', '.edit', function ()  {
                $('.collapse').collapse('show');
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ url('view-single-product') }}",
                    type: 'get',
                    data: {id: id,},
                    dataType: 'json',
                    success: function (data) {
                        $('#sidebar').addClass('active');
                        $('.overlay').addClass('active');
                        $('.collapse.in').toggleClass('in');
                        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                        $('#InputHeader').html('Update Item');
                        $('#previewImage').html('<img src="storage/product/'+data.pic+'" class="img-thumbnail h-100 mx-auto" id="previewLogo">');
                        $('#CategoryId').val(data.categoryId);
                        $.ajax({
                            url: "{{ url('subcategory-select') }}",
                            type: 'post',
                            data: {_token: CSRF_TOKEN, id: data.categoryId},
                            dataType: 'json',
                            success: function (data) {
                                $('#SubcategoryId').html('');
                                data.forEach(function (element) {
                                    $('#SubcategoryId').append($('<option>', {value: element.id, text: element.subcategory_name}));
                                });
                                $('.selectpicker').selectpicker('refresh');
                            }
                        });
                        $('#SubcategoryId').val(data.subcategoryId);
                        $('#ItemName').val(data.name);
                        $('#description').val(data.description);
                        $('#Manufacturer').val(data.manufacturer);
                        $('#UnitId').val(data.unitId);
                        $('#itemId').val(data.id);
                        $('.selectpicker').selectpicker('refresh');
                        $('#InputButton').html('<button type="submit" class="btn btn-primary w-75 mx-auto mt-4 UpdateProduct">Update</button>');
                    }
                });
            });
        });
    </script>


@endsection
