@include('layouts/head')
<body>
   <div class="wrapper">
      <div id="loading" class="page-loader-wrap">
         <div id="preloader">
            <span></span>
         </div>
      </div>
    

            @yield('content')
       
       </div>

@include('layouts/footscript')
