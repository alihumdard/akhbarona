@include("frontend.desktop.adv.mega_970")
<div id="content_sw">
    <ul class="ticker">
        @foreach($arrTicker as $i=>$ticker)
            <li class="category" style="display: none">
                <strong><a href="{{Common::link("frontend.category.index",[$ticker[0]->slug,1])}}">{{$ticker[0]->category_name}}</a></strong>
                <ul>
                    @foreach($ticker as $tk)
                        <li><a href="{{Common::article_link($tk)}}">{{($tk->title)}}</a></li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    <script type="text/javascript">
        var tickers = document.querySelectorAll('ul.ticker');
        new vivvoTickerTyper(tickers[0]);
    </script>
</div>
