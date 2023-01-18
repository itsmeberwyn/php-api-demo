<?php

class Post
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function add_user($data)
    {
        $payload = [];
        $code = 500;
        $remarks = "failed";
        $message = "Failed to add user";

        $sql = "INSERT INTO users (username, email, password) VALUES (?,?,?)";
        $sql = $this->pdo->prepare($sql);
        $sql->execute([
            $data->username,
            $data->email,
            password_hash($data->password, PASSWORD_DEFAULT),
        ]);

        $count = $sql->rowCount();
        $user_id = $this->pdo->lastInsertId();

        if ($count) {
            $payload = ["user_id" => $user_id];
            $remarks = "success";
            $message = "Successfully created user";
            return response($payload, $remarks, $message, $code);
        }
        return response($payload, $remarks, $message, $code);
    }
}

// compair password
// if ($res && password_verify($data->user_password, $res['user_password'])) {
