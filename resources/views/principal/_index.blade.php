@extends('layouts.master')

@section('content')


<div class="content sec-pad">
  <div class="team-detail-wrap shape-wrap">

    <div class="container">
      <div class="membersingle-info team-detail-space">
        <div class="row align-items-start">
          @include('layouts/frontsidebar')
          <div class="col-12 col-sm-12 col-md-12 col-lg-9 mrgn-b-2">
            <div class="team-detail-content nopaddingtop">
              <div class="clearfix header-section-content">
                <h3 class="title-content">Dashboard</h3>
              </div>
              <div class="sec-content fw-ct">
                  <div class="row">
                    <div class="col-sm-12">
                      <ul class="row">
                        <li class="col-sm-4"
                        style="list-style: none;
                        padding: 15px;
                        border-left: 5px solid #412A7F;">
                          <h5>Total Lorem<br> <span style="color: #412A7F">25,000</span></h5>
                          <span style="
                          position: absolute;
                          right: 42px;
                          top: 30px;
                          color: #1f1f1f;
                          font-size: 22px;
                          border-radius: 50%;
                          width: 36px;
                          box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.6);
                          text-align: center;"><i class="fa fa-hand-pointer"></i></span>
                          <span><span style="color: #12cc28"><i class="fa fa-arrow-up"></i>3,48%</span> Since last month</span>
                        </li>
                        <li class="col-sm-4"
                        style="list-style: none;
                        padding: 15px;
                        border-left: 5px solid #412A7F;">
                          <h5>Total Lorem<br> <span style="color: #412A7F">25,000</span></h5>
                          <span style="
                          position: absolute;
                          right: 42px;
                          top: 30px;
                          color: #1f1f1f;
                          font-size: 22px;
                          border-radius: 50%;
                          width: 36px;
                          box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.6);
                          text-align: center;"><i class="fa fa-home"></i></span>
                          <span><span style="color: #12cc28"><i class="fa fa-arrow-up"></i>3,48%</span> Since last month</span>
                        </li>
                        <li class="col-sm-4"
                        style="list-style: none;
                        padding: 15px;
                        border-left: 5px solid #412A7F;">
                          <h5>Total Lorem<br> <span style="color: #412A7F">25,000</span></h5>
                          <span style="
                          position: absolute;
                          right: 42px;
                          top: 30px;
                          color: #1f1f1f;
                          font-size: 22px;
                          border-radius: 50%;
                          width: 36px;
                          box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.6);
                          text-align: center;"><i class="fa fa-check"></i></span>
                          <span><span style="color: #12cc28"><i class="fa fa-arrow-up"></i>3,48%</span> Since last month</span>
                        </li>
                      </ul>
                      <div class="table-scroll">
                        <table id="q-graph">
                            <tbody>
                              <tr class="qtr" id="q1">
                                <th scope="row">May<br>2020</th>
                                <td class="paid bar" style="height: 99px;"></td>
                              </tr>
                                <tr class="qtr" id="q2">
                                <th scope="row">Apr<br>2020</th>
                                <td class="paid bar" style="height: 324px;"></td>
                              </tr>
                              <tr class="qtr" id="q3">
                                <th scope="row">Mar<br>2020</th>
                                <td class="paid bar" style="height: 33px;"></td>
                              </tr>
                              <tr class="qtr" id="q4">
                                <th scope="row">Feb<br>2020</th>
                                <td class="paid bar" style="height: 195px;"></td>
                              </tr>
                              <tr class="qtr" id="q5">
                                <th scope="row">Jan<br>2020</th>
                                <td class="paid bar" style="height: 125px;"></td>
                              </tr>
                              <tr class="qtr" id="q6">
                                <th scope="row">Dec<br>2019</th>
                                <td class="paid bar" style="height: 175px;"></td>
                              </tr>
                            </tbody>
                        </table>
                        <div id="ticks">
                          <div class="tick" style="height: 59px;"><p>50</p></div>
                          <div class="tick" style="height: 59px;"><p>40</p></div>
                          <div class="tick" style="height: 59px;"><p>30</p></div>
                          <div class="tick" style="height: 59px;"><p>20</p></div>
                          <div class="tick" style="height: 59px;"><p>10</p></div>
                          <div class="tick" style="height: 59px;"><p>0</p></div>
                        </div>
                      </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                      <h3 class="title-content bg_underline">Lorem Ipsum</h3>
                      <div class="table-scroll">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col"></th>
                              <th scope="col">Dolor</th>
                              <th scope="col">Sit Amet</th>
                              <th scope="col">Earning</th>
                              <th scope="col">User</th>
                            </tr>
                          </thead>
                          <tbody>
                            @for($i=1;$i<5;$i++)
                            <tr>
                              <th scope="row">{{$i}}</th>
                              <td>Mark</td>
                              <td>John</td>
                              <td>10000</td>
                              <td>25</td>
                            </tr>
                            @endfor
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                      <h3 class="title-content bg_underline">Lorem Ipsum</h3>
                      <div class="table-scroll">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col"></th>
                              <th scope="col">Dolor</th>
                              <th scope="col">Sit Amet</th>
                              <th scope="col">Earning</th>
                              <th scope="col">User</th>
                            </tr>
                          </thead>
                          <tbody>
                            @for($i=1;$i<5;$i++)
                            <tr>
                              <th scope="row">{{$i}}</th>
                              <td>Mark</td>
                              <td>John</td>
                              <td>10000</td>
                              <td>25</td>
                            </tr>
                            @endfor
                          </tbody>
                        </table>
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
<style type="text/css">
#q-graph {
  display: block; /* fixes layout wonkiness in FF1.5 */
  position: relative;
  width: 600px;
  height: 300px;
  margin: 5em 0 0 8em;
  padding: 0;
  background: transparent;
  font-size: 11px;
}

#q-graph caption {
  caption-side: top;
  width: 600px;
  text-transform: uppercase;
  letter-spacing: .5px;
  top: -40px;
  position: relative;
  z-index: 10;
  font-weight: bold;
}

#q-graph tr, #q-graph th, #q-graph td {
  position: absolute;
  bottom: 0;
  width: 50px;
  z-index: 2;
  margin: 0;
  padding: 0;
  text-align: center;
}

#q-graph td {
  transition: all .3s ease;

  &:hover {
    background-color: desaturate(#85144b, 100);
    opacity: .9;
    color: white;
  }
}

#q-graph thead tr {
  left: 100%;
  top: 50%;
  bottom: auto;
  margin: -2.5em 0 0 5em;}
#q-graph thead th {
  width: 7.5em;
  height: auto;
  padding: 0.5em 1em;
}
#q-graph thead th.sent {
  top: 0;
  left: 0;
  line-height: 2;
}
#q-graph thead th.paid {
  top: 2.75em;
  line-height: 2;
  left: 0;
}

#q-graph tbody tr {
  height: 296px;
  padding-top: 2px;
  color: #AAA;
}
#q-graph #q1 {
  left: 0;
}
#q-graph #q2 {left: 100px;}
#q-graph #q3 {left: 200px;}
#q-graph #q4 {left: 300px;}
#q-graph #q5 {left: 400px;}
#q-graph #q6 {left: 500px; border-right: none;}
#q-graph tbody th {bottom: -2.75em; vertical-align: top;
font-weight: normal; color: #333;}
#q-graph .bar {
    width: 15px;
    border: 1px solid;
    border-bottom: none;
    color: #000;
    border-radius: 5px;
}
#q-graph .bar p {
  margin: 5px 0 0;
  padding: 0;
  opacity: .4;
}
#q-graph .sent {
  left: 13px;
  background-color: $color-sent;
  border-color: transparent;
}
#q-graph .paid {
  left: 17px;
  bottom: 4px;
  background-color: #412A7F;
  border-color: transparent;
}


#ticks {
  position: relative;
  top: -300px;
  left: 110px;
  width: 596px;
  height: 300px;
  z-index: 1;
  margin-bottom: -250px;
  font-size: 10px;
  font-family: "fira-sans-2", Verdana, sans-serif;
}

#ticks .tick {
  position: relative;
  border-top: 1px dotted #C4C4C4;
  width: 600px;
}

#ticks .tick p {
  position: absolute;
  left: -5em;
  top: -0.8em;
  margin: 0 0 0 0.5em;
}
</style>

@endsection
