@if(count($arrArticleFiles))
    @for($i = (count($arrArticleFiles) - 1);$i >= 0;$i--)
        <?php $fileInfo = pathinfo($arrArticleFiles[$i]->real_path);?>
        <div data-id="{{$arrArticleFiles[$i]->id}}" data-type="multiple_attachments_holder" data-title="{{$arrArticleFiles[$i]->title}}" data-des="{{$arrArticleFiles[$i]->description}}" data-order="{{$arrArticleFiles[$i]->order_number}}" class="attachment_sortable item row_{{$i%2}} mime_{{$fileInfo['extension']}} article-files" style="position: relative;">
            <div class="item_actions" wfd-id="33">
                <span class="image_delete delete-article-files" data-id="{{$arrArticleFiles[$i]->id}}" data-type="multiple_attachments_holder"><img src="{{asset('/admin/assets/img/icon_delete.gif')}}" alt="Delete" title="Delete"></span>
            </div>
            <div class="item_data" title="" wfd-id="29">
                <div class="item_line1" wfd-id="32">
                    {{$arrArticleFiles[$i]->real_path}}
                </div>
                <div class="item_line2" wfd-id="30">
                    Title: <span class="title_holder" wfd-id="31">{{$arrArticleFiles[$i]->title}}</span>
                </div>
            </div>
        </div>
    @endfor
@endif
