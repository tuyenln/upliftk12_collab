   @include('teacher/header')
    <!-- page content -->
    <style type="text/css">
    	.invalid-feedback{color:red;}
    </style>
      <div class="right_col" role="main">

        <div class="">
          
          <div class="clearfix"></div>
          <?php //dd($errors); ?>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel" style="margin-bottom:350px;">
                <div class="x_title">
                  <h2>Teacher <small></small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
 <div class="col-sm-12">
 	<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> 
                   <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
</div>
 
              </div>
            </div>
          </div>
        </div>
        @include('admin/footer')