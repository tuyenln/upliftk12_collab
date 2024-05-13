@if($data && $type == 'student')
<div class="table-scroll">
<table class="table table-bordered table-striped">
  <thead>
    <th>Objective</th>
    <th>Match</th>
  </thead>
  <tbody>
    @php
      $colect = collect();
      foreach($data->groupBy('userid') as $key=>$data_user) {
        // $st = [];
        foreach($data_user->groupBy('case_data') as $key2=>$q){
          $percent = $q->sum('fraction')/$q->count()*100;
          $vkl = [
            'objective' => $key2,
            'value' => $percent
          ];
          $colect->push($vkl);
        }
      }
    @endphp
    @foreach($colect->groupBy('objective') as $key => $value)
      @php $below = $value->where('value', '<=', 70)->count(); @endphp
      <tr>
        <td>{{strtoupper(substr($key, -3))}}</td>
        <td>{{number_format($below/$value->count()*100)}}%</td>
      </tr>
    @endforeach
		{{-- @foreach($data->groupBy('case_data') as $key=>$data_case)
			<tr>
	      <td>{{strtoupper(substr($key, -3))}}</td>
	      @dump($data_case->sum('fraction')/$data_case->count())
	      <td>{{number_format($data_case->sum('fraction')/$data_case->count()*100)}}%</td>
	    </tr>
		@endforeach --}}
  </tbody>
</table>
</div>
@endif
@if($data && $type == 'objective')
<div class="table-scroll">
<table class="table table-bordered table-striped">
  <thead>
    <th>Students to meet</th>
  </thead>
  <tbody>
  	@php $i=0 @endphp
		@foreach($data->groupBy('userid') as $key=>$student)
      @php 
      	$percent = $student->sum('fraction')/$student->count()*100
      @endphp
      @if($percent < 70)
      @php $i++ @endphp
			<tr>
	      <td>{{$student[0]->firstname}} {{$student[0]->lastname}}</td>
	    </tr>
	    @endif
		@endforeach
		@if($i==0)
			<tr><td>No one to meet</td></tr>
		@endif
  </tbody>
</table>
</div>
@endif