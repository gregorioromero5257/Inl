<?php


Route::get('/', function () {
    return view('welcome');
});
Route::get('/developer', function () {
    return view('home');
});
Route::get('/custom-report', function () {
    return view('home');
});
Route::get('/document-repository', function () {
    return view('home');
});
Route::get('/dashboard', function () {
    return view('home');
});
Route::get('/users', function () {
    return view('home');
});
Route::get('/states', function () {
    return view('home');
});
Route::get('/state/{key}', function () {
    return view('home');
});
Route::get('/state/{key}/documentary-information', function () {
    return view('home');
});
Route::get('/state/{key}/quantitative-sources', function () {
    return view('home');
});
Route::get('/state/{key}/qualitative-sources', function () {
    return view('home');
});

Route::get('/state/{key}/detailed-report', function () {
    return view('home');
});
Route::get('/state/{key}/executive-report', function () {
    return view('home');
});
Route::get('/state/{key}/quantitative-sources/indicators-by-decision/{year}', function () {
    return view('home');
});
Route::get('/state/{key}/qualitative-sources/scope-by-decision', function () {
    return view('home');
});
Route::get('/state/{key}/qualitative-sources/select-ambit/{ambit}/problematic-by-criterion', function () {
    return view('home');
});
Route::get('/state/{key}/qualitative-sources/{ambit}/observations-by-source-by-criterion', function () {
    return view('home');
});
Route::get('/state/{key}/qualitative-sources/{ambit}/observations-by-ambit', function () {
    return view('home');
});
Route::get('/state/{key}/qualitative-sources/{ambit}/problematic-by-criterion', function () {
    return view('home');
});
Route::get('/state/{key}/qualitative-sources/{ambit}/ambit-conclusion', function () {
    return view('home');
});
Route::get('/sociodemographic_context', function () {
    return view('home');
});
Route::get('/profile', function () {
    return view('home');
});

Route::get('/state/{key}/qualitative-sources/select-ambit', function () {
    return view('home');
});

Route::get('/state/{key}/qualitative-sources/select-ambit/{ambit}/by-criterion', function () {
    return view('home');
});

Route::get('/state/{key}/qualitative-sources/select-ambit/{ambit}/ambit-conclusion', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('invoice', function(){
    return view('invoice');
});

Route::get('{path}',"HomeController@index")->where( 'path', '([A-z\d-\/_.]+)?' );
