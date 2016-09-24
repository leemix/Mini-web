<?php
namespace app\data\Entity;

class NewsEntity {

	public $titulo;
	public $descricao;
	public $conteudo;

    public function setTitulo($titulo) {
    	if(is_string($titulo)) {
    		$this->titulo = $titulo;

    		return $this;
    	}

    	throw new Exception('The argument passed is not a valid data');
    }

    public function getTitulo() {
    	return $this->titulo;
    }

    public function setDescricao($descricao) {
    	if(is_string($descricao)) {
    		$this->descricao = $descricao;

    		return $this;
    	}

    	throw new Exception('Fail to insert some data');
    }

    public function getDescricao() {
    	return $thi->descricao;
    }


    public function setConteudo($conteudo) {
    	if(is_string($conteudo)) {
    		$this->conteudo = $conteudo;

    		return $this;
    	}

    	throw new Exception('Fail to insert some data');
    }

    public function getConteudo() {
    	return $this->conteudo;
    }
}