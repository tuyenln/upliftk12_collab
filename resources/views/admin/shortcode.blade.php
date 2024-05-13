@extends('layouts.master')
@section('content')
<?php  $user = Auth::user();?>

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
                        <h3 class="title-content">Manage Cases / Objectives</h3>
                        <span>Total: {{$aRows->total()}}</span>
                     </div>
                     @if(count($aRows))
                     <div class="table-scroll">
                        <table class="table table-bordered table-striped actionlistform">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Case</th>
                                 <th>Shortcode</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($aRows as $aKey => $aRow)
                              {{--@php
                                 $explode = explode('|', $aRow->case_data);
                                 if(is_array($explode)){
                                    $case = $collection->where('identifier', $explode[1])->first();
                                 }
                              @endphp--}}
                              <tr>
                                 <th scope="row" data-id="{{$aRow->id}}">{{ $aKey+1 }}</th>
                                 <td>{{$aRow['humanCodingScheme'] ?? 'None'}}</td>
                                 <td><input type="text" name="shorcode" value="{{$aRow->shortCode}}"></td>
                                 <td>
                                    <a href="javascript:;" class="btn btn-primary update_shortcode">Update</a>
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                     @else
                     No data found
                     @endif
                     <div class="clearfix"></div>
                     {{ $aRows->appends(request()->except('page'))->links() }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('styles')
<style type="text/css" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css"></style>
<style type="text/css">
   .hidden {
      display: none !important;
   }
</style>
@endpush
@push('scripts')
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
   $(document).on("click", '.update_shortcode', function(e) {
      var tr = $(this).closest('tr')
      var id = tr.find('th').data('id')
      var shorcode = tr.find('input[name=shorcode]').val()
       alert('it is not working');
      /*$.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         url: './update-shortcode',
         type: 'POST',
         data: {
            id: id,
            value: shorcode
         },
         dataType: 'json',
         success: function(res) {
            alert(res.message)
            console.log(res)
         },
         error: function (error) {
            console.log(error)
            alert(error.responseJSON.message)
         }
      })*/
   });
</script>
@endpush('scripts')
