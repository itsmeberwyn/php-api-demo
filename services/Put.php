<?php

class Put
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function update_user($data)
    {
        $payload = [];
        $code = 200;
        $remarks = "success";
        $message = "Nothing to update";

        $sql = "UPDATE users SET username=?, email=? WHERE id=?";
        $sql = $this->pdo->prepare($sql);
        $sql->execute([
            $data->username,
            $data->email,
            $data->id
        ]);

        $count = $sql->rowCount();

        if ($count) {
            $remarks = "success";
            $message = "Successfully updated user";
            return response($payload, $remarks, $message, $code);
        }
        return response($payload, $remarks, $message, $code);
    }
}
