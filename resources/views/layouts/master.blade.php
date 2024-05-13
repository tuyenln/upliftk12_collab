@include('layouts/head')
<body>
   <div class="wrapper" id="app">
      <div id="loading" class="page-loader-wrap">
         <div id="preloader">
            <span></span>
         </div>
      </div>
      @include('layouts/header')
            @yield('content')
  </div>

@include('layouts/footscript')
