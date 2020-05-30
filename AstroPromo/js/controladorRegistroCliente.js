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
  var dato_fotoperfil = $('#fotoPerfil').prop("files")[0];
  var dato_fotoportada = $('#fotoPortada').prop("files")[0];
  var fd = new FormData();
  fd.append("fotoPerfil", dato_fotoperfil);
  fd.append("fotoPortada", dato_fotoportada);
  $("form#form-cliente :input").each(function () {
    if ($(this).attr("id") != "fotoPerfil" && $(this).attr("id") != "fotoPortada") {
      fd.append($(this).attr("name"), $(this).val());
    }
  });
  //var parametros = $("#form-cliente").serialize() +"&fotoPerfil="+dato_fotoperfil+"&fotoPortada="+dato_fotoportada;
  //console.log(parametros);
  //console.log(dato_fotoperfil);
  $(this).attr('disabled', true);
  $(this).html('Cargando...');
  $.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/usuario.php?accion=registro&tipo=cliente",
    method: "POST",
    data: fd,
    contentType: false,
    processData: false,
    //contentType:'multipart/form-data',
    success: (res) => {
      if (res.valido) {
        window.location.href = 'perfilCliente.html';
      } else {
        alert(res.mensaje)
      }
      $(this).attr('disabled', false);
      $(this).html('Registrate');
    },
    error: (error) => {
      alert("Sucedio un error")
      $(this).attr('disabled', false);
      $(this).html('Registrate');
    }

  });

});

