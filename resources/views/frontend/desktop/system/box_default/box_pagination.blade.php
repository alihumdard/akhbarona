@if($total > 0)
<nav id="box_pagination" aria-label="Page navigation example">
    @if($total > $perPage)
        <?php $numberPage = ceil($total/$perPage)?>
        <ul class="pagination">
            @if(($currentPage-10) > 0)
                <?php
                    $routeParam["page"] = $currentPage-10;
                ?>                        
                <li class="page-item">
                    <a href="{{Common::link($routeName,$routeParam)}}" class="page-link pagi-active pagi-active-1" aria-label="Previous">
                        <span aria-hidden="true"><</span>
                    </a>
                </li>
            @endif

            @if($currentPage > 1)
                <?php $routeParam["page"] = $currentPage-1;?>
                <li class="page-item">
                    <a href="{{Common::link($routeName,$routeParam)}}" class="page-link pagi-active pagi-active-1" aria-label="Previous">
                        <span aria-hidden="true"><</span>
                    </a>
                </li>
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
                <li class="page-item"><a class="page-link pagi-active" href="{{Common::link($routeName,$routeParam)}}">{{$i}}</a></li>
                @else
                <li class="page-item">{{$i}}</li>
                @endif
            @endfor

            @if($currentPage < $numberPage )
                <?php $routeParam["page"] = $currentPage+1;?>
                <li class="page-item">
                    <a href="{{Common::link($routeName,$routeParam)}}" class="page-link pagi-active pagi-active-1" aria-label="Previous">
                        <span aria-hidden="true">></span>
                    </a>
                </li>
            @endif

            @if(($currentPage+10) < $numberPage)
                <?php $routeParam["page"] = $currentPage+10;?>
                <li class="page-item">
                    <a href="{{Common::link($routeName,$routeParam)}}" class="page-link pagi-active pagi-active-1" aria-label="Previous">
                        <span aria-hidden="true">></span>
                    </a>
                </li>
            @endif
        </ul>
    @endif

    {{Config::get("site.lang.LNG_TOTAL")}}:

    <span class="pagination_total">
        {{$total}}
    </span>

    | {{Config::get("site.lang.LNG_DISPLAYING")}}:

    <span class="pagination_total">
        {{($perPage*($currentPage-1)+1).' - '.(($perPage*$currentPage) > $total?$total:($perPage*$currentPage))}}
    </span>
</nav>
@endif
