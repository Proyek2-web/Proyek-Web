<nav class="navbar navbar-expand-lg navbar-light  position-fixed w-100 " style="z-index: 99">
    <div class="container">
        <a class="navbar-brand " href="#">Keramik Kinasih</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('home') ? 'active' : ''}}"  href="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('product') ? 'active' : ''}}" href="product">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" {{ request()->is('about') ? 'active' : ''}} href="about">Company</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : ''}}" href="contact" >Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>