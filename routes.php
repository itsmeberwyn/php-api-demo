<?php
require_once('./config/Config.php');
require_once('./modules/Procedural.php');
require_once('./services/Get.php');
require_once('./services/Post.php');
require_once('./services/Put.php');
require_once('./services/Delete.php');

$db = new Connection();
$pdo = $db->connect();

$get = new Get($pdo);
$post = new Post($pdo);
$put = new Put($pdo);
$delete = new Delete($pdo);

if (isset($_REQUEST['request'])) {
    $req = explode('/', rtrim($_REQUEST['request'], '/'));
} else {
    $req = array("errorcatcher");
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $body = json_decode(file_get_contents("php://input"));

        switch ($req[0]) {
            case 'user':
                echo json_encode($post->add_user($body));
                break;

            default:
                echo responseError(400);
                break;
        }
        break;

    case 'GET':
        switch ($req[0]) {
            case 'users':
                if (sizeof($req) == 2) {
                    // get specific user
                    // users/{id}
                    echo json_encode($get->get_user_by_id($req[1]));
                    return;
                }
                // get all users
                echo json_encode($get->get_users());
                break;
            default:
                echo responseError(400);
                break;
        }
        break;

    case 'PUT':
        $body = json_decode(file_get_contents("php://input"));

        switch ($req[0]) {
            case 'user':
                echo json_encode($put->update_user($body));
                break;
            default:
                echo responseError(400);
                break;
        }
        break;

    case 'DELETE':
        switch ($req[0]) {
            case 'users':
                if (sizeof($req) == 2) {
                    // delete specific user
                    echo json_encode($delete->delete_user($req[1]));
                    return;
                }
                break;
            default:
                echo responseError(400);
                break;
        }
        break;
}

// POST /user
// GET /users
// GET /users/1
// PUT /users/1