@extends('layouts.app')

@section('content')
    
<style type="text/css">
  .schedule-item-border {
    border: 1px solid black;

    height: 200px;
  }
  .schedule-img {
    width: 250px;
    height: 166px;
  }

  .schedule-table {
    width: 100%;
    display: table;
    border-collapse: separate;
    box-sizing: border-box;
    text-indent: initial;
    border-spacing: 10px;
    border-color: grey;
    border: 1px solid grey;
    border-radius: 20px;
  }

  .schedule-border {
    border: 1px solid black;
    padding: 5px;
    font-size: 20px;

  }

</style>
  <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="1000">
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      @if (array_key_exists('google_images', $data))
        @foreach ($data['google_images'] as $key=>$google_images)
          @foreach ($google_images as $google_image)
            <div style="padding-top: 20px; height: 100vh;" class="item" data-time="3">
              <h3 style="text-align: center;">{{ $data['title']['google_images'][$key] }}</h3>
              <img src="{{ $google_image->url }}" style="max-height: 90%; border: 2px solid #544949; margin-top: -5px;" >
            </div>
          @endforeach
        @endforeach
      @endif

      @if (array_key_exists('sites', $data))
        @foreach ($data['sites'] as $key=>$site)
          <div style="padding-top: 20px; @if (!(array_key_exists('title', $data) && $data['title'] == 'off')) height: 90vh; @else height: 100vh; @endif" class="item" data-time="{{ $data['time']['sites'][$key] }}">
              <!-- <div> -->
                <iframe style="width: 90%; height: 100%; margin-left: 5%;" src="{{ $site->url }}"></iframe>
            <!-- </div> -->
          </div>
        @endforeach
      @endif

      @if (array_key_exists('schedules', $data))
        @foreach ($data['schedules'] as $key=>$schedules)
          @for ($i = 1; $i <= ceil($schedules->count() / 4); $i ++)
            <div style="padding-top: 20px;" class="item" data-time="{{ $data['time']['schedules'][$key] }}">
                <!-- <div> -->
                  <div class="" style="padding: 10px;">
                    <!-- Wrapper for slides -->
                    <h1 style="font-weight: bold;">Termine</h1>
                
                    <div class="table-responsive text-center" style="margin-top: 10px; width: 100%;">
                
                      <table class="schedule-table" style="width: 100%;" cellspacing="10px">
                        <tbody>
                          @foreach ($schedules as $schedule)
                            @if ( $loop->index < (($i * 4) - 4) || $loop->index + 1 > ($i * 4)  )
                              @continue    
                            @endif

                            @if (($loop->index + 2) % 2 == 0)
                              <tr class="slide-tr slide-number-{{ ceil(($loop->index + 1) / 4) }}">
                            @endif
                                <td class="schedule-border" style="padding: 10px; @if (($loop->index + 2) % 2 == 0) background-color: #0389f7; @else background-color: #e2e2e2; @endif">
                                  <div>
                                    <img class="schedule-img" src="{{ asset('storage') . '/' . $schedule->image->url }}" style="@if (($schedules->count() == $loop->index + 1) && (($loop->index + 1) % 2 == 1) && (($loop->index + 1) % 4 == 1)) width: auto; height: 50vh;  @else width: 250px; height: 166px; @endif">
                                  </div>
                                  <div style="">
                                    <strong>
                                      <h3 style="font-weight: bold; padding-top: 5px; padding-bottom: 5px; margin: 0px;">
                            {{ __('schedule.' . date('l', strtotime($schedule->date))) }}, {{ date('d.m', strtotime($schedule->date)) }}
                            <br>
                            {{ __('schedule.time') }}: {{ $schedule->time }}
                            </h3>
                            
                                    </strong>
                                  </div>
                                  <div>
                                    <strong>
                                      <div>
                              {{ $schedule->line1 }}
                            </div>
                            <div>
                                        {{ $schedule->line2 }}
                            </div>
                            <div>
                                        {{ $schedule->line3 }}
                            </div>
                                    </strong>
                                  </div>
                                </td>
                            @if (($loop->index + 2) % 2 != 0)
                              </tr>
                            @endif
                          @endforeach
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
              <!-- </div> -->
            </div>
          
          @endfor
        @endforeach
      @endif
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" style="background-image: none;">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" style="background-image: none;">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <script>

    var items = $("#myCarousel").find(".item");

    items.each(function(index){
      if (index == 0) {
        $(items[index]).addClass("active");
      }
    });

    // 
    //   var items = $(this).find(".item.active").data('time');
    //   console.log(index.toElement);
        
    // });
    var totalItems = $('.item').length;
    var currentIndex = $('div.active').index() + 1;


    var time = 3000;

    if ($($(".item")[0]).data('time')) {
      time = $($(".item")[0]).data('time') * 1000;
    }
    $('#myCarousel').carousel({
      pause: false,
      interval: time 
    });

    $('#myCarousel').on('slid.bs.carousel', function() {
      c = $('#myCarousel');
      currentIndex = $('div.active').index() + 1;
      console.log($('div.active').index());
      
      if ($($(".item")[currentIndex]).data('time')) {
        time = $($(".item")[currentIndex]).data('time') * 1000;
      }
      opt = c.data()['bs.carousel'].options;
      opt.interval= time;
      c.data({options: opt});
      time = $($(".item")[0]).data('time') * 1000;
    });
  </script>
@endsection