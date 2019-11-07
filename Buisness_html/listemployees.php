<?php
    
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
                //include('../errors/database_error.php');
                exit();
            }
        }
        return self::$db;
    }
}

class Employees {
    private $id;
    private $first_name;
    private $last_name;

    public function __construct($id, $first_name, $last_name) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($value) {
        $this->id = $value;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function setFirstName($value) {
        $this->first_name = $value;
    }
    
    public function getLastName() {
        return $this->last_name;
    }

    public function setLastName($value) {
        $this->last_name = $value;
    }
}
class EmployeeDB {
    public static function getEmployees() {
        $db = Database::getDB();
        $query = 'SELECT * FROM employee
                  ORDER BY employeeID';
        $statement = $db->prepare($query);
        $statement->execute();
        
        $employees = array();
        foreach ($statement as $row) {
            $employee = new Employees($row['employeeID'],
                                     $row['fname'],
                                     $row['lname']);
            $employees[] = $employee;
        }
        return $employees;
    }
}
$employees = EmployeeDB::getEmployees();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fall2018 Portfolio</title>
    <link href="B_Css/style3.css" rel="stylesheet" />
    <link href="B_Css/form.css" rel="stylesheet" />
    <script src="js/port_formsubmit.js"></script>
</head>
<body>
<header>
    <h1>Happy Hound</h1>
    <img src="Images/paw_2_40.png" id="paw" alt=""/>&nbsp;&nbsp;<img src="Images/Happy pup 1.jpg" alt="Photo of Happy Dog" />&nbsp;&nbsp;<img src="Images/paw_2_40.png" id="paw" alt=""/>
    <h2>Activity Center</h2>
        <nav>
            <ul>
                <li><a href="B_Discrip.html">Main</a></li>
                <li><a href="B_Newsletter.html">Newsletter</a></li>
            </ul>
        </nav>
</header>
<section>
    <article>
  <h2>List Employees</h2>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  
  <ul>
      <?php foreach ($employees as $employee): ?>    
      <li>
            <?php echo $employee->getFirstName() . " " . $employee->getLastName() ?>
      </li>
    <?php endforeach; ?>
  </ul>
  <p>&nbsp;</p>
</section>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h1>&nbsp;</h1>
<h2>&nbsp;</h2>
</article>
</body>
</html>