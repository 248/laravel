<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;

use App\Article;
use App\Tag;
// use App\Http\Requests\ArticleRequest;

use Carbon\Carbon;

class ArticlesController extends Controller {

	function __construct(){
		$this->middleware('auth', ['except' => ['index', 'show']]);
	}

	public function index() {
		// $articles = Article::all();  //古いコード
		// $articles = Article::where('published_at', '<=', Carbon::now())->orderBy('published_at', 'asc')->get();
		// $articles = Article::latest('published_at')->get();
		
		$articles = Article::published()->orderBy('published_at', 'desc')->get();
// $articles = array();

		// $result = \DBAL::connection('dbal_mysql')->fetchAll("SELECT NOW() as now");

		return view('articles.index', compact('articles'));
	}

	public function create() {
		$tags = Tag::lists('name', 'id');
		return view('articles.create', compact('tags'));
	}

	public function store(Requests\ArticleRequest $request) {
		// Article::create($request->all());
		$articles = \Auth::user()->articles()->create($request->all());
		$articles->tags()->attach($request->input('tag_list'));
		\Session::flash('flash_message', '記事を追加しました。');
		// return redirect('articles');
		return redirect()->route('articles.index');
	}

	public function show(Article $article) {
		// return $id;
		// $article = Article::findOrFail($id);

		return view('articles.show', compact('article'));
	}

	public function edit(Article $article) {
		// $article = Article::findOrFail($id);
		$tags = Tag::lists('name', 'id');

		return view('articles.edit', compact('article', 'tags'));
	}

	public function update(Article $article, Requests\ArticleRequest $request) {
		// $article = Article::findOrFail($id);

		$article->update($request->all());
		$article->tags()->sync($request->input('tag_list'));
		\Session::flash('flash_message', '記事を更新しました。');
		// return redirect(url('articles', [$article->id]));
		return redirect()->route('articles.show', [$article->id]);
	}

	public function destroy(Article $article) {
		// $article = Article::findOrFail($id);

		$article->delete();
		\Session::flash('flash_message', '記事を削除しました。');
		// return redirect('articles');
		return redirect()->route('articles.index');
	}
}
