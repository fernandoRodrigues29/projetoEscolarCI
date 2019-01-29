<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Usuario_m extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function ListarUsuariosComImagem(){
		$this->db->select('usuarios.id,nome,email,img');
			$this->db->from('usuarios');
				$this->db->join('imagem_usuario','usuarios.id = imagem_usuario.fk_usuario','left');
					$query = $this->db->get();
						$colecao = $query->result_array();
							$this->db->close(); 
								return $colecao;
	}
	function ListarUsuariosComImagemClausula($clausula){
		$this->db->select('usuarios.id,nome,email,login,img');
			$this->db->from('usuarios');
				$this->db->join('imagem_usuario','usuarios.id = imagem_usuario.fk_usuario','left');
					$this->db->where($clausula);
					$query = $this->db->get();
						$colecao = $query->result_array();
							$this->db->close(); 
								return $colecao;
	}	

}

?>