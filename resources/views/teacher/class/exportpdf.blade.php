<table width="100%" border="1">
	<tr><td align="center">
		<h1>Class : {{ $aClass->name }}</h1>
		<h2>Student List</h2>
	</td></tr>
</table>

@if(count($aStudentLists))
<table width="100%" border="1">
	@php $i = 1; @endphp
	<tr>
		@foreach($aStudentLists as $aKey => $aStudentList)
		@php $j= $i%3; @endphp
		<td width="33%">
			Go to: upliftk12.com <br>
			Click: Login at top right<br>
			Name : {{$aStudentList->name}}<br>
			Last Name : {{$aStudentList->lname}}<br>
			Username: {{$aStudentList->username}}<br>
			Password: {{$aStudentList->username}}<br>
			<a href="{{url('/')}}/fastLogin/{{$aStudentList->username}}/{{$aStudentList->username}}">Login</a>
		</td>
    @if($j == 0) </tr><tr> @endif
	@php $i++ @endphp
	@endforeach
</table>
@else
No data found
@endif

