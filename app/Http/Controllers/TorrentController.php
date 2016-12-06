<?php

namespace App\Http\Controllers;
use App\ShowMeta;
use Aria2;
use Curl;

class TorrentController extends Controller {

	public function findTorrent($name = '', $id = '') {
		if ($name == '') {
			$name = @$_GET['name'];
			$_id = @$_GET['id'];
		}
		preg_match("/(e[0-9]+|E[0-9]+)/", $name, $m);
		$s = @$m[1];
		$ch = new Curl();
		$result = $ch->get('https://kickass.cd/search.php?q=' . $name);
		$html = str_get_html($result);
		if (!$html) {
			return response()->json("Try Again!", 500);
		}
		$x = [];
		foreach ($html->find('tr') as $key => $value) {
			try {
				$_x = @$value->find('.cellMainLink')[0]->innertext;
				if (preg_match("/$s.*ettv/i", $_x)) {
					$x = [@$value->find('.cellMainLink')[0]->innertext, @$value->find('a[title=Torrent magnet link]')[0]->href];
					$show = ShowMeta::find($_id);
					if ($show) {
						$show->magnet = $x[1];
						$show->save();
						$this->startDownload($show->magnet);
					}
					return response()->json("Torrent Found!", 200);
				}
			} catch (Exception $e) {
			}
		}
		return response()->json("Try Again!", 500);
	}

	public function startDownload($uri) {
		$aria2 = new Aria2();
		$aria2->addUri([$uri], [
			'dir' => storage_path() . "/downloads",
			'--seed-time' => 0,
		]);
	}

	public function aria2status() {
		$aria2 = new Aria2();
		$r = $aria2->tellActive();
		return response()->json($r, 200);
	}

	public function aria2remove() {
		$aria2 = new Aria2();
		$aria2->remove(@$_GET['id']);
		return redirect('/');
	}
}
