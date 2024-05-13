<header id="header" class="fixed-top ">
    <div class="container-fluid">

      <div class="row justify-content-center">
        <div class="col-xl-9 d-flex align-items-center">
          <h1 class="logo mr-auto"><a href="/"><img src="{{url('public/assets/images/logo.png')}}" alt=""></a></h1>
          <nav class="nav-menu d-none d-lg-block">
            <ul>
              <li class="{{ Request::route()->getName() == 'home' ? 'active' : '' }}"><a href="/">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#services">Services</a></li>
              <li><a href="#faq">FAQ</a></li>
              <li class="{{ Request::route()->getName() == 'contact' ? 'active' : '' }}"><a href="contact">Contact Us</a></li>
            </ul>
          </nav>
          <a href="{{URL::to('login')}}" class="get-started-btn scrollto">LogIn</a>
        </div>
      </div>

    </div>
  </header><!-- End Header -->