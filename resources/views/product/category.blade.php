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

            <div class="row">
                <div class="col">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <div class="input-group col-md-5 col-lg-3 ml-auto">
                                <input type="text" class="form-control border" placeholder="New category"
                                       aria-label="Add new category" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary shadow-none px-2" type="button">
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
                                    <th scope="col" class="border-0">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Ali</td>
                                    <td>Kerry</td>
                                    <td>
                                        <div class="d-table mx-auto btn-group-sm btn-group">
                                            <button type="button" class="btn btn-white">
                                                <i class="material-icons"></i>
                                            </button>
                                            <button type="button" class="btn btn-white">
                                                <i class="material-icons"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection