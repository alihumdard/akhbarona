@if($total > 0)
    <div id="box_pagination">
        @if($total > $perPage)
            <?php $numberPage = ceil($total/$perPage)?>
            <span class="pagination">
            @if(($currentPage-10) > 0)
                    <?php
                    $routeParam["page"] = $currentPage-10;
                    ?>
                    <a href="{{Common::link($routeName,$routeParam)}}" class="page_groups"><img src="{{$fileRepo->getMobileUrl("img/pagination_first.gif")}}" alt="first" /></a>
                @endif

                @if($currentPage > 1)
                    <?php $routeParam["page"] = $currentPage-1;?>
                    <a href="{{Common::link($routeName,$routeParam)}}" class="page_groups"><img src="{{$fileRepo->getMobileUrl("img/pagination_back.gif")}}" alt="back" /></a>
                @endif
                <?php
                $rangePage = 10;
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
                @for($i=$startPage; $i<= $endPage;$i++)
                    <?php $routeParam["page"] = $i;?>
                    @if($i != $currentPage)
                        <a href="{{Common::link($routeName,$routeParam)}}">{{$i}}</a>
                    @else
                        <span class="page_active">{{$i}}</span>
                    @endif
                @endfor

                @if($currentPage < $numberPage )
                    <?php $routeParam["page"] = $currentPage+1;?>
                    <a href="{{Common::link($routeName,$routeParam)}}" class="page_groups"><img src="{{$fileRepo->getMobileUrl("img/pagination_next.gif")}}" alt="next" /></a>
                @endif

                @if(($currentPage+10) < $numberPage)
                    <?php $routeParam["page"] = $currentPage+10;?>
                    <a href="{{Common::link($routeName,$routeParam)}}" class="page_groups"><img src="{{$fileRepo->getMobileUrl("img/pagination_last.gif")}}" alt="last" /></a>
                @endif
        </span>
        @endif

        {{Config::get("site.lang.LNG_TOTAL")}}:

        <span class="pagination_total">
        {{$total}}
    </span>

        | {{Config::get("site.lang.LNG_DISPLAYING")}}:

        <span class="pagination_total">
        {{($perPage*($currentPage-1)+1).' - '.(($perPage*$currentPage) > $total?$total:($perPage*$currentPage))}}
    </span>
    </div>
@endif
