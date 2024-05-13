@extends('layouts.master')
@section('content')
<?php   $user = Auth::user();?>

<div class="content sec-pad">
   <div class="team-detail-wrap shape-wrap">
      <div class="container">
         <div class="membersingle-info team-detail-space">
            <div class="row align-items-start">
               <!-- side bar menu-->
               @include('layouts/frontsidebar')
               <div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2">
                  <div class="team-detail-content nopaddingtop">
                     <div class="clearfix header-section-content hasbutton">
                        <h3 class="title-content">Manage Teachers</h3>
                         @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                    @endif
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
                                                <td>{{$aRow->school_info->school ?? ''}}</td>
                                                <td>{{$aRow->school_info->district_info->name ?? ''}}</td>
                                                <td>
                                                   <a class="edit" href="{{ $user->urlEditTeacher($aRow->id) }}" title="Edit"><i class="lni lni-pencil-alt"></i></a>
                                                   <a class="delete" href="javascript:void(0);" title="Delete" onclick="$(this).parent('td').find('#delete-form').submit();">
                                                       <i class="lni lni-trash"></i>
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
@endsection
<script type="text/javascript">
   $(document).on("change", '#dist', function(e) {
   var department = $(this).val();
   var url="{{url('get_school_dist')}}";
   $.ajax({
   type: "POST",
   data: {department: department,"_token": "{{ csrf_token() }}"},
   url: url,
   success: function(json)
   {
   $('#school_name').html(json);
   }
   });

   });
</script>
