<?php
namespace app\data;

use app\data\Entity\NewsEntity;

interface DataAccess {
	public function InsertNews(NewsEntity $News);
}