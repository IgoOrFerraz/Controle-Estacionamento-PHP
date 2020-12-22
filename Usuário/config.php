
<?php

require_once('../pooling.php');

//--------------- LOGIN, CADASTRO E EDIÇÃO DE CADASTRO -----------------------------//

if ($_GET['acao'] == 'login') {

	if(empty($_POST['log_cpf']) || empty($_POST['log_senha'])){
		header("location: index.php?acao=vazio");	
	}
	else{
		// aceitar apenas campos do type String nos parametros de Login e Senha
		$log_cpf = mysqli_real_escape_string($dbm, $_POST['log_cpf']);
		$log_senha = mysqli_real_escape_string($dbm, $_POST['log_senha']);

		// realiza a query e retorna o array com o resultado
		$query = mysqli_query($dbm, "SELECT * FROM usuarios WHERE cpf = '$log_cpf' && senha = '$log_senha' LIMIT 1");
    	$resultado = mysqli_fetch_array($query);

		// conferir se existe retorno quanto a query pesquisada
    	if($resultado != null){
			
			session_start();	
			$_SESSION['cpf'] = $resultado['cpf'];
			$_SESSION['usuario'] = $resultado['usuario'];
			$_SESSION['email'] = $resultado['email'];
			$_SESSION['senha'] = $resultado['senha'];
			$_SESSION['data_nasc'] = $resultado['data_nasc'];
			$_SESSION['telefone'] = $resultado['telefone'];
			$_SESSION['endereco'] = $resultado['endereco'];
			$_SESSION['bairro'] = $resultado['bairro'];
			$_SESSION['cidade'] = $resultado['cidade'];
			
			header("location: painel.php");
		}
    	
    	else{
			header("location: index.php?acao=erro");		
		}
	}
}

else if($_GET['acao'] == 'cadastrar'){
	
	$cad_cpf = $_POST['cad_cpf'];
	$cad_usuario = $_POST['cad_usuario'];
	$cad_nasc = $_POST['cad_nasc'];
	$cad_senha = $_POST['cad_senha'];
	$cad_conf_senha = $_POST['cad_conf_senha'];
	$cad_email = $_POST['cad_email'];
	
	
	if ((empty($cad_email)) || (empty($cad_usuario)) || (empty($cad_cpf)) || (empty($cad_senha)) || (empty($cad_conf_senha)) || (empty($cad_nasc))) {
		header("location: index.php?acao=cad_vazio");
	}
	
	else if ($cad_senha != $cad_conf_senha) {
		header("location: index.php?acao=cad_sen_dif");
	}

	else{
		$trytrans=TRUE;

	    while ($trytrans){

	    	mysqli_query($dbm,"START TRANSACTION");
	      	
	      	$cmdsql="INSERT INTO usuarios (cpf,
	                                    usuario,
										email,
										senha,
										data_nasc)
	                      VALUES ('$cad_cpf',
	                              '$cad_usuario', 
	                              '$cad_email',
	                              '$cad_senha',
								  '$cad_nasc')";
	        		
			mysqli_query($dbm,$cmdsql);
		  	
	      	if ( mysqli_errno($dbm)==0){ 
	        	mysqli_query($dbm,"COMMIT");
				header("location: index.php?acao=cadastrorealizado");
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

else if($_GET['acao'] == 'editarcad'){
	
	$edit_cpf = $_POST['edit_cpf'];
	$edit_usuario = $_POST['edit_usuario'];
	$edit_email = $_POST['edit_email'];
	$edit_senha = $_POST['edit_senha'];
	$edit_nasc = $_POST['edit_nasc'];

	$edit_fone = $_POST['edit_fone'];
	$edit_end = $_POST['edit_end'];
	$edit_bairro = $_POST['edit_bairro'];
	$edit_cidade = $_POST['edit_cidade'];
	
	# verificar se algum dos campos está vazio
	if ((empty($edit_email)) || (empty($edit_usuario)) || (empty($edit_cpf)) || (empty($edit_senha)) || (empty($edit_nasc))) {
		header("location: painel.php?acao=erro");
	}

	else{
		$trytrans=TRUE;
		while ($trytrans){

	    	mysqli_query($dbm,"START TRANSACTION");
			  
			$cmdsql="	UPDATE usuarios
						SET usuario = '$edit_usuario',
							email = '$edit_email',
							senha = '$edit_senha',
							telefone = '$edit_fone',
							endereco = '$edit_end',
							bairro = '$edit_bairro',
							cidade = '$edit_cidade'

						WHERE cpf = '$edit_cpf';		
					";
			$query=mysqli_query($dbm,$cmdsql);
			
			if (mysqli_errno($dbm)==0){
			  mysqli_query($dbm,"COMMIT");
			  $trytrans=FALSE;
			  header("location: index.php?acao=editsucesso");
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

else if($_GET['acao'] == 'encerrar'){
	session_destroy();
	header("location: index.php");
}

// ------------- CADASTRO, EXCLUSÃO E CONSULTA DE VEICULOS ----------------------------//

else if($_GET['acao'] == 'consultarveic'){

	$cad_placa = $_POST['cad_placa'];
	$dono = $_POST['cria_veic'];

	if ((empty($cad_placa)) || (empty($dono))) { header("location: veiculos.php?acao=vazio"); }

	else{
		$trytrans=TRUE;
		while ($trytrans){

	    	mysqli_query($dbm,"START TRANSACTION");
			  
			$query=mysqli_query($dbm,"SELECT * FROM veiculo WHERE placa = '$cad_placa' AND dono = '$dono' LIMIT 1");
			$resultado = mysqli_fetch_array($query);
			
			$idcategoria = $resultado['idcategoria'];

			$query=mysqli_query($dbm,"SELECT * FROM categoria WHERE idcategoria = $idcategoria LIMIT 1");
			$resultado_cat = mysqli_fetch_array($query);

			
			
			mysqli_query($dbm,"ROLLBACK");

			session_start();
			$_SESSION['idveiculo'] = $resultado['idveiculo'];
			$_SESSION['placa'] = $resultado['placa'];
			$_SESSION['modelo'] = $resultado['modelo'];
			$_SESSION['cor'] = $resultado['cor'];
			$_SESSION['cat'] = $resultado_cat['nome'];
			$_SESSION['ano'] = $resultado['ano'];
			$_SESSION['dono'] = $resultado['dono'];

			$trytrans = FALSE;
		}

		header("location: resultado.php?resul=veic");
		
	}
}

else if($_GET['acao'] == 'cadastrarveic'){

	$cad_placa = $_POST['cad_placa'];
	$cad_modelo = $_POST['cad_modelo'];
	$cad_cor = $_POST['cad_cor'];
	$cad_ano = $_POST['cad_ano'];
	$cad_cat = $_POST['cad_cat'];
	$cria_veic = $_POST['cria_veic'];
	
	if ( (empty($cad_placa)) || (empty($cad_modelo)) || (empty($cad_cor)) || (empty($cad_ano)) || (empty($cad_cat)) || (empty($cria_veic)) ) {
		header("location: veiculos.php?acao=vazio");
	}

	else{
		$trytrans=TRUE;
	
		while ($trytrans){

	    	# Iniciando a transação (O SGBD é avisado para iniciar os logs de transação)
			mysqli_query($dbm,"START TRANSACTION");
			
			$query = mysqli_query($dbm,"SELECT * FROM categoria WHERE nome = '$cad_cat' LIMIT 1");
			$resul = mysqli_fetch_array($query);
			$idcategoria = $resul['idcategoria'];  
			
	      	$cmdsql="INSERT INTO veiculo	(placa,
											modelo,
											cor,
											ano,
											dono,
											idcategoria)
	                      					
	                      					VALUES ('$cad_placa',
	                              			'$cad_modelo',
	                              			'$cad_cor',
											'$cad_ano',
											'$cria_veic',
											'$idcategoria')";

			$execsql=mysqli_query($dbm,$cmdsql);
			
	      	if ( mysqli_errno($dbm)==0){ 
				mysqli_query($dbm,"COMMIT");
				header("location: veiculos.php?acao=sucesso");
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
				header("location: veiculos.php?acao=sucesso");
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

else if($_GET['acao'] == 'excluirveic'){

	$cad_placa = $_POST['cad_placa'];
	if ((empty($cad_placa))) { header("location: veiculos.php?acao=vazio"); }

	else{
		$trytrans=TRUE;
		while ($trytrans){

	    	mysqli_query($dbm,"START TRANSACTION");

			$query=mysqli_query($dbm,"SELECT idveiculo FROM veiculo WHERE placa = '$cad_placa' LIMIT 1");
			$resultado = mysqli_fetch_array($query);

			mysqli_query($dbm,"SET FOREIGN_KEY_CHECKS=0");
			
			$idveiculo = $resultado['idveiculo'];
			
			$execsql=mysqli_query($dbm,"DELETE FROM veiculo WHERE idveiculo = '$idveiculo' LIMIT 1");

			mysqli_query($dbm,"SET FOREIGN_KEY_CHECKS=1");

	      	if ( mysqli_errno($dbm)==0){ 
	        
	        	mysqli_query($dbm,"COMMIT");
				$trytrans=FALSE;
				header("location: veiculos.php?acao=exclus_sucesso");
	      	}
	      	else{ 
	        	# Erro irrecuperavel. Parar de tentar a transação
	          	$trytrans=FALSE;
				$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
				echo $mens;
				# A transação deve ser ABORTADA
				mysqli_query($dbm,"ROLLBACK");
			}
		}
	}
}

// ------------- RESERVA -------------------------------------------------------------//

else if($_GET['acao'] == 'efetuarreserva'){

	$data = $_POST['cad_data'];
	$hora_inicio = $_POST['cad_hora'];
	$qtdhoras = $_POST['cad_qtdhrs'];
	$placa = $_POST['cad_placa'];
	$cpf = $_POST['cria_veic'];

	if ((empty($data)) || (empty($hora_inicio)) || (empty($qtdhoras)) || (empty($placa))) {
		header("location: painel.php?acao=vazio");
	}	
	else{
		$hrs = explode(':',$hora_inicio);

		$hora_inicio = $hora_inicio.":00";
		$hora_fim = ($hrs[0] += $qtdhoras).':'.$hrs[1].':00';

		//echo $data."<br>".$hora_inicio."<br>".$hora_fim."<br>";

		$trytrans=TRUE;
		while ($trytrans){
			mysqli_query($dbm,"START TRANSACTION");

			$query = mysqli_query($dbm,"SELECT idveiculo, idcategoria FROM veiculo WHERE placa = '$placa' AND dono = '$cpf'");
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
				header("location: reserva.php?acao=veicjareserva");
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
					header("location: reserva.php?acao=semvag");
				break;
				}
				
			}
			if ( mysqli_errno($dbm)==0){ 
				mysqli_query($dbm,"COMMIT");
				$trytrans=FALSE;
				header("location: reserva.php?acao=sucesso");
				//echo "<br> finalizou com sucesso";
			}
			else{
				$trytrans=FALSE;
				$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
				# A transação deve ser ABORTADA
				mysqli_query($dbm,"ROLLBACK");
				//echo "<br> finalizou com erro";
				header("location: reserva.php?acao=errores");
			}
		}
	}
}

else if($_GET['acao'] == 'consultarreserva'){

	$placa = $_POST['cad_placa'];
	$res_data = $_POST['cad_data'];
	$cpf = $_POST['cria_veic'];

	if ((empty($placa)) || (empty($res_data))) { header("location: painel.php?acao=vazio"); }

	else{
		$trytrans=TRUE;
		
		$_SESSION['resulreserv'] = array();
		session_start();

		while ($trytrans){
	    	mysqli_query($dbm,"START TRANSACTION");
			
			$query=mysqli_query($dbm,"SELECT idveiculo FROM veiculo WHERE placa = '$placa' AND dono = '$cpf' LIMIT 1");
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
				header("location: reserva.php?acao=erro");
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
				
				header("location: reserva.php?acao=exclus_sucesso");
	      	}
	      	else{ 
				# Erro irrecuperavel. Parar de tentar a transação
				$trytrans=FALSE;
				$mens=mysqli_errno($dbm)."-".mysqli_error($dbm);
				echo $mens;
				# A transação deve ser ABORTADA
				mysqli_query($dbm,"ROLLBACK");
				header("location: reserva.php?acao=erro");
			}
		}
	}
}

else if($_GET['acao'] == 'fatura'){

	$cpf = $_POST['cria_veic'];

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


?>