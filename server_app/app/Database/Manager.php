<?php namespace App\Database;

use Doctrine\DBAL\DriverManager;
use Illuminate\Config\Repository;

class Manager
{

	/** @var Repository  */
	protected $config;

	/**
	 * @param Repository $config
	 */
	public function __construct(Repository $config)
	{
		$this->config = $config;
	}

	/**
	 * @param null $name
	 * @return \Doctrine\DBAL\Connection
	 * @throws \Doctrine\DBAL\DBALException
	 */
	public function connection($name = null)
	{
		$configure = $this->config->get('database');
		$connection = DriverManager::getConnection($configure['connections'][$name]);
		$connection->setFetchMode($configure['fetch']);
		return $connection;
	}
} 


