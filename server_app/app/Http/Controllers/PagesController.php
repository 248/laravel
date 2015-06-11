<?php namespace App\Http\Controllers;

// use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;

use Jyggen\Curl\Request;
use Jyggen\Curl\Response;
// use Jyggen\Curl\Curl;


// require_once '/vagrant/develop/laravel/server_app/interface.proto.php';

class PagesController extends Controller {

	public function about() {

// var_dump(Curl::get('http://153.149.155.132/edit'));

		$array = array(
			"title" => "MyFavorite",
			"content" => "Color is Black."
			);

		$json = json_encode($array);

		$request = new Request('https://153.149.155.132/edit');
		$request->setOption(CURLOPT_SSL_VERIFYPEER, false); // ssl証明書無視

		$request->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		$request->setOption(CURLOPT_FOLLOWLOCATION, true);
		$request->setOption(CURLOPT_POST, true);
		$request->setOption(CURLOPT_POSTFIELDS, $json);

		$request->execute();


		if ($request->isSuccessful()) {
			// $response = Response::forge($request);
			$response = $request->getResponse();
			echo $response->getStatusCode();
			var_dump(json_decode($response->getContent()));
		} else {
			throw new Exception($resquest->getErrorMessage());
			echo $resquest->getErrorMessage();
		}

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

	public function proto() 
	{

				// $request = new \App\proto\Test\Test();
		$test = new \Proto\Request\NetworkTestRequest();
		$test->setTransmissionNo(1);
		$test->setAllNetStoreId("0000");
		$test->setAllNetSerialNo("000000000000");
		$test->setAllNetGameId("AAAA");

		$req = new \Proto\Request();
		$req->setNetworkTestRequest($test);
				// $aggregate = new \App\MyLibs\Aggregate();
				// $request->
		var_dump($req);
		$raw = $req->serializeToString();



		$request = new Request('https://153.128.38.1/asgt-ps02/request?work=network_test');
		$request->setOption(CURLOPT_SSL_VERIFYPEER, false); // ssl証明書無視

		$request->setOption(CURLOPT_HTTPHEADER, array('Content-Type: application/x-protobuf'));
		$request->setOption(CURLOPT_FOLLOWLOCATION, true);
		$request->setOption(CURLOPT_POST, true);
		$request->setOption(CURLOPT_POSTFIELDS, $raw);

		$request->execute();


		if ($request->isSuccessful()) {
			$response = Response::forge($request);
			echo $response->getStatusCode();
			echo $response->getContent();
			$res = \Proto\Response::parseFromString($response->getContent());
			var_dump($res);
		} else {
			throw new Exception($resquest->getErrorMessage());
			echo $resquest->getErrorMessage();
		}

		$tmp = $res->getNetworkTestResponse();

		var_dump($tmp);

		echo $tmp->getResult();

	}

	public function db() 
	{

	}
}
