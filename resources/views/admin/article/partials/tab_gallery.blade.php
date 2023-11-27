<div id="tab_gallery" class="row" style="display: none;">
    <div class="col-md-12 list-gallery">
        <p>Click and drag the images to change their order on the page. Double-click the image to edit the properties on the right-hand side.</p>
        @if(!$edit)
            <div class="row">
                <div class="col-md-12" style="color: red; text-align: center; font-weight: bold;">
                    You must save the article first.
                </div>
            </div>
        @else
            <div class="form-group" id="notice-list_gallery_image" style="height: 30px;line-height: 30px; color: white;display: none;">
                <div class="col-md-12"></div>
            </div>
            <div class="row">
                <div class="col-md-9" id="list_gallery_image">
                    <?php
                        $gallery = ($edit?$article->getGallery('ASC'):null);
                        if($gallery) {
                    ?>
                    @include('admin.article.partials.gallery',["arrArticleFiles"=>$gallery,'repoFile'=>$fileRepo])
                    <?php }?>
                </div>
                <div class="col-md-3">
                    <div class="form-group align-center"><a class="btn btn-success" id="add_gallery" style="color: white;"><i class="fa fa-plus"></i> Add new image</a></div>
                    <div class="form-group" id="apply-list_gallery_image" style="height: 30px;line-height: 30px; color: white;display: none;">
                        <div class="col-md-12"></div>
                    </div>
                    <div class="form-group">
                        <label for="gallery_title">Image Title</label>
                        <input type="text" id="gallery_title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="gallery_description">Description</label>
                        <textarea id="gallery_description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" class="apply-article-files">Apply</button>
                        <img src="{{asset('admin/assets/img/loading_bar.gif')}}" id="apply-loading-list_gallery_image" style="display:none;">
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

