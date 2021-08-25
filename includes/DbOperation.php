<?php
 
class DbOperation
{
    
    private $con;
 
 
    function __construct()
    {
  
        require_once dirname(__FILE__) . '/DbConnect.php';
 //Vindo Arquivo da Conectividade
     
        $db = new DbConnect();
		//Colocada em Variável a Sessão do Arquivo requerido como nova Aqui
 

        $this->con = $db->connect();
		//Colocada a Variável da Função igual a do Arquivo requerido dentro do Local de Conectividade 
    }
	
	
	function createHero($name, $realname, $rating, $teamaffiliation){//Parâmetros dentro da Função
		$stmt = $this->con->prepare("INSERT INTO heroes (name, realname, rating, teamaffiliation) VALUES (?, ?, ?, ?)");//O "prepare" tem que reconhecer Valores como Viáveis.Values vão ser Inseridos por quem usa a Aplicação. Como "id" é auto_incremento sem necessidade e ocasião para citá-lo aqui
		$stmt->bind_param("ssis", $name, $realname, $rating, $teamaffiliation);//bind_paragram:Organiza dados de Acordo com seus Tipos(i(de número);s(de escritos);b(de imagens).
		if($stmt->execute())
			return true; 			
		return false;
	}
	
	function getHeroes(){
		$stmt = $this->con->prepare("SELECT id, name, realname, rating, teamaffiliation FROM heroes");
		$stmt->execute();
		$stmt->bind_result($id, $name, $realname, $rating, $teamaffiliation);
		
		$heroes = array(); 
		
		while($stmt->fetch()){
			$hero  = array();
			$hero['id'] = $id; 
			$hero['name'] = $name; 
			$hero['realname'] = $realname; 
			$hero['rating'] = $rating; 
			$hero['teamaffiliation'] = $teamaffiliation; 
			
			array_push($heroes, $hero); 
		}
		
		return $heroes; 
	}
	
	
	function updateHero($id, $name, $realname, $rating, $teamaffiliation){
		$stmt = $this->con->prepare("UPDATE heroes SET name = ?, realname = ?, rating = ?, teamaffiliation = ? WHERE id = ?");
		$stmt->bind_param("ssisi", $name, $realname, $rating, $teamaffiliation, $id);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	
	function deleteHero($id){
		$stmt = $this->con->prepare("DELETE FROM heroes WHERE id = ? ");
		$stmt->bind_param("i", $id);
		if($stmt->execute())
			return true; 
		return false; 
}}
/*Treino

$nome="Lucas";

create table Pessoas(
apelido varchar(10),
nome varchar(50),
primare key(nome));
insert into Pessoas('Lulu','Lucas');

O que aparece

Lulu Lucas

Sem ainda id Automático
	
	
	
