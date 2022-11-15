<?php

class Connection
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=wikifilm;host=127.0.0.1', 'root', 'root');
    }

    public function insert(User $user): bool
    {
        $query = 'INSERT INTO user (email, password, password2, first_name, last_name, username)
                    VALUES (:email, :password, :password2, :first_name, :last_name, :username)';


        $a = $this->login($user->email, $user->password);

        if ($a) {
            echo 'Un Utilisateur avec cet email existe déja ';
            return false;
        } else {
            $statement = $this->pdo->prepare($query);

            return $statement->execute([
                'email' => $user->email,
                'password' => md5($user->password . 'ALotOfSalt'),
                'password2' => md5($user->password2 . 'ALotOfSalt'),
                'first_name' => $user->firstName,
                'last_name' => $user->lastName,
                'username' => $user->username
            ]);
        }

    }

    public function login($mail, $pass):bool
    {
        $query = "SELECT * FROM user WHERE email='$mail' and password='".md5($pass . 'ALotOfSalt')."'";

        $statement = $this->pdo->prepare($query);

        $statement->execute();

        $user = $statement->fetchAll(PDO::FETCH_ASSOC);

        if($statement->rowCount() === 1){
            $_SESSION['name']=$user[0]["first_name"];
            $_SESSION['id']=$user[0]["id"];
            return true;
        }
        else{
            return false;
        }

    }

}