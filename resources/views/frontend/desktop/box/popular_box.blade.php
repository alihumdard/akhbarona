<h3 class="box_title title_purple">مقالات ساخنة</h3>
<div class="box box_white_new">
    <ul class="tabs tabs_new">
        <li> الأكثر قراءة </li>
    </ul>

        <div id="box_most_popular">
            @foreach($popularBox as $article)
                @include("frontend.desktop.summary.summary_popular",[$article,$fileRepo])
            @endforeach
        </div>
</div>
