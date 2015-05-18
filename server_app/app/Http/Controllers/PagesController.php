<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {

	public function about() {
		// 配列に値をセット
		$data = [];
		$data["first_name"] = "Luke";
		$data["last_name"] = "Skywalker";

        // view関数の第２引数に配列を渡す
		return view('pages.about', $data);
		// return view('pages.about');
        // 変数に値をセット
		// $first_name = "Luke";
		// $last_name = "Skywalker";

  //       // view関数の第２引数に compact関数を使う
		// return view('pages.about', compact('first_name',
	}
}
