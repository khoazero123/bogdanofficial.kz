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

Route::get('/',          'MainController@index');
Route::get('forecast',                            'MainController@forecast');
Route::get('forecast/{code_forecaster_people}',   'MainController@forecast');
Route::get('forecast/{code_forecaster_people}/{forecast_code}',   'MainController@forecast_detail');
Route::get('statistics',                            'MainController@statistics');
Route::get('forecaster-people',                            'MainController@forecaster_people');

Route::get('blog',          'MainController@blog');
Route::get('blog/{code}',   'MainController@blog_detail');

Route::get('faq',          'MainController@faq');
Route::get('live',          'MainController@live');



//возврат
Route::any('resultpay', 'PaymentController@resultpay');

Route::group(['middleware' => 'auth', 'prefix' => 'personal'], function ()
{


    //Информация о счете
    Route::get('/',      'PersonalController@index');

    //Покупка подписки
    Route::get('payment',       'PersonalController@payment');
    Route::post('paymentpay',   'PaymentController@paymentpay');

    //Пополнить счёт
    Route::get('subscription',  'PersonalController@subscription');
    Route::post('subscription',  'PersonalController@subscription_request');

    //Личные данные
    Route::get('data',  'PersonalController@data');
    Route::post('data',  'PersonalController@data_request');

});




Route::group(['middleware' => 'role:admin', 'namespace' => 'Admin', 'prefix' => 'admin'], function ()
{

    Route::any('ckeditor-upload-image', 'UploadImageController@CkeditorUploadImage');

    Route::get('/', function()
        {
            return redirect('/admin/forecast');
        }
    );

    Route::get('forecast', 'ForecastController@index');


    Route::get('forecast/save/',      'ForecastController@save');//создать
    Route::get('forecast/save/{id}',  'ForecastController@save')->where(['id' => '[0-9]+']);//изменить
    Route::post('forecast/save/',      'ForecastController@_save');//создать
    Route::post('forecast/save/{id}', 'ForecastController@_save')->where(['id' => '[0-9]+']);//изменить
    Route::get('forecast/delete/{id}', 'ForecastController@delete')->where(['id' => '[0-9]+']);//удалить


    Route::get('statistics',             'StatisticsController@index');
    Route::get('statistics/save/',       'StatisticsController@save');//создать
    Route::get('statistics/save/{id}',   'StatisticsController@save')->where(['id' => '[0-9]+']);//изменить
    Route::post('statistics/save/',      'StatisticsController@_save');//создать
    Route::post('statistics/save/{id}',  'StatisticsController@_save')->where(['id' => '[0-9]+']);//изменить
    Route::get('statistics/delete/{id}', 'StatisticsController@delete')->where(['id' => '[0-9]+']);//удалить


    Route::get('forecaster-people',             'ForecasterPeopleController@index');
    Route::get('forecaster-people/save/',       'ForecasterPeopleController@save');//создать
    Route::get('forecaster-people/save/{id}',   'ForecasterPeopleController@save')->where(['id' => '[0-9]+']);//изменить
    Route::post('forecaster-people/save/',      'ForecasterPeopleController@_save');//создать
    Route::post('forecaster-people/save/{id}',  'ForecasterPeopleController@_save')->where(['id' => '[0-9]+']);//изменить
    Route::get('forecaster-people/delete/{id}', 'ForecasterPeopleController@delete')->where(['id' => '[0-9]+']);//удалить


    Route::get('blog',             'BlogController@index');
    Route::get('blog/save/',       'BlogController@save');//создать
    Route::get('blog/save/{id}',   'BlogController@save')->where(['id' => '[0-9]+']);//изменить
    Route::post('blog/save/',      'BlogController@_save');//создать
    Route::post('blog/save/{id}',  'BlogController@_save')->where(['id' => '[0-9]+']);//изменить
    Route::get('blog/delete/{id}', 'BlogController@delete')->where(['id' => '[0-9]+']);//удалить


    Route::get('faq',             'FaqController@index');
    Route::get('faq/save/',       'FaqController@save');//создать
    Route::get('faq/save/{id}',   'FaqController@save')->where(['id' => '[0-9]+']);//изменить
    Route::post('faq/save/',      'FaqController@_save');//создать
    Route::post('faq/save/{id}',  'FaqController@_save')->where(['id' => '[0-9]+']);//изменить
    Route::get('faq/delete/{id}', 'FaqController@delete')->where(['id' => '[0-9]+']);//удалить


    Route::get('live',             'LiveController@index');
    Route::get('live/save/',       'LiveController@save');//создать
    Route::get('live/save/{id}',   'LiveController@save')->where(['id' => '[0-9]+']);//изменить
    Route::post('live/save/',      'LiveController@_save');//создать
    Route::post('live/save/{id}',  'LiveController@_save')->where(['id' => '[0-9]+']);//изменить
    Route::get('live/delete/{id}', 'LiveController@delete')->where(['id' => '[0-9]+']);//удалить

    Route::get('user',             'UserController@index');
    Route::get('user/save/',       'UserController@save');//создать
    Route::get('user/save/{id}',   'UserController@save')->where(['id' => '[0-9]+']);//изменить
    Route::post('user/save/',      'UserController@_save');//создать
    Route::post('user/save/{id}',  'UserController@_save')->where(['id' => '[0-9]+']);//изменить
    Route::get('user/delete/{id}', 'UserController@delete')->where(['id' => '[0-9]+']);//удалить


    Route::get('subscription-type',             'SubscriptionTypeController@index');
    Route::get('subscription-type/save/',       'SubscriptionTypeController@save');//создать
    Route::get('subscription-type/save/{id}',   'SubscriptionTypeController@save')->where(['id' => '[0-9]+']);//изменить
    Route::post('subscription-type/save/',      'SubscriptionTypeController@_save');//создать
    Route::post('subscription-type/save/{id}',  'SubscriptionTypeController@_save')->where(['id' => '[0-9]+']);//изменить

    Route::get('payment', 'PaymentController@index');

});


Auth::routes();