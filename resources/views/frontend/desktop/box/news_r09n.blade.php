@if(count($newsR09n) > 0)

<div class="col-md-6 mt-3">
        <div class="heading mt-4">
            <span>طب وصحة</span><svg xmlns="http://www.w3.org/2000/svg" width="10"
                height="47" viewBox="0 0 10 50"
                style="margin-bottom: 8px; margin-left: -5px;" fill="none">
                <rect y="25" width="10" height="25" fill="#2E4866" />
                <rect width="10" height="25" fill="#C2111E" />
            </svg>
        </div>
        <!-- horizantal line -->
        <hr class="red-line">
        <div class="main-div mt-3">
        <?php $article = $newsR09n[0];unset($newsR09n[0])?>

            @if($article->image)
                <a href="{{Common::article_link($article)}}">
                    <img class="img-fluid" class="image-fluid" src="{{$fileRepo->getMedium($article->image,true,$article->md5_file)}}" width="305" height="200" alt="{{$article->image_caption?$article->image_caption:$article->title}}" /><br />
                </a>
            @endif
        <div>
                @foreach($newsR09n as $article)
                <p>
                     <a  style="color:black; text-decoration:none;" href="{{Common::article_link($article)}}" >{{$article->title}}</a>
                </p>
                @endforeach        
                <div>
                    <a href="{{Common::mobileLink()}}health">
                        <button style="margin-right: 10px; margin-bottom: 10px;">
                            اقرأ أكثر
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
