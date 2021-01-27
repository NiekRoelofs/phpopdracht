<?php

class User_Service
{
    private $user_dao;

    public function __construct()
    {
        $this->user_dao = new User_DAO();
    }

    public function getAllUsers()
    {
        return $this->user_dao->getAll();
    }

    public function getUserById($id)
    {
        return $this->user_dao->getById($id);
    }

    public function getUserByName($name){
        return $this->user_dao->getByName($name);
    }

    public function checkUserByEmail($email){
        return $this->user_dao->checkByEmail($email);
    }

    public function getUserByDate($date){
        return $this->user_dao->getByDate($date);
    }

    public function getUserByEmail($email) {
        return $this->user_dao->getByEmail($email);
    }

    public function createUser($user)
    {
        return $this->user_dao->create($user);
    }

    public function updateUser($user){
        return $this->user_dao->update($user);
    }

    public function login($username, $password) {
        return $this->user_dao->login($username, $password);
    }

    public function deleteUser($user)
    {
        $this->user_dao->delete($user);
    }
}