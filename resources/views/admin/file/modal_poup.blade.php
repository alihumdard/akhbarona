<div id="popup_file_modal" class="modal hide fade in" data-keyboard="false" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display: block !important;border-bottom: none !important;padding-bottom: 0px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="container">
                    <ul class="nav nav-tabs popup-file-nav-tabs">
                        <li class="active"><a href="javascript:;" data-id="body_browser_list_file">Browse files</a></li>
                        <li><a href="javascript:;" data-id="upload_file_computer">Upload file(s) from your computer</a></li>
                    </ul>
                </div>
            </div>
            <div class="modal-body" style="min-height: 350px !important;">
                <div class="row">
                    <div class="col-md-3 list-folder"></div>
                    <div class="col-md-9 list-file"></div>
                </div>
            </div>
        </div>

    </div>
</div>
@section('script_modal')
    <script>
        function getListFolder(typeFile) {
            $.ajax({
                type: "POST",
                url: "{{route('file.ajaxDirectory')}}",
                data: {_token:$('meta[name=csrf-token]').attr('content'),type_file:typeFile,is_multiple:((selectImageId=='image' || selectImageId == 'VIVVO_GENERAL_WEBSITE_LOGO_image' || typeFile == 100)?0:1)},
                success: function (data) {
                    $("#modal_loading .close").click();
                    $('#popup_file_modal .modal-body').html(data);
                    $('#popup_file_modal').modal(true);
                }
            });
        }
        $( document ).tooltip({
            content:function(){
                return this.getAttribute("title");
            }
        });

    </script>
@stop
