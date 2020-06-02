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

$(document).ready(function () {
  $.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/empresa.php?accion=perfil",
    method: "GET",
    dataType: 'json',
    success: (res) => {
      if (!res.valido) {
        window.location.href = 'login.html';
      } else {
        $('#perfil-nombre').html(res.nombre);
        $('#perfil-pais').html(res.pais);
        $('#perfil-direccion').html(res.direccion);
        $('#perfil-numeroTelefono').html(res.telefono);
        $('#perfil-correo').html(res.correo);
        $('#perfil-logotipo').attr("src", res.logotipo);
        $('#perfil-banner').css("background-image", 'url(' + res.banner + ')');
      }
    },
    error: (error) => {
      alert("Sucedió un error al cargar el perfil");
    }

  });
});

$("#btn-registrarProducto").click(function () {
  var dato_fotoProducto = $('#foto-Producto').prop("files")[0];
  console.log(dato_fotoProducto);
  var infoProducto = new FormData();
  infoProducto.append("foto-Producto", dato_fotoProducto);
  $("form#form-producto :input").each(function () {
    if ($(this).attr("type") != "file") {
      console.log($(this).attr("name")+" "+":"+" "+$(this).val());
      infoProducto.append($(this).attr("name"), $(this).val());
    }
  });
  $(this).attr('disabled', true);
  $(this).html('Cargando...');
  console.log(infoProducto);
  $.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/producto.php?accion=registro",
    method: "POST",
    data: infoProducto,
    contentType: false,
    processData: false,
    success: (res) => {
      if (res.valido) {
        window.location.href = 'perfilEmpresa.html';
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
      console.log(error);
    }

  });

});