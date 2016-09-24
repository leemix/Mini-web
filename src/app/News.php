<?php 
namespace app;

use app\data\Entity;
use app\data\DataAccess;

class News {

    /**
    @var deve ser uma instância de DataAccess
    */
    protected $DataAccess;
    /**
    @param object $data deve implementar a interface DataAccess
    */
    
	public function __construct(DataAccess $data) {
		$this->DataAccess = $data;
	}
    
    public function getNews() {
    	try {
    		$entity = new Entity\NewsEntity();
    		return $this->DataAccess->getNews($entity);
    	} catch (Exception $e) {
    		echo $e->getMessage();
    	}
    }

	public function NewsFromInput() {
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$Newspec = array(
				'titulo' => FILTER_SANITIZE_STRING,
				'descricao' => FILTER_SANITIZE_STRING,
				'conteudo' => FILTER_SANITIZE_STRING
			);

		    $News = array_filter(filter_var_array($_News, $Newspec));

		    if(count($_POST) == count($News)) {
		    	$News = new Entity\NewsEntity();
		    	$News->setTitulo($News['titulo']);
		    	$News->setDescricao($News['descricao']);
		    	$News->setConteudo($News['conteudo']);

		    	return $this->DataAccess->InsertNews($News);
		    }
		}
	}
}	