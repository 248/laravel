<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;

use App\Article;
// use App\Http\Requests\ArticleRequest;

use Carbon\Carbon;

class ArticlesController extends Controller {

	public function index() {
		// $articles = Article::all();  古いコード
		// $articles = Article::where('published_at', '<=', Carbon::now())->orderBy('published_at', 'asc')->get();
		// $articles = Article::latest('published_at')->get();
		$articles = Article::published()->orderBy('published_at', 'asc')->get();

		return view('articles.index', compact('articles'));
	}

	public function create() {
		return view('articles.create');
	}

	public function store(Requests\ArticleRequest $request) {
		Article::create($request->all());
		return redirect('articles');
	}

	public function show($id) {
		// return $id;
		$article = Article::findOrFail($id);

		return view('articles.show', compact('article'));
	}

}
