<?xml version="1.0"?>
<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">
    <channel>
        <title>{{$setting["VIVVO_WEBSITE_TITLE"]}}</title>
        <link>{{Config::get("app.url")}}</link>
        <description>{{$setting["VIVVO_GENERAL_META_DESCRIPTION"]}}</description>
        @if($articles && count($articles) > 0)
            @foreach($articles as $article)
                <item>
                    <title>{{$article->title}}</title>
                    <link>{{\App\Helper\Common::article_link($article)}}</link>
                    <description>{{$article->abstract?$article->abstract:Common::subWords($article->body,25)}}</description>
                    <g:image_link>{{$fileRepo->getImage($article->image)}}</g:image_link>
                    <g:category>{{$article->category_name}}</g:category>
                    <g:id>{{$article->id}}</g:id>
                </item>
            @endforeach
        @endif
    </channel>
</rss>
