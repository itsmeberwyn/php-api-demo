<?php
function responseError($code)
{
    switch ($code) {
        case 400:
            $msg = "Bad Request. Please contact the systems administrator.";
            break;
        case 401:
            $msg = "Unauthorized user.";
            break;
        case 403:
            $msg = "Forbidden. Please contact the systems administrator.";
            break;
        default:
            $msg = "Request Not Found.";
            break;
    }

    http_response_code($code);
    return json_encode(array("status" => array("remarks" => "failed", "message" => $msg), "timestamp" => date_create()));
}

function response($payload, $remarks, $message)
{
    $status = array("remarks" => $remarks, "message" => $message);
    return array("status" => $status, "payload" => $payload, "timestamp" => date_create());
}
