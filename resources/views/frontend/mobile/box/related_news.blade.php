<div id="box_related_news" class="box">
    <div class="box_title_holder"><div class="box_title">{{Config::get("site.lang.LNG_RELATED_NEWS")}}</div></div>
    <div class="box_body">
        <div class="box_content">
            <ul>
                @foreach($relatedNews as $article)
                    <li>
                        <a href="{{\App\Helper\Common::article_link($article)}}">
                            {{$article->title}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
