<div id="box_comments">
    <div class="box_body">
        <div class="comment_block">
            <h4 class="title_comments">
                {{Config::get("site.lang.LNG_COMMENTS")}} <span>({{$comments["total"]}} {{Config::get("site.lang.LNG_COMMENT_POSTED")}})</span>
            </h4>
            <div id="comment_list">
                @include("frontend.mobile.box.list_comment",[$comments,$commentPages,$isAdmin])
            </div>
            <div id="comment_dump_container"> </div>
            @include("frontend.mobile.box.comments_add",["id"=>$commentPages["articleId"]])
        </div>
    </div>
</div>
<script type="text/javascript">
    function reportComment(id) {
        jQuery.post( "{{route("mobile.comment")}}", {
            action: 'comment',
            security:'{{$security}}',
            cmd: 'reportInappropriateContent',
            id: id,
            template_output: 'box/dump'
        }).done(function( data ) {
            jQuery('#comment_report_' + id).html(data);
        });
    }
    function voteComment(id, vote) {
        jQuery.post( "{{route("mobile.comment")}}", {
            action: 'comment',
            cmd: 'vote',
            security:'{{$security}}',
            id: id,
            vote: vote,
            template_output: 'box/dump'
        }).done(function( data ) {
                jQuery('#comment_vote_' + id).html(data);
            });
    }
    function loadCommentsPage(pg) {
        jQuery.post( "{{route("mobile.comment")}}", {
            action: 'comment',
            cmd: 'proxy',
            security:'{{$security}}',
            pg: pg,
            CURRENT_URL: '',
            article_id: {{$commentPages["articleId"]}},
            template_output: 'box/comments'
        }).done(function( data ) {
            jQuery('#comment_list').html(data);
        });
    }

    var reply_to_comment_id = 0;

    function updateComments() {

        var commentParam = jQuery('#comment_form').serialize(true);
        commentParam.template_output = 'box/comments_add';
        commentParam.form_container = 'comment_form_holder';
        commentParam.security = '{{$security}}';

        document.getElementById("comment_dump_container").innerHTML = "";
        jQuery.post( "{{route("mobile.comment")}}", commentParam).done(function( data ) {
            var _json = data;
            document.getElementById("comment_dump_container").innerHTML = _json.content;
            if(_json.isError != 1) {
                var form = jQuery('#comment_form');
                form.find('textarea').val('');
                form.find('input[name=author]').val('') ;
                form.find('input[name=www]').val('');
                setTimeout(function(){ jQuery("#comment_dump_container").html(""); }, 5000);

            }
            @if(Config::get("site.VIVVO_ANALYTICS_TRACKER_ID"))
            _gaq.push(['_trackEvent', 'Article', 'Comment', '{{$commentPages["articleId"]}}', 1]);
            @endif
            @if(isset($setting["VIVVO_COMMENTS_ENABLE_THREADED"]) && $setting["VIVVO_COMMENTS_ENABLE_THREADED"])
            cancelReplyTo();
            @endif
        });

        return false;
    }

    function clearCommentDumps() {
        var commentDump = jQuery('#comment_dump_container');
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
