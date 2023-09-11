<?php
function checkrequest(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
       return true;
    }
    return false;
}
function issetpost($input){
if (isset($_POST[$input])) {
  return true;
}
return false;
}

function sanitizeinput($input){
return trim(htmlspecialchars(htmlentities($input)));
}
function requiredval($input){
    if (empty($input)) {
        return false;
    }
    return true;
}
function minval($input,$lenthe){
    if(strlen($input) < $lenthe) {
        return false;
    }
    return true;
}
function maxval($input,$lenthe){
    if (strlen($input) > $lenthe) {
        return false;
    }
    return true;
}
function emailval($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}
class InputValidator {
    public static function checkRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function issetPost($input) {
        return isset($_POST[$input]);
    }

    public static function sanitizeInput($input) {
        return trim(htmlspecialchars(htmlentities($input)));
    }

    public static function requiredVal($input) {
        return !empty($input);
    }

    public static function minVal($input, $length) {
        return strlen($input) >= $length;
    }

    public static function maxVal($input, $length) {
        return strlen($input) <= $length;
    }

    public static function emailVal($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    public static function connection(){
        $con =new PDO('mysql:localhost;dbname=php814','root','');
        
    }
}
class DB
{
    public $connection;
    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=localhost;dbname=php317" ,"root","");
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            die($e->getMessage());
        }
    }

    public function getData($table, $columns = "*", $condition = true)
    {
        $query = "SELECT $columns FROM $table WHERE $condition";
        $data = $this->connection->query($query);
        return $data->fetchAll();
    }

    public function insertData($table, $columns, $data)
    {
        foreach ($columns as $column) {
            $c[] = '`' . $column . '`';
        }
        $col = implode(', ', $c);
        $d = array_map(function ($x) {
            return gettype($x) == 'string' ?  "'" . $x . "'" : $x;
        }, $data);
        $info = implode(', ', $d);
        $query = "INSERT INTO $table ($col) VALUES ($info)";
        $sql = $this->connection->prepare($query);
        return $sql->execute();
    }

    public function updateData($table, $data, $condition)
    {
        foreach ($data as $key => $val) {
            $d[] = "`$key` = '$val'";
        }
        $info = implode(', ', $d);
        $query = "UPDATE $table SET $info WHERE $condition";
        $sql = $this->connection->prepare($query);
        return $sql->execute();
    }

    public  function deleteData($table, $condition = true)
    {
        $query = "DELETE FROM $table WHERE $condition";
        $sql = $this->connection->prepare($query);
        return $sql->execute();
    }
}
// //Example usage


// if (InputValidator::checkRequest('POST')) {
//     if (InputValidator::issetPost('username')) {
//         $username = InputValidator::sanitizeInput($_POST['username']);
//         if (InputValidator::requiredVal($username) && InputValidator::minVal($username, 3)) {
//             // Process the validated username
//         } else {
//             // Handle validation errors
//         }
//     } else {
//         // Handle missing input
//     }

//     if (InputValidator::issetPost('email')) {
//         $email = InputValidator::sanitizeInput($_POST['email']);
//         if (InputValidator::emailVal($email)) {
//             // Process the validated email
//         } else {
//             // Handle validation errors
//         }
//     } else {
//         // Handle missing input
//     }
// } else {
//     // Handle invalid request method
// }
