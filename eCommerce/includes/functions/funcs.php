<?php

  // Create (getAll) function [v1.0]
    function getAll($field, $table, $where = NULL, $and = NULL, $orderField, $ordering = 'DESC'){
      global $con;
      $theAll = $con->prepare("SELECT $field FROM $table $where $and ORDER BY $orderField $ordering");
      $theAll->execute();
      $all = $theAll->fetchAll();
      return $all;
    }


  // Create (redirect) function [v2.0]
    function redirectFunc($theMsg, $url = null, $sec = 3){
      if($url === null){
        $url = 'index.php';
        $link = 'Home Page';

      } else{

        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
          $url = $_SERVER['HTTP_REFERER'];
          $link = 'Previous Page';

        } else{
          $url = 'index.php';
          $link = 'Home Page';
        }
      }

      echo $theMsg;
      echo "<div class='alert alert-warning war-msg'>You will redirected to $link after $sec seconds.</div>";
      header("refresh:$sec;url=$url");
      exit();
    }

  // Create (title) function [v1.0]
    function getTitle() {
        global $titlePage;

        if(isset($titlePage)) {
            echo $titlePage;
        } else {
            echo 'Default';
        }
    }

  // Create (activeUser) function [v1.0]
    function activeUser($user){
      global $con;
      $stmt = $con->prepare("SELECT
                                Username, RegStatus
                              FROM
                                users
                              WHERE
                                Username = ?
                              AND
                                RegStatus = 0");

      $stmt->execute(array($user));
      $status = $stmt->rowCount();

      return $status;
    }

  // Create (check) function [v1.0]
    function check($select, $from, $value){
      global $con;
      $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");

      $statement->execute(array($value));
      $count = $statement->rowCount();

      return $count;
    }

  // Create (count) function [v1.0]
    function countItems($item, $table){
      global $con;
      $stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
      $stmt2->execute();
      return $stmt2->fetchColumn();
    }

  // Create (getLatest) function [v1.0]
    function getLatest($select, $table, $order, $limit = 5){
      global $con;
      $thestmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
      $thestmt->execute();
      $rows = $thestmt->fetchAll();
      return $rows;
    }
