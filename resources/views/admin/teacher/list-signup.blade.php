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
                        <h3 class="title-content">Manage Teachers Signup</h3>
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                     </div>
                        <div class="sec-content fw-ct">
                           <div class="row">
                              <div class="col-sm-12">
                                 <!--tabel start-->
                                 <div class="x_content">
                                    @if(count($aRows))
                                    <div class="table-scroll">
                                       <table class="table table-bordered table-striped actionlistform">
                                          <thead>
                                             <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>School</th>
                                                <th>District</th>
                                                <th>Phone</th>
                                                <th>Action</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             @foreach($aRows as $aKey => $aRow)
                                             <tr>
                                                <th scope="row">{{ $aKey+1 }}</th>
                                                <td>{{$aRow->name}}</td>
                                                <td>{{$aRow->school ?? ''}}</td>
                                                <td>{{$aRow->district ?? ''}}</td>
                                                <td>{{$aRow->phone ?? ''}}</td>
                                                <td>
                                                   <a class="edit" href="{{ route('admin.teacher.signup.edit', $aRow->id) }}" title="Edit"><i class="lni lni-pencil-alt"></i></a>
                                                   <a class="delete" href="javascript:void(0);" title="Delete" onclick="jQuery(this).parent('td').find('#delete-form').submit();"><i class="lni lni-trash"></i>
                                                   </a>
                                                   <form id="delete-form" onsubmit="return confirm('Are you sure to delete?');" action="{{ route('admin.teacher.signup.destroy', $aRow->id) }}" method="post" style="display: none;">
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
