<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />   
    <link rel="shortcut icon" href="img/Favicon.png" />
    <title>Projeto reCAPTCHA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/estilo.css" />
    <script src="js/scripts.js" defer></script>

    <!-- API Google reCAPTCHA --> 
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
    function validarPost() {
      /*VERIFICA SE O RECAPTCHO FOI SELECIONADO*/
      if (grecaptcha.getResponse() != "")
        return true;
      // ERRO NÃO SELECIONADO
      alert('Por favor selecionar a caixa "Não sou um robô"')
      return false;
    }
  </script>

<?php
if ($_POST) {
  // echo "</pre>";
  // print_r($_POST);
  // echo "</pre>";
  // exit;

  // CURL

  $curl = curl_init();

  // DEFINICOES DA REQUISIÇÃO COM CURL
  curl_setopt_array($curl, [
    CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => [
      'secret' => '6LcwsDomAAAAADl_y8W3HSGsUAtXmA-4cDse59El',
      'response' => $_POST['g-recaptcha-response'] ?? ''
    ]
  ]);

  // EXECUTA A REQUISIÇÃO
  $response = curl_exec($curl);

  // FECHA A CONEXÃO CURL
  curl_close($curl);

  // echo "</pre>";
  // print_r($response);
  // echo "</pre>";
  // exit;

  // RESPONSE EM ARRAY
  $responseArray = json_decode($response, true);

  // SUCESSO DO RECAPCHA
  $sucesso = $responseArray['success'] ?? false;

  // echo "</pre>";
  // var_dump($sucesso);
  // echo "</pre>";
  // exit;

  // RETORNO PARA O USUÁRIO
  echo $sucesso ? "Parabéns, usuário cadastrado com sucesso!" : "";


  if ($sucesso) {
    header('Location: Processa.html');
    exit;
  }
}
?>
</head>

  <body>
    <div id="register-container">
      <div id="register-banner">
        <div id="banner-layer">
          <h1>Google reCAPTCHA</h1>
        </div>
      </div>

      <div id="register-form">
        <h2>Segurança em Sistemas para Internet</h2>
        <p>Insira suas credenciais para se cadastrar no sistema</p>
      <!--------------- FORM CONTATO -------------------->
      <form onsubmit="return validarPost()" method="POST">
        <div class="field">
          <label for="nome" style="font-weight: bold;">Nome</label>
            <div class="control">
              <input style="margin-top: 5px; border-radius: 12px; background-color: #EBEBEB; padding: 6px 8px 7px; font-family: 'Montserrat', sans-serif; font-size: 15px; width: 100%; font-weight: bold;"  type="text" name="nome" id="nome" class="input" placeholder="Informe seu nome..." required>
            </div>
        </div>
<br>
        <div class="field">
          <label for="email" style="font-weight: bold;">E-mail</label>
            <div class="control">
              <input style="margin-top: 5px; border-radius: 12px; background-color: #EBEBEB; padding: 6px 8px 7px; font-family: 'Montserrat', sans-serif; font-size: 15px; width: 100%; font-weight: bold;"  type="email" name="email" id="email" placeholder="Informe seu e-mail..." required>
            </div>
        </div>
<br>
<div class="g-recaptcha" data-sitekey="6LcwsDomAAAAABEQJnIFCxeTbXUKZFDQgn5eFXwg"></div>
<br>
          <div class="field is-grouped">
            <div class="control">
              <button class="button is-link" style="margin-left:40%; margin-top:-5%;">Enviar</button>
                </div>
          </div>
          <div style="font-size: 11px; padding-top: 12px; color: #808080; text-align: center;">Observação: Este formulário é protegido pelo Google reCAPTCHA</div>         
          <div id="instrucoes">
            <div id="instrucoes-titulo">INSTRUÇÕES DE USO</div>
            <div id="instrucoes-fator1">Informe seu primeiro</div>
            <div id="instrucoes-email">nome</div>
            <div id="instrucoes-fator2">Informe seu endereço de</div>
            <div id="instrucoes-senha">e-mail</div>
            <div id="instrucoes-fator3">Selecione o reCAPTCHA</div>
          </div>
      
      </form>
      <!--------------- FIM FORM CONTATO -------------------->      
      </div>
    </div>
  </body>
</html>
