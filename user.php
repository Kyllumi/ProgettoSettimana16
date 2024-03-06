<?php

class UserDTO
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM users';
        $res = $this->conn->query($sql, PDO::FETCH_ASSOC);

        if ($res) { // Controllo se ci sono dei dati nella variabile $res
            return $res;
        }

        return null;
    }
    public function getUserByID(int $id)
    {
        $sql = 'SELECT * FROM users WHERE id = :id';
        $stm = $this->conn->prepare($sql);
        $res = $stm->execute(['id' => $id]);

        if ($res) { // Controllo se ci sono dei dati nella variabile $res
            return $res;
        }

        return null;
    }
    public function saveUser(array $user)
    {
        var_dump($user);
        $sql = "INSERT INTO users (firstname, lastname, email, password, admin) VALUES (:firstname, :lastname, :email, :password, :admin)";
        $stm = $this->conn->prepare($sql);
        $stm->execute(['firstname' => $user['firstname'], 'lastname' => $user['lastname'], 'email' => $user['email'], 'password' => $user['password'], 'admin' => $user['admin']]);
        return $stm->rowCount();
    }
    public function updateUser(array $user)
    {
        $sql = "UPDATE users SET name = :nome, lastname = :cognome, email = :email, password = :password, admin = :admin WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->execute(['nome' => $user['name'], 'cognome' => $user['lastname'], 'email' => $user['email'], 'password' => $user['password'], 'admin' => $user['admin'], 'id' => $user['id']]);
        return $stm->rowCount();
    }
    public function deleteUser(int $id)
    {
        $sql = "DELETE users WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->execute(['id' => $id]);
        return $stm->rowCount();
    }
}
