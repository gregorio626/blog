<?php

include dirname(dirname(__FILE__)) . '/config/database.config.php';

/*This class is used to interact with a database
 * Created: 12-03-16
 */
class Database {

  // The credentials needed for connecting to the database
  private $host = DB_HOST;
  private $dbname = DB_NAME;
  private $user = DB_USER;
  private $pass = DB_PASS;

  /* The database handler */
  private $dbh;

  /* Errors */
  private $error;

  /* The query statement */
  private $stmt;

  /* The default constrctor */
  public function __construct() {
    // Set the DSN
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

    // Set the options
    $options = array(
      PDO::ATTR_PERSISTENT => true, //Persistent connections increase performance by first checking to see if there is already a connection to the database
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //If an error occurs, and exception will be thrown
    );

    // Attempt to create a new PDO instance
    try {
      $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    }

    // Catch any errors that might occur
    catch (PDOException $e){
      $this->error = $e->getMessage();
    }
  }

  /* Prepares a query and stores it in $stmt */
  public function query($query) {
    $this->stmt = $this->dbh->prepare($query);
  }

  /* Used to bind the inputs with the placeholders put in the prepared statement
   * ONLY USE AFTER query() FUNCITON HAS BEEN CALLED
   */
  public function bind($param, $value, $type=null) {
    if(is_null($type)) {
      switch(true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }
    $this->stmt->bindValue($param, $value, $type);
  }

  /* Ecexutes the query statement */
  public function execute() {
    return $this->stmt->execute();
  }

  /*Returns an array of the result set rows */
  public function getResultSet() {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  /*Returns an array of the result set rows */
  public function getResultSets() {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /* Returns the number of rows effected from the previous update, delete, or insert statement */
  public function getRowCount() {
    return $this->stmt->rowCount();
  }

  /* Returns the last inserted id as a string */
  public function getLastInsertId() {
    return $this->dbh->lastInsertId();
  }

  /* Begin a transaction */
  public function beginTransaction() {
    return $this->dbh->beginTransaction();
  }

  /* Ends a transaction and commits changes */
  public function endTransaction() {
    return $this->dbh->commit();
  }

  /*Cancels a transaction */
  public function cancelTransaction() {
    return $this->dbh->rollBack();
  }

  /* Dump the information contained in the prepared statement */
  public function debugDumpParams() {
    return $this->stmt->debugDumpParams();
  }
}

/*
foreach($db as $key => $value) {
  define(strtoupper($key), $value);
}

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$conn) {
  die("Error: Cannot connect to database---->" . mysqli_connect_error());
} else {
  echo "Successfully connected to database!";
}

*/

?>
