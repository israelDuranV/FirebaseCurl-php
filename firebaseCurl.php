<?php
const URL = "https://my-app.firebaseio.com/presupuestos";
class FirebaseCurl{
  private $ch;
  function __construct(){
    $this->ch   = curl_init();
    curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
  }
  public function insertar($data){
    $json_insert = URL.".json";
    curl_setopt($this->ch,CURLOPT_URL,$json_insert);
    curl_setopt($this->ch,CURLOPT_POST,1);
    curl_setopt($this->ch,CURLOPT_POSTFIELDS,$data);
    curl_setopt($this->ch,CURLOPT_HTTPHEADER,array('Content-Type: text/plain'));
    $response = curl_exec($this->ch);
    $return = array();
    if(curl_errno($this->ch)){
      $return['error'] = "error: ".curl_errno($this->ch);
    }else{
      $return['error'] = false;
    }
    return $return;
  }
  public function consultaRetorno(){
    $json = URL.".json";
    curl_setopt($this->ch,CURLOPT_URL,$json);
    $response = curl_exec($this->ch);
    curl_close($this->ch);
    $data = json_decode($response,true);
    return $data;
  }
  public function consultaUnica($key){
    $json = URL."/".$key.".json";
    curl_setopt($this->ch,CURLOPT_URL,$json);
    $response = curl_exec($this->ch);
    curl_close($this->ch);
    $data = json_decode($response,true);
    return $data;
  }
  public function deleteOne($key){
      $json_update = URL."/".$key.".json";
      curl_setopt($this->ch, CURLOPT_URL,$url);
      curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      $result   = curl_exec($this->ch);
      $httpCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
      curl_close($this->ch);
      return $result;
   }
   public function updateOne($data,$key){
      $json_update = URL."/".$key.".json";
      curl_setopt( $this->ch, CURLOPT_URL,$json_update);
      curl_setopt( $this->ch, CURLOPT_CUSTOMREQUEST, "PATCH" );
      curl_setopt( $this->ch, CURLOPT_POSTFIELDS, $data);
      curl_setopt( $this->ch, CURLOPT_RETURNTRANSFER, true );
      $response = curl_exec( $this->ch );
      curl_close( $this->ch );
      return $response;
   }
}
/*
//INSERT
$data       = '{"concepto":"Curso de canto","subtotal":"100","ID":"10"}';
$myobj      = new FirebaseCurl();
$result     = $myobj->insertar($data);
print_r($result);
*/
//agregando comentario
/*
//UPDATE
$key = "-Ld5uVCWLAH2oxBW3Syy";
$data = '{"concepto":"Curso de ctualizado","subtotal":"300","ID":"3"}';
$myobj = new FirebaseCurl();
$result = $myobj->updateOne($data,$key);
*/
/*
//DELETE
$key = "-Ld5fpwjM8ZsyC7S5UGN";
$myobj = new FirebaseCurl();
$result = $myobj->deleteOne($key);
*/
/*
//INSERT
$data = '{"concepto":"Curso de react","subtotal":"300","ID":"3"}';
$myobj = new FirebaseCurl();
$result = $myobj->insertar($data);
print_r($result);
*/
/*
//SELECCIONAR ALL
$myobj  = new FirebaseCurl();
$resultado = $myobj->consultaRetorno();
print_r($resultado);
*/
/*
//SELECCIONAR UNO
$key = "-Ld5uVCWLAH2oxBW3Syy";
$myobj  = new FirebaseCurl();
$result = $myobj->consultaUnica($key);
*/
?>
