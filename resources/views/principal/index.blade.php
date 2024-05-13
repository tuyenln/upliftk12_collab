@extends('principal.layouts.master')
@section('title', 'Principal')
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
			<ul class="tab-headers" role="tablist">
				{{--<li class="dashboard">
				  <a class="nav-link" data-toggle="tab" href="#dashboard" aria-controls="dashboard" aria-selected="false">
					<i class="fa fa-dashboard"></i>
					<p>Dashboard</p>
					<div class="clearfix"></div>
				  </a>
				</li>--}}
				<li class="lessons active">
					<a data-toggle="tab" href="#lessons" aria-controls="lessons" aria-selected="true">
						<i class="fa fa-user-o"></i>
						<p>Teachers</p>
					</a>
				</li>
				<li class="reports">
					<a data-toggle="tab" href="#reports" aria-controls="reports" aria-selected="false">
						<i class="fa fa-users"></i>
						<p>Students</p>
					</a>
				</li>
			</ul>
			<div class="divider"></div>
			<div class="tab-content">
				<div class="tab-pane fade" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
				  <div class="container">
					TB
				  </div>
				</div>
				<div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
				  <div class="container">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 mrgn-b-2" style="margin-top: 50px;">
							<div class="team-detail-content nopaddingtop">
								<div class="clearfix header-section-content hasbutton doublebutton">
									<h3 class="title-content">Manage Students</h3>
									<div class="h2-button">
										<a href="{{ route('principal.student.create') }}" class="btn btn-primary pull-right button-header-content">Add Student</a>
										<a href="{{ route('principal.student.uploadcsv') }}" class="btn btn-primary pull-right button-header-content">Upload Csv</a>
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
																		<a class="edit" href="{{ route('principal.student.edit',$aRow->id) }}"><i class="lni lni-pencil-alt"></i></a>
																		<a class="delete" href="javascript:void(0);" onclick="jQuery(this).parent('td').find('#delete-form').submit();"><i class="lni lni-trash"></i>
																		</a>
																		<form id="delete-form" onsubmit="return confirm('Are you sure to delete?');" action="{{ route('principal.student.destroy',$aRow->id) }}" method="post" style="display: none;">
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
				<div class="tab-pane fade active in" id="lessons" role="tabpanel" aria-labelledby="lessons-tab">
					<div class="container">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 mrgn-b-2" style="margin-top: 50px">
								<div class="team-detail-content nopaddingtop">
									<div class="clearfix header-section-content hasbutton">
										<h3 class="title-content">Manage Teachers</h3>
										<a href="{{ $user->urlCreateTeacher() }}" class="btn btn-primary pull-right button-header-content">Add Teacher</a>
									</div>
									<div class="sec-content fw-ct">
										<div class="row">
											<div class="col-sm-12">
												<!--tabel start-->
												<div class="x_content">
													@if($user->is_admin)
														<form class="form-inline" method="GET" action="">
															<div class="form-group mr-6">
																<select class="form-control" name="district_id" id="dist">
																	<option value="">--Select District Name--</option>
																	@foreach($districts as $district)
																		<option value="{{$district->id}}" {{ (isset($_GET['district_id']) && $_GET['district_id'] == $district->id) ? 'selected' : '' }}>{{$district->name}}</option>
																	@endforeach
																</select>
															</div>
															<div class="form-group mr-6">
																<select class="form-control" name="school_id" id="school_name">
																	@if(isset($schools))
																		@foreach($schools as $school)
																			<option value="{{ $school->id }}" {{ (isset($_GET['school_id']) && $_GET['school_id'] == $school->id) ? 'selected' : '' }}>{{ $school->school }}</option>
																		@endforeach
																	@endif
																</select>
															</div>
															<div class="form-group mr-6">
																<button class="btn btn-primary" type="submit">Apply Filter</button>
															</div>
														</form>
													@endif
													@if(count($aRows))
														<div class="table-scroll">
															<table class="table table-bordered table-striped actionlistform">
																<thead>
																<tr>
																	<th>#</th>
																	<th>Name</th>
																	<th>School</th>
																	<th>District</th>
																	<th>Action</th>
																</tr>
																</thead>
																<tbody>
																@foreach($aRows as $aKey => $aRow)
																	<tr>
																		<th scope="row">{{ $aKey+1 }}</th>
																		<td>{{$aRow->name}}</td>
																		<td>{{$aRow->school_info->school}}</td>
																		<td>{{$aRow->school_info->district_info->name}}</td>
																		<td>
																			<a class="edit" href="{{ $user->urlEditTeacher($aRow->id) }}" title="Edit"><i class="lni lni-pencil-alt"></i></a>
																			<a class="delete" href="javascript:void(0);" title="Delete" onclick="jQuery(this).parent('td').find('#delete-form').submit();"><i class="lni lni-trash"></i>
																			</a>
																			<form id="delete-form" onsubmit="return confirm('Are you sure to delete?');" action="{{ $user->urlDeleteTeacher($aRow->id) }}" method="post" style="display: none;">
																				{{ method_field('DELETE') }}
																				{{ csrf_field() }}
																			</form>
																		</td>
																	</tr>
																@endforeach
																</tbody>
															</table>
														</div>
													@else
														No data found
													@endif
												</div>
											{{ $aRows->appends(request()->except('page'))->links() }}
											<!--t6abel end-->
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
  @if(Session::get('message'))
	  <div class="notification">
		  <p>[{{Session::get('message')}}]</p>
	  </div>
  @endif
  <div class="clear-invite" id="clear-invite">
	  <form action="{{route('teacher.postClearInvites')}}" method="post">
		  @csrf
		  <h3>Clear all stuent invites</h3>
		  <p>You are about to clear all the students that have been invited to this lesson. They will no longer be able to access the content. Are you sure you want to continue?</p>
		  <input name="lesson_id" id="lesson_id" hidden>
		  <div class="ci-button">
			  <button type="button" class="cancel-button">CANCEL</button>
			  <button type="submit" id="">CLEAR INVITES</button>
		  </div>
	  </form>
  </div>
  <div class="clear-invite" id="remove-invite">
	  <form action="{{route('teacher.postRemoveInvite')}}" method="post">
		  @csrf
		  <h3>Remove this student from invites?</h3>
		  <p>You are about to remove this student that have been invited to this lesson. He will no longer be able to access the content. Are you sure you want to continue?</p>
		  <input name="lesson_id" id="lesson_id2" hidden>
		  <input name="student_id" id="student_id" hidden>
		  <div class="ci-button">
			  <button type="button" class="cancel-button">CANCEL</button>
			  <button type="submit" id="">REMOVE INVITE</button>
		  </div>
	  </form>
  </div>
@endsection
@push('scripts')
<script type="text/javascript">
	setTimeout(function(){
		$(".notification").hide();
	}, 2000);

</script>
@endpush