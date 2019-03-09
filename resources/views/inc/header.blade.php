<main class="main-content col-12 p-0 sticky-top">
    <div class="main-navbar sticky-top bg-white">
        <!-- Main Navbar -->
        <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
            <div class="main-navbar">
                <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-0 p-0">
                    <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                        <div class="d-table m-auto">
                            <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;"
                                 src="{{asset('images/shards-dashboards-logo.svg')}}" alt="Shards Dashboard">
                            <span class="d-none d-md-inline ml-1">Shards Dashboard</span>
                        </div>
                    </a>
                    <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                        <i class="material-icons">&#xE5C4;</i>
                    </a>
                </nav>
            </div>
            <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                <div class="input-group input-group-seamless ml-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                        <input class="navbar-search form-control search" type="text" placeholder="Tracking for something..."
                               aria-label="Search">
                </div>
                <ul class="navbar-nav border-left flex-row ">
                    <li class="nav-item border-right dropdown N-menubar">
                        <a class="nav-link text-nowrap px-3 my-2" href="#" role="button" id="dropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="nav-link-icon__wrapper fs-16">
                                More <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu no-shadow p-0 m-0" aria-labelledby="dropdownMenuLink">
                            <div class="row fs-12 mx-lg-2 my-2">
                                <div class="col-2">
                                    <h6 class="text-success">Product</h6>
                                    <hr class="my-0 bg-secondary">
                                    <ul class="list-unstyled font-weight-normal lh-1-9">
                                        <li><a class="nav-link lh-1-1" href="{{route('category')}}">Category</a></li>
                                        <li><a class="nav-link lh-1-1" href="{{route('subcategory')}}">Subcategory</a>
                                        </li>
                                        <li><a class="nav-link lh-1-1" href="{{route('unit')}}">Unit</a></li>
                                        <li><a class="nav-link lh-1-1" href="{{route('product')}}">Item</a></li>
                                        <li><a class="nav-link lh-1-1" href="{{route('PriceList')}}">Price List</a></li>
                                    </ul>
                                </div>
                                <div class="col-2">
                                    <h6 class="text-success">Purchase</h6>
                                    <hr class="my-0 bg-secondary">
                                    <ul class="list-unstyled font-weight-normal lh-1-9">
                                        <li>Category</li>
                                        <li>Subcategory</li>
                                        <li>Item</li>
                                    </ul>
                                </div>
                                <div class="col-2">
                                    <h6 class="text-success">Sales</h6>
                                    <hr class="my-0 bg-secondary">
                                    <ul class="list-unstyled font-weight-normal lh-1-9">
                                        <li>Category</li>
                                        <li>Subcategory</li>
                                        <li>Item</li>
                                    </ul>
                                </div>
                                <div class="col-2">
                                    <h6 class="text-success">Customer</h6>
                                    <hr class="my-0 bg-secondary">
                                    <ul class="list-unstyled font-weight-normal lh-1-9">
                                        <li>Category</li>
                                        <li>Subcategory</li>
                                        <li>Item</li>
                                    </ul>
                                </div>
                                <div class="col-2">
                                    <h6 class="text-success">Supplier</h6>
                                    <hr class="my-0 bg-secondary">
                                    <ul class="list-unstyled font-weight-normal lh-1-9">
                                        <li><a class="nav-link lh-1-1" href="{{route('supplier')}}">Supplier</a></li>
                                        <li>Subcategory</li>
                                        <li>Item</li>
                                    </ul>
                                </div>
                                <div class="col-2">
                                    <h6 class="text-success">Reports</h6>
                                    <hr class="my-0 bg-secondary">
                                    <ul class="list-unstyled font-weight-normal lh-1-9">
                                        <li>Category</li>
                                        <li>Subcategory</li>
                                        <li>Item</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item border-right dropdown notifications">
                        <a class="nav-link nav-link-icon text-center" href="#" role="button" id="dropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="nav-link-icon__wrapper">
                                <i class="material-icons">&#xE7F4;</i>
                                <span class="badge badge-pill badge-danger">2</span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">
                                <div class="notification__icon-wrapper">
                                    <div class="notification__icon">
                                        <i class="material-icons">&#xE6E1;</i>
                                    </div>
                                </div>
                                <div class="notification__content">
                                    <span class="notification__category">Analytics</span>
                                    <p>Your websiteâ€™s active users count increased by
                                        <span class="text-success text-semibold">28%</span> in the last week. Great job!
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="notification__icon-wrapper">
                                    <div class="notification__icon">
                                        <i class="material-icons">&#xE8D1;</i>
                                    </div>
                                </div>
                                <div class="notification__content">
                                    <span class="notification__category">Sales</span>
                                    <p>Last week your storeâ€™s sales count decreased by
                                        <span class="text-danger text-semibold">5.52%</span>. It could have been worse!
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item notification__all text-center" href="#"> View all Notifications </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#"
                           role="button"
                           aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle mr-2" src="{{asset('images/avatars/0.jpg')}}"
                                 alt="User Avatar">
                            <span class="d-none d-md-inline-block">Sierra Brooks</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-small">
                            <a class="dropdown-item" href="user-profile-lite.html">
                                <i class="material-icons">&#xE7FD;</i> Profile</a>
                            <a class="dropdown-item" href="components-blog-posts.html">
                                <i class="material-icons">vertical_split</i> All User</a>
                            <a class="dropdown-item" href="add-new-post.html">
                                <i class="material-icons">note_add</i> Add New User</a>
                            <a class="dropdown-item" href="add-new-post.html">
                                <i class="material-icons">note_add</i> User Role</a>
                            <a class="dropdown-item" href="add-new-post.html">
                                <i class="material-icons">note_add</i> Role Permission</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{route('logout')}}">
                                <i class="material-icons text-danger">&#xE879;</i> Logout </a>
                        </div>
                    </li>
                </ul>
                <nav class="nav">
                    <a href="#"
                       class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
                       data-toggle="collapse" data-target=".header-navbar" aria-expanded="false"
                       aria-controls="header-navbar">
                        <i class="material-icons">&#xE5D2;</i>
                    </a>
                </nav>
        </nav>
    </div>
</main>

<script>
    $('.search').keyup(function (e) {
        if (e.keyCode === 13) {
            let id = $('.search').val();
            $.ajax({
                url: "{{ url('tracking') }}",
                type: 'get',
                data: {id: id,},
                success: function (data) {
                    window.location.href = data;
                }
            });
        }
    });
</script>
