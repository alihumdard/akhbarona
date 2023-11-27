<div class="container" style="margin-bottom: 20px;">
    <ul class="nav nav-tabs left-nav-tabs">
        <li class="active"><a href="javascript:;" data-id="tab_options">Options</a></li>
        <li><a href="javascript:;" data-id="tab_sefriendly">SE Friendly</a></li>
    </ul>
</div>
<div id="tab_options" class="row">
    <div class="col-md-12">
        @if(!Auth::user()->hasPermission(['article.pending']))
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                @foreach($arrStatus as $key=>$vl)
                    <option value="{{$key}}" @if(is_numeric(old('status')) && old('status') == $key) selected="selected" @elseif(!is_numeric(old('status')) && $edit && $article->status == $key) selected="selected" @endif>{{$vl}}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" required="required">
                <option value="">All Category</option>
                @foreach($categories as $key=>$arr)
                    <option value="{{$key}}" @if($key == old('category_id')) selected="selected" @elseif(!old('category_id') && $edit && $article->category_id == $key) selected="selected" @endif>{{$arr['category_name']}}</option>
                    @if(isset($arr['child']) && count($arr['child']) > 0)
                        @foreach($arr['child'] as $child)
                            <option value="{{$child['id']}}" @if(old('category_id') && old('category_id') == $child['id']) selected="selected" @elseif(!old('category_id') && $edit && $article->category_id == $child['id']) selected="selected" @endif>- {{$child['category_name']}}</option>
                        @endforeach
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" value="{{$edit?$article['author']:Auth::user()->first_name}}" class="form-control" placeholder="">
            @if(!Auth::user()->hasPermission(['article.pending']))

            <select name="user_id" class="form-control" style="margin-top: 10px;">

                @foreach($users as $user)
                    <option value="{{$user->userid}}" @if(old('user_id') == $user->userid) selected="selected" @elseif(old('user_id') === null && (($edit && $article->user_id == $user->userid) || (Auth::user()->userid == $user->userid && !$edit))) selected="selected" @endif>{{$user->username}}</option>
                @endforeach
            </select>
            @endif
        </div>
        <div class="form-group">
            <label for="quick_tags">Quick Tags</label>
            <div class="row" id="quick_tags" style="padding-left: 20px;">
                <?php
                    $arrTags = [];
                    if($edit && $tags) {
                        foreach ($tags as $tag) {
                            $arrTags[$tag->id] = 1;
                        }
                    }
                ?>
                @if($headTags)
                    @foreach($headTags as $tagId=>$tagName)
                        <div class="col-md-6" style="padding-left: 0px;padding-right: 0px;">
                            <div class="row">
                                <div class="col-md-2" style="text-align: right;padding-right: 0px;padding-left: 0px;"><input type="checkbox" style="width: 20px; height: 20px;" name="quick_tag[]" value="{{'1:'.$tagId}}" @if(isset($arrTags[$tagId])) checked="checked" @endif></div>
                                <div class="col-md-10" style="text-align: left;padding-left: 8px;">{{ucfirst($tagName)}}</div>

                            </div>


                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="created">Publishing date</label>
            <input type="text" name="created" id="created" value="{{old('created')?old('created'):($edit?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$article->created)->format('M d, Y h:i A'):date('M d, Y h:i A'))}}" class="form-control" placeholder="">
        </div>
        <div class="form-group" style="border-bottom: 1px solid #ced4da">
            <div class="row">
                <div class="col-md-8">
                    <label for="created">Show comments: </label>
                </div>
                <div class="col-md-4">
                    <input type="radio" value="1" name="show_comment" @if(!$edit || $article->show_comment == 1) checked="checked" @endif> Yes &nbsp;<input name="show_comment" type="radio" value="0" @if($edit && $article->show_comment == 0) checked="checked" @endif> No
                </div>
            </div>
        </div>
        <div class="form-group" style="border-bottom: 1px solid #ced4da">
            <div class="row">
                <div class="col-md-8">
                    <label for="show_poll">Show ratings (rate the article): </label>
                </div>
                <div class="col-md-4">
                    <input type="radio" value="1" name="show_poll" @if(!$edit || $article->show_poll == 1) checked="checked" @endif> Yes &nbsp;<input name="show_poll" type="radio" value="0" @if($edit && $article->show_poll == 0) checked="checked" @endif> No
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label for="rss_feed">Publish to feed: </label>
                </div>
                <div class="col-md-4">
                    <input type="radio" value="1" name="rss_feed" @if(!$edit || $article->rss_feed == 1) checked="checked" @endif> Yes &nbsp;<input name="rss_feed" type="radio" value="0" @if($edit && $article->rss_feed == 0) checked="checked" @endif> No
                </div>
            </div>
        </div>
    </div>
</div>
<div id="tab_sefriendly" class="row" style="display: none;">
    <div class="col-md-12">
        <div class="form-group">
            <label for="sefriendly">SE friendly name</label>
            <input type="text" name="sefriendly" id="sefriendly" value="{{old("sefriendly")?old("sefriendly"):((old("sefriendly") === null && $edit)?$article->sefriendly:'')}}" class="form-control" placeholder="">
        </div>
        <div class="form-group">
            <label for="keywords">META Keywords</label>
            <textarea name="keywords" class="form-control" id="keywords">{{old("keywords")?old("keywords"):((old("keywords") === null && $edit)?$article->keywords:'' )}}</textarea>
        </div>
        <div class="form-group">
            <label for="description">META description</label>
            <textarea name="description" class="form-control" id="description">{{old("description")?old("description"):((old("description") === null && $edit)?$article->description:'' )}}</textarea>
        </div>
    </div>
</div>
