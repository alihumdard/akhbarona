@if($article->image)
    <div class="image">
        <a href="{{Common::article_link($article)}}">
            <img src="{{$fileRepo->$fnc($article->image,true,$article->md5_file)}}" @if($width)width="{{$width}}"@endif @if($height)height="{{$height}}"@endif alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
        </a>
    </div>
@endif
