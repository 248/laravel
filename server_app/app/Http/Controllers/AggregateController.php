<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AggregateController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('aggregate.index');
	}

	public function search(Requests\AggregateRequest $request)
	{
		$error = null;
		$input = $request->all();
		// \Input::replace($input);

		if(strtotime($input["start"]) > strtotime($input["end"]))
		{
			$error = "start <= end となるように入力して下さい。";
				return view('aggregate.index',compact('error'));
		}

		$fileList = \Csv::getFileList($input["type"], $input["start"], $input["end"]);
// dd($fileList);
		$data = array();
		$aggregate = new \App\MyLibs\Aggregate();
		foreach ($fileList as $key => $value) 
		{
			if (!file_exists(config('system.aggregate_file_pass').$value)) {
				$error = "検索対象外のデータが含まれています。";
				return view('aggregate.index',compact('error'));
			}
			$aggregate->setCsv(config('system.aggregate_file_pass').$value)->foming();
		}
		$data = $aggregate->create($input["start"], $input["end"])->get();

		$header = $data[0];
		unset($data[0]);

// var_dump($data);
		// var_dump(\Csv::read("/vagrant/sales_.csv"));
		return view('aggregate.index',compact('error','header','data','fileList'));
	}

	public function download($fileName)
	{
		\Csv::cnvSjis(config('system.aggregate_file_pass').$fileName);

		$buf   = mb_convert_encoding("/tmp/sjis.csv", "SJIS-win", "UTF-8");

		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".$fileName);
		readfile($buf);
	}

	public function test()
	{
		return view('aggregate.search');
	}

}
