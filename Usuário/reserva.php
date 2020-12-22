<?php 
  session_start();
  include_once('./menu.php');
?>

  <script type="text/javascript" language="javascript">

    function sumircampos(){
      document.getElementById('cadastrar_res').type = 'hidden';
      document.getElementById('consultar_res').type = 'hidden';
    }

    function cadres(){

      sumircampos();

      document.getElementById('cad_placa').type = 'text';
      document.getElementById('cad_data').type = 'date';
      document.getElementById('cad_hora').type = 'time';
      document.getElementById('cad_qtdhrs').type = 'text';

      document.getElementById('button_universe').type = 'submit';
      document.getElementById('voltar').type = 'button';
      
      document.getElementById('titulo').innerHTML = 'EFETUAR RESERVA';
      document.getElementById('form').action = 'config.php?acao=efetuarreserva';
    }

    function consres(){

      sumircampos();
      
      document.getElementById('cad_placa').type = 'text';
      document.getElementById('cad_data').type = 'date';
      
      document.getElementById('button_universe').type = 'submit';
      document.getElementById('button_universe').value = 'Consultar Reservas';
      document.getElementById('voltar').type = 'button';

      document.getElementById('titulo').innerHTML = 'CONSULTAR RESERVA';
      document.getElementById('form').action = 'config.php?acao=consultarreserva';
    }

  </script>

  <div id="principal"class="principal">
    <div class="corpo">
      <div class="container campo_vagas">
        
        <div class="container logotipo"></div>
        <label id="titulo" class="titulo">RESERVAS</label>      
        <hr>

        <form id="form" action="#" method="POST">
          <div class="painel_conteudo row">

            <div class="col-sm-12 conteudo form-group form_cad_vaga">

              <input type="button" id="cadastrar_res" class="btn btn-outline-warning btn-block" value="Efetuar Reserva" onclick=" cadres(); ">

              <input type="button" id="consultar_res" class="btn btn-warning btn-block" value="Consultar Reserva" onclick=" consres(); ">

              <input type="hidden" id="cad_placa" name="cad_placa" class="form-control" placeholder="Placa do Veículo" maxlength="11" pattern="[A-Za-z]{3}[0-9]{4}" required>
              <input type="hidden" id="cad_data" name="cad_data" class="form-control" required>
              <input type="hidden" id="cad_hora" name="cad_hora" class="form-control" required>
              <input type="hidden" id="cad_qtdhrs" name="cad_qtdhrs" class="form-control" placeholder="Quantas Horas?" maxlength="1" pattern="[0-9]{1}" required>
              
              <!-- Campo reservado para ser encaminhado via post para o config para ser utilizado para referenciar o veiculo -->
              <input type="hidden" name="cria_veic" value = "<?php echo $_SESSION['cpf']; ?>">

              <input type="hidden" id="button_universe" class="btn btn-warning btn-block" value="Cadastrar Veículo">
              <input type="hidden" id="voltar" class="btn btn-outline-warning btn-block" value="Voltar" onclick="window.location.href = 'reserva.php';">
              
            </div>
          </div>
        </form>
      </div>  
    </div>    
  </div>
</body>
</html>