@if(count($arrArticleFiles))
    @for($i = (count($arrArticleFiles) - 1);$i >= 0;$i--)
        <span data-id="{{$arrArticleFiles[$i]->id}}" data-type="list_gallery_image" data-title="{{$arrArticleFiles[$i]->title}}" data-des="{{$arrArticleFiles[$i]->description}}" data-order="{{$arrArticleFiles[$i]->order_number}}" class="image_sortable article-files" title="" style="width: 110px; height: 110px; line-height: 110px; position: relative;">
            <span class="image_delete delete-article-files" data-id="{{$arrArticleFiles[$i]->id}}" data-type="list_gallery_image"><img src="{{asset('/admin/assets/img/icon_delete.gif')}}" alt="Delete" title="Delete"></span>
            <img src="{{$repoFile->getThumbview($arrArticleFiles[$i]->real_path)}}" title="" alt="">
        </span>
    @endfor
@endif
