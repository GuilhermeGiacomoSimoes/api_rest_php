<?php

namespace Source\Controllers;

use Source\Models\Validations;
use Source\Models\User;

require "../../vendor/autoload.php";
require "../Config.php";

switch($_SERVER["REQUEST_METHOD"]){
	case "POST":
		$data = json_decode(file_get_contents("php://input"),false);

		if(!$data){
			header("HTTP/1.1 400 Bad request");
			echo json_encode(array("response" => "Nenhum dado informado"));
			exit;
		}

		$errors = array();

		if(!Validations::validationString($data->first_name)){
			array_push($errors, "nome invalido");
		}	

		if(!Validations::validationString($data->last_name)){
			array_push($errors, "sobrenome invalido");
		}

		if(!Validations::validationEmail($data->email)){
			array_push($errors, "email invalido");
		}

		if(count($errors)>0){
			header("HTTP/1.1 400 Bad request");
			echo json_encode(array("response" => "ha campos invalidos no formulario", 
					       "fields"   => $errors));
			exit;
		}

		$user = new User();
		$user->first_name = $data->first_name;
		$user->last_name  = $data->last_name;
		$user->email      = $data->email;
		$user->save(); 
	
		if($user->fail()){
			header("HTTP/1.1 500 internal server error");
			echo json_encode(array( "response" => $user->fail()->getMessage() ));	
			exit;
		}
	
		break;

	default:
		header("HTTP/1.1 401 Unauthorized");
		echo json_encode(array( "response" => "Metodo nao previsto na api" ));
		break;
}

?>
