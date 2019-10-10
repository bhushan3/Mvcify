<?php
namespace Mvcify\Model;

class User extends \Mvcify\Core\Model
{
    public function createUser($name, $location, $email)
    {
        $sql        = 'INSERT INTO user (name, location, email) VALUES (:name, :location, :email)';
        $query      = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':location' => $location, ':email' => $email);

        if ($query->execute($parameters)) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function getUser($id)
    {
        $sql        = 'SELECT id, name, location, email FROM user WHERE id = :id LIMIT 1';
        $query      = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);

        return $query->rowcount() ? $query->fetch() : false;
    }

    public function getAllUsers()
    {
        $sql   = 'SELECT id, name, location, email FROM user';
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function updateUser($name, $location, $email, $id)
    {
        $sql        = 'UPDATE user SET name = :name, location = :location, email = :email WHERE id = :id';
        $query      = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':location' => $location, ':email' => $email, ':id' => $id);

        return $query->execute($parameters);
    }

    public function deleteUser($id)
    {
        $sql        = 'DELETE FROM user WHERE id = :id';
        $query      = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        $query->execute($parameters);
    }

    public function getTotalUsers()
    {
        $sql   = 'SELECT COUNT(id) AS total FROM user';
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch()->total;
    }
}
