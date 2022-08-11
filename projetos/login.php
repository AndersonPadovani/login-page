<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Login</title>
    <link rel="stylesheet" href="./_css/login.css">
    <link rel="stylesheet" href="./_css/modal.css">
</head>
<body onload='lembrarUsuario()'>
    <section class="container">
        <!-- Sessao esquerda que contem a iamgen ilustrativa -->
        <section class="left">
            <figcaption><img src="./_img/admin-page.svg" alt="Imagen Apresentação Admin"></figcaption>
        </section>
        
        <hr>

        <!-- Sessão direita resposnavel pelos inputs -->
        <section class="rigth">
            <form method="post">
                <h2>Login</h2>
                <div class="inputs">
                    <input type="email" name="email" id="email" placeholder="user@email.com" required>
                    <input type="password" name="passw" id="passw" placeholder="*******" required minlength=4>
                    <div class="check">
                        <label for="lembre">Lembrar Senha?<input type="checkbox" name="lembre" id="lembre"></label>                    
                        <a id='esqueceu' href="#"><label for="esqueceu">Esqueceu senha?</label></a>                   
                    </div>
                </div>
                <input id='btn-entrar' class="btn-entrar" type="submit" value="ENTRAR">
            </form>
        </section>
    </section>   
    
    <section id='logged' class="logged">
        <div class="modal">
            <h2 id='modalUser'></h2>
            <span id='spanModal'></span>

            <input id='closeModal' type="button" value="X">
        </div>
    </section>
    <script src="./_js/login.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
</body>
</html>