<div class="footer_banner">
    @include("frontend.desktop.adv.footer_top")
</div>
<div id="footer">
    @include("frontend.desktop.box.footer")
</div>
<script>
    function searchKeyword(id) {
        var commentParam = $(id).serialize(true);
        new Ajax.Request( '{{route("frontend.search")}}', {
            parameters: commentParam,
            method:'post',
            evalScripts: true,
            onSuccess: function(response) {
                window.location.href = response.responseText;
            }
        });
        return false;
    }
</script>
