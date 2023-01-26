<?php

$host = "127.0.0.1"; 
$user = "root"; 
$password = ""; 
$dbname = "reactdb"; 
$id = '';

$con = mysqli_connect($host, $user, $password,$dbname);

$method = $_SERVER['REQUEST_METHOD'];
$request = '';
if(isset($_SERVER['PATH_INFO']) && isset($_SERVER['PATH_INFO']) !=''){
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
}


if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}else{
  //die("Connection test");  
}


switch ($method) {
    case 'GET':
      $id = 0;
      if(isset($_GET['id'])){
        $id = $_GET['id'];
      }
      $sql = "select * from contacts".($id ? " where id=$id":''); 
      break;
    case 'POST':
      $name = $_POST["name"];
      $email = $_POST["email"];
      $country = $_POST["country"];
      $city = $_POST["city"];
      $job = $_POST["job"];

      $sql = "insert into contacts (name, email, city, country, job) values ('$name', '$email', '$city', '$country', '$job')"; 
      break;
}

// run SQL statement
$result = mysqli_query($con,$sql);

// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error($con));
}

if ($method == 'GET') {
    if (!$id) echo '[';
    for ($i=0 ; $i<mysqli_num_rows($result) ; $i++) {
      echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
    if (!$id) echo ']';
  } elseif ($method == 'POST') {
    echo json_encode($result);
  } else {
    echo mysqli_affected_rows($con);
  }

$con->close();
