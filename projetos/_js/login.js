var passw = document.getElementById("passw");
var email = document.getElementById("email");

document.getElementById("btn-entrar").addEventListener('click', (e) => {
    var apiUrl = "https://localhost/crudSql/api.php";
    e.preventDefault();

    var logged = document.getElementById('logged');
    var modalH2 = document.getElementById('modalUser'); 
    var modalSpan = document.getElementById('spanModal');
    var checkLembre = document.getElementById('lembre');

    if(passw.validity.valid && email.validity.valid){

        var form_data = new FormData();
        form_data.append('typeSql', 'loginAuth');
        form_data.append('appQuery', 'validLogin');
        form_data.append('dataQuery', JSON.stringify({'user_email': email.value, 'user_pass': CryptoJS.SHA1(passw.value).toString()})); 

        $.ajax({
            url: apiUrl,
            method: "POST",
            data: form_data,
            contentType: false,
            processData: false,
            success: ((resp) => {
                var data = JSON.parse(resp);
                if(data.status === 200 && data.infoData != undefined){
                    modalH2.innerHTML = data.infoData[0].user_name;
                    modalSpan.innerHTML = 'Sejá bem vindo, você será redirecionado automaticamente em 3s aguarde...';
                    logged.style.display = 'flex';
                    if(checkLembre.checked){
                        handleCheckSaveUser();
                    }
                    setTimeout(() => { window.location = window.origin }, 3000)
                }else{
                    modalH2.innerHTML = "Usuario Invalido!";
                    modalH2.style.color = 'red';
                    modalSpan.innerHTML = 'Não conseguimos localizar o usuario no banco de dados!';
                    logged.style.display = 'flex';
                }
            })
        })
        
    }else{
        passw.reportValidity();
        email.reportValidity();
    }
})

document.getElementById('closeModal').addEventListener('click', (e) => {
    e.preventDefault();

    var logged = document.getElementById('logged');

    logged.style.display = 'none';

})

function handleCheckSaveUser(){
    localStorage.setItem('@user_login', email.value);
    localStorage.setItem('@user_passw', passw.value);

}

function lembrarUsuario(){
    var userLogin = '@user_login';
    var userPassw = '@user_passw';

    if(localStorage.getItem(userLogin) != null && localStorage.getItem(userPassw) != null){
        email.value = localStorage.getItem(userLogin);
        passw.value = localStorage.getItem(userPassw);
    }
}