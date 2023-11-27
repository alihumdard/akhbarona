<feed xmlns="https://www.w3.org/2005/Atom" xml:base="{{Config::get("app.url")}}">
    <title type="text">{{$setting["VIVVO_WEBSITE_TITLE"]}}</title>
    <id>{{Config::get("app.url")}}</id>
    <link rel="alternate" type="text/html" hreflang="en" href="{{Config::get("app.url")}}" />
    <link rel="self" type="application/atom+xml" href="{{url()->current()}}" />
    <rights>© {{date("Y")}} Akhbarona Media</rights>
    <generator>Akhbarona Media</generator>
    <updated>{{date("Y-m-dTH:i:s")}}</updated>
    @if($articles && count($articles) > 0)
        @foreach($articles as $article)
            <entry>
                <title>{{$article->title}}</title>
                <id>{{\App\Helper\Common::article_link($article)}}</id>
                <link rel="alternate" type="text/html" hreflang="en" href="{{\App\Helper\Common::article_link($article)}}" />
                <published>{{\App\Helper\Common::format_date_atom($article->created)}}</published>
                <updated>{{\App\Helper\Common::format_date_atom(($article->last_edited && $article->last_edited != '0000-00-00 00:00:00')?$article->last_edited:$article->created)}}</updated>
                <author>
                    <name>{{$article->author}}</name>
                </author>
                <category term="tech" scheme="{{\App\Helper\Common::cat_link($article)}}" label="tech" />
                <content type="html"><![CDATA[<p><img src="{{$fileRepo->getImage($article->image)}}"></p>{{$article->body}}]]></content>
            </entry>
        @endforeach
    @endif
</feed>
