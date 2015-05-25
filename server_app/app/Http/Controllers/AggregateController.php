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
		
		$fileList = \Csv::getFileList($input["type"], $input["start"], $input["end"]);
// var_dump($input);
		$data = array();
		$aggregate = new \App\MyLibs\Aggregate();
		foreach ($fileList as $key => $value) 
		{
			if (!file_exists(config('system.aggregate_file_pass').$value)) {
				$error = "検索対象外のデータが含まれています。";
				break;
			}
			$aggregate->setCsv(config('system.aggregate_file_pass').$value)->foming();
		}
		$data = $aggregate->create($input["start"], $input["end"])->get();

		$header = $data[0];
		unset($data[0]);

// var_dump($data);
		// var_dump(\Csv::read("/vagrant/sales_.csv"));
		return view('aggregate.index',compact('error','header','data'));
	}

	public function test()
	{
		return view('aggregate.search');
	}

}
