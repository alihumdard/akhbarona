 <div id="page">
    <div class="middle_container">

      <div class="mid_part">
        <span dir="ltr">
        @if($parent)
            @include("frontend.mobile.system.box_default.box_pagination",["total"=>$arrData["total"],"currentPage"=>$page,"perPage"=>$perPage,"routeName"=>"frontend.category.level2","routeParam"=>["parent"=>$parent,"slug"=>$category->sefriendly,"page"=>1]])
        @else
            @include("frontend.mobile.system.box_default.box_pagination",["total"=>$arrData["total"],"currentPage"=>$page,"perPage"=>$perPage,"routeName"=>"frontend.category.index","routeParam"=>["slug"=>$category->sefriendly,"page"=>1]])
        @endif
        </span>
        <div class="clearfix"></div>
    @if($arrData["total"] > 0)
        @foreach($arrData["data"] as $article)
            @include("frontend.mobile.summary.category",[$setting,$article,$fileRepo,$category])
        @endforeach
    @else
        {{Config::get("site.lang.LNG_NO_ENTRIES")}}
    @endif
          @if($parent)
              @include("frontend.mobile.system.box_default.box_pagination",["total"=>$arrData["total"],"currentPage"=>$page,"perPage"=>$perPage,"routeName"=>"frontend.category.level2","routeParam"=>["parent"=>$parent,"slug"=>$category->sefriendly,"page"=>1]])
          @else
              @include("frontend.mobile.system.box_default.box_pagination",["total"=>$arrData["total"],"currentPage"=>$page,"perPage"=>$perPage,"routeName"=>"frontend.category.index","routeParam"=>["slug"=>$category->sefriendly,"page"=>1]])
          @endif

        <div class="menu_under_ads2 head_lines">
            @include("frontend.mobile.adv.banner_1")
        </div>

        <ul class="breadcrumb2">
          <li class="active">المواضيع الأكثر مشاهدة</li>
        </ul>
        <div class="clearfix"></div>
        @foreach($popularBox as $article)

        <div class="oth_headlines">
          <p><a href="{{\App\Helper\Common::article_link($article)}}">
        @if($article->image)
            <img class="lazyload" data-src="{{$fileRepo->getSummaryMedium($article->image,true,$article->md5_file)}}" alt="{{$article->image_caption?$article->image_caption:$article->title}}" />
        @endif</a><span><a href="{{\App\Helper\Common::article_link($article)}}"><font><font>{{$article->title}}</font></font></a></span> </p>
        </div>
        @endforeach

      <iframe src="https://www.facebook.com/plugins/likebox.php?locale=ar_AR&amp;href=http%3A%2F%2Fwww.facebook.com%2Fakhbaronacom&amp;width=300&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false&amp;appId=175996969140016" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:258px;" allowTransparency="true" class="fb_fanpage"></iframe>

    </div>
    </div>
  </div>
