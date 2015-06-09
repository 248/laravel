<?php namespace App\Database;

use Illuminate\Support\Facades\Facade;

class DatabaseFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'dbal';
	}
}