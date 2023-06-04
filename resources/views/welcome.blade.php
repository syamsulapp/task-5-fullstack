@extends('layouts.app')

@section('judul', 'Rakamin VIX Task 5')

@section('konten')
<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- ***** Preloader End ***** -->


<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="#" class="logo">
                        <img src="assets/images/logo.png" alt="Softy Pinko" />
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="#welcome" class="active">Home</a></li>
                        <li><a href="#features">About</a></li>
                        <li><a href="#blog">Articles</a></li>
                        <li><a href="#blog2">Category</a></li>

                        @guest
                        @if(Route::has('login'))
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @endif

                        @if(Route::has('register'))
                        <li><a href="{{ route('register') }}">Register</a></li>
                        @endif
                        @else
                        <li><a href="{{ route('home') }}">{{ Auth::user()->name }}</a></li>

                        @endguest
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->

<!-- ***** Welcome Area Start ***** -->
<div class="welcome-area" id="welcome">

    <!-- ***** Header Text Start ***** -->
    <div class="header-text">
        <div class="container">
            <div class="row">
                <div class="offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 col-md-12 col-sm-12">
                    <h1>We provide the best <strong>strategy</strong><br>to grow up your <strong>business</strong></h1>
                    <p>Softy Pinko is a professional Bootstrap 4.0 theme designed by Template Mo
                        for your company at absolutely free of charge</p>
                    <a href="#features" class="main-button-slider">Discover More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Header Text End ***** -->
</div>
<!-- ***** Welcome Area End ***** -->

<!-- ***** Features Small Start ***** -->
<section class="section home-feature">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                        <div class="features-small-item">
                            <div class="icon">
                                <i><img src="assets/images/featured-item-01.png" alt=""></i>
                            </div>
                            <h5 class="features-title">Modern Strategy</h5>
                            <p>Customize anything in this template to fit your website needs</p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->

                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
                        <div class="features-small-item">
                            <div class="icon">
                                <i><img src="assets/images/featured-item-01.png" alt=""></i>
                            </div>
                            <h5 class="features-title">Best Relationship</h5>
                            <p>Contact us immediately if you have a question in mind</p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->

                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s">
                        <div class="features-small-item">
                            <div class="icon">
                                <i><img src="assets/images/featured-item-01.png" alt=""></i>
                            </div>
                            <h5 class="features-title">Ultimate Marketing</h5>
                            <p>You just need to tell your friends about our free templates</p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Features Small End ***** -->

<!-- ***** Features Big Item Start ***** -->
<section class="section padding-top-70 padding-bottom-0" id="features">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12 align-self-center" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                <img src="assets/images/left-image.png" class="rounded img-fluid d-block mx-auto" alt="App">
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mobile-top-fix">
                <div class="left-heading">
                    <h2 class="section-title">Let’s discuss about you project</h2>
                </div>
                <div class="left-text">
                    <p>Nullam sit amet purus libero. Etiam ullamcorper nisl ut augue blandit, at finibus leo efficitur. Nam gravida purus non sapien auctor, ut aliquam magna ullamcorper.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="hr"></div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Features Big Item End ***** -->

<!-- ***** Features Big Item Start ***** -->
<section class="section padding-bottom-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mobile-bottom-fix">
                <div class="left-heading">
                    <h2 class="section-title">We can help you to grow your business</h2>
                </div>
                <div class="left-text">
                    <p>Aenean pretium, ipsum et porttitor auctor, metus ipsum iaculis nisi, a bibendum lectus libero vitae urna. Sed id leo eu dolor luctus congue sed eget ipsum. Nunc nec luctus libero. Etiam quis dolor elit.</p>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5 col-md-12 col-sm-12 align-self-center mobile-bottom-fix-big" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                <img src="assets/images/right-image.png" class="rounded img-fluid d-block mx-auto" alt="App">
            </div>
        </div>
    </div>
</section>
<!-- ***** Features Big Item End ***** -->

<!-- ***** Blog Start ***** -->
<section class="section" id="blog">
    <div class="container">
        <!-- ***** Section Title Start ***** -->
        <div class="row">
            <div class="col-lg-12">
                <div class="center-heading">
                    <h2 class="section-title">Artikel</h2>
                </div>
            </div>
            <div class="offset-lg-3 col-lg-6">
                <div class="center-text">
                    <p>kumpulan kategori ter hot</p>
                </div>
            </div>
        </div>
        <!-- ***** Section Title End ***** -->
        <div class="row">
            @foreach($articles as $a)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="blog-post-thumb">
                    <div class="img">
                        <img src="{{ $a->image }}" alt="">
                    </div>
                    <div class="blog-content">
                        <h3>
                            <a href="#">{{ $a->title }}</a>
                        </h3>
                        <div class="text">
                            {{ $a->content }}
                        </div>
                        <a href="#" class="main-button">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ***** Blog End ***** -->

<!-- ***** Blog2 Start ***** -->
<section class="section" id="blog2">
    <div class="container">
        <!-- ***** Section Title Start ***** -->
        <div class="row">
            <div class="col-lg-12">
                <div class="center-heading">
                    <h2 class="section-title">Kategori</h2>
                </div>
            </div>
            <div class="offset-lg-3 col-lg-6">
                <div class="center-text">
                    <p>kumpulan kategori ter hot.</p>
                </div>
            </div>
        </div>
        <!-- ***** Section Title End ***** -->

        <div class="row">
            @foreach($categories as $c)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="blog-post-thumb">
                    <div class="img">
                        <img src="assets/images/blog-item-01.png" alt="">
                    </div>
                    <div class="blog-content">
                        <h3>
                            <a href="#">{{ $c->name }}</a>
                        </h3>
                        <div class="text">
                            Created by users : {{ $c->users_id }}.
                        </div>
                        <a href="#" class="main-button">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ***** Blog End ***** -->

<!-- ***** Footer Start ***** -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <ul class="social">
                    <li><a href="https://www.linkedin.com/in/muhammad-syamsul-marif-48b688170"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="https://www.instagram.com/x4msulm4rif/"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="https://github.com/syamsulapp"><i class="fa fa-github"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p class="copyright">Copyright &copy; {{ now()->year }} Samsul Marif </p>
            </div>
        </div>
    </div>
</footer>

@endsection
