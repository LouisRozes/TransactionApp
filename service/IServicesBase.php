<?php

interface IServiceBase{
    public function GetById($id);
    public function GetList();
    public function Add($agregar);
    public function Edit($id, $agregar);
    public function Delete($id);
}
?>