<?php

	namespace DB;

	class Database {

		public function __construct()
		{
			
			set_error_handler(function($errno, $errstr, $errfile, $errline) {
				throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
			}, E_ALL);

			$dbname = getenv('DB_NAME');
			$user = getenv('DB_USER');
			$password = getenv('DB_PASS');
			$host = getenv('DB_HOST');

			$connStr = sprintf("host=%s port=5432 dbname=%s user=%s password=%s", $host, $dbname, $user, $password);

			try {
			  $DBconnection = pg_connect($connStr);

			  $stmt = pg_prepare($DBconnection, "insert_query", "INSERT INTO employees (nome) VALUES ($1);");
			  $result = pg_execute($DBconnection, "insert_query", array('Wallace', 'Wendel', 'Wesley', 'Ana Flavia'));

			} catch (Exception $e) {
				die("Ocorreu uma erro ao conectar no banco de dados :( " . $e->getMessage() . PHP_EOL);
			}

		}
		
	}

/* "host=$host port=5432 dbname=$dbname user=$user password=$password"; */
?>
