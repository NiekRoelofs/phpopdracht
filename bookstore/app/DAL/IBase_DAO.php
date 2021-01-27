<?php

interface IBase_DAO {
    public function getAll();
    public function getById(int $id);
    public function create($obj);
    public function delete($obj);

}