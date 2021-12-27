<?php
class ServiceCookie implements IServiceBase{

private $utilities;
private $cookieName;

public function __construct()
{
    $this->utilities = new Utilities();
    $this->cookieName ="transaccion";
}

public function GetList()
{
    $listTransacciones = array();
    if(isset($_COOKIE[$this->cookieName])){
        $listTransaccionesDecode =json_decode($_COOKIE[$this->cookieName],false);
        foreach($listTransaccionesDecode as $elementDecode)
        {
            $element = new Transacciones();
            $element->set($elementDecode);
            array_push($listTransacciones, $element);
        }
    }else{
        setcookie($this->cookieName,json_encode($listTransacciones),$this->utilities->GetCookieTime(),"/");
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
    $listTransacciones =$this->GetList();
    $transId =1;

    if(!empty($listTransacciones)){
        $lastTrans = $this->utilities->GetLastElement($listTransacciones);
        $transId = $lastTrans->id + 1;
    }

    $agregar->id = $transId;
    array_push($listTransacciones,$agregar);
    setcookie($this->cookieName,json_encode($listTransacciones),$this->utilities->GetCookieTime(),"/");
}

public function Edit($id,$agregar)
{
    $element = $this->GetById($id);
    $listTransacciones = $this->GetList();
    $elementIndex = $this->utilities->getIndexElement($listTransacciones,'id',$id);
    $listTransacciones[$elementIndex] = $agregar;
    setcookie($this->cookieName,json_encode($listTransacciones),$this->utilities->GetCookieTime(),"/");
}

public function Delete($id)
{
    $listTransacciones =$this->GetList();
    $elementIndex = $this->utilities->GetIndexElement($listTransacciones,'id',$id);
    unset($listTransacciones[$elementIndex]);
    $listTransacciones = array_values($listTransacciones);
    setcookie($this->cookieName,json_encode($listTransacciones),$this->utilities->GetCookieTime(),"/");
}

}

?>