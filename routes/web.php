<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

//Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localizationRedirect']], function () {

    Route::group(['namespace' => 'Site'], function () {
        Route::get('/', 'IndexController@index')->name('site.home');

        Route::get('/404', 'IndexController@notFound')->name('site.notFound');

        Route::group(['namespace' => 'Sections'], function () {
            Route::get('page/{alias}', 'PageController@index');

            Route::get('news/{alias}/', 'NewsController@index')->name('site.news.index');
            Route::get('news/{alias}/{id}', 'NewsController@show')->name('site.news.show')->where('id', '[0-9]+');
            Route::get('news/{alias}/rubrics', 'NewsController@rubrics')->name('site.news.rubrics');
            Route::get('news/{alias}/rubrics/{rubric}', 'NewsController@rubricsShow')->name('site.news.rubrics.show')->where('rubric', '[0-9]+');

            Route::get('links/{alias}.json', 'LinksController@indexJson')->name('site.links.indexJson');
            Route::get('links/{alias}', 'LinksController@index')->name('site.links.index');
        });

        Route::group(['namespace' => 'Feedback'], function () {
            Route::post('feedback', 'FeedbackController@storeFeedback')->name('feedback');
        });

    });

//});
