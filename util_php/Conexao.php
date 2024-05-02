<?php
        header('Content-type: text/html, charset:utf8');
        $dbHost = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "adocaes";
        
        $conn = new mysqli ($dbHost,$dbUsername,$dbPassword,$dbName);
      //  if ($conn->connect_error) {
      //          die("Connection failed: " . $conn->connect_error);
      //        }
      //        echo "Connected successfully";
?>