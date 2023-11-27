<div id="page">
    <div class="middle_container">
      <div class="mid_part">
        @if($arrData['total'] > 0)
            @foreach($arrData['data'] as $article)
            <div class="head_lines">
              <div class="head_name">{{$article->category_name}}</div>
              <div class="head_time_l">{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$article->created)->format("h:i")}}</div>
              <!-- <div class="head_cmd">27</div> -->

              <div class="head_title"><a href="{{\App\Helper\Common::article_link($article)}}">{{$article->title}}</a></div>
              <div class="head_lines_img"><a href="{{\App\Helper\Common::article_link($article)}}">
                <img id="defaultDemo" class="lazyload" data-src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" width="442" height="300" alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
            </a></div>
            </div>
            @endforeach
        @endif



        <div class="menu_under_ads2 head_lines">
            @include("frontend.mobile.adv.banner_1")
        </div>


        <ul class="breadcrumb2">

          <li class="active"> <a title="المزيد في شاشة أخبارنا" href="{{Config::get('app.url')}}mobile/sport/tv">الشاشة الرياضية</a></li>
        </ul>
        <div class="clearfix"></div>
        @if(count($cate57) > 0)
        <div class="carousel slide" id="myCarousel" dir="ltr">
          <ol class="carousel-indicators">
            @foreach($cate57 as $i=>$article)
                <li data-slide-to="{{$i}}" data-target="#myCarousel" @if($i==0) active @endif></li>
            @endforeach
          </ol>


         <div class="carousel-inner">
             @foreach($cate57 as $i=>$article)

            <div class="item @if($i==0)active @endif">
                <h4 dir="rtl"><a href="{{\App\Helper\Common::article_link($article)}}" style="color:#D78835;">{{$article->title}}</a></h4>

                <a href="{{\App\Helper\Common::article_link($article)}}">
                    <img class="lazyload" data-src="{{$fileRepo->getMedium($article->image,true,$article->md5_file)}}" width="442" height="300" alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
                </a>
              <div class="carousel-caption">
                <p style="position:absolute; text-align:center; left:46%; bottom:120px;"> <a href="{{$fileRepo->getMedium($article->image,true,$article->md5_file)}}"><img class="lazyload" data-src="{{$fileRepo->getMobileUrl('assets/img/youtube_play_button.png')}}" /></a> </p>
              </div>
            </div>
            @endforeach

          </div>
          <a data-slide="prev" href="#myCarousel" class="left carousel-control">‹</a>
          <a data-slide="next" href="#myCarousel" class="right carousel-control">›</a>


        </div>
        @endif
        <div class="menu_under_ads2 head_lines">
            @include("frontend.mobile.adv.banner_2")
        </div>
        <ul class="breadcrumb2">
          <li class="active">الأكثر مشاهدة</li>
        </ul>
        <div class="clearfix"></div>
        @foreach($popularBox as $article)

        <div class="oth_headlines">
          <p><a href="{{\App\Helper\Common::article_link($article)}}">
        @if($article->image)
            <img class="lazyload" data-src="{{$fileRepo->getSummaryLarge($article->image,true,$article->md5_file)}}" width="442" height="300" alt="{{$article->image_caption?$article->image_caption:$article->title}}"  />
        @endif

    </a><span><a href="{{\App\Helper\Common::article_link($article)}}"><font><font>{{$article->title}}</font></font></a></span> </p>
        </div>
        @endforeach

      <iframe src="https://www.facebook.com/plugins/likebox.php?locale=ar_AR&amp;href=http%3A%2F%2Fwww.facebook.com%2Fakhbaronacom&amp;width=300&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;appId=175996969140016" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:258px;" allowTransparency="true" class="fb_fanpage"></iframe>

    </div>
    </div>
  </div>
