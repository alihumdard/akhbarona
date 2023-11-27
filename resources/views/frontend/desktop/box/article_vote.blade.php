<div id="box_article_rating" class="box box_gray">
    <h3 class="box_title title_gray">{{Config::get("site.lang.LNG_RATE_ARTICLE")}}</h3>
    <div class="article_rating">{{Common::getVoteAvg($article,2)}}</div>
    <div id="stars"> </div>
    <script type="text/javascript" language="javascript">
        function isVoted() {
            var name = "akh_article_session=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            var objs = null;
            var isVoted = false;
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    objs = JSON.parse(c.substring(name.length, c.length));
                    if(objs && objs.vote) {
                        Object.keys(objs.vote).forEach(function(key) {
                            if(key == {{$article->id}}) {
                                isVoted = true;
                            }
                        });
                    }
                }
            }
            return isVoted;
        }
        var isVoted = isVoted();
        console.log("isVoted",isVoted);
        new Starry('stars', {
            showNull: false,
            startAt: {{Common::getVoteAvg($article)}},
            voted: isVoted,
            callback: isVoted? Prototype.emptyFunction : function (index) {
                var voteParam = {};
                voteParam.action = 'article';
                voteParam.cmd = 'vote';
                voteParam.ARTICLE_id = {{$article->id}};
                voteParam.ARTICLE_vote = index;
                voteParam.template_output = 'box/article_vote';

                new Ajax.Updater('box_article_rating', '{{route("article.vote")}}', {
                    parameters: voteParam,
                    evalScripts: true,
                    insertion: Element.replace
                    @if(Config::get("site.VIVVO_ANALYTICS_TRACKER_ID"))
                    ,onSuccess: function(xhr) {
                        if (xhr.getResponseHeader('X-Vivvo-Action-Status') == 1) {
                            _gaq.push(['_trackEvent', 'Article', 'Rate', '{{$article->id}}', index]);
                        }
                    }
                    @endif
                });
            },
            sprite: '{{$fileRepo->getDesktopUrl("img/stars.gif")}}'
        });
    </script>
</div>
