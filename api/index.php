<?php
ini_set('display_errors', 1);

$wpload = dirname(__FILE__) . '/../../../../wp-load.php';

require_once $wpload;
require_once "../vendor/autoload.php";

/** @var \Model\DancersModel $dancers_model */
$dancers_model = \Services\SingletonFactory::getInstance('\Model\DancersModel');

/** @var \Model\UserModel $user_model */
$user_model = \Services\SingletonFactory::getInstance('\Model\UserModel');

global $response;

$response = [];

if (isset($_GET["action"])) {
    if ($_GET["action"] == "get" && $_GET["value"] == "all") {
        $response["query"] = $dancers_model->getAll();
    } elseif ($_GET["action"] == "get" && is_numeric($_GET["value"])) {
        $response["query"] = $dancers_model->getById(is_numeric($_GET["value"]));
    } elseif ($_GET["action"] == "uservote" && isset($_GET["username"]) && isset($_GET["password"]) && isset($_GET["id"])) {
        if ($user_model->identify($_GET["username"], $_GET["password"])) {
            $user_model->setUserVote($_GET["username"], $_GET["id"]);
            $response = [
                "status" => "success"
            ];
        } else {
            $response = [
                "status" => "error"
            ];
        }
    } elseif ($_GET["action"] == "createuser" && isset($_GET["username"]) && isset($_GET["password"]) && isset($_GET["email"])) {
        if ($user_model->createUser($_GET["username"], $_GET["password"], $_GET["email"])) {
            $response = [
                "status" => "success"
            ];
        } else {
            $response = [
                "status" => "error"
            ];
        }
    } elseif ($_GET["action"] == "userconnect" && isset($_GET["username"]) && isset($_GET["password"])) {
        if ($user_model->identify($_GET["username"], $_GET["password"])) {
            $response = [
                "status" => "success"
            ];
        } else {
            $response = [
                "status" => "error"
            ];
        }
    }
} else {
    $response = [
        "message" => "La requète n'a rien donnée",
        "status" => "error"
    ];
}

echo json_encode($response);

