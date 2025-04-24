<!-- Admin Navbar -->
<div class="container-fluid border-bottom py-3 px-3 px-md-5">
    <div class="d-flex align-items-center justify-content-between w-100 font-sans">

        <!-- Left: Logo -->
        <a class="logo-brand" href="/">
            GLEAM <i class="text-small">AND</i> GRACE
        </a>

        <!-- Center: Navigation Links -->
        <div class="d-none d-md-flex gap-5 justify-content-center align-items-center fw-bold fs-6">
            <!-- Contact Dropdown -->
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="contactDropdown" data-bs-toggle="dropdown">
                    Contact Messages
                </a>
                <ul class="dropdown-menu" aria-labelledby="contactDropdown">
                    <li><a class="dropdown-item text-center" href="/contact-messages/">View Messages</a></li>
                </ul>
            </div>

            <!-- Users Dropdown -->
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" data-bs-toggle="dropdown">
                    Users
                </a>
                <ul class="dropdown-menu" aria-labelledby="usersDropdown">
                    <li><a class="dropdown-item text-center" href="/users/">All Users</a></li>
                    <li><a class="dropdown-item text-center" href="/users/add">Add User</a></li>
                </ul>
            </div>

            <!-- Users Dropdown -->
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" data-bs-toggle="dropdown">
                    Products
                </a>
                <ul class="dropdown-menu" aria-labelledby="usersDropdown">
                    <li><a class="dropdown-item text-center" href="/products/">All Products</a></li>
                    <li><a class="dropdown-item text-center" href="/products/add/">Add Product</a></li>
                </ul>
            </div>
        </div>

        <!-- Right: Logout Button -->
        <div class="d-none d-md-block">
            <?= $this->Form->create(null, ['url' => '/auth/logout', 'method' => 'post']) ?>
            <?= $this->Form->button('Logout', ['class' => 'btn btn-dark w-100 rounded-0']) ?>
            <?= $this->Form->end() ?>
        </div>


        <!-- Mobile Toggler -->
        <button class="navbar-toggler d-md-none border-0"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#adminOffcanvas"
                aria-controls="adminOffcanvas"
                aria-label="Toggle navigation">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</div>

<!-- Offcanvas Menu (Mobile Only) -->
<div class="offcanvas offcanvas-start d-md-none" data-bs-backdrop="false" tabindex="-1" id="adminOffcanvas" aria-labelledby="adminOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="adminOffcanvasLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav fw-bold fs-6 font-sans">
            <!-- Contact Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="contactDropdownMobile" data-bs-toggle="dropdown">
                    Contact Messages
                </a>
                <ul class="dropdown-menu" aria-labelledby="contactDropdownMobile">
                    <li><a class="dropdown-item text-center" href="/contact-messages/">View Messages</a></li>
                </ul>
            </li>

            <!-- Products Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="productDropdownMobile" data-bs-toggle="dropdown">
                    Products
                </a>
                <ul class="dropdown-menu" aria-labelledby="productsDropdownMobile">
                    <li><a class="dropdown-item text-center" href="/products/">View Products</a></li>
                    <li><a class="dropdown-item text-center" href="/products/add">Add Product</a></li>
                </ul>
            </li>

            <!-- Users Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="usersDropdownMobile" data-bs-toggle="dropdown">
                    Users
                </a>
                <ul class="dropdown-menu" aria-labelledby="usersDropdownMobile">
                    <li><a class="dropdown-item text-center" href="/users/">All Users</a></li>
                    <li><a class="dropdown-item text-center" href="/users/add">Add User</a></li>
                </ul>
            </li>
            <li class="nav-item my-3">
                <div class="d-block d-md-none">
                    <?= $this->Form->create(null, ['url' => '/auth/logout', 'method' => 'post']) ?>
                    <?= $this->Form->button('Logout', ['class' => 'btn btn-dark w-100 rounded-0']) ?>
                    <?= $this->Form->end() ?>
                </div>
            </li>
        </ul>
    </div>
</div>
