
    var usuario_logado = window.sessionStorage.getItem('user');

    console.log(usuario_logado);

    if(usuario_logado == null){

      window.location = '../app/login.html';
    } 
