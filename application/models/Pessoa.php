<?php
    class Pessoa extends CI_Model{
        function __construct() { 
          parent::__construct();
        }
        
        private int $id;
        private string $nome;
        private string $endereco;
        private string $contato;
//id
        public function getId(){ 
            retrun $id;
        }
        public function setId($id){
            $this->id = $id;
        }
//nome
        public function getNome(){ 
            retrun $nome;
        }
        public function setNome($nome){
            $this->nome = $nome;
        }
//endereco
        public function getEndereco(){ 
            retrun $endereco;
        }
        public function setEndereco($endereco){
            $this->endereco = $endereco;
        }
//contato
        public function getContato(){ 
            retrun $contato;
        }
        public function setContato($contato){
            $this->contato = $contato;
        }
    }
?>
