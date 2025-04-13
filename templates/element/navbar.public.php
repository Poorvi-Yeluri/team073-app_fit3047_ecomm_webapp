<!-- Top banner -->
<div class="container-fluid py-2 justify-content-center bg-black" id="changeTextDiv">
    <div class="d-flex justify-content-center w-100 ms-md-5 ps-md-5">
        <a class="text-white text-decoration-none ps-2" href="#" id="textContent">
            Our Biggest Sale!
        </a>
    </div>
</div>

<!-- Top Navbar -->
<div class="container-fluid d-flex gap-0 justify-content-between align-items-center py-2 border-bottom">
    <!-- Left: Toggler (mobile only) + Search -->
    <div class="d-flex align-items-center">
        <!-- Toggler -->
        <button class="navbar-toggler d-md-none border-0"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation"
                style="outline: none; box-shadow: none;">
            <span class="material-symbols-outlined">menu</span>
        </button>

        <!-- Search Icon + Input -->
        <div class="position-relative d-md-flex d-none align-items-center" id="search-wrapper">
            <span class="material-symbols-outlined me-2"
                  id="search-bar-icon"
                  style="cursor: pointer;">search</span>
            <input type="search"
                   class="form-control animated-search-input"
                   id="search-bar"
                   placeholder="What are you looking for?"
                   aria-label="Search">
        </div>
    </div>

    <!-- Center: Logo -->
    <a class="logo-brand fs-sm-1" href="/">
        GLEAM <i class="text-small">AND</i> GRACE
    </a>


    <!-- Right Icons (desktop only) -->
    <div class="d-md-flex d-none align-items-center gap-3">
        <span class="material-symbols-outlined" style="cursor: pointer;">location_on</span>
        <span class="material-symbols-outlined" style="cursor: pointer;">shopping_cart</span>
        <span class="material-symbols-outlined" id="popoverButton"
              data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Loading..."
              style="cursor: pointer;">
            person
        </span>
    </div>
</div>

<!-- Bottom Nav - Desktop only -->
<div class="container-fluid justify-content-center py-3 border-bottom d-none d-md-flex">
    <div class="d-flex flex-wrap gap-4 ms-md-5 ps-md-5">
        <a class="nav-link px-2 text-uppercase" href="#">Home Decor</a>
        <a class="nav-link px-2 text-uppercase" href="#">Jewelry</a>
        <a class="nav-link px-2 text-uppercase" href="#">Gifts</a>
        <a class="nav-link px-2 text-uppercase" href="#">Clearance</a>
    </div>
</div>

<!-- Offcanvas Navigation (Mobile only) -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="width: 75%">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="#">NEW</a></li>
            <li class="nav-item"><a class="nav-link" href="#">SALE</a></li>
            <li class="nav-item"><a class="nav-link" href="#">BEDROOM</a></li>
            <li class="nav-item"><a class="nav-link" href="#">BATHROOM</a></li>
            <li class="nav-item"><a class="nav-link" href="#">LIVING</a></li>
            <li class="nav-item"><a class="nav-link" href="#">DINING</a></li>
            <li class="nav-item"><a class="nav-link" href="#">FURNITURE</a></li>
            <li class="nav-item"><a class="nav-link" href="#">JEWELERY</a></li>
            <li class="nav-item"><a class="nav-link" href="#">CLEARANCE</a></li>
        </ul>
    </div>
</div>



<!-- Optional Mobile Search Section -->
<div class="container-fluid d-md-none input-group border-top border-bottom py-2">
    <input class="form-control" type="search" placeholder="What are you looking for?" aria-label="Search">
</div>

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
                    <a href="/auth/login" class="btn btn-dark w-100 mb-2">Login</a>
                    <a href="/auth/register" class="btn btn-secondary w-100">Sign up</a>
                `;
            }
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

    const bgColors = [
        "bg-success",  // Green background
        "bg-primary",  // Primary color background
        "bg-dark",     // Dark background
        "bg-warning",   // Yellow background
        "bg-black",    // Black background
    ];

    let currentIndex = 0;

    function changeContentAndStyle() {
        // Change text content
        document.getElementById("textContent").textContent = texts[currentIndex];
        document.getElementById("changeTextDiv").classList.remove(...bgColors);
        document.getElementById("changeTextDiv").classList.add(bgColors[currentIndex]);
        currentIndex = (currentIndex + 1) % texts.length;
    }

    setInterval(changeContentAndStyle, 3000);
</script>
