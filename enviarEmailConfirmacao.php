<?php
    require_once __DIR__ . '/config/config.php';
    require_once __DIR__ . '/src/core/Database.php';
    $email = $_POST["email"]?? null;

    date_default_timezone_set('America/Sao_Paulo');
    $token = bin2hex(random_bytes(2));
    $token_hash = password_hash($token, PASSWORD_DEFAULT);
    $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));
    $db = new Database();
    $pdo = $db->getConnection();
    $sql = $pdo->prepare("INSERT INTO redefinicoes (email, token, expira) VALUES (:email, :token, :expira);");
    $sql->bindValue(':email', $email);
    $sql->bindValue(':token', $token_hash);
    $sql->bindValue(':expira', $expira);
    if($sql->execute()){
        echo"Código de verificação enviado!!";
        echo $token;
    }else{
        echo"algum erro!";
    }
    #Montando o email:
    
?>
<!-- solicitar_redefinicao.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verificação de E-mail</title>
  <style>
    /* Reset básico */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    body {
      background-color: #1e1e3f; /* fundo escuro */
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      height: 100vh;
    }

    /* Header */
    header {
      width: 100%;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      color: #000;
      font-weight: bold;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    header a {
      text-decoration: none;
      color: #000;
      margin-left: 20px;
      font-weight: normal;
      font-size: 0.9rem;
    }

    header .logo {
      display: flex;
      align-items: center;
    }

    header .logo-circle {
      width: 24px;
      height: 24px;
      background-color: #7b5fff;
      border-radius: 50%;
      margin-right: 10px;
    }

    /* Card central */
    .card {
      margin-top: 100px;
      background-color: #fff;
      padding: 40px;
      border-radius: 16px;
      width: 400px;
      text-align: center;
    }

    .card h1 {
      font-size: 1.4rem;
      margin-bottom: 15px;
    }

    .card p {
      font-size: 0.95rem;
      margin-bottom: 20px;
    }

    .card input[type="text"] {
      width: 100%;
      padding: 12px;
      font-size: 1.2rem;
      letter-spacing: 10px;
      text-align: center;
      border-radius: 8px;
      border: 1px solid #ccc;
      margin-bottom: 15px;
    }

    .card a {
      color: #7b5fff;
      text-decoration: none;
      font-size: 0.85rem;
    }

    .card a:hover {
      text-decoration: underline;
    }

    .card button {
      margin-top: 15px;
      width: 100%;
      padding: 12px;
      background-color: #7b5fff;
      color: #fff;
      font-size: 1rem;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    .card button:hover {
      background-color: #654ce0;
    }

    /* Responsivo */
    @media(max-width: 450px){
      .card {
        width: 90%;
        padding: 30px 20px;
      }
    }

  </style>
</head>
<body>
  <header>
    <div class="logo">
      <div class="logo-circle"></div>
      Digital Signage
    </div>
    <nav>
      <a href="#">Sobre nós</a>
      <a href="#">Conhecer a ferramenta</a>
      <a href="#">Encarregados</a>
      <a href="#">GitHub</a>
    </nav>
  </header>

  <div class="card">
    <h1>Pronto! Verifique seu e-mail para começar.</h1>
    <p>Um código de 4 dígitos foi enviado à <strong><?=$email?></strong></p>
    <p>O código expira em 5 minutos</p>
    <form action="verifyCode.php?act=<?=$token_hash?>" method="post">
       <input name ="code" type="text" maxlength="4" value="0000">
       <p>Não recebeu nenhum código? <a href="#">Re-enviar Código</a></p>
      <button>Verificar</button>
    </form>
   
    
  </div>
</body>
</html>






