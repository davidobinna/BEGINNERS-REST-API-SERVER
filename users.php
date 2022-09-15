<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Content-Type: application/json');

//print_r($_SERVER);
//include database.php file
require_once __DIR__."./database.php";

//create a object of users class
$user = new Database();

// create a api variable to get HTTP method dynamically
$api = $_SERVER['REQUEST_METHOD'];

//get id from url
$id = intval($_GET['id'] ?? '' );

// Get all or a single user from database
if ($api == 'GET') {
    # code...
    if ($id > 0) {
        # code... 
         $data = $user->fetch($id);
         echo json_encode($data);
    } else {
        # code...
        $data = $user->fetch();
        echo json_encode($data);
  }
}
 
//add a new user into database

if ($api == 'POST') {
    # code...
    
    $name = $user->test_input($_POST['name']);
    $email = $user->test_input($_POST['email']);
    $phone = $user->test_input($_POST['phone']);

    if ($user->insert($name, $email, $phone)) {
        # code...
        echo $user->message('User added Successfully',false);

    } else {
        # code...
        echo $user->message('Failed to add a user!', true);
    }
}

// Update an user in database
if ($api == 'PUT') {
     

    //$arr = file('php://input') or die ('Error: Cannot find file');
    //var_dump($arr);
  
    parse_str(file_get_contents('php://input'), $post_input);
    //print_r($post_input);

    $name = $user->test_input($post_input['name']);
    $email = $user->test_input($post_input['email']);
    $phone = $user->test_input($post_input['phone']);

    if ($id != null) {
      if ($user->update($name, $email, $phone, $id)) {
        echo $user->message('User updated successfully!',false);
      } else {
        echo $user->message('Failed to update an user!',true);
      }
    } else {
      echo $user->message('User not found!',true);
    }
  }

  // Delete an user from database
  if ($api == 'DELETE') {
    if ($id != null) {
      if ($user->delete($id)) {
        echo $user->message('User deleted successfully!', false);
      } else {
        echo $user->message('Failed to delete an user!', true);
      }
    } else {
      echo $user->message('User not found!', true);
    }
  }
?>