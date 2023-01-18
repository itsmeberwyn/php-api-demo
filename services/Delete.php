<?php

class Delete
{
    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function delete_user($user_id)
    {
        $payload = [];
        $code = 200;
        $remarks = "success";
        $message = "Nothing to delete";

        $sql = "DELETE FROM users WHERE id=?";
        $sql = $this->pdo->prepare($sql);
        $sql->execute([
            $user_id
        ]);

        $count = $sql->rowCount();

        if ($count) {
            $remarks = "success";
            $message = "Successfully deleted user";
            return response($payload, $remarks, $message, $code);
        }
        return response($payload, $remarks, $message, $code);
    }
}
