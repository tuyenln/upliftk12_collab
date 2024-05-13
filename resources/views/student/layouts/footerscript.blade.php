<script type="text/javascript" src="{{url('public/js/jquery.min.js')}}"> </script>
<script type="text/javascript" src="{{url('public/js/datepicker.js')}}"> </script>
<script type="text/javascript" src="{{url('public/js/bootstrap.min.js')}}"> </script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src="{{url('public/js/profilepic.js')}}"></script>


@yield('script')
<script type="text/javascript">
    $('.collapse-icon').click(function() {
        $('.left-panel').toggleClass('show-left-panel');
    });

    $('.btn-name').click(function(e) {
        event.preventDefault();
        document.getElementById("myDropdown").classList.toggle("show");
    });

    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
    window.onclick = function(e) {
        if (!e.target.matches('.dropbtn')) {
            var myDropdown = document.getElementById("myDropdown");
            if (myDropdown.classList.contains('show')) {
                myDropdown.classList.remove('show');
            }
        }
    }
</script>
@yield('script-bottom')
@stack('scripts')