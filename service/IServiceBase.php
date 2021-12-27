<?php
   interface IServiceBase{
       public function GetByID($id);
       public function GetList();
       public function Add($agregar);
       public function Update($id, $agregar);
       public function Delete($id);
   }
?>