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
			if (!file_exists("/vagrant/".$value)) {
				$error = "検索対象外の月が含まれています";
				break;
			}
			$aggregate->setCsv("/vagrant/".$value)->foming();
		}
		$data = $aggregate->create($input["start"], $input["end"])->get();
// var_dump($data);
		// var_dump(\Csv::read("/vagrant/sales_.csv"));
		return view('aggregate.index',compact('error','data'));
	}

	public function test()
	{
		return view('aggregate.search');
	}

}
