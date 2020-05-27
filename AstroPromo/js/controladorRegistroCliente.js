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

$("#btn-registrate").click(function () {
  var parametros = $("#form-cliente").serialize() + "&cliente=true&empresa=false";
  console.log(parametros);
  /*$.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/usuario.php?accion=registro",
    method: "POST",
    data: parametros,
    dataType: 'json',
    success: (res) => {
      if (res.valido) {
        window.location.href = 'perfilCliente.html';
      } else {
        alert('Credenciales invalidas');
      }
      console.log(res);
    },
    error: (error) => {
      console.log(error);
    }
  });*/
});

