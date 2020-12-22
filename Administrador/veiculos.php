<?php 
  session_start();
  include_once('./menu.php');
?>

  <script type="text/javascript" language="javascript">

    function sumircampos(){
      document.getElementById('cadastrar_veic').type = 'hidden';
      document.getElementById('consultar_veic').type = 'hidden';
      document.getElementById('excluir_veic').type = 'hidden';
    }

    function cadveic(){

      sumircampos();
      // Aparecer Campos CadastrarVagas
      document.getElementById('cad_placa').type = 'text';
      document.getElementById('cad_modelo').type = 'text';
      document.getElementById('cad_cor').type = 'text';
      document.getElementById('cad_ano').type = 'text';
      document.getElementById('cad_obs').type = 'text';

      document.getElementById('button_universe').type = 'submit';
      document.getElementById('voltar').type = 'button';
      
      document.getElementById('titulo').innerHTML = 'CADASTRAR VEÍCULO';
      document.getElementById('form').action = 'config.php?acao=cadastrarveic';
    }

    function consveic(){

      sumircampos();
      
      // Aparecer Campos CadastrarVagas
      document.getElementById('cad_placa').type = 'text';

      document.getElementById('button_universe').type = 'submit';
      document.getElementById('button_universe').value = 'Consultar Veic';
      document.getElementById('voltar').type = 'button';

      document.getElementById('titulo').innerHTML = 'CONSULTAR VEÍCULO';
      document.getElementById('form').action = 'config.php?acao=consultarveic';
    }

    function excluirveic(){

      sumircampos();

      // Aparecer Campos ExcluirVagas
      document.getElementById('cad_placa').type = 'text';

      document.getElementById('button_universe').type = 'submit';
      document.getElementById('button_universe').value = 'Excluir Veículo';
      document.getElementById('voltar').type = 'button';

      document.getElementById('titulo').innerHTML = 'EXCLUIR VEÍCULO';
      document.getElementById('form').action = 'config.php?acao=excluirveic';
    }
  </script>

  <div id="principal"class="principal">
    <div class="corpo">
      <div class="container campo_vagas">
        
        <div class="container logotipo"></div>
        <label id="titulo" class="titulo">VEÍCULOS</label>      
        <hr>

        <form id="form" action="#" method="POST">
          <div class="painel_conteudo row">

            <div class="col-sm-12 conteudo form-group form_cad_vaga">

              <input type="button" id="cadastrar_veic" class="btn btn-outline-warning btn-block" value="Cadastrar Veículo" onclick=" cadveic(); ">

              <input type="button" id="consultar_veic" class="btn btn-warning btn-block" value="Consultar Veículo" onclick=" consveic(); ">

              <input type="button" id="excluir_veic" class="btn btn-warning btn-block" value="Excluir Veículo" onclick=" excluirveic(); ">

              <input type="hidden" id="cad_placa" name="cad_placa" class="form-control" placeholder="Placa do Veículo">
              <input type="hidden" id="cad_modelo" name="cad_modelo" class="form-control" placeholder="Modelo do Veículo">
              <input type="hidden" id="cad_cor" name="cad_cor" class="form-control" placeholder="Cor do Veículo">
              <input type="hidden" id="cad_ano" name="cad_ano" class="form-control" placeholder="Ano do Veículo">
              <input type="hidden" id="cad_obs" name="cad_obs" class="form-control" placeholder="Observações">

              <!-- Campo reservado para ser encaminhado via post para o config para ser utilizado para referenciar o veiculo -->
              <input type="hidden" name="cria_veic" value = "<?php echo $_SESSION['cpf']; ?>">

              <input type="hidden" id="button_universe" class="btn btn-warning btn-block" value="Cadastrar Veículo">
              <input type="hidden" id="voltar" class="btn btn-outline-warning btn-block" value="Voltar" onclick="window.location.href = 'veiculos.php';">
              

            </div>
          </div>
        </form>
      </div>  
    </div>    
  </div>
</body>
</html>