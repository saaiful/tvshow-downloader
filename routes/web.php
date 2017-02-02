<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */
$app->get('/', 'ShowController@getHome');
$app->get('/show/{id}', 'ShowController@getShow');
$app->get('/episode/{id}', 'ShowController@getEpisode');
$app->get('/whats-new', 'ShowController@getWhatsNew');
$app->get('/torrent', 'TorrentController@findTorrent');
$app->get('/new-show', function () use ($app) {
	return view('new-show');
});
$app->get('/update-all', 'TorrentController@updateAll');
$app->get('/add-show-ajax', 'ShowController@addShow');
$app->get('/aria2-ajax', 'TorrentController@aria2status');
$app->get('/aria2-remove', 'TorrentController@aria2remove');
$app->get('/auto-download', 'TorrentController@AutoDownload');