function Alterar_Senha(){
  
  document.getElementById('nova_senha').type = 'password';
  document.getElementById('conf_senha').type = 'password';

  // Titulo
  document.getElementById('titulo').innerHTML = 'ALTERAR SENHA';

  // Botão
  document.getElementById('btn_entrar').type = 'hidden';
  document.getElementById('btn_altsenha').type = 'hidden';
  document.getElementById('btn_alterar').type = 'submit';
  document.getElementById('btn_voltar').type = 'button';
  
  //Alterar o Form
  
  document.getElementById('form').action = 'config.php?acao=alterarsenha';
}

function ativar(campo){

  document.getElementById('cadastrar_categoria').type = 'hidden';
  document.getElementById('excluir_categoria').type = 'hidden';

  document.getElementById('cadastrar_vaga').type = 'hidden';
  document.getElementById('consultar_vaga').type = 'hidden';
  document.getElementById('excluir_vaga').type = 'hidden';

  document.getElementById('cadastrar_reserva').type = 'hidden';
  document.getElementById('consultar_reserva').type = 'hidden';
  
  document.getElementById('campo1').value = null;
  document.getElementById('campo2').value = null;
  document.getElementById('campo3').value = null;
  document.getElementById('campo4').value = null;
  document.getElementById('campo5').value = null;
  document.getElementById('campo6').value = null;
  document.getElementById('campo7').value = null;
 

  document.getElementById('cadastrar_'+campo).type = 'button';
  if (campo != 'categoria'){document.getElementById('consultar_'+campo).type = 'button';}
  if (campo != 'reserva'){document.getElementById('excluir_'+campo).type = 'button';}
}

// --------------------------------- CATEGORIAS -------------------------------- //

function cad_cat(){

  document.getElementById('campo3').type = 'hidden';
  document.getElementById('campo4').type = 'hidden';
  document.getElementById('campo5').type = 'hidden';
  document.getElementById('campo6').type = 'hidden';
  document.getElementById('campo7').type = 'hidden';

  let nome = document.getElementById('campo1');
  let preco = document.getElementById('campo2');
  let botao = document.getElementById('botao');

  nome.type = 'text';
  nome.placeholder = 'Digite o Nome da Categoria';
  nome.name = 'cat_nome';
  nome.title = "Apenas Letras";
  nome.value = null;

  preco.type = 'text';
  preco.placeholder = 'Digite o Preço da Categoria';
  preco.name = 'cat_preco';
  preco.value = null;

  botao.type = 'submit';
  botao.value = 'Cadastrar Categoria';


  document.getElementById('form').action = 'config.php?acao=cadcat';
  document.getElementById('titulo').innerHTML = 'CADASTRAR CATEGORIA';

}

function excluir_cat(){

  document.getElementById('campo2').type = 'hidden';
  document.getElementById('campo3').type = 'hidden';
  document.getElementById('campo4').type = 'hidden'; 
  document.getElementById('campo5').type = 'hidden';
  document.getElementById('campo6').type = 'hidden';
  document.getElementById('campo7').type = 'hidden';
  
  let botao = document.getElementById('botao');
  let campo_excluir = document.getElementById('campo1');

  campo_excluir.type = 'text';
  campo_excluir.placeholder = 'Digite o Nome da Categoria';
  campo_excluir.name = 'campo_cat';
  campo_excluir.title = "Apenas Letras";
  campo_excluir.value = null;

  botao.type = 'submit';
  botao.value = 'Excluir Categoria';

  document.getElementById('form').action = 'config.php?acao=excluircat';
  document.getElementById('titulo').innerHTML = 'EXCLUIR CATEGORIA';

}

// -------------------------------- VAGAS ------------------------------------ //

function cad_vaga(){

  document.getElementById('campo3').type = 'hidden';
  document.getElementById('campo4').type = 'hidden';
  document.getElementById('campo5').type = 'hidden';
  document.getElementById('campo6').type = 'hidden';
  document.getElementById('campo7').type = 'hidden';

  let id = document.getElementById('campo1');
  let categoria = document.getElementById('campo2');
  let botao = document.getElementById('botao');

  id.type = 'text';
  id.placeholder = 'Digite o ID da Vaga';
  id.name = 'vaga_id';
  id.value = null;

  categoria.type = 'text';
  categoria.placeholder = 'Digite a Categoria';
  categoria.name = 'vaga_cat';
  categoria.title = "Apenas Letras";
  categoria.value = null;

  botao.type = 'submit';
  botao.value = 'Cadastrar Vaga';


  document.getElementById('form').action = 'config.php?acao=cadastrarvaga';
  document.getElementById('titulo').innerHTML = 'CADASTRAR VAGA';

}

function exc_vaga(){

  document.getElementById('campo2').type = 'hidden';
  document.getElementById('campo3').type = 'hidden';
  document.getElementById('campo4').type = 'hidden'; 
  document.getElementById('campo5').type = 'hidden';
  document.getElementById('campo6').type = 'hidden';
  document.getElementById('campo7').type = 'hidden';

  let exc_id = document.getElementById('campo1');
  let botao = document.getElementById('botao');
  
  exc_id.type = 'text';
  exc_id.placeholder = 'Digite o ID da Vaga';
  exc_id.name = 'vaga_excluir';
  exc_id.value = null;

  botao.type = 'submit';
  botao.value = 'Excluir Vaga';

  document.getElementById('form').action = 'config.php?acao=excluirvaga';
  document.getElementById('titulo').innerHTML = 'EXCLUIR VAGA';

}
function cons_vaga(){

  document.getElementById('campo2').type = 'hidden';
  document.getElementById('campo3').type = 'hidden';
  document.getElementById('campo4').type = 'hidden';
  document.getElementById('campo5').type = 'hidden';
  document.getElementById('campo6').type = 'hidden';
  document.getElementById('campo7').type = 'hidden';

  let cons_id = document.getElementById('campo1');
  
  cons_id.type = 'text';
  cons_id.placeholder = 'Digite o ID da Vaga';
  cons_id.name = 'idvaga';
  cons_id.value = null;
  
  let botao = document.getElementById('botao');
  botao.type = 'submit';
  botao.value = 'Consultar Vaga';

  document.getElementById('form').action = 'config.php?acao=consultarvagas';
  document.getElementById('titulo').innerHTML = 'CONSULTAR VAGA';
  
}

// ------------------------------------ VEICULO -------------------------------//

function cons_veic(){

  document.getElementById('campo2').type = 'hidden';
  document.getElementById('campo3').type = 'hidden';
  document.getElementById('campo4').type = 'hidden';
  document.getElementById('campo5').type = 'hidden';
  document.getElementById('campo6').type = 'hidden';
  document.getElementById('campo7').type = 'hidden';

  let cons_id = document.getElementById('campo1');
  
  cons_id.onload = cons_id.value = null;
  cons_id.type = 'text';
  cons_id.placeholder = 'Digite a Placa do Veículo';
  cons_id.name = 'placa';
  cons_id.maxLength = "7";
  cons_id.pattern = "[A-Za-z]{3}[0-9]{4}";
  
  let botao = document.getElementById('botao');
  botao.type = 'submit';
  botao.value = 'Consultar Veiculo';

  document.getElementById('form').action = 'config.php?acao=consultarveic';
  document.getElementById('titulo').innerHTML = 'CONSULTAR VEÍCULO';
  
}

// ------------------------------------ RESERVA -------------------------------//

function cad_res(){

  document.getElementById('campo4').type = 'hidden';
  document.getElementById('campo5').type = 'hidden';
  document.getElementById('campo6').type = 'hidden';
  document.getElementById('campo7').type = 'hidden';

  let data = document.getElementById('campo1');
  let hora_inicio = document.getElementById('campo2');
  let qtdhoras = document.getElementById('campo3');
  let veiculo = document.getElementById('campo4');
  let botao = document.getElementById('botao');

  data.type = 'date';
  data.name = 'res_data';
  data.value = null;

  hora_inicio.type = 'time';
  hora_inicio.name = 'res_horainicio';
  hora_inicio.value = null;

  qtdhoras.type = 'text';
  qtdhoras.name = 'qtdhoras';
  qtdhoras.placeholder = 'Quantas Horas?';
  qtdhoras.maxLength = "1";
  qtdhoras.pattern = "[0-9]{1}";
  qtdhoras.value = null;

  veiculo.type = 'text';
  veiculo.name = 'res_veic';
  veiculo.placeholder = 'Digite a Placa do Veículo a ser Reservado';
  veiculo.maxLength = "7";
  veiculo.pattern = "[A-Za-z]{3}[0-9]{4}";

  botao.type = 'submit';
  botao.value = 'Efetuar Reserva';


  document.getElementById('form').action = 'config.php?acao=efetuarreserva';
  document.getElementById('titulo').innerHTML = 'EFETUAR RESERVA';

}

function cons_res(){

  document.getElementById('campo3').type = 'hidden';
  document.getElementById('campo4').type = 'hidden';
  document.getElementById('campo5').type = 'hidden';
  document.getElementById('campo6').type = 'hidden';
  document.getElementById('campo7').type = 'hidden';

  let data = document.getElementById('campo1');
  let veiculo = document.getElementById('campo2');
  let botao = document.getElementById('botao');

  data.type = 'date';
  data.name = 'res_data';

  veiculo.type = 'text';
  veiculo.name = 'res_veic';
  veiculo.placeholder = 'Digite a Placa do Veículo';
  veiculo.maxLength = "7";
  veiculo.pattern = "[A-Za-z]{3}[0-9]{4}";

  botao.type = 'submit';
  botao.value = 'Consultar Reserva';

  document.getElementById('form').action = 'config.php?acao=consres';
  document.getElementById('titulo').innerHTML = 'CONSULTAR RESERVA';

}

function faturas(){

  document.getElementById('campo2').type = 'hidden';
  document.getElementById('campo3').type = 'hidden';
  document.getElementById('campo4').type = 'hidden';
  document.getElementById('campo5').type = 'hidden';
  document.getElementById('campo6').type = 'hidden';
  document.getElementById('campo7').type = 'hidden';

  let cons_cpf = document.getElementById('campo1');
  
  cons_cpf.onload = cons_cpf.value = null;
  cons_cpf.type = 'text';
  cons_cpf.placeholder = 'Digite o CPF do Cliente';
  cons_cpf.name = 'cpf';
  cons_cpf.maxLength = '11';
  cons_cpf.pattern="[0-9]{11}";
  cons_cpf.title = "Digite apenas Numeros, Sem (.) nem (-)"
  cons_cpf.required = true;

  let botao = document.getElementById('botao');
  botao.type = 'submit';
  botao.value = 'Consultar Fatura';

  document.getElementById('form').action = 'config.php?acao=fatura';
  document.getElementById('titulo').innerHTML = 'FATURA';
  
}

function relatórios(){

  document.getElementById('campo5').type = 'hidden';
  document.getElementById('campo6').type = 'hidden';
  document.getElementById('campo7').type = 'hidden';

  let btn_clientes = document.getElementById('campo1');
  let btn_reservas = document.getElementById('campo2');
  let btn_veiculos = document.getElementById('campo3');
  let btn_vagas = document.getElementById('campo4');

  btn_clientes.value = 'Clientes';
  btn_reservas.value = 'Reservas';
  btn_veiculos.value = 'Veículos';
  btn_vagas.value = 'Vagas';

  btn_clientes.type = 'Button';
  btn_reservas.type = 'Button';
  btn_veiculos.type = 'Button';
  btn_vagas.type = 'Button';

  btn_clientes.onclick = function(){
    window.location.href = 'config.php?acao=relcli';
  }
  btn_reservas.onclick = function(){
    window.location.href = 'config.php?acao=relres';
  }
  btn_veiculos.onclick = function(){
    window.location.href = 'config.php?acao=relveic';
  }
  btn_vagas.onclick = function(){
    window.location.href = 'config.php?acao=relvag';
  }

  btn_clientes.className = 'btn btn-outline-warning btn-block';
  btn_reservas.className = 'btn btn-outline-warning btn-block';
  btn_veiculos.className = 'btn btn-outline-warning btn-block';
  btn_vagas.className = 'btn btn-outline-warning btn-block';


  document.getElementById('titulo').innerHTML = 'RELATÓRIOS';
}