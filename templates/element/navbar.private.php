<!-- Top Navbar with Search -->
<div class="container d-flex gap-0 justify-content-start justify-content-lg-between align-items-center">
    <!-- Toggler Button for Offcanvas (Only visible on mobile) -->
    <button class="navbar-toggler border-0 d-md-none"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#mobileMenu"
            aria-controls="mobileMenu">
        <span class="material-symbols-outlined">menu</span>
    </button>

    <!-- Site Title -->
    <a class="logo-brand" href="/users/">GLEAM AND GRACE</a>

    <ul class="d-none d-md-flex justify-content-center gap-5 ">

        <!-- Contact Messages Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle"
               href="#"
               id="contactDropdown"
               role="button"
               data-bs-toggle="dropdown"
               aria-expanded="false">
                Contact Messages
            </a>
            <ul class="dropdown-menu" aria-labelledby="contactDropdown">
                <li><a class="dropdown-item text-center" href="/contact-messages/">View Messages</a></li>
            </ul>
        </li>

        <!-- Users Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                Users
            </a>
            <ul class="dropdown-menu" aria-labelledby="usersDropdown">
                <li><a class="dropdown-item text-center" href="/users/">All Users</a></li>
                <li><a class="dropdown-item text-center" href="/users/add">Add User</a></li>
            </ul>
        </li>

    </ul>
    <!-- Icons (Visible for larger screens) -->
    <div class="d-none d-md-flex gap-3 fs-sm-7">
        <a href="/auth/logout" class="btn btn-md btn-dark">Logout</a>
    </div>
</div>

<!-- Offcanvas Menu for Mobile -->
<div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="contactDropdownMobile" role="button"
                   data-bs-toggle="dropdown">
                    Contact Messages
                </a>
                <ul class="dropdown-menu" aria-labelledby="contactDropdownMobile">
                    <li><a class="dropdown-item text-center" href="/contact-messages/">View Messages</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="usersDropdownMobile" role="button"
                   data-bs-toggle="dropdown">
                    Users
                </a>
                <ul class="dropdown-menu" aria-labelledby="usersDropdownMobile">
                    <li><a class="dropdown-item text-center" href="/users/">All Users</a></li>
                    <li><a class="dropdown-item text-center" href="/users/add">Add User</a></li>
                </ul>
            </li>
            <li class="nav-item mt-3">
                <a href="/auth/logout" class="btn btn-md btn-dark w-100">Logout</a>
            </li>
        </ul>
    </div>
</div>


