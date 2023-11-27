<div id="tab_attachments" class="row" style="display: none;">
    <div class="col-md-12">
        <p>Click and drag the files to change their order on the page. Double-click the file to edit the properties on the right-hand side.</p>
        @if(!$edit)
            <div class="row">
                <div class="col-md-12" style="color: red; text-align: center; font-weight: bold;">
                    You must save the article first.
                </div>
            </div>
        @else
            <div class="form-group" id="notice-multiple_attachments_holder" style="height: 30px;line-height: 30px; color: white;display: none;">
                <div class="col-md-12"></div>
            </div>
            <div class="row">
                <div class="col-md-9" id="multiple_attachments_holder">
                    <?php
                    $attachment = ($edit?$article->getAttachment('ASC'):null);
                    if($attachment) {
                    ?>
                    @include('admin.article.partials.attachment',["arrArticleFiles"=>$attachment,'repoFile'=>$fileRepo])
                    <?php }?>
                </div>
                <div class="col-md-3">
                    <div class="form-group align-center"><a class="btn btn-success" id="add_attachment" style="color: white;"><i class="fa fa-plus"></i> Add new attachment</a></div>
                    <div class="form-group" id="apply-multiple_attachments_holder" style="height: 30px;line-height: 30px; color: white;display: none;">
                        <div class="col-md-12"></div>
                    </div>
                    <div class="form-group">
                        <label for="attachment_title">Attachment Title</label>
                        <input type="text" id="attachment_title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="attachment_description">Description</label>
                        <textarea id="attachment_description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" class="apply-article-files">Apply</button>
                        <img src="{{asset('admin/assets/img/loading_bar.gif')}}" id="apply-loading-multiple_attachments_holder" style="display:none;">
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>
