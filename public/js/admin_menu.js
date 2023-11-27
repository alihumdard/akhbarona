if(typeof(vivvo) == "undefined") var vivvo = {};

vivvo.admin.frontendMenu = Class.create ();

Object.extend (
	vivvo.admin.frontendMenu.prototype,
	{
		initialize: function (){
			if (!$('admin_menu_holder')){
				$('container').insert({before: '<div id="admin_menu_holder" style="display:none;position:absolute;top:0px;left:0px;width:100%;overflow:hidden;"></div>'});
			}
			$('admin_menu_holder').insert('<div id="admin_menu"></div>');
			$('admin_menu').insert('<div id="admin_dump" class="dump"></div>');
			$('admin_menu').insert('<span id="admin_menu_close">Dismiss this bar</span>');
	
			if ($('admin_menu')){
				var category = Try.these(
					function() { return vivvo.params.content.search_options.search_cid},
					function() { return vivvo.params.article.category}
				) || false;
				
				var article = Try.these(
					function() { return vivvo.params.article.id}
				) || false;
				
				var comments = Try.these(
					function() { return vivvo.params.article.comments}
				) || false;
				
				$('admin_menu_close').observe('click', this.disableAdminMenu.bind(this));
				
				if (category){
					$('admin_menu').insert('<a id="admin_edit_category" href ="' + vivvo.fs_admin_dir + 'categories.php?frontend_edit=1&search_cid=' + category + '">' + vivvo.lang.get('LNG_EDIT_CATEGORY_OPTION') + '</a>');
					$('admin_menu_holder').show();
					this.categoryModal = new Control.Modal('admin_edit_category',
						{
							onSuccess: this.initCategoryForm.bind(this),
							width:500,
							height:500
						}
					);
				}
				if (article){
					$('admin_menu').insert('<a id="admin_edit_article" href ="' + vivvo.fs_admin_dir + 'article_edit.php?frontend_edit=1&search_id=' + article + '">' + vivvo.lang.get('LNG_EDIT_ARTICLE_OPTION') + '</a>');
					$('admin_menu_holder').show();
					this.articleModal = new Control.Modal('admin_edit_article',
						{
							onSuccess: this.initArticleForm.bind(this),
							width:500,
							height:500
						}
					);
				}
				if (comments != false && comments != '0'){
					$('admin_menu').insert('<a id="admin_moderate_comments" class="last" href ="' + vivvo.fs_admin_dir + 'comments.php?frontend_moderate=1&search_limit=200&search_article_id=' + article + '">' + vivvo.lang.get('LNG_MODERATE_COMMENTS') + '</a>');
					$('admin_menu_holder').show();
					this.commentsModal = new Control.Modal('admin_moderate_comments',
						{
							onSuccess: this.initCommentForm.bind(this),
							width:500,
							height:500
						}
					);
				}
			}
		},
		
		disableAdminMenu: function () {
			var searchOptions = {};
			searchOptions.action = 'vivvoCore';
			searchOptions.cmd = 'preferences';
			searchOptions.VIVVO_MODULES_FRONTEND_ADMIN = '0';
			
			vivvo.admin.utils.ajaxExecute(searchOptions, this.reload.bind(this), vivvo.fs_admin_dir + 'ajax.php', $('admin_dump'));
		},
		
		initCategoryForm: function () {
			$('category_edit_form').observe('submit', this.onSubmitCategory.bind(this));
		},
		
		onSubmitCategory: function () {
			vivvo.admin.utils.ajaxExecute($('category_edit_form').serialize(true), this.onCompleteEdit.bind(this), vivvo.fs_admin_dir + 'ajax.php', $('admin_dump'));
		},
		
		initArticleForm: function () {
			$('article_edit_form').observe('submit', this.onSubmitArticle.bind(this));
		},
		
		onSubmitArticle: function () {
			vivvo.admin.utils.ajaxExecute($('article_edit_form').serialize(true), this.onCompleteEdit.bind(this), vivvo.fs_admin_dir + 'ajax.php', $('admin_dump'));
		},
		
		initCommentForm: function () {
			
		},
		
		commentEdit: function (id){
			if (id){
				var searchOptions = {};
				
				searchOptions.action = 'comment';
				searchOptions.cmd = 'edit';
				searchOptions.COMMENT_id = id;
				searchOptions.COMMENT_description = $('COMMENT_description_' + id).value;
				
				vivvo.admin.utils.ajaxExecute(searchOptions, this.onCompleteEdit.bind(this), vivvo.fs_admin_dir + 'ajax.php', $('admin_dump'));
			}
			return false;
		},
		
		commentDelete: function (id){
			if (id){
				var searchOptions = {};
				
				searchOptions.action = 'comment';
				searchOptions.cmd = 'delete';
				searchOptions.COMMENT_id = id;
				
				vivvo.admin.utils.ajaxExecute(searchOptions, this.onCompleteEdit.bind(this), vivvo.fs_admin_dir + 'ajax.php', $('admin_dump'));
			}
			return false;
		},
		
		onCompleteEdit: function(transport){
			Control.Modal.close();
			this.reload.delay(5);
		},
		
		reload : function () {
			window.location.reload();
		}
	}
);

var vivvoAdminMenu;
document.observe("dom:loaded", function() {
	vivvoAdminMenu = new vivvo.admin.frontendMenu();
});