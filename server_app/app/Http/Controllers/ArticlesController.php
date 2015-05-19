<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Article;

class ArticlesController extends Controller {

	public function index() {
		$articles = Article::all();

		return view('articles.index', compact('articles'));
	}

	public function create() {
		return view('articles.create');
	}

	public function store(Request $request) {
  //       // ①フォームの入力値を取得
		// $inputs = \Request::all();

  //       // ②マスアサインメントを使って、記事をDBに作成
		// Article::create($inputs);

		$rules = [    // ②
		'title' => 'required|min:3',
		'body' => 'required',
		'published_at' => 'required|date',
		];
		$this->validate($request, $rules);  // ③

		Article::create($request->all());

		// ③記事一覧へリダイレクト
		return redirect('articles');
	}

	public function show($id) {
		// return $id;
		$article = Article::findOrFail($id);

		return view('articles.show', compact('article'));
	}

}
