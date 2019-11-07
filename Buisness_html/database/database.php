<?php
/*  Date	Name	Description                                 */
/*  --------------------------------------------------------------- */
/*                                                                  */
/*  9/13/2019  David Verbeck   Created databse class for use of      */
/*                            other pages                           */
/********************************************************************/

class Database {
    private static $dsn = 'mysql:host=localhost;dbname=dave_buisnessdb';
    private static $username = 'root';
    private static $password = 'Pa$$w0rd';
    private static $db;

    private function __construct() {}

    public static function getDB () {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                                     self::$username,
                                     self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                echo 'Connection error, please try again later';
                exit();
            }
        }
        return self::$db;
    }
}
?>