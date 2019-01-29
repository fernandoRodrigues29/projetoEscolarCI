<?php
/**
 * Description of Pessoa
 * @author Fernando
 */
class Pessoa {
   private $nome;
   private $endereco;
   private $contato;
   
   function __construct() { }
   
    public function getNome(){ 
       return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getEndereco(){ 
       return $this->endereco;
    }
    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function getContato(){ 
       return $this->contato;
    }
    public function setContato($contato){
        $this->contato = $contato;
    }   

}
