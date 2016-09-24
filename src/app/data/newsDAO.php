<?php
namespace app\data;

use \PDO;
use app\data\Entity;


class NewsDAO implements DataAccess {
	private $PDO;

	public function __construct(PDO $pdo) {
		$this->pdo = $pdo;
	}

	public function getNews() {

		$stm = $this->pdo->prepare(
			'SELECT titulo,
			        descricao,
			        conteudo 
			 FROM   News
		');


		if($stm->execute()) {

		    while($News = $stm->fetch(PDO::FETCH_ASSOC)) {
		    	$result[] = $News;
		    }
            
			$stm->closeCursor();

			return $result;
		}

		throw new Exception('Fail to retrieve some data');		
	}

	public function InsertNews(Entity\NewsEntity $News) {
		$stm = $this->pdo->prepare(
			'INSERT INTO News(
			  titulo, 
			  descricao, 
			  conteudo
			) VALUES (
			  :titulo, 
			  :descricao, 
			  :conteudo
			);'
		);

		$stm->bindValue(':titulo', $News->getTitulo());
		$stm->bindValue(':descricao', $News->getDescricao());
		$stm->bindValue(':conteudo', $News->getConteudo());

		if($stm->execute()) {
			return (int) $this->pdo->lastInsertId();
		}

		throw new Exception('Fail to insert some data');
	}
}