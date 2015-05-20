<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;

use App\Article;
// use App\Http\Requests\ArticleRequest;

use Carbon\Carbon;

class ArticlesController extends Controller {

	function __construct(){
		$this->middleware('auth', ['except' => ['index', 'show']]);
	}

	public function index() {
		// $articles = Article::all();  古いコード
		// $articles = Article::where('published_at', '<=', Carbon::now())->orderBy('published_at', 'asc')->get();
		// $articles = Article::latest('published_at')->get();
		$articles = Article::published()->orderBy('published_at', 'desc')->get();

		return view('articles.index', compact('articles'));
	}

	public function create() {
		return view('articles.create');
	}

	public function store(Requests\ArticleRequest $request) {
		Article::create($request->all());
		// return redirect('articles');
		return redirect()->route('articles.index');
	}

	public function show($id) {
		// return $id;
		$article = Article::findOrFail($id);

		return view('articles.show', compact('article'));
	}

	public function edit($id) {
		$article = Article::findOrFail($id);

		return view('articles.edit', compact('article'));
	}

	public function update($id, Requests\ArticleRequest $request) {
		$article = Article::findOrFail($id);

		$article->update($request->all());

		// return redirect(url('articles', [$article->id]));
		return redirect()->route('articles.show', [$article->id]);
	}

	public function destroy($id) {
		$article = Article::findOrFail($id);

		$article->delete();
		\Session::flash('flash_message', '記事を削除しました。');
		// return redirect('articles');
		return redirect()->route('articles.index');
	}
}
