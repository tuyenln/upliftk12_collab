@extends('layouts.master')
@section('content')
<?php $user = Auth::user();?>

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
                <h3 class="title-content">Report details</h3>
              </div>
                @php
                  $passage_id = $pl->passage_id;
                  //get content passage
                  $content_word = $pl->assessment->passages[$passage_id-1]['content'];
                  $array_word = explode(' ', $content_word);
                  $speech_words = $pl->speech_words;
                  $pos = 0;
                  foreach($speech_words->reverse() as $key=>$word){
                    $pos++;
                    if($word['score'] > 0)  break;
                  }
                  $end_array_word = $speech_words->count() - $pos;
                  $true_words = $pl->speech_words->take($end_array_word+1);

                  $phonemes = $pl->phonemes;
                  $pos_phone = 0;
                  foreach($phonemes->reverse() as $key=>$word){
                    $pos_phone++;
                    if($word['score'] > 0)  break;
                  }
                  $end_array_phonemes = $phonemes->count() - $pos_phone;
                  $true_phonemes = $pl->phonemes->take($end_array_phonemes+1);
                  $arr_phonemes = $true_phonemes->groupBy('phoneme')
                                  ->sortByDesc(function ($value, $key) {
                                    return count($value);
                                  });
                  $new_collect = collect();
                  foreach ($arr_phonemes as $key => $phonemes) {
                    $new_collect->push(collect([
                       'name' => $key,
                       'count' =>  $phonemes->count(),
                       'score' =>  $phonemes->avg('score')
                    ]));
                  }
                  // dump($new_collect->groupBy('count')->sortBy('score'));

                  $arr_label = [];
                  $arr_value = [];
                  $arr_color = [];
                  $list_color = ['255, 0, 0','255, 166, 0','255, 255, 0','0, 255, 0'];
                  foreach ($arr_phonemes->take(10) as $key => $phonemes) {
                      $arr_label[] = $phonemes->first()->phoneme;
                      $score = (int) $phonemes->avg('score');
                      $arr_value[] = $score;
                      switch ($score) {
                        case $score >= 85:
                          $key = 3;
                          break;
                        case $score >= 80:
                          $key = 2;
                          break;
                        case $score >= 70:
                          $key = 1;
                          break;
                        case $score < 70:
                          $key = 0;
                          break;

                        default:
                          $key = 0;
                          break;
                      }
                      $arr_color[] = "rgba($list_color[$key], 0.2)";
                  }
                @endphp
            <div class="sec-content fw-ct">
              <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>Student</th>
                      <th>Class</th>
                      <th>Assessment</th>
                      <th>Passage</th>
                      <th>Date taken test</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ $pl->user->full_name }}</td>
                    <td>{{ $student_class->name ?? '' }}</td>
                    <td>{{ $pl->assessment->name }}</td>
                    <td>{{ $pl->assessment->passages[$pl->passage_id-1]['name'] }}</td>
                    <td>{{ date('M dS, Y H:i',strtotime($pl->updated_at)) }}</td>
                  </tr>
                </tbody>
              </table>
              @php $speech_results = $pl->speech_results->first(); @endphp
              <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                      <th>Average Phoneme Score</th>
                      <th>Word count</th>
                      <th>Words correct/min</th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ number_format($true_phonemes->avg('score'), 2) }}%</td>
                    <td>{{ $true_words->count() }}</td>
                    <td>{{ number_format($speech_results->result['overall_metrics']['wcm'] ?? 0, 2) }}</td>
                  </tr>
                </tbody>
              </table>
              @if($speech_results && $speech_results->audio_url)
              <div class="text-center">
                <audio controls>
                  <source src="{{asset('public'.$speech_results->audio_url)}}" type="audio/mpeg">
                  Your browser does not support the audio element.
                </audio>
              </div>
              @endif

              <p class="speech_words">
                @php $i=0; @endphp
                @foreach($array_word as $key=>$word)
                  @if($i > $end_array_word)
                    <span class="line_through">{{$word}}</span>
                  @else
                    @php $strip_word = preg_replace('/[^A-Za-z0-9\-]/', '', $word); @endphp
                    @if($speech_words->where('word', $strip_word)->count())
                      @php $val = $speech_words->get($i);$i++; @endphp
                      @if($val && $val->score < 80)
                        <a class="change_score" data-id="{{$val->id}}" data-score="{{$val->score}}" href="javascript:;">{{$word}}</a>
                      @else
                        {{$word}}
                      @endif
                    @else
                      {{$word}}
                    @endif
                  @endif
                @endforeach
              </p>

              <!-- draw chart -->
              <canvas id="myChart" width="400" height="200"></canvas>
              <div class="row">
                <div class="col-sm-12">
                  <h3 class="title-content bg_underline">Phonemes</h3>
                  <div class="table-scrolly">
                    <table class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th>Phoneme</th>
                            <th>Count</th>
                            <th>Average Score</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ( $new_collect->groupBy('count')->sortBy('score') as $key=>$phonemes )
                          @foreach ( $phonemes->sortBy('score') as $key=>$phoneme )
                          <tr>
                            <th scope="row">{{ $phoneme['name'] }}</th>
                            <th scope="row">{{$phoneme['count']}}</th>
                            <th scope="row">{{number_format($phoneme['score'], 2)}}%</th>
                          </tr>
                          @endforeach
                        @endforeach
                          <tr>
                            <th scope="row">Grand Total</th>
                            <th scope="row">{{$true_phonemes->count()}}</th>
                            <th scope="row">{{number_format($true_phonemes->avg('score'), 2)}}%</th>
                          </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <a class="btn btn-primary" href="{{ route('teacher.class.report', ['class' => $student_class->id ?? null, 'assessment' => $pl->assessment->id, 'passage' => $passage_id]) }}">Back to list</a>
              </div>
            </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
<div id="modal_change_score" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Score</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="update_score" method="post" action="">
          <h6></h6>
          <input type="number" name="score" min="1" max="100">
          <input type="hidden" name="word_id">
          <button type="submit">Save</button>
        </form>
      </div>
      <div class="modal-footer">{{--
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
      </div>
    </div>
  </div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style type="text/css">
  .speech_words {
    border: 1px solid #412A7F;
    padding: 15px;
  }
  .speech_words .change_score {
    border: 1px solid #cc0c2c;
    padding: 0 5px;
  }
  .speech_words .line_through {
    text-decoration: line-through;
  }
  .modal-content  {
    -webkit-border-radius: 0px !important;
    -moz-border-radius: 0px !important;
    border-radius: 0px !important;
  }
</style>
@endpush
@push('scripts')
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script type="text/javascript">
  var ctx = document.getElementById('myChart').getContext('2d');
  var arr_label = [<?php echo '"'.implode('","', $arr_label).'"' ?>];
  var arr_data = [<?php echo '"'.implode('","', $arr_value).'"' ?>];
  var arr_color = [<?php echo '"'.implode('","', $arr_color).'"' ?>];
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: arr_label,
        datasets: [{
            label: 'Score',
            data: arr_data,
            backgroundColor: arr_color,
            borderColor: 'rgba(4, 51, 128, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
  $(document).on('click', '.change_score', function(){
    let id = $(this).data('id');
    let score = $(this).data('score');
    let text = $(this).text();
    let modal = $('#modal_change_score');
    modal.find('h6').html(text);
    modal.find('input[name=word_id]').val(id);
    modal.find('input[name=score]').val(score);
    modal.modal('show');
  });

  $(document).on('submit', 'form.update_score', function(e){
    e.preventDefault();
    let form_data = $(this).serialize();
    let modal = $('#modal_change_score');
        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '/teacher/update-score',
          type: 'POST',
          data: form_data,
          success: function(res) {
            if(res.status == "success"){
              toastr.success(res.msg, '', {timeOut: 2000})
              modal.modal('hide');
              setTimeout(function(){
                window.location.reload();
              }, 2000);
            }else{
              toastr.error(res.msg, '', {timeOut: 2000})
            }
          }
        });
  });
</script>
@endpush
