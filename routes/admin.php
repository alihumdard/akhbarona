<?php
Route::any('uploadmedia', ['as' => 'uploadmedia', 'uses' => 'MediaController@uploadmedia']);
Route::any('pickvideo', ['as' => 'pickvideo', 'uses' => 'MediaController@pickvideo']);
Route::get('login', ['as' => 'adminLogin', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' => 'postAdminLogin', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('logout', [
    'as' => 'auth.logout',
    'uses' => 'Auth\AuthController@getLogout'
]);
// Register password reset routes only if it is enabled inside website settings.
Route::get('password/remind', ['as' => 'forgotPassword', 'uses' => 'Auth\PasswordController@forgotPassword']);
Route::post('password/remind', ['as' => 'sendPassword', 'uses' => 'Auth\PasswordController@sendPasswordReminder']);
Route::get('password/reset/{token}', ['as' => 'resetPassword', 'uses' => 'Auth\PasswordController@getReset']);
Route::post('password/reset', ['as' => 'postResetPassword', 'uses' => 'Auth\PasswordController@postReset']);

Route::group(['middleware' => 'auth'], function () {

    /**
     * Dashboard
     */

    Route::get('/', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index'
    ]);
    Route::get('/test', [
        'as' => 'test',
        'uses' => 'DashboardController@test'
    ]);
    Route::get('/log', [
        'as' => 'log',
        'uses' => 'DashboardController@log'
    ]);

    /**
     * User Profile
     */

    Route::get('profile', [
        'as' => 'profile',
        'uses' => 'ProfileController@index'
    ]);

    Route::get('profile/activity', [
        'as' => 'profile.activity',
        'uses' => 'ProfileController@activity'
    ]);

    Route::put('profile/details/update', [
        'as' => 'profile.update.details',
        'uses' => 'ProfileController@updateDetails'
    ]);

    Route::post('profile/avatar/update', [
        'as' => 'profile.update.avatar',
        'uses' => 'ProfileController@updateAvatar'
    ]);

    Route::post('profile/avatar/update/external', [
        'as' => 'profile.update.avatar-external',
        'uses' => 'ProfileController@updateAvatarExternal'
    ]);

    Route::put('profile/login-details/update', [
        'as' => 'profile.update.login-details',
        'uses' => 'ProfileController@updateLoginDetails'
    ]);

    Route::post('profile/two-factor/enable', [
        'as' => 'profile.two-factor.enable',
        'uses' => 'ProfileController@enableTwoFactorAuth'
    ]);

    Route::post('profile/two-factor/disable', [
        'as' => 'profile.two-factor.disable',
        'uses' => 'ProfileController@disableTwoFactorAuth'
    ]);

    Route::get('profile/sessions', [
        'as' => 'profile.sessions',
        'uses' => 'ProfileController@sessions'
    ]);

    Route::delete('profile/sessions/{session}/invalidate', [
        'as' => 'profile.sessions.invalidate',
        'uses' => 'ProfileController@invalidateSession'
    ]);

    /**
     * Admin Account Management
     */
    Route::get('admin-user', [
        'as' => 'user-admin.list',
        'uses' => 'AdminAccountController@index'
    ]);

    Route::get('admin-user/create', [
        'as' => 'user-admin.create',
        'uses' => 'AdminAccountController@create'
    ]);

    Route::post('admin-user/create', [
        'as' => 'user-admin.store',
        'uses' => 'AdminAccountController@store'
    ]);

    Route::get('admin-user/{user}/show', [
        'as' => 'user-admin.show',
        'uses' => 'AdminAccountController@view'
    ]);

    Route::get('admin-user/{user}/edit', [
        'as' => 'user-admin.edit',
        'uses' => 'AdminAccountController@edit'
    ]);

    Route::put('admin-user/{user}/update/details', [
        'as' => 'user-admin.update.details',
        'uses' => 'AdminAccountController@updateDetails'
    ]);

    Route::put('admin-user/{user}/update/login-details', [
        'as' => 'user-admin.update.login-details',
        'uses' => 'AdminAccountController@updateLoginDetails'
    ]);

    Route::delete('admin-user/{user}/delete', [
        'as' => 'user-admin.delete',
        'uses' => 'AdminAccountController@delete'
    ]);

    Route::post('admin-user/{user}/update/avatar', [
        'as' => 'user-admin.update.avatar',
        'uses' => 'AdminAccountController@updateAvatar'
    ]);

    Route::post('admin-user/{user}/update/avatar/external', [
        'as' => 'user-admin.update.avatar.external',
        'uses' => 'AdminAccountController@updateAvatarExternal'
    ]);

    Route::get('admin-user/{user}/sessions', [
        'as' => 'user-admin.sessions',
        'uses' => 'AdminAccountController@sessions'
    ]);

    Route::delete('admin-user/{user}/sessions/{session}/invalidate', [
        'as' => 'user-admin.sessions.invalidate',
        'uses' => 'AdminAccountController@invalidateSession'
    ]);

    Route::post('admin-user/{user}/two-factor/enable', [
        'as' => 'user-admin.two-factor.enable',
        'uses' => 'AdminAccountController@enableTwoFactorAuth'
    ]);

    Route::post('admin-user/{user}/two-factor/disable', [
        'as' => 'user-admin.two-factor.disable',
        'uses' => 'AdminAccountController@disableTwoFactorAuth'
    ]);

    /**
     * Roles & Permissions
     */

    Route::get('role', [
        'as' => 'role.index',
        'uses' => 'RolesController@index'
    ]);

    Route::get('role/create', [
        'as' => 'role.create',
        'uses' => 'RolesController@create'
    ]);

    Route::post('role/store', [
        'as' => 'role.store',
        'uses' => 'RolesController@store'
    ]);

    Route::get('role/{role}/edit', [
        'as' => 'role.edit',
        'uses' => 'RolesController@edit'
    ]);

    Route::put('role/{role}/update', [
        'as' => 'role.update',
        'uses' => 'RolesController@update'
    ]);

    Route::delete('role/{role}/delete', [
        'as' => 'role.delete',
        'uses' => 'RolesController@delete'
    ]);


    Route::post('permission/save', [
        'as' => 'permission.save',
        'uses' => 'PermissionsController@saveRolePermissions'
    ]);

    Route::resource('permission', 'PermissionsController');
    // category
    Route::get('category', [
        'as' => 'category.index',
        'uses' => 'CategoriesController@index'
    ]);
    Route::get('category/create', [
        'as' => 'category.create',
        'uses' => 'CategoriesController@create'
    ]);

    Route::post('category/store/{id?}', [
        'as' => 'category.store',
        'uses' => 'CategoriesController@store'
    ]);

    Route::get('category/{id}/edit', [
        'as' => 'category.edit',
        'uses' => 'CategoriesController@edit'
    ]);

    Route::delete('category/{id}/delete', [
        'as' => 'category.delete',
        'uses' => 'CategoriesController@delete'
    ]);
    Route::post('category/sort', [
        'as' => 'category.sort',
        'uses' => 'CategoriesController@sort'
    ]);
    // article
    Route::get('article', [
        'as' => 'article.index',
        'uses' => 'ArticleController@index'
    ]);
    Route::get('article/create', [
        'as' => 'article.create',
        'uses' => 'ArticleController@create'
    ]);

    Route::post('article/store/{id?}', [
        'as' => 'article.store',
        'uses' => 'ArticleController@store'
    ]);

    Route::get('article/{id}/edit', [
        'as' => 'article.edit',
        'uses' => 'ArticleController@edit'
    ]);

    Route::delete('article/{id}/delete', [
        'as' => 'article.delete',
        'uses' => 'ArticleController@delete'
    ]);
    Route::get('article/search-tag', [
        'as' => 'article.searchTag',
        'uses' => 'ArticleController@searchTag'
    ]);
    Route::post('article/sort', [
        'as' => 'article.sort',
        'uses' => 'ArticleController@sort'
    ]);

    Route::post('article/select-action', [
        'as' => 'article.selectAction',
        'uses' => 'ArticleController@selectAction'
    ]);
    Route::post('article/add-gallery', [
        'as' => 'article.gallery',
        'uses' => 'ArticleController@addGallery'
    ]);
    Route::post('article/apply-file', [
        'as' => 'article.applyFile',
        'uses' => 'ArticleController@applyFile'
    ]);
    Route::post('article/sort-file', [
        'as' => 'article.sortFile',
        'uses' => 'ArticleController@sortFile'
    ]);
    Route::post('article/del-file', [
        'as' => 'article.delFile',
        'uses' => 'ArticleController@delFile'
    ]);
    // tags
    Route::post('tag/quick-create', [
        'as' => 'tag.quickCreate',
        'uses' => 'TagController@quickCreate'
    ]);
    // files
    Route::get('file', [
        'as' => 'file.index',
        'uses' => 'FileController@index'
    ]);
    Route::get('file/download/{file}', [
        'as' => 'file.download',
        'uses' => 'FileController@download'
    ]);
    Route::post('file/del/{file}', [
        'as' => 'file.del',
        'uses' => 'FileController@delete'
    ]);
    Route::post('file/ajax-directory', [
        'as' => 'file.ajaxDirectory',
        'uses' => 'FileController@getListFolder'
    ]);
    Route::post('file/ajax-upload-file', [
        'as' => 'file.upload',
        'uses' => 'FileController@upload'
    ]);
    Route::any('ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
        ->name('ckfinder_connector');

    Route::any('ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
        ->name('ckfinder_browser');
    // user filter
    Route::delete(
        'user/delete-filter/{userFilter}',
        [
            'as' => 'user.delFilter',
            'uses' => 'UserFilterController@delFilter'
        ]
    );
    Route::post('user/save-filter', [
        'as' => 'user.saveSearchFilter',
        'uses' => 'UserFilterController@saveSearchFilter'
    ]);
    // comment
    Route::get('comment', [
        'as' => 'comment.index',
        'uses' => 'CommentController@index'
    ]);
    Route::get('comment/create', [
        'as' => 'comment.create',
        'uses' => 'CommentController@create'
    ]);

    Route::post('comment/store/{id?}', [
        'as' => 'comment.store',
        'uses' => 'CommentController@store'
    ]);

    Route::get('comment/{id}/edit', [
        'as' => 'comment.edit',
        'uses' => 'CommentController@edit'
    ]);

    Route::delete('comment  /{comment}/delete', [
        'as' => 'comment.delete',
        'uses' => 'CommentController@delete'
    ]);
    Route::post('comment/select-action', [
        'as' => 'comment.selectAction',
        'uses' => 'CommentController@selectAction'
    ]);
    // pages
    Route::get('page', [
        'as' => 'page.index',
        'uses' => 'PageController@index'
    ]);
    Route::get('page/create', [
        'as' => 'page.create',
        'uses' => 'PageController@create'
    ]);

    Route::post('page/store/{page?}', [
        'as' => 'page.store',
        'uses' => 'PageController@store'
    ]);

    Route::post('page/{page}/edit', [
        'as' => 'page.edit',
        'uses' => 'PageController@edit'
    ]);

    Route::delete('page/{page}/delete', [
        'as' => 'page.delete',
        'uses' => 'PageController@delete'
    ]);
    Route::post('page/sort', [
        'as' => 'page.sort',
        'uses' => 'PageController@sort'
    ]);
    // settings
    Route::get('setting/{type}', [
        'as' => 'setting.edit',
        'uses' => 'SettingController@edit'
    ]);
    Route::post('setting/{type}', [
        'as' => 'setting.store',
        'uses' => 'SettingController@store'
    ]);
});
