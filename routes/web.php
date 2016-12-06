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

$app->get('/download', function () use ($app) {
	$aria2 = new Aria2();
	// dd($aria2->tellActive());
	// dd($aria2->tellStatus('3a05770f9707fdc7'));
	var_dump($aria2->addUri(array('magnet:?xt=urn:btih:cda771af1343855c4440fcfc94a93b2e0ca02c47&dn=%5BBigTitsAtSchool%5D+Blanche+Bradburry+%28Teacher+Tease+-+05.12.2016%29&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969&tr=udp%3A%2F%2Fzer0day.ch%3A1337&tr=udp%3A%2F%2Fopen.demonii.com%3A1337&tr=udp%3A%2F%2Ftracker.coppersurfer.tk%3A6969&tr=udp%3A%2F%2Fexodus.desync.com%3A6969'), array(
		'dir' => storage_path() . "/downloads",
		'--seed-time' => 0,
	)));
});
$app->get('/', 'ShowController@getHome');
$app->get('/show/{id}', 'ShowController@getShow');
$app->get('/episode/{id}', 'ShowController@getEpisode');
$app->get('/whats-new', 'ShowController@getWhatsNew');
$app->get('/torrent', 'TorrentController@findTorrent');
$app->get('/new-show', function () use ($app) {
	return view('new-show');
});
$app->get('/add-show-ajax', 'ShowController@addShow');
$app->get('/aria2-ajax', 'TorrentController@aria2status');
$app->get('/aria2-remove', 'TorrentController@aria2remove');
