<?php
class connectBD {
   private $host; 
   private $bd; 
   private $usuario; 
   private $senha; 
   private $sql; 
 
   function conectar(){
      $conexao = mysql_connect($this->host,$this->usuario,$this->senha) or die($this->mensagem(mysql_error()));
      return $conexao;
   }
 
   function selecionarDB(){
      $banco = mysql_select_db($this->bd) or die($this->mensagem(mysql_error()));
      if($banco){
         return true;
      }else{
         return false;
      }
   }
 
   function executar(){
      $query = mysql_query($this->sql) or die ($this->mensagem(mysql_error()));
      return $query;
   }
 
   function set($propriedade,$valor){
      $this->$propriedade = $valor;
   }
 
   function mensagem($erro){
      echo $erro;
   }
}
 
?>