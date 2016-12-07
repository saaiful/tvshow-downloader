# TvShow Downloader

This is a simple web application for "Automatic TvShow Download". It's written in Lumen (php) and use aria2 as torrent downloader. 

![TvShow Downloader](http://i67.tinypic.com/2hem0zr.png)


### Data Source
* kickass.cd
* tvmaze.com


### Installation

1. Clone this project using git (`git clone https://github.com/saaiful/tvshow-downloader`) or download and unzip it in your server root.
2. Install it using `composer install`.
3. Edit the .env file and set your database details.
4. Migrate using `php artisan migrate`.
5. Install aria2 in your server/pc and enable rpc (`aria2c --enable-rpc --rpc-listen-all`), in windows x64 download the setup file from https://github.com/saaiful/aria2-win64-rpc and just install it and reboot your pc.
6. Set a cron job or set a task using windows task scheduler. 

Cron Job: `* * * * * php path_to_you_app/artisan schedule:run >> /dev/null 2>&1`<br>
Task scheduler : `php path_to_you_app/artisan schedule:run`

All downloads can be found in `storage/downloads`.
