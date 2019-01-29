<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Auxiliar extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function selectSimples($tabela){
		$this->db->from($tabela);
		$query = $this->db->get();
		$colecao = $query->result_array();
		$this->db->close(); 
		return $colecao;
	}

	function selectCampos($tabela,$campos){
		$this->db->select($campos);
		$this->db->from($tabela);
		$query = $this->db->get();
		$colecao = $query->result_array();
		//$this->db->close(); 
		return $colecao;
	}
	
	function selectClausula($tabela,$campos,$clausulas){
		$this->db->select($campos);
		$this->db->from($tabela);
		$this->db->where($clausulas);
		$query = $this->db->get();

		$colecao = $query->result_array();
		//$this->db->close(); 
		return $colecao;
	}
	function selectClausulaLinha($tabela,$campos,$clausulas){
		$this->db->select($campos);
		$this->db->from($tabela);
		$this->db->where($clausulas);
		$query = $this->db->get();
		return $query->row();
	}

	function selectOrdem($tabela,$campos,$clausulas,$ordem){
		$this->db->select($campos);
		$this->db->from($tabela);
		$this->db->where($clausulas);
		$this->db->order_by($ordem);
		$query = $this->db->get();
		$colecao = $query->result_array();
		$this->db->close(); 
		return $colecao;
	}

	function inserir($tabela,$conteudo){
		$this->db->insert($tabela, $conteudo);
			if($this->db->affected_rows() > 0) {
			    //return true; 
			    return $this->db->insert_id();
			}else {
				return false;
			}
				$this->db->close(); 
	}

	function atualizar($tabela,$data,$where){
			$this->db->where($where);
				$this->db->update($tabela, $data);
				//echo $this->db->last_query();
					$linhasAfetadas = $this->db->affected_rows();
						if($linhasAfetadas > 0){
							return true;
						}else{
							return false;
						}
	}

	function atualizar_string($tabela,$data,$where){
		if($this->db->query("UPDATE $tabela SET $data WHERE $where")){
			echo $this->db->last_query();
				return TRUE;
			} else { 
				return FALSE;
			}
		//$this->db->close();
	}

		function excluir($tabela,$clausulas){
		$this->db->where($clausulas);
		$this->db->delete($tabela);
		//$this->db->affected_rows()
			if($this->db->affected_rows()){
				return true;	
			}else{
				return false;
			}
		$this->db->close(); 
	}


}

?>