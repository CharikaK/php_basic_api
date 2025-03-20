<?php
include('db.php');

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'),true);


switch($method){
    case 'GET':
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $result = $conn->query("SELECT * FROM users WHERE id=$id");
            $data = $result->fetch_assoc();
            echo json_encode($data);
        }else{
            $results = $conn->query("SELECT * FROM users");
            $users = [];
            while($row = $result->fetch_assoc()){
            $users[] = $row;
            }
            echo json_encode($users);
            
        }
        break;
    case 'POST': 
        $name = $input['name'];
        $email = $input['email'];
        $age = $input['age'];

        $conn->query( "INSERT INTO users (name, email, age) VALUES ('$name','$email','$age')" );
       
        echo json_encode(["message" => "User added successfully"]);
        break;
     case 'PUT':
        $id = $input['id'];
        $name = $input['name'];
        $email = $input['email'];
        $age = $input['age'];
        
        $conn->query("UPDATE users SET name='$name', email='$email', age=$age WHERE id=$id");
        echo json_encode(["message"=>"User updated successfully"]);
        break;
    case 'DELETE':
        $id = $input['id'];
        $conn->query( "DELETE FROM users WHERE id=$id" );
        http_response_code(204);
        echo json_encode("User deleted successfully");
        
        break; 
    default:
    echo json_encode(["message" => "Invalid request method"]);
}