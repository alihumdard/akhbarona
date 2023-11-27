<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="author">Title</label>
            <input type="text" name="title" id="title" value="{{old("title")?old("title"):($edit?$article->title:"")}}" required="required" class="form-control" placeholder="">
        </div>
    </div>
</div>
<div id="tab_main_info" class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="abstract">Abstract</label>
            <textarea name="abstract" class="form-control" id="abstract">{{old("abstract")?old("abstract"):((old("abstract") === null && $edit)?$article->abstract:'' )}}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Abstract image</label>
            <input type="text" name="image" id="image" value="{{old("image")?old("image"):($edit?$article->image:"")}}" required="required" class="custom-form-control" placeholder="">
            <a href="javascript:;" id="poup_select_image"><i class="fas fa-search"></i></a>

        </div>

        <div class="form-group">
            <label for="image_caption">Image Caption</label>
            <input type="text" name="image_caption" id="image_caption" value="{{old("image_caption")?old("image_caption"):((old("image_caption") === null && $edit)?$article->image_caption:"")}}" class="custom-form-control" placeholder="">
        </div>

        <div class="form-group">
		<!-- video Js Changes--->
		    <div>
			    <a href="javascript::void(1);" class="insert_media btn btn-primary" style="cursor:pointer;text-decoration:underline;">Upload Video</a>
				<a href="javascript::void(1);" class="btn btn-primary pickvideo"  style="cursor:pointer;text-decoration:underline;float:right;">Pick Video</a>
				<div id="videoresult"></div>
			</div>
			<!------>
            <textarea name="body" class="form-control" id="body_article">{{old("body")?old("body"):((old("body") === null && $edit)?$article->body:'' )}}</textarea>
        </div>
        <div class="form-group">
            <div class="autocomplete-input form_line" wfd-id="27">
                <label wfd-id="30">Tags <img src="{{asset('admin/assets/img/loading_bar.gif')}}" class="loader" alt="Loading..." style="display:none"></label>

                <ul class="holder" wfd-id="123">
                    <?php $tagsId = '';?>
                    @if($edit && $tags)
                        @foreach($tags as $tag)
                            <?php $tagsId .= $tag->group_id.':'.$tag->id.',';?>
                            @if(!isset($headTags[$tag->id]))
                                <li class="bit bit-box" wfd-id="318"><span class="category" wfd-id="319">{{$tag->group}}</span> {{$tag->name}}<a href="javascript:;" class="closebutton del-tags" onclick="delSelectTag(this)" data-id="{{$tag->id}}" group-id="{{$tag->group_id}}"></a></li>
                            @endif
                        @endforeach
                    @endif
                    <li class="bit-input" id="search_tag_input" wfd-id="124"><input class="maininput form-control"
                                                                                    type="text"
                                                                                    id="anonymous_element_2"
                                                                                    wfd-id="146"></li>
                </ul>


            </div>
            <input name="tags_id" type="hidden" value="{{$tagsId}}">
        </div>
    </div>
</div>
