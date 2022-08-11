<?php 
include('./conect.php');

// Cabeçalo de authorização de acesso CORS
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

// Validador de entrada de requizições para api
$_appQuery   = $_POST['appQuery'];        //Nome da aplicação que esta fazendo a requizição para a api que usará o nome do banco
$_typeSql   = $_POST['typeSql'];        //Tipo da consulta, SELECT, UPDATE, INSERT, DELETE, PUT ETC..
$_authKey   = $_POST['authKey'];        //Sistema de authenticação para validaçao derequizição
$_dataQuery = $_POST['dataQuery'];      //Variaveis em formato json para inserção na query string


$response['status'] = 200;
$response['serverMSG'] = 'Consulta realizada com sucesso!';

try {
    //Array, contendo nomes dos bancos do servidor SQL
    $queryName = [

                'selectAllprojetos'=> 'SELECT * FROM port_projetos;', 
                'loginAuth'=> 'SELECT user_name, user_email, user_phone, user_level FROM users WHERE BINARY user_email = :email AND user_pass = :pass;',
                'selectAllUsers' => 'SELECT * FROM users;'
            ]; 
    
    //Validação do tipo de requisição do client
    switch ($_appQuery) {
        case 'validLogin':
            $data = json_decode($_dataQuery, true);

            $queryString = $con->prepare($queryName[$_typeSql]);

            $queryString->bindValue(':email', $data['user_email']);
            $queryString->bindValue(':pass', $data['user_pass']);

            $queryString->execute();

            if($queryString->errorInfo()[0] === '00000'){
                $info = $queryString->fetchAll(PDO::FETCH_ASSOC);
                if($info != []){
                    $response['infoData'] = $info;
                }
            }else{
                $response['status'] = 500;
                $response['sqlError'] = $queryString->errorInfo();
            }

            break;
        
        case 'projetos':
            $queryString = $con->prepare($queryName[$_typeSql]);
            $queryString->execute();
            
            if($queryString->errorInfo()[0] === '00000'){
                $info = $queryString->fetchAll(PDO::FETCH_ASSOC);
                if($info != []){
                    $response['infoData'] = $info;
                }
            }else{
                $response['status'] = 500;
                $response['sqlError'] = $queryString->errorInfo();
            }
            break;
        
        case 'insert':
            # code...
            break;

        case 'delete':
            # code...
            break;
        
        default:
            $response['status'] = 500;
            $response['serverMSG'] = 'Sua consulta não foi realizada corretamente!';
            break;
    }

} catch ( PDOException $Exception ) {
    $response['status'] = 500;
    $response['serverMSG'] = $Exception.getMessage();
}

if($response['status'] == 500){
    $response['serverMSG'] = 'Falha ao tetnta realizar esta consulta no nosso banco!';
}

if($_appName || $_typeSql || $_authKey || $_dataQuery){
    echo json_encode($response);
}else{
    echo '404';     //Inserir pagina 404
}

?>