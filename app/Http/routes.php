<?php

Route::get('/key', function() {
    $exitCode = Artisan::call('key:generate');
    return '<h1>Cache facade value cleared</h1>';
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

// return what you want
/*Route::get('setlocale/{locale}', function ($locale) {
  if (in_array($locale, \Config::get('app.locales'))) {
    Session::put('locale', $locale);
  }
  return redirect()->back();
});*/
$lang = \App\Models\Languages::get();
$str="";
foreach ($lang as $key => $item) {
	// code...
	$str.=$item->code.'|';
}
$str=substr(trim($str), 0, -1);
//$str.='('.$str.')';

	Route::group(['prefix' => '{lang}', 'where' => ['lang' => $str ],'middleware' => 'language'],function(){
  //Route::group(['prefix' => 'adminControl',  'middleware' => 'auth'], function()
  Route::get('/', ['as' => 'index', 'uses' => 'front\HomeController@index']);
  Route::get('contactUs', ['as' => 'contactUs.index', 'uses' => 'front\ContactUsController@index']);
  Route::get('portfolio', ['as' => 'portfolio.index', 'uses' => 'front\PortfolioController@index']);
	Route::get('projectCategory', ['as' => 'portfolio.projectCategory', 'uses' => 'front\PortfolioController@projectCategory']);
  Route::get('details', ['as' => 'portfolio.details', 'uses' => 'front\PortfolioController@details']);
  Route::get('aboutUs', ['as' => 'aboutUs.index', 'uses' => 'front\AboutUsController@index']);
  Route::post('contactUs', ['as' => 'contactUs.store', 'uses' => 'front\ContactUsController@store']);
  Route::get('ourServices', ['as' => 'ourServices.index', 'uses' => 'front\OurServicesController@index']);
  Route::post('subscribe/add', ['as' => 'subscribe.add', 'uses' => 'front\SubscribeController@add']);
});

Route::auth();
Route::group(['prefix' => 'adminControl',  'middleware' => 'auth'], function()
{
  //////////////Users///////////////////
  Route::resource('users','admin\UserController');


  Route::get('/', ['as' => 'dashboard.index', 'uses' => 'admin\DashboardController@index']);
  Route::get('/dashbard', ['as' => 'dashboard.index', 'uses' => 'admin\DashboardController@index']);
  Route::get('users', ['as' => 'users.index', 'uses' => 'admin\UserController@index']);
  Route::get('users/create', ['as' => 'users.create', 'uses' => 'admin\UserController@create']);
  Route::post('users/create', ['as' => 'users.store', 'uses' => 'admin\UserController@store']);
  Route::get('users/{id}', ['as' => 'users.show', 'uses' => 'admin\UserController@show']);
  Route::get('users/{id}/edit', ['as' => 'users.edit', 'uses' => 'admin\UserController@edit']);
  Route::patch('users/{id}', ['as' => 'users.update', 'uses' => 'admin\UserController@update']);
  Route::delete('users/{id}', ['as' => 'users.destroy', 'uses' => 'admin\UserController@destroy']);
  Route::post('uploadImage/store', ['as' => 'uploadImage.store', 'uses' => 'admin\UploadImageController@store']);
  //////////////Setting///////////////////
  Route::get('setting/{id}/edit', ['as' => 'setting.edit', 'uses' => 'admin\SettingController@edit']);
  Route::patch('setting/{id}', ['as' => 'setting.update', 'uses' => 'admin\SettingController@update']);
  //////////////Setting///////////////////
  /////////socialMedia ///////////
  Route::get('socialMedia', ['as' => 'socialMedia.index', 'uses' => 'admin\SocialMediaController@index']);
  Route::get('socialMedia/create', ['as' => 'socialMedia.create', 'uses' => 'admin\SocialMediaController@create']);
  Route::post('socialMedia/create', ['as' => 'socialMedia.store', 'uses' => 'admin\SocialMediaController@store']);
  Route::get('socialMedia/{id}', ['as' => 'socialMedia.show', 'uses' => 'admin\SocialMediaController@show']);
  Route::get('socialMedia/{id}/edit', ['as' => 'socialMedia.edit', 'uses' => 'admin\SocialMediaController@edit']);
  Route::patch('socialMedia/{id}', ['as' => 'socialMedia.update', 'uses' => 'admin\SocialMediaController@update']);
  Route::delete('socialMedia/{id}', ['as' => 'socialMedia.destroy', 'uses' => 'admin\SocialMediaController@destroy']);

  /////////Contact us ///////////
  /////////languages ///////////
  //Route::resource('languages','admin\LanguagesController');

  Route::get('languages', ['as' => 'languages.index', 'uses' => 'admin\LanguagesController@index']);
  Route::get('languages/create', ['as' => 'languages.create', 'uses' => 'admin\LanguagesController@create']);
  Route::post('languages/create', ['as' => 'languages.store', 'uses' => 'admin\LanguagesController@store']);
  Route::get('languages/{id}', ['as' => 'languages.show', 'uses' => 'admin\LanguagesController@show']);
  Route::get('languages/{id}/edit', ['as' => 'languages.edit', 'uses' => 'admin\LanguagesController@edit']);
  Route::patch('languages/{id}', ['as' => 'languages.update', 'uses' => 'admin\LanguagesController@update']);
  Route::delete('languages/{id}', ['as' => 'languages.destroy', 'uses' => 'admin\LanguagesController@destroy']);


  /////////Contact us ///////////
  Route::get('contactRequest', ['as' => 'contactRequest.index', 'uses' => 'admin\ContactRequestController@index']);
	Route::get('newsletter', ['as' => 'newsletter.index', 'uses' => 'admin\NewsletterController@index']);
  Route::get('sendMsg', ['as' => 'newsletter.message', 'uses' => 'admin\NewsletterController@message']);
  Route::post('sendMsg/send', ['as' => 'newsletter.send', 'uses' => 'admin\NewsletterController@send']);
  /////////Services ///////////
  Route::get('services', ['as' => 'services.index', 'uses' => 'admin\ServicesController@index']);
  Route::get('services/create', ['as' => 'services.create', 'uses' => 'admin\ServicesController@create']);
  Route::post('services/create', ['as' => 'services.store', 'uses' => 'admin\ServicesController@store']);
  Route::get('services/{id}', ['as' => 'services.show', 'uses' => 'admin\ServicesController@show']);
  Route::get('services/{id}/edit', ['as' => 'services.edit', 'uses' => 'admin\ServicesController@edit']);
  Route::patch('services/{id}', ['as' => 'services.update', 'uses' => 'admin\ServicesController@update']);
  Route::delete('services/{id}', ['as' => 'services.destroy', 'uses' => 'admin\ServicesController@destroy']);
  /////////aboutus ///////////
   Route::get('about', ['as' => 'about.index', 'uses' => 'admin\AboutController@index']);
   Route::get('about/create', ['as' => 'about.create', 'uses' => 'admin\AboutController@create']);
   Route::post('about/create', ['as' => 'about.store', 'uses' => 'admin\AboutController@store']);
   Route::get('about/{id}', ['as' => 'about.show', 'uses' => 'admin\AboutController@show']);
   Route::get('about/{id}/edit', ['as' => 'about.edit', 'uses' => 'admin\AboutController@edit']);
   Route::patch('about/{id}', ['as' => 'about.update', 'uses' => 'admin\AboutController@update']);
   Route::delete('about/{id}', ['as' => 'about.destroy', 'uses' => 'admin\AboutController@destroy']);

  /////////slider ///////////
  Route::get('slider', ['as' => 'slider.index', 'uses' => 'admin\SliderController@index']);
  Route::get('slider/create', ['as' => 'slider.create', 'uses' => 'admin\SliderController@create']);
  Route::post('slider/create', ['as' => 'slider.store', 'uses' => 'admin\SliderController@store']);
  Route::get('slider/{id}', ['as' => 'slider.show', 'uses' => 'admin\SliderController@show']);
  Route::get('slider/{id}/edit', ['as' => 'slider.edit', 'uses' => 'admin\SliderController@edit']);
  Route::patch('slider/{id}', ['as' => 'slider.update', 'uses' => 'admin\SliderController@update']);
  Route::delete('slider/{id}', ['as' => 'slider.destroy', 'uses' => 'admin\SliderController@destroy']);
  /////////slider ///////////
  Route::get('pages', ['as' => 'pages.index', 'uses' => 'admin\PagesController@index']);
  Route::get('pages/create', ['as' => 'pages.create', 'uses' => 'admin\PagesController@create']);
  Route::post('pages/create', ['as' => 'pages.store', 'uses' => 'admin\PagesController@store']);
  Route::get('pages/{id}', ['as' => 'pages.show', 'uses' => 'admin\PagesController@show']);
  Route::get('pages/{id}/edit', ['as' => 'pages.edit', 'uses' => 'admin\PagesController@edit']);
  Route::patch('pages/{id}', ['as' => 'pages.update', 'uses' => 'admin\PagesController@update']);
  Route::delete('pages/{id}', ['as' => 'pages.destroy', 'uses' => 'admin\PagesController@destroy']);
  /////////statistics ///////////
  Route::get('statistics', ['as' => 'statistics.index', 'uses' => 'admin\StatisticsController@index']);
  Route::get('statistics/create', ['as' => 'statistics.create', 'uses' => 'admin\StatisticsController@create']);
  Route::post('statistics/create', ['as' => 'statistics.store', 'uses' => 'admin\StatisticsController@store']);
  Route::get('statistics/{id}', ['as' => 'statistics.show', 'uses' => 'admin\StatisticsController@show']);
  Route::get('statistics/{id}/edit', ['as' => 'statistics.edit', 'uses' => 'admin\StatisticsController@edit']);
  Route::patch('statistics/{id}', ['as' => 'statistics.update', 'uses' => 'admin\StatisticsController@update']);
  Route::delete('statistics/{id}', ['as' => 'statistics.destroy', 'uses' => 'admin\StatisticsController@destroy']);

   ///projectCategory //
  Route::get('projectCategory', ['as' => 'projectCategory.index', 'uses' => 'admin\ProjectsCategoryController@index']);
	Route::get('projectCategory/create', ['as' => 'projectCategory.create', 'uses' => 'admin\ProjectsCategoryController@create']);
	Route::post('projectCategory/create', ['as' => 'projectCategory.store', 'uses' => 'admin\ProjectsCategoryController@store']);
	Route::get('projectCategory/{id}', ['as' => 'projectCategory.show', 'uses' => 'admin\ProjectsCategoryController@show']);
	Route::get('projectCategory/{id}/edit', ['as' => 'projectCategory.edit', 'uses' => 'admin\ProjectsCategoryController@edit']);
	Route::patch('projectCategory/{id}', ['as' => 'projectCategory.update', 'uses' => 'admin\ProjectsCategoryController@update']);
	Route::delete('projectCategory/{id}', ['as' => 'projectCategory.destroy', 'uses' => 'admin\ProjectsCategoryController@destroy']);

	/////////projects ///////////
	Route::get('projects', ['as' => 'projects.index', 'uses' => 'admin\ProjectsController@index']);
	Route::get('projects/create', ['as' => 'projects.create', 'uses' => 'admin\ProjectsController@create']);
	Route::post('projects/create', ['as' => 'projects.store', 'uses' => 'admin\ProjectsController@store']);
	Route::get('projects/{id}', ['as' => 'projects.show', 'uses' => 'admin\ProjectsController@show']);
	Route::get('projects/{id}/edit', ['as' => 'projects.edit', 'uses' => 'admin\ProjectsController@edit']);
	Route::patch('projects/{id}', ['as' => 'projects.update', 'uses' => 'admin\ProjectsController@update']);
	Route::delete('projects/{id}', ['as' => 'projects.destroy', 'uses' => 'admin\ProjectsController@destroy']);
	Route::post('projects/deleteProjectsImages', ['as' => 'projects.deleteProjectsImages', 'uses' => 'admin\ProjectsController@deleteProjectsImages']);
	Route::post('projects/deleteProjectsPlans', ['as' => 'projects.deleteProjectsPlans', 'uses' => 'admin\ProjectsController@deleteProjectsPlans']);
});
