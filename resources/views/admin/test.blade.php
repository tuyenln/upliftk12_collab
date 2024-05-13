@extends('layouts.master')
@section('content')
<?php  $user = Auth::user();?>
<?php
$server_check_version = '1.0.4';
$start_time = microtime(TRUE);
$operating_system = PHP_OS_FAMILY;
$memtotal = "";
$memused = "";
$memfree = "";
$phpload = "";
$total_time = "";
$disktotal = "";
$diskfree = "";
$diskused = "";
$totalconnections = "";
$connections = "";
$cpuload = "";
$memshared = "";
$memcached = "";
if ($operating_system != 'Windows') {
    $load = sys_getloadavg();
    $cpuload = $load[0];
    // Linux MEM
    $free = shell_exec('free');
    $free = (string)trim($free);
    $free_arr = explode("\n", $free);
    $mem = explode(" ", $free_arr[1]);
    $mem = array_filter($mem, function($value) { return ($value !== null && $value !== false && $value !== ''); }); // removes nulls from array
    $mem = array_merge($mem); // puts arrays back to [0],[1],[2] after
    $memtotal = round($mem[1] / 1000000,2);
    $memused = round($mem[2] / 1000000,2);
    $memfree = round($mem[3] / 1000000,2);
    $memshared = round($mem[4] / 1000000,2);
    $memcached = round($mem[5] / 1000000,2);
    $memavailable = round($mem[6] / 1000000,2);
    // Linux Connections
    $connections = `netstat -ntu | grep :80 | grep ESTABLISHED | grep -v LISTEN | awk '{print $5}' | cut -d: -f1 | sort | uniq -c | sort -rn | grep -v 127.0.0.1 | wc -l`;
    $totalconnections = `netstat -ntu | grep :80 | grep -v LISTEN | awk '{print $5}' | cut -d: -f1 | sort | uniq -c | sort -rn | grep -v 127.0.0.1 | wc -l`;

    $memusage = round(($memavailable/$memtotal)*100);



    $phpload = round(memory_get_usage() / 1000000,2);

    $diskfree = round(disk_free_space(".") / 1000000000);
    $disktotal = round(disk_total_space(".") / 1000000000);
    $diskused = round($disktotal - $diskfree);

    $diskusage = round($diskused/$disktotal*100);

    if ($memusage > 85 || $cpuload > 85 || $diskusage > 85) {
        $trafficlight = 'red';
    } elseif ($memusage > 50 || $cpuload > 50 || $diskusage > 50) {
        $trafficlight = 'orange';
    } else {
        $trafficlight = '#2F2';
    }

    $end_time = microtime(TRUE);
    $time_taken = $end_time - $start_time;
    $total_time = round($time_taken,4);

}
?>
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
               		<h3 class="title-content">Dashboard</h3>
              	</div>
                <div class="sec-content fw-ct">
                  <div class="row">
                    <div class="col-sm-12">
                        <h5 style="color: #967FDF;"><i class="fa fa-network-wired"></i>NET Stat</h5>
                        <ul class="row">
                            <li class="col-sm-4"
                                style="list-style: none;
                        padding: 15px;
                        border-left: 5px solid #967FDF;">
                                <h5>Total<br> <span style="color: #967FDF"><?php echo $totalconnections; ?></span></h5>
                                {{--<span><span style="color: #12cc28"><i class="fa fa-arrow-up"></i>3,48%</span> Since last month--}}</span>
                            </li>
                            <li class="col-sm-4"
                                style="list-style: none;
                        padding: 15px;
                        border-left: 5px solid #967FDF;">
                                <h5>Established<br> <span style="color: #967FDF"><?php echo $connections ; ?></span></h5>
                                {{--<span><span style="color: #12cc28"><i class="fa fa-arrow-up"></i>3,48%</span> Since last month</span>--}}
                            </li>
                            <li class="col-sm-4"
                                style="list-style: none;
                        padding: 15px;
                        border-left: 5px solid #967FDF;">
                                <h5>CPU Usage<br> <span style="color: #967FDF"><?php echo $cpuload . '%'; ?></span></h5>
                                {{--<span><span style="color: #12cc28"><i class="fa fa-arrow-up"></i>3,48%</span> Since last month</span>--}}
                            </li>
                        </ul>
                        <h5 style="color: #967FDF;"><i class="fa fa-memory"></i>RAM</h5>
                      <ul class="row">
                        <li class="col-sm-4"
                        style="list-style: none;
                        padding: 15px;
                        border-left: 5px solid #967FDF;">
                          <h5>Total<br> <span style="color: #967FDF"><?php echo $memtotal . ' GB'; ?></span></h5>
                          <span style="
                          position: absolute;
                          right: 42px;
                          top: 30px;
                          color: #1f1f1f;
                          font-size: 22px;
                          border-radius: 50%;
                          width: 36px;
                          box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.6);
                          text-align: center;"><i class="far fa-circle"></i></span>
                          {{--<span><span style="color: #12cc28"><i class="fa fa-arrow-up"></i>3,48%</span> Since last month--}}</span>
                        </li>
                        <li class="col-sm-4"
                        style="list-style: none;
                        padding: 15px;
                        border-left: 5px solid #967FDF;">
                          <h5>Used<br> <span style="color: #967FDF"><?php echo $memused . ' GB'; ?></span></h5>
                          <span style="
                          position: absolute;
                          right: 42px;
                          top: 30px;
                          color: #1f1f1f;
                          font-size: 22px;
                          border-radius: 50%;
                          width: 36px;
                          box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.6);
                          text-align: center;"><i class="far fa-times-circle"></i></span>
                          {{--<span><span style="color: #12cc28"><i class="fa fa-arrow-up"></i>3,48%</span> Since last month</span>--}}
                        </li>
                          <li class="col-sm-4"
                              style="list-style: none;
                        padding: 15px;
                        border-left: 5px solid #967FDF;">
                              <h5>Available<br> <span style="color: #967FDF"><?php echo $memfree . ' GB';?></span></h5>
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
                              {{--<span><span style="color: #12cc28"><i class="fa fa-arrow-up"></i>3,48%</span> Since last month</span>--}}
                          </li>
                          <li class="col-sm-4"
                              style="list-style: none;
                        padding: 15px;
                        border-left: 5px solid #967FDF;">
                              <h5>Cached<br> <span style="color: #967FDF"><?php echo $memcached . ' GB';?></span></h5>
                              {{--<span><span style="color: #12cc28"><i class="fa fa-arrow-up"></i>3,48%</span> Since last month</span>--}}
                          </li>
                          <li class="col-sm-4"
                              style="list-style: none;
                        padding: 15px;
                        border-left: 5px solid #967FDF;">
                              <h5>Shared<br> <span style="color: #967FDF"><?php echo $memshared . ' GB';?></span></h5>
                              {{--<span><span style="color: #12cc28"><i class="fa fa-arrow-up"></i>3,48%</span> Since last month</span>--}}
                          </li>
                      </ul>
                        <h5 style="color: #967FDF;"><i class="fa fa-hdd"></i>Hard Disk</h5>
                        <ul class="row">
                          <li class="col-sm-4"
                              style="list-style: none;
                        padding: 15px;
                        border-left: 5px solid #967FDF;">
                              <h5>Total<br> <span style="color: #967FDF"><?php echo $disktotal . ' GB'; ?></span></h5>
                              <span style="
                          position: absolute;
                          right: 42px;
                          top: 30px;
                          color: #1f1f1f;
                          font-size: 22px;
                          border-radius: 50%;
                          width: 36px;
                          box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.6);
                          text-align: center;"><i class="far fa-circle"></i></span>
                              {{--<span><span style="color: #12cc28"><i class="fa fa-arrow-up"></i>3,48%</span> Since last month--}}</span>
                          </li>
                          <li class="col-sm-4"
                              style="list-style: none;
                        padding: 15px;
                        border-left: 5px solid #967FDF;">
                              <h5>Used<br> <span style="color: #967FDF"><?php echo $diskused . ' GB'; ?></span></h5>
                              <span style="
                          position: absolute;
                          right: 42px;
                          top: 30px;
                          color: #1f1f1f;
                          font-size: 22px;
                          border-radius: 50%;
                          width: 36px;
                          box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.6);
                          text-align: center;"><i class="far fa-times-circle"></i></span>
                              {{--<span><span style="color: #12cc28"><i class="fa fa-arrow-up"></i>3,48%</span> Since last month</span>--}}
                          </li>
                          <li class="col-sm-4"
                              style="list-style: none;
                        padding: 15px;
                        border-left: 5px solid #967FDF;">
                              <h5>Free<br> <span style="color: #967FDF"><?php echo $diskfree . ' GB'; ?></span></h5>
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
                              {{--<span><span style="color: #12cc28"><i class="fa fa-arrow-up"></i>3,48%</span> Since last month</span>--}}
                          </li>
                      </ul>
                    </div>
                  </div>
                </div>

            </div>
          </div>
        </div>
      </div>
    </div>

      <div id="details" style="background: white;
    position: fixed;
    top: 200px;
    right: 0px;
    box-shadow: 0 0 6px 1px rgba(0,0,0,0.1);
    padding: 10px;">
          <p><span class="description">📟 Server Name: </span> <span class="result"><?php echo $_SERVER['SERVER_NAME']; ?></span></p>
          <p><span class="description">💻 Server Addr: </span> <span class="result"><?php echo $_SERVER['SERVER_ADDR']; ?></span></p>
          <p><span class="description">🌀 PHP Version: </span> <span class="result"><?php echo phpversion(); ?></span></p>
          <p><span class="description">🏋️ PHP Load: </span> <span class="result"><?php echo $phpload; ?> GB</span></p>

          <p><span class="description">⏱️ Load Time: </span> <span class="result"><?php echo $total_time; ?> sec</span></p>
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
  background-color: #967FDF;
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
