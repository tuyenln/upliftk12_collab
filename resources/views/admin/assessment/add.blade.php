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
                         <h3 class="title-content">{{ $aRow ? "Edit" : "Add New" }} Assessment</h3>
                     </div>
                        <div id="app" class="sec-content fw-ct">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <!--Form  add -->
                                 <div class="x_content">
                                       @if($aRow)
                                       <form id="formAdd" method="POST"  action="{{ route('admin.assessment.edit',$aRow->id) }}" enctype="multipart/form-data">
                                          @else
                                       <form id="formAdd" method="POST"  action="{{ route('admin.assessment.store') }}" enctype="multipart/form-data">
                                          @endif
                                          @csrf
                                          <label for="name"><b>{{ __('Assessment Name') }}</b></label>
                                          <div class="form-group">
                                             <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $aRow ? $aRow->name : old('name') }}" required placeholder="Name">
                                             @if ($errors->has('name'))
                                             <span class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('name') }}</strong>
                                             </span>
                                             @endif
                                          </div>
                                          <label for="subject"><b>{{ __('Subject') }}</b></label>
                                          <div class="form-group">
                                             <select v-model="subject" @change="changeSubject()" name="subject" class="select_subject form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" required>
                                                <option value="">Select subject</option>
                                                @foreach($subjects as $s)
                                                   <option value="{{$s->id}}" {{ ($aRow && $aRow->subject == $s->id) ? 'selected' : '' }}>{{$s->name}}</option>
                                                @endforeach
                                             </select>
                                             @if ($errors->has('subject'))
                                             <span class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('subject') }}</strong>
                                             </span>
                                             @endif
                                          </div>
                                          <label for="s_grade"><b>{{ __('Grade Level') }}</b></label>
                                          <div class="form-group">
                                             <select id="s_grade" name="grade_level[]" class="form-control{{ $errors->has('grade_level') ? ' is-invalid' : '' }}" multiple required>
                                                <option value="" disabled>Select grade level</option>
                                                @foreach($grade_levels as $l)
                                                   <option value="{{$l->id}}" {{ ($aRow && in_array($l->id, $aRow->grade_level)) ? 'selected' : '' }}>{{$l->name}}</option>
                                                @endforeach
                                             </select>
                                             <p class="valid alert alert-danger hidden">Please select grade level</p>
                                             @if ($errors->has('grade_level'))
                                             <span class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('grade_level') }}</strong>
                                             </span>
                                             @endif
                                          </div>
                                          <div id="sec_pg" class="section_wrap {{ ($aRow && $aRow->passages) ? '' : 'hidden' }}" v-if="show_passages">
                                             @php
                                                $leng = ($aRow && $aRow->passages) ? count($aRow->passages) : 1;
                                             @endphp
                                             @for($i=0;$i<$leng;$i++)
                                             @php $j = $i+1; @endphp
                                             <div class="section_item pg">
                                                <label for="passages[{{$i}}][name]"><b>{{ __('Passage '. $j) }}</b></label>
                                                <a href="javascript:;" class="btn btn-danger delete_section" title="Remove"><i class="fa fa-times"></i></a>
                                                <div class="form-group">
                                                   <input type="text" id="passages[{{$i}}][name]" name="passages[{{$i}}][name]" class="form-control{{ $errors->has('section_name') ? ' is-invalid' : '' }}" value="{{ $aRow->passages[$i]['name'] ?? '' }}" placeholder="Passage Name">
                                                   <p class="valid alert alert-danger hidden">Please input name</p>
                                                </div>
                                                <div class="form-group">
                                                   <textarea class="form-control" name="passages[{{$i}}][content]" placeholder="Passage content">{{ $aRow->passages[$i]['content'] ?? '' }}</textarea>
                                                   <p class="valid alert alert-danger hidden">Please input content</p>
                                                </div>
                                             </div>
                                             @endfor
                                          </div>
                                          <div id="sec_sec" class="section_wrap {{ ($aRow && $aRow->sections) ? '' : 'hidden' }}" v-if="show_sections">
                                             @php
                                                $leng = ($aRow && $aRow->sections) ? count($aRow->sections) : 1;
                                             @endphp
                                             @for($i=0;$i<$leng;$i++)
                                             @php $j = $i+1; @endphp
                                             <div class="section_item sec">
                                                <label for="sections[{{$i}}][name]"><b>{{ __('Section '. $j) }}</b></label>
                                                <a href="javascript:;" class="btn btn-danger delete_section" title="Remove"><i class="fa fa-times"></i></a>
                                                <div class="form-group">
                                                   <input type="text" id="sections[{{$i}}][name]" name="sections[{{$i}}][name]" class="form-control{{ $errors->has('section_name') ? ' is-invalid' : '' }}" value="{{ $aRow->sections[$i]['name'] ?? '' }}" placeholder="Section Name">
                                                   <p class="valid alert alert-danger hidden">Please input name</p>
                                                </div>
                                                <div class="form-group">
                                                   <input type="text" id="sections[{{$i}}][words]" name="sections[{{$i}}][words]" class="tagsinput form-control{{ $errors->has('sections[$i][words]') ? ' is-invalid' : '' }}" value="{{ $aRow->sections[$i]['words'] ?? '' }}" placeholder="Section Words" data-role="tagsinput">
                                                   <p class="valid alert alert-danger hidden">Please input words</p>
                                                   <p>Seperate by comma or enter</p>
                                                </div>
                                             </div>
                                             @endfor
                                          </div>
                                          <a v-if="show_passages" href="javascript:;" class="btn btn-primary add_pg {{ ($aRow && $aRow->passages) ? '' : 'hidden' }}">Add passage</a>
                                          <a v-if="show_sections" href="javascript:;" class="btn btn-primary add_section {{ ($aRow && $aRow->sections) ? '' : 'hidden' }}">Add section</a>
                                          <button type="submit" class="btn btn-df add_form">Save</button>
                                       </form>
                                 </div>
                                 <!--Form  add end-->
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

<div class="section_item pg clone hidden">
   <label for="passages[99][name]"><b>{{ __('Passage 99') }}</b></label>
   <a href="javascript:;" class="btn btn-danger delete_section" title="Remove"><i class="fa fa-times"></i></a>
   <div class="form-group">
      <input type="text" id="passages[99][name]" name="passages[{99][name]" class="form-control" value="" placeholder="Passage Name">
      </span>
      <p class="valid alert alert-danger hidden">Please input name</p>
   </div>
   <div class="form-group">
      <textarea class="form-control" name="passages[99][content]" placeholder="Passage content"></textarea>
      <p class="valid alert alert-danger hidden">Please input content</p>
   </div>
</div>

<div class="section_item sec clone hidden">
   <label for="sections[99][name]"><b>{{ __('Section 99') }}</b></label>
   <a href="javascript:;" class="btn btn-danger delete_section" title="Remove"><i class="fa fa-times"></i></a>
   <div class="form-group">
      <input type="text" id="sections[99][name]" name="sections[99][name]" class="form-control" value="" placeholder="Section Name">
      <p class="valid alert alert-danger hidden">Please input name</p>
   </div>
   <div class="form-group">
      <input type="text" id="sections[99][words]" name="sections[99][words]" class="form-control tagsinput" value="" placeholder="Section Words">
      <p class="valid alert alert-danger hidden">Please input words</p>
      <p>Seperate by comma or enter</p>
   </div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
<style type="text/css">
   .hidden{display: none;}
   .bootstrap-tagsinput{
       display: block;
       width: 100%;
       min-height: calc(1.5em + 2rem + 2px);
       padding: 1rem 1.9rem;
       font-size: 1rem;
       font-weight: 400;
       line-height: 1.5;
       color: #495057;
       background-color: #fff;
       background-clip: padding-box;
       border: 1px solid #ced4da;
       border-radius: 0.625rem;
   }
   .bootstrap-tagsinput .tag {color: #1f1f1f;}
</style>
@endpush
@push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function() {
      $(document).on('click', '.add_form', function(e){
         // e.preventDefault();
         var val = $('#s_grade').val();
         if(!val){
            $('#s_grade').siblings('.valid').removeClass('hidden');
            flag = false;
         }
         $('.valid').addClass('hidden');
            flag = true;
         $('#sec_sec:not(.hidden) .section_item.sec:not(.hidden)').each(function(index) {
            input = $(this).find('input.tagsinput');
            if(!input.val()){
               input.siblings('.valid').removeClass('hidden');
               flag = false;
            }
         });
         $('#sec_pg:not(.hidden) .section_item:not(.hidden)').each(function(index) {
            $(this).find('input,textarea,select').each(function(){
               val = $(this).val();
               if(val == ''){
                  $(this).siblings('.valid').removeClass('hidden');
                  flag = false;
               }
            });
         });
            if(flag == false){
               return false;
            }
         if($('#sec_pg').hasClass('hidden') && !$('#sec_sec').hasClass('hidden')){
            $('#sec_pg').remove();
         }
         if($('#sec_sec').hasClass('hidden') && !$('#sec_pg').hasClass('hidden')){
            $('#sec_sec').remove();
         }
      });
      // passagessss
      $(document).on('click', '.add_pg', function(){
         var length = $('.section_wrap').find('.section_item.pg:not(.hidden)').length;
         if(length >= 10){
            alert("max");
            return false;
         }
         var clone = $('.section_item.pg.hidden').clone().removeClass('hidden clone');
         $('#sec_pg').append(clone);
         console.log('added');
         reindex();
      });

      // sectionnnnnn
      $(document).on('click', '.add_section', function(){
         var length = $('.section_wrap').find('.section_item.sec:not(.hidden)').length;
         if(length >= 10){
            alert("max");
            return false;
         }
         var clone = $('.section_item.sec.hidden').clone().removeClass('hidden clone');
         $('#sec_sec').append(clone);
         clone.find('.tagsinput').tagsinput('items');
         reindex();
      });

      $(document).on('click', '.delete_section', function(){
         this.closest('.section_item').remove();
         reindex();
      });
      function reindex(){
         $('.section_wrap').each(function(i){

            $(this).find('.section_item:not(.hidden)').each(function(index){
               // a = $(this).find('a.collapsepanel');
               // props = $(this).find('.props');
               // counter = $(this).find('.ms_counter');
               label = $(this).find('label');
               // a.attr('href',function(i,txt) {return txt.replace(/\d+/, index+1); });
               // props.attr('id', function(i,txt) {return txt.replace(/\d+/, index+1); });
               // counter.text(function(i,txt) {return txt.replace(/\d+/, index+1); });
               label.html(function(i,txt) {return txt.replace(/\d+/, index+1); });
               label.attr('for', function(i,txt) {return txt.replace(/\d+/, index); });
               $(this).find('input,textarea,select').each(function(){
                  this.id = this.name.replace(/\d+/, index);
                  this.name = this.name.replace(/\d+/, index);
               });
            });
         });
      }
      $(document).on('change', 'select[name="subject"]', function(){
         var val = $(this).val();
         if(val == '23'){
            $('#sec_pg, .add_pg').removeClass('hidden');
            $('#sec_sec, .add_section').addClass('hidden');
         }else {
            $('#sec_pg, .add_pg').addClass('hidden');
            $('#sec_sec, .add_section').removeClass('hidden');
         }
         // console.log(val)
      });


   });
</script>
{{-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> --}}
{{-- <script type="text/javascript" src="/resources/js/myvue.js"></script> --}}
@endpush
