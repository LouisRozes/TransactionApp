<?php
class ServiceFile implements IServiceBase
{

private $utilities;
private $fileHandler;
private $directory;
public $fileName;


public function __construct($directory = "data")
{
    $this->utilities = new Utilities();
    $this->directory = $directory;
    $this->fileName="transaccion";
    $this->fileHandler = new JsonFileHandler($this->directory,$this->fileName);
}

public function GetList()
{
    $listTransaccionesDecode = $this->fileHandler->ReadFile();
    $listTransacciones = array();

    if($listTransaccionesDecode == false){
        $this->fileHandler->SaveFile($listTransacciones);
    }else{
        foreach($listTransaccionesDecode as $elementDecode)
        {
            $element = new Transacciones();
            $element->set($elementDecode);
            array_push($listTransacciones, $element);
        }
    }
    return $listTransacciones;
}

public function GetById($id)
{
    $listTransacciones = $this->GetList();
    $trans = $this->utilities->Filtrar($listTransacciones,'id',$id)[0];
    return $trans;
}

public function Add($agregar)
{
    $listTransacciones = $this->GetList();
    $transId = 1;

    if(!empty($listTransacciones)){
        $lastTrans = $this->utilities->GetLastElement($listTransacciones);
        $transId = $lastTrans->id + 1;
    }

    $agregar->id = $transId;
    array_push($listTransacciones, $agregar);
    $this->fileHandler->SaveFile($listTransacciones);
}

public function Edit($id, $agregar)
{
    $element = $this->GetById($id);
    $listTransacciones = $this->GetList();
    $elementIndex = $this->utilities->getIndexElement($listTransacciones,'id',$id);
    $listTransacciones[$elementIndex] = $agregar;
    $this->fileHandler->SaveFile($listTransacciones);
}

public function Delete($id)
{
    $listTransacciones =$this->GetList();
    $elementIndex = $this->utilities->GetIndexElement($listTransacciones,'id',$id);
    unset($listTransacciones[$elementIndex]);
    $listTransacciones= array_values($listTransacciones);
    $this->fileHandler->SaveFile($listTransacciones);
}

}
?>