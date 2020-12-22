
<?php

require_once('../pooling.php');

//--------------- LOGIN E ALTERAÇÃO DE SENHA -----------------------------//

if ($_GET['acao'] == 'login') {

	if(empty($_POST['login']) || empty($_POST['senha'])){	header("location: index.php?acao=vazio");	}

	else{
	
		$login = mysqli_real_escape_string($dbm, $_POST['login']);
		$senha = mysqli_real_escape_string($dbm, $_POST['senha']);

		$query = mysqli_query($dbm, "SELECT * FROM login_adm WHERE admlogin = '$login' && admsenha = '$senha' LIMIT 1");
    	$resultado = mysqli_fetch_array($query);

		// conferir se existe retorno quanto a query pesquisada
    	if($resultado != null){	
			session_start();
			$_SESSION['id'] = $resultado['id_admin'];
			header("location: painel.php");	
		}
    	
    	else{	header("location: index.php?acao=erro");	}
	}
}

else if($_GET['acao'] == 'alterarsenha'){
	
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	$nova_senha = $_POST['nova_senha'];
	$conf_senha = $_POST['conf_senha'];

	if ((empty($login)) || (empty($senha)) || (empty($nova_senha)) || (empty($conf_senha))) {
		header("location: index.php?acao=cad_vazio");
	}
	else if ($nova_senha != $conf_senha) {
		header("location: index.php?acao=erro");
	}
	else{
		$trytrans=TRUE;

	    while ($trytrans){

	    	mysqli_query($dbm,"START TRANSACTION");
			mysqli_query($dbm,"UPDATE login_adm SET admsenha = '$nova_senha' WHERE admsenha = '$senha';");
		  	
	      	if (mysqli_errno($dbm)==0){ 
				mysqli_query($dbm,"COMMIT");
				$trytrans = FALSE;
				header("location: index.php?acao=alterado");
			} 
	      	else{   
	      		$trytrans=FALSE;
	          	$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
	        	mysqli_query($dbm,"ROLLBACK");
	      	}
	    }
	}
}

else if($_GET['acao'] == 'encerrar'){
	session_destroy();
	header("location: index.php");
}

// ------------- CADASTRO, EXCLUSÃO E CONSULTA DE VAGAS ----------------------------//

else if($_GET['acao'] == 'cadcat'){

	$nome = $_POST['cat_nome'];
	$preco = $_POST['cat_preco'];
	
	if ((empty($nome)) || (empty($preco))) {
		header("location: painel.php?acao=vazio");
	}

	else{
		$trytrans=TRUE;
		while ($trytrans){

	    	mysqli_query($dbm,"START TRANSACTION");

		  	mysqli_query($dbm,"INSERT INTO categoria (nome,preco) VALUES ('$nome','$preco')");

	      	if ( mysqli_errno($dbm)==0){ 
				mysqli_query($dbm,"COMMIT");
				$trytrans=FALSE;
				header("location: painel.php?acao=sucesso");
			}
			  
	      	else{
				# Erro irrecuperavel. Parar de tentar a transação
				$trytrans=FALSE;
				$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
	        	# A transação deve ser ABORTADA
	        	mysqli_query($dbm,"ROLLBACK");
	      	}
	    }
	}
}

else if($_GET['acao'] == 'excluircat'){

	$nome = $_POST['campo_cat'];
	
	if (empty($nome)) {
		header("location: painel.php?acao=vazio");
	}

	else{
		$trytrans=TRUE;
		while ($trytrans){

	    	mysqli_query($dbm,"START TRANSACTION");

			$query = mysqli_query($dbm,"SELECT idcategoria FROM categoria WHERE nome = '$nome' LIMIT 1");
			$resultado = $query->fetch_array();

			$idcategoria = $resultado['idcategoria'];

			if(isset($idcategoria)){
				mysqli_query($dbm,"DELETE FROM vagas WHERE idcategoria = '$idcategoria'");
				mysqli_query($dbm,"DELETE FROM categoria WHERE idcategoria = '$idcategoria' LIMIT 1");	

				if ( mysqli_errno($dbm)==0){ 
					mysqli_query($dbm,"COMMIT");
					$trytrans=FALSE;
					header("location: painel.php?acao=exclus_sucesso");
				}
				  
				else{
				# Erro irrecuperavel. Parar de tentar a transação
				$trytrans=FALSE;
				$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
				
				# A transação deve ser ABORTADA
				mysqli_query($dbm,"ROLLBACK");
				header("location: painel.php?acao=erro");
				}
			}
			else{
				$trytrans=FALSE;
				header("location: painel.php?acao=erro");
			}
	    }
	}
}

else if($_GET['acao'] == 'cadastrarvaga'){

	$id = $_POST['vaga_id'];
	$cat = $_POST['vaga_cat'];
	
	if ((empty($id)) || (empty($cat))) {
		header("location: painel.php?acao=vazio");
	}

	else{
		$trytrans=TRUE;
		while ($trytrans){

	    	mysqli_query($dbm,"START TRANSACTION");
			  
			$query = mysqli_query($dbm,"SELECT * FROM categoria WHERE nome = '$cat' LIMIT 1");
			$resultado = $query->fetch_array(); 
			$idcategoria = $resultado['idcategoria'];
			
			if($idcategoria == null){
				$trytrans=FALSE;
				mysqli_query($dbm,"ROLLBACK");
				header("location: painel.php?acao=erro_cat");
			}

			else{
				mysqli_query($dbm,"INSERT INTO vagas (idvagas, idcategoria) VALUES ('$id','$idcategoria')");

				if ( mysqli_errno($dbm)==0){ 
					mysqli_query($dbm,"COMMIT");
					$trytrans=FALSE;
					header("location: painel.php?acao=sucesso");
				}
				else{
					$trytrans=FALSE;
					$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
					# A transação deve ser ABORTADA
					mysqli_query($dbm,"ROLLBACK");
				}
			}
	    }
	}
}

else if($_GET['acao'] == 'excluirvaga'){

	$id = $_POST['vaga_excluir'];
	if (empty($id)) { header("location: painel.php?acao=vazio"); }

	else{
		$trytrans=TRUE;
		while ($trytrans){

	    	mysqli_query($dbm,"START TRANSACTION");
		  	mysqli_query($dbm,"DELETE FROM vagas WHERE idvagas = '$id' LIMIT 1");

	      	if ( mysqli_errno($dbm)==0){ 
	        
	        	mysqli_query($dbm,"COMMIT");
	        	$trytrans=FALSE;
				header("location: painel.php?acao=exclus_sucesso");
	      	}
	      	else{ 
	          	$trytrans=FALSE;
	          	$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
	        
	        	# A transação deve ser ABORTADA
				mysqli_query($dbm,"ROLLBACK");
				header("location: painel.php?acao=erro");
	      	}
		}
	}
}

else if($_GET['acao'] == 'consultarvagas'){

	$idvaga = $_POST['idvaga'];
	if ((empty($idvaga))) { header("location: painel.php?acao=vazio"); }

	else{
		$trytrans=TRUE;
		while ($trytrans){

	    	mysqli_query($dbm,"START TRANSACTION");
			  
			$query=mysqli_query($dbm,"SELECT * FROM vagas WHERE idvagas = '$idvaga' LIMIT 1");
			$resultado = mysqli_fetch_array($query);
			$idcat = $resultado['idcategoria'];

			$query=mysqli_query($dbm,"SELECT * FROM categoria WHERE idcategoria = '$idcat' LIMIT 1");
			$resultado = mysqli_fetch_array($query);
			$nome_cat = $resultado['nome'];
			$preco_cat = $resultado['preco'];
			
			session_start();
			$_SESSION['cod_vaga'] = $idvaga;
			$_SESSION['nome_cat'] = $nome_cat;
			$_SESSION['preco_cat'] = $preco_cat;

			if ( mysqli_errno($dbm)==0){ 
				mysqli_query($dbm,"COMMIT");
				$trytrans=FALSE;
				header("location: resultado.php?resul=vaga");
			}
			else{
				$trytrans=FALSE;
				$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
				# A transação deve ser ABORTADA
				mysqli_query($dbm,"ROLLBACK");
			}
		}
	}
}

// ------------- CADASTRO, EXCLUSÃO E CONSULTA DE VEICULOS ----------------------------//

else if($_GET['acao'] == 'consultarveic'){

	$placa = $_POST['placa'];
	if (empty($placa)) { header("location: painel.php?acao=vazio"); }

	else{
		$trytrans=TRUE;
		while ($trytrans){

	    	mysqli_query($dbm,"START TRANSACTION");
			  
			$query=mysqli_query($dbm,"SELECT * FROM veiculo WHERE placa = '$placa' LIMIT 1");
			$resultado = mysqli_fetch_array($query);

			$idcategoria = $resultado['idcategoria'];

			$query2=mysqli_query($dbm,"SELECT * FROM categoria WHERE idcategoria = '$idcategoria' LIMIT 1");
			$resultado2 = mysqli_fetch_array($query2);



			
			session_start();
			$_SESSION['idveiculo'] = $resultado['idveiculo'];
			$_SESSION['placa'] = $resultado['placa'];
			$_SESSION['modelo'] = $resultado['modelo'];
			$_SESSION['cor'] = $resultado['cor'];
			$_SESSION['ano'] = $resultado['ano'];
			$_SESSION['dono'] = $resultado['dono'];
			$_SESSION['cat'] = $resultado2['nome'];
			

			if ( mysqli_errno($dbm)==0){ 
				mysqli_query($dbm,"COMMIT");
				$trytrans=FALSE;
				header("location: resultado.php?resul=veic");
			}
			else{
				$trytrans=FALSE;
				$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
				# A transação deve ser ABORTADA
				mysqli_query($dbm,"ROLLBACK");
			}
		}		
	}
}

else if($_GET['acao'] == 'editarveic'){

	$idveiculo = $_POST['campo1'];
	$modelo = $_POST['campo3'];
	$cor = $_POST['campo4'];
	$dono = $_POST['campo7'];
	
	if ( (empty($modelo)) || (empty($cor)) || (empty($dono)) ) {
		header("location: veiculos.php?acao=vazio");
	}

	else{

		$trytrans=TRUE;
	
		while ($trytrans){

	    	# Iniciando a transação (O SGBD é avisado para iniciar os logs de transação)
			mysqli_query($dbm,"START TRANSACTION");
			
	      	$cmdsql="UPDATE veiculo	SET modelo = '$modelo', cor = '$cor', dono = '$dono' WHERE idveiculo = '$idveiculo'";
											
			$execsql=mysqli_query($dbm,$cmdsql);
			
	      	if ( mysqli_errno($dbm)==0){ 
				mysqli_query($dbm,"COMMIT");
				header("location: painel.php?acao=sucesso");
				$trytrans=FALSE;
	      	}
	      	else{ 
	          	$trytrans=FALSE;
	          	echo $mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
	        	# A transação deve ser ABORTADA
	        	mysqli_query($dbm,"ROLLBACK");
			}
		}
	}
}

// ------------------------------- RESERVAS -------------------------------------------//

else if($_GET['acao'] == 'efetuarreserva'){

	$data = $_POST['res_data'];
	$hora_inicio = $_POST['res_horainicio'];
	$qtdhoras = $_POST['qtdhoras'];
	$placa = $_POST['res_veic'];

	if ((empty($data)) || (empty($hora_inicio)) || (empty($qtdhoras)) || (empty($placa))) {
		header("location: painel.php?acao=vazio");
	}	
	else{
		$hrs = explode(':',$hora_inicio);

		$hora_inicio = $hora_inicio.":00";
		$hora_fim = ($hrs[0] += $qtdhoras).':'.$hrs[1].':00';

		echo $data."<br>".$hora_inicio."<br>".$hora_fim."<br>";

		$trytrans=TRUE;
		while ($trytrans){
			mysqli_query($dbm,"START TRANSACTION");

			$query = mysqli_query($dbm,"SELECT idveiculo, idcategoria FROM veiculo WHERE placa = '$placa'");
			$resultado = mysqli_fetch_array($query);

			$idveiculo = $resultado['idveiculo'];
			$idcat = $resultado['idcategoria'];

			$cod = "SELECT * FROM reserva WHERE datares = '$data' AND idveiculo = '$idveiculo' AND
						((inicio >= '$hora_inicio' && inicio < '$hora_fim' && fim >= '$hora_fim') OR
						(inicio >= '$hora_inicio' && fim <= '$hora_fim') OR
						(inicio <= '$hora_inicio' && fim >= '$hora_fim') OR
						(inicio <= '$hora_inicio' && fim > '$hora_inicio' && fim <= '$hora_fim')) LIMIT 1";

			$verifveic = mysqli_query($dbm,$cod);
			$resul = mysqli_fetch_array($verifveic);

			echo $resul['idreserva'];

			if($resul != null){
				$trytrans=FALSE;
				header("location: painel.php?acao=veicjareserva");
			break;
			}
			
			if($resultado != null){
	
				$cod = "SELECT idvagas FROM reserva WHERE datares = '$data' AND
						((inicio >= '$hora_inicio' && inicio < '$hora_fim' && fim >= '$hora_fim') OR
						(inicio >= '$hora_inicio' && fim <= '$hora_fim') OR
						(inicio <= '$hora_inicio' && fim >= '$hora_fim') OR
						(inicio <= '$hora_inicio' && fim > '$hora_inicio' && fim <= '$hora_fim'))";

				$query = mysqli_query($dbm,$cod);

				$i = 0;
				$menosvaga = null;
				while ($row = mysqli_fetch_array($query, MYSQLI_NUM)) {
					printf("IDVAGA: %s <br>", $row[0]);
					if($i == 0){
						$menosvaga = "'".$row[0]."'";
					}
					else{
						$menosvaga = $menosvaga.", '".$row[0]."'";
					}
					$i = 1;
				}
				echo $menosvaga."<br>";

				if(isset($menosvaga)){
					echo "Varios Param <br>";
					$cod = sprintf("SELECT idvagas FROM vagas WHERE idcategoria = '$idcat' AND idvagas NOT IN ($menosvaga) LIMIT 1");
					//echo $cod;"<br>";
					$query = mysqli_query($dbm, $cod);	
					$resultado = mysqli_fetch_array($query);
					$idvaga = $resultado[0];

					echo $idvaga."<br>";
				}
				else{
					$query = mysqli_query($dbm,"SELECT idvagas FROM vagas WHERE idcategoria = '$idcat' LIMIT 1");
					$resultado = mysqli_fetch_array($query);
					$idvaga = $resultado[0];
					echo $idvaga."<br>";
				}
				
				if(isset($idvaga)){
					$cod = "INSERT INTO reserva (datares, inicio, fim, idveiculo, idvagas) VALUES ('$data', '$hora_inicio', '$hora_fim', '$idveiculo', '$idvaga')";
					mysqli_query($dbm, $cod);
				}
				else if(empty($idvaga)){
					$trytrans=FALSE;
					header("location: painel.php?acao=semvag");
				break;
				}
				
			}
			if ( mysqli_errno($dbm)==0){ 
				mysqli_query($dbm,"COMMIT");
				$trytrans=FALSE;
				header("location: painel.php?acao=sucesso");
				//echo "<br> finalizou com sucesso";
			}
			else{
				$trytrans=FALSE;
				$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
				# A transação deve ser ABORTADA
				mysqli_query($dbm,"ROLLBACK");
				//echo "<br> finalizou com erro";
				header("location: painel.php?acao=errores");
			}
		}
	}
}

else if($_GET['acao'] == 'consres'){

	$placa = $_POST['res_veic'];
	$res_data = $_POST['res_data'];
	
	if ((empty($placa)) || (empty($res_data))) { header("location: painel.php?acao=vazio"); }

	else{
		$trytrans=TRUE;
		
		$_SESSION['resulreserv'] = array();
		session_start();

		while ($trytrans){
	    	mysqli_query($dbm,"START TRANSACTION");
			
			$query=mysqli_query($dbm,"SELECT idveiculo FROM veiculo WHERE placa = '$placa' LIMIT 1");
			$resultado = mysqli_fetch_array($query);
			$idveiculo = $resultado['idveiculo'];

			$query=mysqli_query($dbm,"SELECT * FROM reserva WHERE datares = '$res_data' AND idveiculo = '$idveiculo'");
			
			$i = 0;
			while ($row = mysqli_fetch_array($query)){
				$result = "$row[0], $row[1], $row[2], $row[3], $row[4], $row[5]";
				
				if($i == 0){
					$_SESSION['resulreserv'] = $result.';';
				}
				else{
					$_SESSION['resulreserv'] .= $result.';';
				}
				$i = 1;
			}

			mysqli_free_result($query);
			
	      	if ( mysqli_errno($dbm)==0){ 
	        
	        	mysqli_query($dbm,"COMMIT");
				$trytrans=FALSE;
				header("location: resultado.php?resul=consres");
	      	}
	      	else{ 
	
	          	$trytrans=FALSE;
				$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
				echo $mens;
	
	        	# A transação deve ser ABORTADA
				mysqli_query($dbm,"ROLLBACK");
				header("location: painel.php?acao=erro");
			}
		}
	}
}

else if($_GET['acao'] == 'excluires'){

	$idres = $_POST['idres'];
	if (empty($idres)) { header("location: painel.php?acao=vazio"); }

	else{
		$trytrans=TRUE;
		while ($trytrans){

			mysqli_query($dbm,"START TRANSACTION");
			
			mysqli_query($dbm,"DELETE FROM reserva WHERE idreserva = '$idres' LIMIT 1");

	      	if ( mysqli_errno($dbm)==0){ 
	        
	        	mysqli_query($dbm,"COMMIT");
				$trytrans=FALSE;
				
				header("location: painel.php?acao=exclus_sucesso");
	      	}
	      	else{ 
				# Erro irrecuperavel. Parar de tentar a transação
				$trytrans=FALSE;
				$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
				echo $mens;
				# A transação deve ser ABORTADA
				mysqli_query($dbm,"ROLLBACK");
				header("location: veiculos.php?acao=erro");
			}
		}
	}
}

else if($_GET['acao'] == 'fatura'){

	$cpf = $_POST['cpf'];
	
	if (empty($cpf)) { header("location: painel.php?acao=vazio"); }

	else{

		$trytrans=TRUE;
		
		$_SESSION['strfinal'] = array();
		session_start();

		while ($trytrans){

			$idveiculos = 0;
			$idcategorias = 0;
			$cont = 0;

	    	mysqli_query($dbm,"START TRANSACTION");
			
			$query=mysqli_query($dbm,"SELECT idveiculo, idcategoria, placa FROM veiculo WHERE dono = '$cpf'");
			
			while ($row = mysqli_fetch_array($query)){
				
				$totalhoras = 0;	
				$novo_veiculos = "$row[0]";
				$novo_categorias = "$row[1]";
				$novo_placa = "$row[2]";
				
				$valor_cat=mysqli_query($dbm,"SELECT preco, nome FROM categoria WHERE idcategoria = '$novo_categorias'");
				$resultado = mysqli_fetch_array($valor_cat);
				
				$novo_valor = $resultado['preco'];
				$novo_categorias = $resultado['nome'];

				$valor_cat=mysqli_query($dbm,"SELECT inicio, fim FROM reserva WHERE idveiculo = '$novo_veiculos'");

				while ($row = mysqli_fetch_array($valor_cat)){
					echo $row[0]." ------ ".$row[1]."<br>";

					$hora_inicio = explode(':', $row[0]);
					$hora_fim = explode(':', $row[1]);
					
					$horas = $hora_fim[0] - $hora_inicio[0];
					
					echo "Horas Inicio e Fim: ".$hora_inicio[0]." ---------- ".$hora_fim[0]."<br>";	
					
					$totalhoras += $horas;
					echo $totalhoras."<br><br>";
				}
				echo "Valor: ".$novo_valor."<br>";
				$valor_total = ($totalhoras * $novo_valor);

				$strperveic = $novo_veiculos.", ".$novo_categorias.", ".$novo_placa.", ".$totalhoras.", ".$valor_total;


				if($cont == 0){
					$_SESSION['strfinal'] = $strperveic.';';
				}
				else{
					$_SESSION['strfinal'] .= $strperveic.';';
				}
				$cont = 1;

				echo $strperveic.'<br>';
				echo $_SESSION['strfinal']."<br><hr><br>";
				
			}

			if ( mysqli_errno($dbm)==0){ 
				
				mysqli_query($dbm,"COMMIT");
				$trytrans=FALSE;
				header("location: resultado.php?resul=fatura");
				
			}
			else{
				$trytrans=FALSE;
				$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
				# A transação deve ser ABORTADA
				mysqli_query($dbm,"ROLLBACK");
				header("location: painel.php?acao=erro");
			}
		}		
	}
}

// ------------------------------- RELATÓRIOS -------------------------------------------//

else if($_GET['acao'] == 'relcli'){

	mysqli_query($dbm,"START TRANSACTION");	
	session_start();
	$i = 0;

	$query=mysqli_query($dbm,"SELECT * FROM usuarios");
	
	while ($row = mysqli_fetch_array($query)){
		$result = "$row[0], $row[1], $row[2], $row[4], $row[5], $row[6], $row[7], $row[8]";
		
		if($i == 0){
			$_SESSION['rel'] = $result.';';
		}
		else{
			$_SESSION['rel'] .= $result.';';
		}
		$i = 1;
	}
	echo $_SESSION['rel'];

	if ( mysqli_errno($dbm)==0){ 
	        
		mysqli_query($dbm,"COMMIT");
		header("location: resultado.php?resul=relcli");
	  }
	  else{ 

		$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
		echo $mens;

		# A transação deve ser ABORTADA
		mysqli_query($dbm,"ROLLBACK");
		header("location: painel.php?acao=erro");
	}
}

else if($_GET['acao'] == 'relveic'){

	mysqli_query($dbm,"START TRANSACTION");
	session_start();
	$i = 0;

	$query=mysqli_query($dbm,"SELECT * from veiculo INNER JOIN categoria on veiculo.idcategoria = categoria.idcategoria");
	
	while ($row = mysqli_fetch_array($query)){
		$result = "$row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9]";
		
		if($i == 0){
			$_SESSION['rel'] = $result.';';
		}
		else{
			$_SESSION['rel'] .= $result.';';
		}
		$i = 1;
	}
	echo $_SESSION['rel'];

	if ( mysqli_errno($dbm)==0){ 
	        
		mysqli_query($dbm,"COMMIT");
		header("location: resultado.php?resul=relveic");
	  }
	  else{ 

		$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
		echo $mens;

		# A transação deve ser ABORTADA
		mysqli_query($dbm,"ROLLBACK");
		header("location: painel.php?acao=erro");
	}
}

else if($_GET['acao'] == 'relres'){

	mysqli_query($dbm,"START TRANSACTION");
	session_start();
	$i = 0;

	$query=mysqli_query($dbm,"SELECT * from reserva INNER JOIN veiculo on reserva.idveiculo = veiculo.idveiculo");
	
	while ($row = mysqli_fetch_array($query)){
		$result = "$row[1], $row[2], $row[3], $row[5], $row[7], $row[11]";
		
		if($i == 0){
			$_SESSION['rel'] = $result.';';
		}
		else{
			$_SESSION['rel'] .= $result.';';
		}
		$i = 1;
	}
	echo $_SESSION['rel'];

	if ( mysqli_errno($dbm)==0){ 
	        
		mysqli_query($dbm,"COMMIT");
		header("location: resultado.php?resul=relres");
	  }
	  else{ 

		$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
		echo $mens;

		# A transação deve ser ABORTADA
		mysqli_query($dbm,"ROLLBACK");
		header("location: painel.php?acao=erro");
	}
}

else if($_GET['acao'] == 'relvag'){

	mysqli_query($dbm,"START TRANSACTION");
	session_start();
	$i = 0;

	$query=mysqli_query($dbm,"SELECT * from vagas INNER JOIN categoria on vagas.idcategoria = vagas.idcategoria");
	
	while ($row = mysqli_fetch_array($query)){
		$result = "$row[0], $row[1], $row[2], $row[3], $row[4]";
		
		if($i == 0){
			$_SESSION['rel'] = $result.';';
		}
		else{
			$_SESSION['rel'] .= $result.';';
		}
		$i = 1;
	}
	echo $_SESSION['rel'];

	if ( mysqli_errno($dbm)==0){ 
	        
		mysqli_query($dbm,"COMMIT");
		header("location: resultado.php?resul=relvag");
	  }
	  else{ 

		$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
		echo $mens;

		# A transação deve ser ABORTADA
		mysqli_query($dbm,"ROLLBACK");
		header("location: painel.php?acao=erro");
	}
}

?>