<?php
    $startIndex = ($commentPages["currentPage"]-1)*$commentPages["perPage"]+1;
?>
@foreach($comments['data'] as $index=>$comment)
    <div class="comment_holder">
        <a name="comment_{{$comment->id}}"> </a>
        <div class="comment_body">
            <div class="comment_header">
                {{$startIndex++}} |
                {{$comment->author}}
            </div>
            <div class="comment_title">
                {{$comment->www}}
            </div>
            <div class="comment_text">
                {{$comment->description}}
            </div>
            <div class="comment_actions">
                <a href="javascript:voteComment({{$comment->id}}, 1);"><img src="{{$fileRepo->getDesktopUrl("img/thumbs_up.gif")}}" title="{{Config::get("site.lang.LNG_COMMENTS_THUMB_UP")}}" alt="{{Config::get("site.lang.LNG_COMMENTS_THUMB_UP")}}" /></a>
                <a href="javascript:voteComment({{$comment->id}}, -1);"><img src="{{$fileRepo->getDesktopUrl("img/thumbs_down.gif")}}" title="{{Config::get("site.lang.LNG_COMMENTS_THUMB_DOWN")}}" alt="{{Config::get("site.lang.LNG_COMMENTS_THUMB_DOWN")}}" /></a>
                <div id="comment_vote_{{$comment->id}}" class="result">
                    {{$comment->vote}}
                </div>
                @if(isset($setting["VIVVO_EMAIL_ENABLE"]) && $setting["VIVVO_EMAIL_ENABLE"] && $isAdmin)
                    @if(isset($setting["VIVVO_COMMENTS_REPORT_INAPPROPRIATE"]) && $setting["VIVVO_COMMENTS_REPORT_INAPPROPRIATE"])
                        <span id="comment_report_{{$comment->id}}">
                                                        <a href="javascript:reportComment({{$comment->id}});">
                                                            <img src="{{$fileRepo->getDesktopUrl("img/comment_report.gif")}}" title="{{Config::get("site.lang.LNG_COMMENTS_REPORT_INAPPROPRIATE")}}" alt="{{Config::get("site.lang.LNG_COMMENTS_REPORT_INAPPROPRIATE")}}" />
                                                        </a>
                                                    </span>
                    @endif
                @endif
                <span class="comment_stamp">
                                                {{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$comment->create_dt,isset($setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"])?$setting["VIVVO_GENERAL_TIME_ZONE_FORMAT"]:null)->format("Y/m/d - h:i")}}
                                            </span>
            </div>
        </div>
    </div>
@endforeach
<div id="new_comment_holder">  </div>

    <?php
    $numberPage = $commentPages["numPage"];
    $currentPage = $commentPages["currentPage"];
    $rangePage = 5;
    $startPage = 1;
    $endPage = $rangePage;
    if($currentPage > 1 && $currentPage%$rangePage == 0) {
        $numRange = $currentPage/$rangePage;
        $startPage = ($numRange)*$rangePage;
        $endPage = ($numRange+1)*$rangePage;
    }elseif($currentPage > $rangePage) {
        $numRange = ceil($currentPage/$rangePage);
        $startPage = ($numRange-1)*$rangePage;
        $endPage = $numRange*$rangePage;
    }
    if($endPage > $numberPage) {
        $endPage = $numberPage;
    }
    ?>
    <div id="box_pagination">
        @if($commentPages["numPage"] > 1)
    <span class="pagination">
        @if($commentPages["currentPage"] > 1)
            <a href="javascript:loadCommentsPage({{$commentPages["currentPage"]}}-1);"><img src="{{$fileRepo->getDesktopUrl("img/pagination_back.gif")}}" alt="back" /></a>
        @endif
        @for($i=$startPage;$i<=$endPage;$i++)
            @if($i != $commentPages["currentPage"])
                <a href="javascript:loadCommentsPage({{$i}});">{{$i}}</a>
            @else
                {{$i}}
            @endif
        @endfor
        @if($commentPages["currentPage"] < $commentPages["numPage"])
            <a href="javascript:loadCommentsPage({{$commentPages["currentPage"]}}+1);"><img src="{{$fileRepo->getDesktopUrl("img/pagination_next.gif")}}" alt="next" /></a>
        @endif
    </span>
        @endif
{{Config::get("site.lang.LNG_TOTAL")}}:
<span class="pagination_total">
        {{$comments["total"] > 0?$comments["total"]:''}}
    </span>
| {{Config::get("site.lang.LNG_DISPLAYING")}}:
<span class="pagination_total">
        {{$comments["total"] > 0?($commentPages["perPage"]*($commentPages["currentPage"]-1)+1).' - '.(($commentPages["perPage"]*$commentPages["currentPage"]) > $comments["total"]?$comments["total"]:($commentPages["perPage"]*$commentPages["currentPage"])):''}}
    </span>
    </div>

