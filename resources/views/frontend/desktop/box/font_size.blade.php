<div class="font_size">
    <span class="social_bookmarks_font">
        <!--Facebook-->
        <iframe src="//www.facebook.com/plugins/like.php?href={{Common::article_link($article)}}&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <!--Twitter-->
        <a href="https://twitter.com/share" class="twitter-share-button" data-via="Akhbaronapress" data-lang="ar">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    </span>
    {{Config::get("site.lang.LNG_FONT_SIZE")}}
    <a href="javascript:tsz('article_body','14px')"> <img alt="Decrease font" border="0" src="{{$fileRepo->getDesktopUrl("img/font_decrease.gif")}}" /></a>
    <a href="javascript:tsz('article_body','18px')"> <img alt="Enlarge font" border="0" src="{{$fileRepo->getDesktopUrl("img/font_enlarge.gif")}}" /></a>
</div>
