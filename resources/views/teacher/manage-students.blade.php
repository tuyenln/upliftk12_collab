@extends('teacher.layouts.master')
@section('title', 'Manage Students')
@section('content')
<style>
	.hover-end{
		width: 150px;padding:0;margin:0;font-size:75%;text-align:center;
		position: absolute; z-index: 101; background: white; opacity: 0.8;color:black;
	}
	.hover-end img {
		width: 100%;
	}
</style>
  <div class="tab-data">
	  <div class="container-fluid">
			<div class="divider"></div>
			<div class="tab-content">
				<div class="tab-pane active" id="reports" role="tabpanel" aria-labelledby="reports-tab">
				  <div class="container">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 mrgn-b-2" style="margin-top: 50px;">
							<div class="team-detail-content nopaddingtop">
								<div class="clearfix header-section-content hasbutton doublebutton">
									<h3 class="title-content">Manage Students</h3>
									<div class="h2-button">
										<a href="{{ route('teacher.student.create') }}" class="btn btn-primary pull-right button-header-content">Add Student</a>
										<a href="{{ route('teacher.student.uploadcsv') }}" class="btn btn-primary pull-right button-header-content">Upload Csv</a>
									</div>
								</div>
								<div class="sec-content fw-ct">
									<div class="row">
										<div class="col-sm-12">
											<div class="x_content">
												@if(count($students))
													<div class="table-scroll">
														<table class="table table-bordered table-striped actionlistform">
															<thead>
															<tr>
																<th>#</th>
																<th>Student ID</th>
																<th>UseName</th>
																<th>Name</th>
																<th>Action</th>
															</tr>
															</thead>
															<tbody>
															@foreach($students as $aKey => $aRow)
																<tr>
																	<th scope="row">{{ $aKey+1 }}</th>
																	<td>{{$aRow->student_id}}</td>
																	<td>{{$aRow->username}}</td>
																	<td>{{$aRow->name}}</td>
																	<td>
																		<a class="edit" href="{{ route('teacher.student.edit',$aRow->id) }}"><i class="lni lni-pencil-alt"></i></a>
																		<a class="delete" href="javascript:void(0);" onclick="jQuery(this).parent('td').find('#delete-form').submit();"><i class="lni lni-trash"></i>
																		</a>
																		<form id="delete-form" onsubmit="return confirm('Are you sure to delete?');" action="{{ route('teacher.student.destroy',$aRow->id) }}" method="post" style="display: none;">
																			{{ method_field('DELETE') }}
																			{{ csrf_field() }}
																		</form>
																	</td>
																</tr>
															@endforeach
															</tbody>
														</table>
													</div>
												@endif
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				  </div>
				</div>
			</div>
	  </div>
  </div>
@endsection
@push('scripts')
<script type="text/javascript">
	setTimeout(function(){
		$(".notification").hide();
	}, 2000);

</script>
@endpush
