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
		$input = $request->all();
		// dd($input);
		return view('aggregate.index');
	}


}
