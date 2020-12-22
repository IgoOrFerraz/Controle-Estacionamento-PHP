<?php
session_start();
include_once('./menu.php');
?>

  <div class="principal">
    <div class="corpo">
      <div class="container campo_painel">
        
        <div class="container logotipo"></div>
        
        <hr>

        <form action="config.php?acao=editarcad" method="POST">
        <div class="painel_conteudo row">

            <div class="col-sm-6 conteudo-esquerdo form-group">
              
              <label for="edit_cpf">CPF:</label>
              <input type="text" id="edit_cpf" name="edit_cpf" class="form-control" value="<?php echo $_SESSION['cpf']; ?>" readonly>
                
              <label for="edit_usuario">Nome de Usuário:</label>
              <input type="text" id="edit_usuario" name="edit_usuario" class="form-control" value="<?php echo $_SESSION['usuario']; ?>" required autofocus>
                
              <label for="edit_email">E-mail:</label>
              <input type="text" id="edit_email" class="form-control" name="edit_email" value="<?php echo $_SESSION['email']; ?>" required>
                
              <label for="edit_senha">Senha:</label>
              <input type="password" id="edit_senha" class="form-control" name="edit_senha" value="<?php echo $_SESSION['senha']; ?>" required>
                
              <label for="edit_dat_nasc">Data de Nascimento:</label>
              <input type="text" id="edit_dat_nasc" class="form-control" name="edit_nasc" value="<?php echo $_SESSION['data_nasc'] ?>" readonly>
                
            </div>
            
            <div class="col-sm-6 conteudo-direito form-group">
              
              <label for="edit_fone">Telefone:</label>
              <input type="text" id="edit_fone" name="edit_fone" class="form-control" value="<?php echo $_SESSION['telefone'] ?>">
              
              <label for="edit_end">Endereço:</label>
              <input type="text" id="edit_end" name="edit_end" class="form-control" value="<?php echo $_SESSION['endereco'] ?>">

              <label for="edit_bairro">Bairro:</label>
              <input type="text" id="edit_bairro" name="edit_bairro" class="form-control" value="<?php echo $_SESSION['bairro'] ?>">

              <label for="edit_end">Cidade:</label>
              <input type="text" id="edit_cidade" name="edit_cidade" class="form-control" value="<?php echo $_SESSION['cidade'] ?>">
              
              <div class="form-group form-botao">
                <input type="submit" class="btn btn-outline-warning btn-block" value="Editar Cadastro">
              </div>
          
            </div>
          
        </div>
        </form>
      </div>  
    </div>    
  </div>
</body>
</html>