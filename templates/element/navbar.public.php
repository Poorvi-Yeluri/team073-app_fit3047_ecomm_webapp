<?php
// Get cart data from session
$session = $this->request->getSession();
$cartItems = $session->read('Cart.items') ?? [];
$cartCount = array_sum(array_column($cartItems, 'quantity'));  // Calculate the total items in the cart
?>

<!-- Top banner -->
<div class="container-fluid py-2" style="background-color: var(--accent-color)">
    <div class="d-flex w-100 justify-content-center align-items-center">
        <a class="text-white text-decoration-none text-center" href="#" id="textContent">
            Our Biggest Sale!
        </a>
    </div>
</div>


<!-- Top Navbar -->
<div class="container-fluid border-bottom py-2 px-3 px-md-5">
    <div class="d-flex w-100 justify-content-start gap-2 justify-content-md-between align-items-center">

        <!-- Left: Toggler + Search -->
        <div class="d-flex align-items-center gap-3">
            <!-- Toggler -->
            <button class="navbar-toggler d-md-none border-0"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar"
                    aria-label="Toggle navigation"
                    style="outline: none; box-shadow: none;">
                <span class="material-symbols-outlined">menu</span>
            </button>

            <!-- Desktop Search -->
            <form method="get" action="/products/search" class="d-none d-md-flex align-items-center position-relative"
                  id="search-wrapper">
                <span class="material-symbols-outlined me-2" id="search-bar-icon" style="cursor: pointer;">search</span>
                <input type="search"
                       name="q"
                       class="form-control animated-search-input"
                       id="search-bar"
                       placeholder="What are you looking for?"
                       aria-label="Search">
            </form>
        </div>

        <!-- Center: Logo (md, lg) -->
        <a class="logo-brand d-none d-md-block position-absolute start-50 translate-middle-x" href="/"
           style="z-index: 1;">
            GLEAM <i class="text-small">AND</i> GRACE
        </a>

        <!-- Center: Logo (sm) -->
        <a class="logo-brand fs-1 d-block d-md-none" href="/">
            GLEAM <i class="text-small">AND</i> GRACE
        </a>

        <!-- Right Icons -->
        <div class="d-none d-md-flex align-items-center gap-3">
            <div class="position-relative d-inline-block">
                <span class="material-symbols-outlined"
                      style="cursor: pointer;"
                      data-bs-toggle="offcanvas"
                      data-bs-target="#cartOffcanvas">
                    shopping_cart
                </span>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= count($session->read('Cart.items') ?? []) ?>
                </span>
            </div>
            <span class="material-symbols-outlined"
                  id="popoverButton"
                  data-bs-toggle="popover"
                  data-bs-placement="bottom"
                  style="cursor: pointer;">
                person
            </span>
        </div>
    </div>
</div>

<!-- Bottom Nav (Desktop only) -->
<div class="container-fluid d-none d-md-flex border-bottom py-3 px-3 px-md-5">
    <div class="d-flex flex-wrap gap-5 justify-content-center w-100">
        <a class="nav-link px-2 text-uppercase"
           href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', '?' => ['category' => 'home-decor']]) ?>">Home
            Decor</a>
        <a class="nav-link px-2 text-uppercase"
           href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', '?' => ['category' => 'jewellery']]) ?>">Jewellery</a>
        <a class="nav-link px-2 text-uppercase"
           href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', '?' => ['category' => 'gifts']]) ?>">Gifts</a>
        <a class="nav-link px-2 text-uppercase"
           href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', '?' => ['category' => 'clearance']]) ?>">Clearance</a>
    </div>
</div>

<!-- Offcanvas Navigation (Mobile only) -->
<div class="offcanvas offcanvas-start"
     tabindex="-1"
     id="offcanvasNavbar"
     data-bs-backdrop="false"
     aria-labelledby="offcanvasNavbarLabel" style="width: 75%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button"
                class="btn-close text-reset"
                data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link px-2 text-uppercase"
                                    href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', '?' => ['category' => 'home-decor']]) ?>">Home
                    Decor</a></li>
            <li class="nav-item"><a class="nav-link px-2 text-uppercase"
                                    href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', '?' => ['category' => 'jewellery']]) ?>">Jewellery</a>
            </li>
            <li class="nav-item"><a class="nav-link px-2 text-uppercase"
                                    href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', '?' => ['category' => 'gifts']]) ?>">Gifts</a>
            </li>
            <li class="nav-item"><a class="nav-link px-2 text-uppercase"
                                    href="<?= $this->Url->build(['controller' => 'Products', 'action' => 'index', '?' => ['category' => 'clearance']]) ?>">Clearance</a>
            </li>
        </ul>
        <hr/>
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link px-2 text-uppercase"
                                    href="<?= $this->Url->build(['controller' => 'Auth', 'action' => 'login', '?' => ['category' => 'home-decor']]) ?>">Login</a>
            </li>
            <li class="nav-item"><a class="nav-link px-2 text-uppercase"
                                    href="<?= $this->Url->build(['controller' => 'Auth', 'action' => 'register', '?' => ['category' => 'jewellery']]) ?>">Register</a>
            </li>
        </ul>
        <hr/>

    </div>
</div>

<!-- Optional Mobile Search Section -->
<div class="container-fluid d-md-none border-top border-bottom py-2 px-4">
    <form method="get" action="/products/search" class="d-flex align-items-center w-100" id="mobile-search-wrapper">
        <input
            type="search"
            name="q"
            class="form-control"
            placeholder="What are you looking for?"
            aria-label="Search"
        >
    </form>
</div>

<!-- Include Cart Element -->
<?= $this->element('cart') ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchIcon = document.getElementById("search-bar-icon");
        const searchInput = document.getElementById("search-bar");

        searchIcon.addEventListener("click", () => {
            searchIcon.classList.toggle("d-none"); // hide icon
            searchInput.classList.toggle("active"); // animate input open

            if (searchInput.classList.contains("active")) {
                searchInput.focus();
            } else {
                searchInput.value = "";
            }
        });

        searchInput.addEventListener("blur", () => {
            searchInput.classList.remove("active"); // animate input close
            searchIcon.classList.remove("d-none");  // show icon again
        });

        let popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        let popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl, {
            html: true,
            sanitize: false,
            content: function () {
                return `
                    <a href="/auth/login" class="btn btn-dark text-white w-100 mb-2">Login</a>
                    <a href="/auth/register" class="btn btn-light text-dark w-100">Sign up</a>
                `;
            },
            placement: 'bottom',  // Make sure it's under the icon
            offset: '0, 8px',  // Added a small gap to ensure it's not too close
            trigger: 'click',  // Optionally, set trigger to 'click' to toggle
        }));

        document.body.addEventListener('click', function (e) {
            if (!popoverTriggerList[0].contains(e.target)) {
                // Close the popover if the click is outside the button
                bootstrap.Popover.getInstance(popoverTriggerList[0]).hide();
            }
        });
    });

    // Dynamic Text and Background Color Changes
    const texts = [
        "Spring Sale is Here!",
        "Don't Miss Our Easter Offers!",
        "Limited Time Offers – Shop Now!",
        "Hurry! Special Discounts Ahead!"
    ];

    function changeContentAndStyle() {
        const textEl = document.getElementById("textContent");

        // Pick random text and background color
        const randomText = texts[Math.floor(Math.random() * texts.length)];

        // Update text and background
        textEl.textContent = randomText;
    }

    // Start interval after DOM is ready
    setInterval(changeContentAndStyle, 3000);
</script>
