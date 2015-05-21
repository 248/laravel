<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CsvFacade extends Facade
{
    protected static function getFacadeAccessor(){
        return 'csv';
    }
}