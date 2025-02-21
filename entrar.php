<?php
class login{
    protected $cpf;
    protected $senha;
    public function __construct(){
        $this->cpf = $_POST["cpf"];
        $this->senha = $_POST["senha"];
    }
    public function TryLogin(){
        
        //Aqui vai o codigo que verifica com o BD se os dados entrados estão corretos, retorna verdadeiro se os dados estiverem corretos, falso se não.
        //apenas para teste, se a senha do usuario for sim, ele aceita, se for não, ele não aceita
        if($this->senha == "sim"){
            return true;
        }else{
            return false;
        }
    }


}

$trylogin = new Login();
if($trylogin->TryLogin()){
    header("Location: index.html");
}else{
    echo '
    <head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Cadastro</title>
</head>
<body>
<img  class="blue" src="Captura de tela de 2025-02-12 00-12-14.png" alt="">
    <h2 class="o">Bem-Vindo de volta ao Prato cheio</h2>

    <div class="numsei">

        <div class="numsei">

            <form id="formLogin" onsubmit="return" method="post" action="entrar.html" >
                <h2>Sua senha ou CPF estão incorretos, tente novamente.</h2>
                <button type="submit" class="cada">Tentar novamente</button>
            </form>
    
            <img class="logi" src="Prato_Cheio2-removebg-preview.png" alt="">
        </div>

    
</body>';
}
