(function () {
  'use strict';
  window.addEventListener('load', function () {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function () {
  $.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/usuario.php?accion=verificarLogeado",
    method: "POST",
    dataType: 'json',
    success: (res) => {
      if (res.valido) {
        if (res.superUsuario) {
          window.location.href = 'superUsuario.html';
        }
        if (res.empresa) {
          window.location.href = 'perfilEmpresa.html';
        }
        if (res.cliente) {
          window.location.href = 'perfilCliente.html';
        }
      }
    },
  });
});

$("#btn-login").click(function () {
  var parametros = $("#form-login").serialize();
  $(this).attr('disabled', true);
  $(this).html('Cargando...');
  $.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/usuario.php?accion=login",
    method: "POST",
    data: parametros,
    dataType: 'json',
    success: (res) => {
      console.log(res);
      if (res.valido) {

        if (res.superUsuario) {
          window.location.href = 'perfilSuperUsuario.html';
        }
        if (res.empresa) {
          window.location.href = 'perfilEmpresa.html';
        }
        if (res.cliente) {
          window.location.href = 'perfilCliente.html';
        }
      } else {
        alert(res.mensaje);
      }
      $(this).attr('disabled', false);
      $(this).html('Entrar');
    },
    error: (error) => {
      alert("Sucedió un error");
      $(this).attr('disabled', false);
      $(this).html('Entrar');
    }
  });
});

/*$("#btn-login").click(function() {
  console.log(document.getElementById('correo').value);
  axios({
    url: 'http://localhost/POO/Proyecto/AstroPromo/api/usuario.php?accion=login',
    method: 'post',
    responseType: 'json',
    data: {
      correo: document.getElementById('correo').value,
      contrasena: document.getElementById('contrasena').value
    },
  }).then(res => {
    if (res.valido)
      window.location.href = 'perfilCliente.html';
    else
      alert('Credenciales invalidas');
    console.log(res);
  }).catch(error => {
    console.error(error);
  });
});*/
