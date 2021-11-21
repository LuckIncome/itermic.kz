<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Avl'], function () {

    Route::group(['namespace' => 'Ajax', 'prefix' => 'ajax'], function () {
        Route::post('good', 'DefaultController@good');
        Route::post('change-switch', 'DefaultController@changeSwitch');
        Route::post('menu', 'DefaultController@menu');

        Route::post('change-order', 'DefaultController@changeOrder');
        Route::post('/fixedNews/{id}', 'DefaultController@fixedNews');
        Route::post('/mainPhoto/{id}', 'DefaultController@mainPhoto');

        Route::post('/saveVideoLink', 'DefaultController@saveVideoLink');
        Route::post('/updateVideoLink/{id}', 'DefaultController@updateVideoLink');
        Route::post('/deleteVideo/{id}', 'DefaultController@deleteVideo');
        Route::post('/change-file-lang/{id}', 'DefaultController@changeFileLang');

        Route::post('check', 'CheckController@index');
        Route::post('profile', 'UploadController@profile'); // For profile

        Route::post('news-images', 'ImageController@newsImages');
        Route::post('news-images/{id}', 'ImageController@imageUpdate');    // этот метод как для новостей, так и для объектов

        Route::post('page-images', 'ImageController@pageImages');
        Route::post('page-images/{id}', 'ImageController@pageUpdate');
        Route::post('page-images-panel/{id}', 'ImageController@changePanel');

        Route::post('/deleteMedia/{id}', 'DefaultController@deleteMedia');
        Route::get('{id}/media-sortable', 'SortableController@mediaSortable');
        Route::post('links_photo', 'ImageController@links_photo');
        Route::post('/deletePhotoLinks/{id}', 'DefaultController@deletePhotoLinks');

        Route::post('news-files', 'FilesController@newsFiles');
        Route::post('saveFileName/{id}', 'FilesController@saveFileName');
        // Route::post('saveFileName/{id}', 'FilesController@saveFileName');

        Route::post('rubrics-files', 'FilesController@rubricsFiles');
        Route::post('rubrics-images', 'ImageController@rubricImages');
    });

    Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
        Route::get('login', ['as' => 'login', 'uses' => 'AuthController@login']);
        Route::post('login', ['uses' => 'AuthController@auth']);
        Route::get('logout', ['uses' => 'AuthController@logout']);
    });

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::group(['namespace' => 'SiteSettings', 'prefix' => 'site-settings'], function () {
            Route::resource('settings', 'SettingsController');
            Route::get('/rubrics/lists', 'RubricsController@lists')->name('admin.site.settings.rubrics.lists');
            Route::resource('{id}/rubrics', 'RubricsController', ['as' => 'admin.site.settings']);
        });

        Route::group(['namespace' => 'Settings', 'prefix' => 'settings'], function () {
            Route::resource('langs', 'LangsController');
            Route::resource('roles', 'RolesController', ['as' => 'admin.settings']);
            Route::resource('users', 'UsersController');
            Route::post('templates/get-files', 'TemplatesController@getTemplatesFiles')->name('templates.files');
            Route::post('templates/get-templates', 'TemplatesController@getTemplates');
            Route::resource('templates', 'TemplatesController', ['as' => 'admin.settings']);
            Route::resource('sections', 'SectionsController', ['as' => 'admin.settings']);
            Route::resource('profile', 'ProfileController');
            Route::get('feedbacks', 'FeedbackController@index')->name('admin.settings.feedback');

            Route::group(['namespace' => 'Configurations'], function () {
                Route::get('sections/configuration/{id}', 'SectionsController@index')->name('admin.settings.sections.configuration');
                Route::post('sections/configuration/{id}', 'SectionsController@save')->name('admin.settings.sections.configuration.save');
            });

            Route::group(['namespace' => 'Sections'], function () {
                Route::resource('sections/{id}/page', 'PagesController');
                Route::resource('sections/{id}/news', 'NewsController');
                Route::resource('sections/{id}/link', 'LinkController');
                Route::resource('sections/{id}/links', 'LinksController');
            });
        });
    });
});

Route::group(['prefix' => 'image', 'namespace' => 'Image'], function () {
    Route::get('resize/{w}/{h}/{path}', 'ImageController@resize')->where('path', '(.*)');
});

Route::group(['prefix' => 'file', 'namespace' => 'Image'], function () {
    Route::get('save/{id}', 'ImageController@save');
});
