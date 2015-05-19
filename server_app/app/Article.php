<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	protected $fillable = ['title', 'body', 'published_at'];

	// published_at も日付ミューテーター使います。よろしく
	protected $dates = ['published_at'];

	//  published scopeを定義
	public function scopePublished($query) {
		$query->where('published_at', '<=', Carbon::now());
	}

	public function getTitleAttribute($value)
	{
		// 大文字に変換
		return mb_strtoupper($value);
	}

	public function setTitleAttribute($value)
	{
        // 小文字に変換
		$this->attributes['title'] = mb_strtolower($value);
	}
}
