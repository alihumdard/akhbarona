<div class="heading mt-4">
    <span>آخر الأخبار</span><svg xmlns="http://www.w3.org/2000/svg" width="10" height="47"
        viewBox="0 0 10 50" style="margin-bottom: 8px; margin-left: -5px;" fill="none">
        <rect y="25" width="10" height="25" fill="#2E4866" />
        <rect width="10" height="25" fill="#C2111E" />
    </svg>
</div>
<!-- horizantal line -->
<hr class="red-line">
<div>
    <div class="row">
        @foreach($latestNewsBhSw as $article)
        <div class="col-12 col-sm-12 col-md-6 mt-3 col-lg-3 mt-3">
            <div class="main-box">
                <img class="img-fluid" src="{{ $article->image ?? 'admin/assets/img/no-image.png' }}" alt="no image available">
                <div class="main-box-text">
                    <p class="story_date_bh_sw"><a style="color:black; text-decoration:none;" href="{{Common::article_link($article)}}">{{$article->title}}</a></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

 
   