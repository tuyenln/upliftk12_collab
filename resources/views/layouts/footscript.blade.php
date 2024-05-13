<!--<script src="{{asset('public/js/app.js')}}"></script>-->
<script type="text/javascript" src="{{url('public/assets/js/jquery.magnific-popup.min.js')}}"></script><!--jquery-->
<script type="text/javascript" src="{{url('public/assets/js/slick.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/assets/js/main.js')}}"></script>

@stack('styles')
</body>
</html>

<script type="text/javascript">
$(document).on("change", '#dist', function(e) {
	var department = $(this).val();
	var url="{{url('get_school_dist')}}";
	$.ajax({
		type: "POST",
		data: {department: department,"_token": "{{ csrf_token() }}"},
		url: url,
		success: function(json) {
			$('#school_name').html(json);
		}
	});
});
$('.collapse-icon').click(function() {
    $('.left-panel').toggleClass('show-left-panel');
});

$('.btn-name').click(function() {
	console.log('ss');
	$('#myDropdown').classList.toggle("show");
});

window.onclick = function(e) {
    if (!e.target.matches('.dropbtn')) {
        var myDropdown = document.getElementById("myDropdown");
        if (myDropdown.classList.contains('show')) {
            myDropdown.classList.remove('show');
        }
    }
}
</script>

@stack('scripts')

</body>
</html>
