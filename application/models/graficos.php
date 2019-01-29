<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Graficos extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function ListarAlunosDisciplina(){
		$this->db->select('aluno.id,nome,d.titulo');
			$this->db->from('aluno');
				$this->db->join('aluno_disciplina as ad','aluno.id = ad.fk_aluno','left');
				$this->db->join('disciplina as d','d.id = ad.fk_disciplina','left');
					$query = $this->db->get();
						$colecao = $query->result_array();
							echo $this->db->last_query();
							exit;
							//$this->db->close(); 
								return $colecao;
	}
	function ListarProfessoresTurmas(){
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