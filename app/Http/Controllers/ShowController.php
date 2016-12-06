<?php

namespace App\Http\Controllers;
use App\Show;
use App\ShowMeta;
use Curl;
use DB;

class ShowController extends Controller {

	public function getHome() {
		$shows = DB::table('shows')->paginate(20);
		return view('home')->with('shows', $shows);
	}

	public function getWhatsNew() {
		$shows = ShowMeta::where('schedule', date('Y-m-d', strtotime('-1 day')))->get();
		return view('whats-new')->with('shows', $shows);
	}

	public function getShow($id) {
		$show = Show::find($id);
		$ep = ShowMeta::where('show_id', $id)->orderBy('schedule', 'desc')->get();
		return view('show')->with('show', $show)->with('ep', $ep);
	}

	public function getEpisode() {
		return view('episode')->with('shows', $shows);
	}

	public function addShow() {
		$id = @$_REQUEST['id'];
		$url = "http://api.tvmaze.com/shows/{$id}?embed=episodes";
		$ch = new Curl();
		$data = json_decode($ch->get($url));
		$pre = str_replace("http://api.tvmaze.com/episodes/", '', @$data->_links->previousepisode->href);
		$nxt = str_replace("http://api.tvmaze.com/episodes/", '', @$data->_links->nextepisode->href);
		if ($data) {
			$show = Show::where('tvmaze_id', $data->id)->first();
			if (!$show) {
				$show = new Show();
			}
			$show->tvmaze_id = $data->id;
			$show->name = $data->name;
			$show->summary = $data->summary;
			$show->schedule = $data->schedule->time;
			$show->cover = $data->image->original;
			$show->p_episode = $pre;
			$show->n_episode = $nxt;
			$show->save();
			$ep = 0;
			foreach ($data->_embedded->episodes as $key => $value) {
				$ep += 1;
				$s = $value->season;
				$x = ShowMeta::where('tvmaze_id', $value->id)->first();
				if (!$x) {
					$x = new ShowMeta();
				}
				$x->tvmaze_id = $value->id;
				$x->show_id = $show->id;
				$x->season = $value->season;
				$x->episode = $value->number;
				$x->name = $value->name;
				$x->schedule = $value->airdate;
				$x->save();
			}
			$show->episode = $ep;
			$show->season = $s;
			$show->save();
			return response()->json("New Show Added!", 200);
		}
		return response()->json("Something Went Wrong!", 500);
	}
}
