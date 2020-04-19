<?php
namespace Source\Controllers;

require "../../vendor/autoload.php";
require "../Config.php";

switch($_SERVER["REQUEST_METHOD"]){
	case "POST":
		$data = json_decode(file_get_contents("php://input"),false);

		if(!$data){
			header("HTTP/1.1 401 Unauthorized");
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

		break;

	default:
		header("HTTP/1.1 401 Unauthorized");
		echo json_encode(array( "response" => "Metodo nao previsto na api" ));
		break;
}
