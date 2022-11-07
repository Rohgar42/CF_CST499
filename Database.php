<?php

class Database
{

    public function connectToDb() {
      try {
        $connectionString = "mysql:host=localhost;dbname=employee_portal";
        $user = "test_tester";
        $pass = "password1";
        $pdo = new PDO($connectionString, $user, $pass);
        return $pdo;
      }
      catch (PDOException $e)	{
        die($e->getMessage());
      }
	  }

    public function executeQuery($con, $sql, $params) {
      // returns a PDOStatement object
      try {
        $stmt = $con->prepare($sql);
        $result = $stmt->execute($params);
        return $result;
      }
      catch (PDOException $e) {
        //die($e->getMessage());
        echo "ERROR : " . $e->getMessage() . " (" . $e->getCode() . ")<br>";
        return false;
      }
  	}

    public function executeSelectQuery($con, $sql, $params=[]) {
      try {
        $stmt = $con->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        return $result;
        //return $result[0];
      }
      catch (PDOException $e) {
        //die($e->getMessage());
        echo "ERROR : " . $e->getMessage() . " (" . $e->getCode() . ")<br>";
        return false;
      }
  	}
}
