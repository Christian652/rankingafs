<?php  
class Conn
{
	private static $host = "localhost";
	private static $dbname = "ranking";
	private static $user = "root";
	private static $pass = "";
	private static $conn = null;

	private static function conectar()
	{
		if (self::$conn == null) {
			try {
			self::$conn = new PDO('mysql:host='.self::$host.';dbname='.self::$dbname.';charset=utf8',self::$user,self::$pass);
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}

		return self::$conn;
	}
	public static function getConn()
	{
		return self::conectar();
	}
}