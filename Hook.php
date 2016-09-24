<?php

abstract class Factory {
  abstract protected factoryMethod();

  public function startFactory() {
    $classe = $this->factoryMethod();
    return new $classe;
  }
}

interface hook {
  protected factoryMethod();
}

class register implements splSubject {
   public $observable = array();

   public function __construct() {

   }

   public function register() {
       // Notifica o observador antes de fazer o registro
       $this->notify('before.Register');

       // Aqui vai o código do método
       echo 'Criando conta';

       // Chama o hook depois do registro
       $this->notify('after.Register');

   }

   public function notify($hook) {
       if($hook !== null) {
        str_replace('.', '', $hook);
        foreach($this->observable[$hook]->functions as $callback) {
          $callback();          
        } 
        return true;
     }
   }
}

class newNotice {

  public $observable = array();

  public function __construct() {

  }

  public function insertNotice() {
    $this->notify('before.new.notice')
    $query = 'insert into noticias (null) values (:null)';
    $stm = $this->pdo->prepare($query);
    $stm->bindValue(':null', $null);
    $stm->execute();
    $stm->closeCursor();
    $this->notify('after.new.notice');
  }

  public function notify($hook) {
    if($hook !== null) {
      foreach($this->observable[$hook]->functions as $callback) {
        $callback();
      }
      return true;
    }
    throw new Exception('Não foi possível completar o hook');
  }
}

class afterRegister extends factory implements splObserver, hook { 
    public $functions = array();
    
    protected function factoryMethod() {
      return $this;
    }

    public function attach($name, $callback) {
        $this->functions['name'] = $name;
        $this->functions['name'][] = $callback;
    }
}