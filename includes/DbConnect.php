<?php 

	class DbConnect
	{
		
		private $con;
	 
		
		function __construct()
		{
	 
		}
	 
	
		function connect()
		{
		
			include_once dirname(__FILE__) . '/Constants.php';//inclui Diretório(local.) de Determinado Arquivo
	 
			//.==Concatenação de Valores
			
			$this->con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	 //Nesse - Variável cria-se conexão com Mysql com itens advindos do Arquivo
		
			if (mysqli_connect_errno()) {
				echo "Falha de conexão com o MySQL: " . mysqli_connect_error();//Último:Nome da Falha;Primeiro:vê a ocorrência da Falha e mostra o que há na determinada condição.
			}
	 
			 
			return $this->con;//Retorna a Conexão em uma Variável Global--Continua em Operação
		}
	 
	}