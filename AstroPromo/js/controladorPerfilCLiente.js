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
    url: "http://localhost/POO/Proyecto/AstroPromo/api/cliente.php?accion=perfil",
    method: "GET",
    dataType: 'json',
    success: (res) => {
      if (!res.valido) {
        window.location.href = 'login.html';
      } else {
        $('#perfil-nombre').html(res.nombre + " " + res.apellido);
        $('#perfil-genero').html(res.genero);
        $('#perfil-fechaNacimiento').html(res.fechaNacimiento);
        $('#perfil-numeroTelefono').html(res.numeroTelefono);
        $('#perfil-correo').html(res.correo);
        $('#perfil-fotoPerfil').attr("src", res.fotoPerfil);
        $('#perfil-fotoPortada').css("background-image", 'url(' + res.fotoPortada + ')');
      }
    },
    error: (error) => {
      alert("Sucedió un error al cargar el perfil");
    }

  });
  $.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/cliente.php?accion=empresasSeguidas",
    method: "GET",
    dataType: 'json',
    success: (res) => {
      if (res.valido) {
        if (res.empresas.length > 0) {
          var tarjetas = "";
          $.each(res.empresas, function (index, value) {
            var jsonValue = JSON.parse(value);
            console.log(jsonValue);
            tarjetas += tarjetaEmpresa(jsonValue);
          });
          $("#tarjetasEmpresas").html(tarjetas);
        } else {
          $("#tarjetasEmpresas").html("Aún no sigues empresas");
        }
      } else {
        $("#tarjetasEmpresas").html("Error al cargar empresas");

      }
    },
    error: (error) => {
      $("#tarjetasEmpresas").html("Error al cargar empresas");
    }

  });

});

function tarjetaEmpresa(jsonEmpresa) {
  var tarjeta = `
  <div class="col-12 col-sm-6">
    <div class="card card-empresa">
      <img class="card-img-top" src="${jsonEmpresa["banner"]}" alt="Card image cap">
        <div class="card-block">
          <img class="img-profile-folow" src="${jsonEmpresa["logotipo"]}" alt="">
            <h4>${jsonEmpresa["nombreEmpresa"]}</h4>
            <p class="card-text">${jsonEmpresa["pais"]},${jsonEmpresa["direccion"]}</p>
            <a href="perfilEmpresaCliente.html?id=${jsonEmpresa["idEmpresa"]}" class="btn btn-primary btn-round btn-lg">Ver</a>
        </div>
    </div>
  </div>
  `;
  return tarjeta;

}