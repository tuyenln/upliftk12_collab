 <!-- footer content -->
   <footer>
          <div class="pull-right">
            @2020 All Rights Reserved Powered By  <a href="https://webcotec.com/">Webcotec Technology</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

      </div>
	   
      <!-- /page content -->
    </div>


  </div>

   <!--<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>-->

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  
  <!-- 
  <!-- daterangepicker -->
  <script type="text/javascript" src="{{url('public/js/moment/moment.min.js')}}"></script>
  <script type="text/javascript" src="{{url('public/public/js/datepicker/daterangepicker.js')}}"></script>
  <!-- chart js -->
 
  <script src="{{url('public/js/custom.js')}}"></script>

  <script type="text/javascript">
    
    $(document).on("change", '#dist', function(e) {
            var department = $(this).val();
            
     var url="{{url('get_school_dist')}}";
            $.ajax({
                type: "POST",
                data: {department: department,        "_token": "{{ csrf_token() }}"},
                url: url,
                
                success: function(json) {
                $('#school_name').html(json);
                

                    
                    
                }
            });

        });
  </script>
 
   
  <!-- pace -->
 
  <!-- flot -->

</body>

</html>