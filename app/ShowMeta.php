<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShowMeta extends Model {
	protected $table = 'show_meta';

	public function show() {
		return $this->hasOne('App\Show', 'id', 'show_id');
	}

	public static function epName($id) {
		$data = ShowMeta::where('tvmaze_id', $id)->first();
		if ($data) {
			return sprintf("%s (S%02dE%02d)", $data->name, $data->season, $data->episode);
		}
		return '-';
	}
}
