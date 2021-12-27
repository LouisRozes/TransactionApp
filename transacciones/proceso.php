<?php
   class Proceso{
       public $id;
       public $Monto;
       public $Descripcion;
       public $Fecha;

       private $utilities;
      
       public function __construct(){
           $this->utilities = new Utilities();
       }

       public function Data($id,$monto,$descripcion,$fecha){
           $this->id = $id;
           $this->Monto = $monto;
           $this->Descripcion = $descripcion;
           $this->Fecha = $fecha;
       }

       public function Set($data){
           foreach($data as $key=>$value) $this->{$key} = $value;
       }
   }
?>