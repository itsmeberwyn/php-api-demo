<?php

class Get
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function get_users()
    {
        $payload = [];
        $code = 200;
        $remarks = "success";
        $message = "Empty result returned";

        $sql = "SELECT * FROM users";
        $sql = $this->pdo->prepare($sql);
        $sql->execute([]);

        if ($res = $sql->fetchAll()) {
            $payload = $res;
            $remarks = "success";
            $message = "Successfully retrieved requested records";
            return response($payload, $remarks, $message, $code);
        }
        return response($payload, $remarks, $message, $code);
    }

    public function get_user_by_id($user_id)
    {
        $payload = [];
        $code = 200;
        $remarks = "success";
        $message = "Empty result returned";

        $sql = "SELECT * FROM users WHERE id = ?";
        $sql = $this->pdo->prepare($sql);
        $sql->execute([
            $user_id
        ]);

        if ($res = $sql->fetchAll()) {
            $payload = $res;
            $remarks = "success";
            $message = "Successfully retrieved requested records";
            return response($payload, $remarks, $message, $code);
        }
        return response($payload, $remarks, $message, $code);
    }
}
