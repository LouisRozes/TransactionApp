<?php
class Transacciones
{
    public $id;
    public $Monto;
    public $Descripcion; 
    public $fecha;

    private $utilities;

    public function __construct(){

        $this->utilities = New Utilities();
    }

    
    public function Data($id,$Monto,$Descripcion,$fecha){
        $this->id = $id;
        $this->Monto= $Monto;
        $this->Descripcion=$Descripcion;
        $this->fecha=$fecha;
    }

    public function set($data)
    {
        foreach($data as $key =>$value) $this->{$key} = $value;

    }


}

?>