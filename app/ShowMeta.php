<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShowMeta extends Model {
	protected $table = 'show_meta';

	public function show() {
		return $this->hasOne('App\Show', 'id', 'show_id');
	}
}
