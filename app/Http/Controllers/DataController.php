<?php

namespace App\Http\Controllers;

use DB;
use App\Project;
use App\Opinion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller {

	public function getDonationsTime() {
		$donations = DB::table('opinions')->lists('donated_amount_in_cents', 'donated_at');
		$output = [];
		$i = 0;

		// Convert cents
		foreach ($donations as $time => $donation) {
			$date = new \DateTime($time);
			$output[$i]['day'] = $date->format('N');
			$output[$i]['hour'] = $date->format('h');
			$output[$i]['value'] = $donation / 100;
			$i++;
		}

		return response()->json($output);
	}
}