<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Aluno_m extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function ListarAlunosComImagem(){
		$this->db->select('aluno.id,nome,email,img');
			$this->db->from('aluno');
				$this->db->join('imagem_usuario','aluno.id = imagem_usuario.fk_usuario','left');
					$query = $this->db->get();
						$colecao = $query->result_array();
							$this->db->close(); 
								return $colecao;
	}
	function ListarAlunosComImagemClausula($clausula){
		$this->db->select('aluno.id,nome,email,login,img');
			$this->db->from('aluno');
				$this->db->join('imagem_usuario','aluno.id = imagem_usuario.fk_usuario','left');
					$this->db->where($clausula);
					$query = $this->db->get();
						$colecao = $query->result_array();
							$this->db->close(); 
								return $colecao;
	}	

}

?>