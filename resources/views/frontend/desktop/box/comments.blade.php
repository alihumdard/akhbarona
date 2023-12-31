    <div id="box_comments">
				<div class="box_body">
					<div class="comment_block">
                        <h4 class="title_comments">
                            <a href="{{\App\Helper\Common::article_rss($article)}}"><img src="{{$fileRepo->getDesktopUrl('img/icon_feed.gif')}}" class="comment_feed" alt="{{Config::get("site.lang.LNG_COMMENT_RSS")}}" title="{{Config::get("site.lang.LNG_COMMENT_RSS")}}" /></a>
                            {{Config::get("site.lang.LNG_COMMENTS")}} <span>({{$comments["total"]}} {{Config::get("site.lang.LNG_COMMENT_POSTED")}})</span>
                        </h4>
						<div id="comment_list">
                            @include("frontend.desktop.box.list_comment",[$comments,$commentPages,$isAdmin])
						</div>
                        @include("frontend.desktop.box.comments_add",["id"=>$commentPages["articleId"]])
					</div>
				</div>
			</div>
    <script type="text/javascript">
        function reportComment(id) {
            new Ajax.Updater('comment_report_' + id, '{{route("desktop.comment")}}', {
                parameters: {
                    action: 'comment',
                    security:'{{$security}}',
                    cmd: 'reportInappropriateContent',
                    id: id,
                    template_output: 'box/dump'
                },onSuccess: function(xhr) {
                    document.getElementById("comment_report_" + id).innerHTML = xhr.responseText;
                }
            });
        }
        function voteComment(id, vote) {
            new Ajax.Updater('comment_vote_' + id, '{{route("desktop.comment")}}', {
                parameters: {
                    action: 'comment',
                    cmd: 'vote',
                    security:'{{$security}}',
                    id: id,
                    vote: vote,
                    template_output: 'box/dump'
                },onSuccess: function(xhr) {
                    document.getElementById("comment_vote_" + id).innerHTML = xhr.responseText;
                }
            });
        }
        function loadCommentsPage(pg) {
            new Ajax.Updater('comment_list', '{{route("desktop.comment")}}', {
                parameters: {
                    action: 'comment',
                    cmd: 'proxy',
                    security:'{{$security}}',
                    pg: pg,
                    CURRENT_URL: '',
                    article_id: {{$commentPages["articleId"]}},
                    template_output: 'box/comments',
                },
                onSuccess: function(xhr) {
                    document.getElementById("comment_list").innerHTML = xhr.responseText;

                }
            });
        }

        var reply_to_comment_id = 0;

        function updateComments() {

            var commentParam = $('comment_form').serialize(true);
            commentParam.template_output = 'box/comments_add';
            commentParam.form_container = 'comment_form_holder';
            commentParam.security = '{{$security}}';

            document.getElementById("comment_dump_container").innerHTML = "";

            new Ajax.Updater('comment_dump_container1', '{{route("desktop.comment")}}', {
                parameters: commentParam,
                evalScripts: true,
                onSuccess: function(xhr) {
                    var _json = xhr.responseText.evalJSON(true);
                    console.log();
                    document.getElementById("comment_dump_container").innerHTML = _json.content;
                    if(_json.isError != 1) {
                        var form = $('comment_form');
                        form.down('textarea').value = '';
                        form.down('input[name=author]').value = '';
                        form.down('input[name=www]').value = '';
                        setTimeout(function(){ clearCommentDumps(); }, 5000);

                    }
                    @if(Config::get("site.VIVVO_ANALYTICS_TRACKER_ID"))
                    _gaq.push(['_trackEvent', 'Article', 'Comment', '{{$commentPages["articleId"]}}', 1]);
                    @endif
                    @if(isset($setting["VIVVO_COMMENTS_ENABLE_THREADED"]) && $setting["VIVVO_COMMENTS_ENABLE_THREADED"])
                    cancelReplyTo();
                    @endif
                }
            });

            return false;
        }

        function clearCommentDumps() {
            var commentDump = $('comment_dump_container');
            if (commentDump) {
                commentDump.childElements().invoke('remove');
            }
        }

        function addCommentDump(message, type, info) {
            var commentDump = $('comment_dump');
            if (!commentDump) {
                var container = $('comment_dump_container');
                if (!container) {
                    return;
                }
                container.insert(commentDump = new Element('div', {'id': 'comment_dump'}));
            }
            if (info) {
                message += ': ' + info;
            }
            commentDump.insert(new Element('span', {'class': type}).update(message));
        }

        @if(isset($setting["VIVVO_COMMENTS_ENABLE_THREADED"]) && $setting["VIVVO_COMMENTS_ENABLE_THREADED"])
        function reply_to_comment(id, root, summary) {
            $('reply_to').value = id;
            $('root_comment').value = root;
            $('description').focus();
            $('writing_reply_to').update(summary);
            $('writing_reply').show();
            reply_to_comment_id = id;
            return false;
        }

        function cancelReplyTo() {
            $('reply_to').value = '';
            $('root_comment').value = '';
            $('writing_reply').hide();
            reply_to_comment_id = 0;
        }
        @endif
    </script>

