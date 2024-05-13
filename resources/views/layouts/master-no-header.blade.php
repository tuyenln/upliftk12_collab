@include('layouts/head')
<body>
   <div class="wrapper" id="app">
      <div id="loading" class="page-loader-wrap">
         <div id="preloader">
            <span></span>
         </div>
      </div>
        @yield('content')
  </div>
