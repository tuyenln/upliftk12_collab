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
                        <div class="clearfix header-section-content">
                           <h3 class="title-content">Manage Principals</h3>
                           <div class="filter-mp">
                              @if(Session::has('message'))
                              <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                              @endif
                              <a href="{{ route('admin.principal.create') }}" class="btn btn-primary pull-right">Add Principal</a>

                              </div>
                        </div>

                        <div class="sec-content fw-ct">
                           <div class="row">
                              <div class="col-sm-12">
                                 <!--tabel start-->
                                 <div class="x_content">
                                    <form class="form-inline paddingright165" method="GET" action="">
                                       <div class="form-group mr-6">
                                          <select class="form-control" name="district_id" id="dist">
                                             <option value="">--Select District Name--</option>
                                             @foreach($districts as $district)
                                             <option value="{{$district->id}}" {{ (isset($_GET['district_id']) && $_GET['district_id'] == $district->id) ? 'selected' : '' }}>{{$district->name}}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                       <div class="form-group mr-6">
                                          <button class="btn btn-primary" type="submit">Apply Filter</button>
                                       </div>
                                    </form>
                                    @if(count($aRows))
                                    <div class="table-scroll">
                                       <table class="table table-bordered table-striped">
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
                                                   <a class="edit" href="{{ route('admin.principal.edit',$aRow->id) }}"><i class="lni lni-pencil-alt"></i></a>
                                                   <a class="delete" href="javascript:void(0);" onclick="jQuery(this).parent('td').find('#delete-form').submit();"><i class="lni lni-trash"></i>
                                                   </a>
                                                   <form id="delete-form" onsubmit="return confirm('Are you sure to delete?');" action="{{ route('admin.principal.destroy',$aRow->id) }}" method="post" style="display: none;">
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
