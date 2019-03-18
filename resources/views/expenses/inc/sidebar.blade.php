<!-- Main Sidebar -->
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">

    <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
        <div class="input-group input-group-seamless ml-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search"> </div>
    </form>
    <div class="nav-wrapper">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{route('/')}}">
                    <i class="material-icons">edit</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('expenses')}}">
                    <i class="material-icons">vertical_split</i>
                    <span>Expenses</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('expenses.list')}}">
                    <i class="material-icons">note_add</i>
                    <span>Expenses List</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<!-- End Main Sidebar -->