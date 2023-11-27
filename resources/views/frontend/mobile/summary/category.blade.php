<div class="head_lines">

    <div class="head_name">{{$category->category_name}}</div>

    <div class="head_time_l">{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$article->created)->format("h:i")}}</div>

    <!-- <div class="head_cmd">27</div> -->

    <div class="head_title"><a href="{{\App\Helper\Common::article_link($article)}}">{{$article->title}}</a></div>

    <div class="head_lines_img"><a href="{{\App\Helper\Common::article_link($article)}}">

            @if($article->image)
                <img class="lazyload" data-src="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" width="442" height="300" alt="{{$article->image_caption?$article->image_caption:$article->title}}"  />
            @endif

        </a></div>

</div>
