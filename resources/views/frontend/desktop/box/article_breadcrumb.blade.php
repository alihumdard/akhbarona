<div class="box_breadcrumb">
    <a href="{{Config::get("app.url")}}">{{Config::get("site.lang.LNG_GO_HOME")}} |
        @foreach($breadcrumbs as $crumb)
            <a href="{{route("frontend.category.index",[$crumb->sefriendly,1])}}">{{$crumb->category_name}}</a> |
        @endforeach
        <strong>{{$article->title}}</strong>
</div>
