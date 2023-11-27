<rss version="2.0" xmlns:media="https://search.yahoo.com/mrss/" xmlns:content="http://purl.org/rss/1.0/modules/content/">
    <channel>
        <generator>Akhbarona Media</generator>
        <title>{{$setting["VIVVO_WEBSITE_TITLE"]}}</title>
        <link>{{Config::get("app.url")}}</link>
        <description>{{$setting["VIVVO_WEBSITE_TITLE"]}}</description>
        <lastBuildDate>{{date("D, d M Y H:i:s O")}}</lastBuildDate>
        <ttl>15</ttl>
        <copyright>© {{date("Y")}} Akhbarona Media</copyright>
        <image>
            <title>{{$setting["VIVVO_WEBSITE_TITLE"]}}</title>
            <url>{{Config::get("app.cdn_url")}}themes/icons/rss.png</url>
            <link>{{Config::get("app.url")}}</link>
        </image>
        @if($articles && count($articles) > 0)
            @foreach($articles as $article)
                <item>
                    <title>{{$article->title}}</title>
                    <link>{{\App\Helper\Common::article_link($article)}}</link>
                    @if($article->image)
                        <media:content large="image" url="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" width="600" height="337" />
                        <media:img url="{{$fileRepo->getImage($article->image)}}"  />
                        <media:thumbnail url="{{$fileRepo->getLarge($article->image,true,$article->md5_file)}}" />
                    @endif
                    <category>{{$article->category_name}}</category>
                    <pubDate>{{date("D, d M Y H:i:s O",strtotime($article->created))}}</pubDate>
                    <description>{{$article->abstract?$article->abstract:Common::subWords($article->body,25)}}</description>
                    <content:encoded>
                        <![CDATA[<p><img src="{{$fileRepo->getImage($article->image)}}"></p>{{$article->body}}]]>
                    </content:encoded>
                    <guid isPermaLink="true">{{Config::get("app.url")}}permalink/{{$article->id}}.html</guid>
                </item>
            @endforeach
        @endif
    </channel>
</rss>
