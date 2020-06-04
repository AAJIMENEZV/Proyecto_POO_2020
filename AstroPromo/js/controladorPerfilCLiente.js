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
      console.log(error);
      $("#tarjetasEmpresas").html("Error al cargar empresas");
    }

  });
  $.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/cliente.php?accion=obtenerPromociones",
    method: "GET",
    dataType: 'json',
    success: (res) => {
      if (res.valido) {
        if (res.promociones.length > 0) {
          var tarjetas = "";
          $.each(res.promociones, function (index, value) {
            var jsonValue = value;
            tarjetas += tarjetaPromocion(jsonValue);
          });
          $("#tarjetaPromociones").html(tarjetas);
        } else {
          $("#tarjetaPromociones").html("Error al cargar promociones");
        }
      } else {
        $("#tarjetaPromociones").html("Error al cargar promociones");

      }
    },
    error: (error) => {
      console.log(error);
      alert("Sucedió un error al cargar el perfil");
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
function tarjetaPromocion(jsonPromocion) {
  var tarjeta = `
  <div class="col-12 col-sm-6">
    <div class="card">
      <img class="card-img-top" src="${jsonPromocion["imagenPromocion"]}" alt="Card image cap">
      <div class="card-block">
        <h4>${jsonPromocion["nombrePromocion"]}</h4>
        <p class="card-text">${jsonPromocion["descripcionPromocion"]}</p>
        <a href="#" class="btn btn-primary btn-round btn-lg" data-toggle="modal"
          data-target="#${jsonPromocion["id"]}">Ver</a>
      </div>
    </div>
  </div>


  <div class="modal fade" id="${jsonPromocion["id"]}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-center" role="document">
      <div class="modal-content">
        <div class="card carta-producto " style="padding: 10px;">
          <img class="card-img-top" src="${jsonPromocion["imagenPromocion"]}" alt="Camisa Barsa">
          <div class="card-block">
            <h4>${jsonPromocion["nombrePromocion"]}</h4>
            <p class="card-text">${jsonPromocion["descripcionPromocion"]}</p>
            <p class="category"><span>Precio Normal: ${jsonPromocion["precioNormal"]}</span>  | <span>Oferta: ${jsonPromocion["descuento"]} </span> </p>
              <p class="category"><span>Precio Oferta: ${jsonPromocion["precioOferta"]} </span> | <span>Fecha Inicio: ${jsonPromocion["fechaInicio"]}</span>  </p>
              <p class="category">Fecha Vencimiento: ${jsonPromocion["fechaVencimiento"]}</p>
            <div style="text-align: center;">
            <a class="btn btn-primary btn-round btn-lg" onclick="realizarCompra('${jsonPromocion["nombrePromocion"]}',${jsonPromocion["precioOferta"]},'${jsonPromocion["id"]}')" id="btn-compra-${jsonPromocion["id"]}">Comprar</a>
            <a href="perfilEmpresaCliente.html?id=${jsonPromocion["refIdEmpresa"].split("/")[1]}" class="btn btn-primary btn-round btn-lg" id="btn-verEmpresa">Ver Empresa</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  `;
  return tarjeta;

}
function asignarEventoClickBtnComprar(){
  $("#btn-compra").click(function () {
    $(this).html('Procesando');
    $(this).attr("disabled", true);
    var nombrePromocion = $(this).attr("name");
    var precioPromocion = $(this).attr("price");
    var confirmacion = confirm(`Vas a comprar ${nombrePromocion}, se cargaran ${precioPromocion} a tu tarjeta. ¿Proceder?`);
    var idPromocion = $(this).attr("id-promocion");
    if(confirmacion){
      var fd = new FormData();
      fd.append("idPromocion",idPromocion);
      $.ajax({
        url: "http://localhost/POO/Proyecto/AstroPromo/api/venta.php?accion=compra",
        method: "POST",
        data: fd,
        contentType:false,
        processData: false,
        success: (res) => {
          console.log(res);
          if (res.valido) {
            alert("Compra realizada correctamente");
          } else {
            alert("No se pudo procesar la compra correctamente")
          }
          $(this).html('Comprar');
          $(this).attr("disabled", false);
        },
        error: (error) => {
          console.log(error);
          alert("Sucedio un error")
          $(this).attr('disabled', false);
          $(this).html('Comprar');
        }
    
      });
    }else{
      $(this).attr("disabled", false);
      $(this).html('Comprar');
    }
  });
}


function realizarCompra(nombrePromocion,precioPromocion,idPromocion){

    $("#btn-compra-"+idPromocion).html('Procesando');
    $("#btn-compra-"+idPromocion).attr("disabled", true);
    var confirmacion = confirm(`Vas a comprar ${nombrePromocion}, se cargaran ${precioPromocion} a tu tarjeta. ¿Proceder?`);
    if(confirmacion){
      var fd = new FormData();
      fd.append("idPromocion",idPromocion);
      $.ajax({
        url: "http://localhost/POO/Proyecto/AstroPromo/api/venta.php?accion=compra",
        method: "POST",
        data: fd,
        contentType:false,
        processData: false,
        success: (res) => {
          console.log(res);
          if (res.valido) {
            alert("Compra realizada correctamente");
          } else {
            alert("No se pudo procesar la compra correctamente")
          }
          $("#btn-compra-"+idPromocion).html('Comprar');
          $("#btn-compra-"+idPromocion).attr("disabled", false);
        },
        error: (error) => {
          console.log(error);
          alert("Sucedio un error")
          $("#btn-compra-"+idPromocion).attr('disabled', false);
          $("#btn-compra-"+idPromocion).html('Comprar');
        }
    
      });
    }else{
      $("#btn-compra-"+idPromocion).attr("disabled", false);
      $("#btn-compra-"+idPromocion).html('Comprar');
    }

}

$("#btn-actualizarCliente").click(function () {
  var dato_fotoperfil = $('#fotoPerfil').prop("files")[0];
  var dato_fotoportada = $('#fotoPortada').prop("files")[0];
  var fd = new FormData();
  fd.append("fotoPerfil", dato_fotoperfil);
  fd.append("fotoPortada", dato_fotoportada);
  $("form#form-actualizarCliente :input").each(function () {
    if ($(this).attr("type") != "file"){
      fd.append($(this).attr("name"), $(this).val());
      console.log($(this).attr("name"));
    }
  });
  $(this).attr('disabled', true);
  $(this).html('Cargando...');
  console.log(fd.get("fotoPerfil"));
  $.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/cliente.php?accion=actualizarCliente",
    method: "POST",
    data: fd,
    contentType:false,
    processData: false,
    success: (res) => {
      if (res.valido) {
        $('#perfil-nombre').html(res.nombre + " " + res.apellido);
        $('#perfil-genero').html(res.genero);
        $('#perfil-fechaNacimiento').html(res.fechaNacimiento);
        $('#perfil-numeroTelefono').html(res.numeroTelefono);
        $('#perfil-fotoPerfil').attr("src", res.fotoPerfil);
        $('#perfil-fotoPortada').css("background-image", 'url(' + res.fotoPortada + ')');
      } else {
        alert("Sucedio un problema al actualizar el perfil")
      }
      $(this).attr('disabled', false);
      $(this).html('Actualizar');
    },
    error: (error) => {
      console.log(error);
      alert("Sucedio un error")
      $(this).attr('disabled', false);
      $(this).html('Actualizar');
    }

  });

});

