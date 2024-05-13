@extends('layouts.master')
@section('css')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
    .note-style {
       position: relative;
       top: 0;
      right: 0;
      width: auto; 
   }
   .dropdown-toggle::after {
      display: inline-block;
      margin-left: 0.255em;
      vertical-align: 0;
      border-top: unset;
      border-right: unset;
      border-bottom: unset;
      border-left: unset;
   }
   .alert1-success {
      color: #155724;
      background-color: #d4edda;
      border-color: #c3e6cb;
   }
   .alert1 {
      position: relative;
      padding: .75rem 1.25rem;
      margin-bottom: 1rem;
      border: 1px solid transparent;
      border-radius: .25rem;
   }
    </style>
  @endsection
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
                     <div class="col-12" style="border-bottom: 1px solid; padding-top: 20px; margin-bottom: 20px;">
                        <h5 style="display: inline-block;">Manage Notes</h5>
                        <span class="btn btn-primary pull-right button-header-content save-note" style="display: inline-block; margin-top: -6px;">Save Notes</span>
                     </div>
                     <div class="alert alert-success" style="display: none;">Your submit was susscessful!</div>

                     <div class="sec-content fw-ct">
                        <div class="row">
                           <div class="col-sm-12">
                              <!--tabel start-->
                              <div class="x_content">
                                 <div id="summernote"></div>
                                 <script>
                                    $('#summernote').summernote({
                                       placeholder: '',
                                       tabsize: 2,
                                       height: 300,
                                       toolbar: [
                                          ['style', ['style']],
                                          ['font', ['bold', 'underline', 'clear']],
                                          ['color', ['color']],
                                          ['para', ['ul', 'ol', 'paragraph']],
                                          ['table', ['table']],
                                          ['insert', ['link', 'picture', 'video']],
                                          ['view', ['fullscreen', 'codeview', 'help']]
                                       ]
                                    });
                                    @if (!empty($aRow))
                                       $('#summernote').summernote('code', '<?php echo $aRow->notes; ?>');
                                    @endif
                                 </script>
                              </div>
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
<script>

$.ajaxSetup({
   headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});

$('.save-note').click(function() {
   var note = $('#summernote').summernote('code');
   console.log(note);
   $.ajax({
      url: "{{route('admin.note.update', $id)}}",
      type: 'post',
      data: {
         'notes' : note
      },
      success: function(response) {
         console.log(response);
         if (response == 'success') {
            $('.alert-success').show();
         }
      }
   })

});
</script>

@endsection
