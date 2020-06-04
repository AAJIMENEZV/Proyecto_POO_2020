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

const tilesProvider = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
var latitud;
var longitud;
let miMapa = L.map('mapa').setView([51.505, -0.09], 13)

L.tileLayer(tilesProvider, {
  maxZoom: 20
}).addTo(miMapa)

let marker2;
miMapa.doubleClickZoom.disable();
miMapa.on('click', e => {
  let latLng = miMapa.mouseEventToLatLng(e.originalEvent)
  marker2 = L.marker([latLng.lat, latLng.lng], { draggable: true }).addTo(miMapa)
  marker2.on("dragend", function (e) {
    latitud = document.getElementById("latitud").value = e.target.getLatLng().lat;
    longitud = document.getElementById("longitud").value = e.target.getLatLng().lng;
    console.log("Latitud: " + latitud + " " + "Longitud: " + longitud);
  });
})

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
  $.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/empresa.php?accion=productos",
    method: "GET",
    dataType: 'json',
    success: (res) => {
      if (res.valido) {
        if (res.productos.length > 0) {
          var tarjetas = "";
          $.each(res.productos, function (index, value) {
            var jsonValue = value;
            selectProducto(jsonValue);
            tarjetas += tarjetaProducto(jsonValue);
          });
          $("#tarjetasProductos").html(tarjetas);
        } else {
          $("#tarjetasProductos").html("Aún no tienes productos");
        }
      } else {
        $("#tarjetasProductos").html("Aún no tienes productos");

      }
    },
    error: (error) => {
      console.log(error);
      alert("Sucedió un error al cargar el perfil");
    }

  });
  




  $.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/empresa.php?accion=sucursales",
    method: "GET",
    dataType: 'json',
    success: (res) => {
      if (res.valido) {
        if (res.sucursales.length > 0) {
          var tarjetas = "";
          $.each(res.sucursales, function (index, value) {
            var jsonValue = value;
            selectSucursal(jsonValue);
            tarjetas += tarjetaSucursal(jsonValue);
          });
          $("#tarjetaSucursales").html(tarjetas);
        } else {
          $("#tarjetaSucursales").html("Aún no tienes sucursales");
        }
        if(res.sucursales.length != 0){
          $.each(res.sucursales, function (index, value) {
            console.log(value);
            llenarMapa(value);
          });
        }
      } else {
        $("#tarjetaSucursales").html("Aún no tienes sucursales");

      }
    },
    error: (error) => {
      console.log(error);
      alert("Sucedió un error al cargar el perfil");
    }

  });
 


  $.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/empresa.php?accion=promociones",
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
          $("#tarjetaPromociones").html("Aún no tienes promociones");
        }
      } else {
        $("#tarjetaPromociones").html("Aún no tienes promociones");

      }
    },
    error: (error) => {
      console.log(error);
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
      console.log($(this).attr("name") + " " + ":" + " " + $(this).val());
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

$("#btn-registrarSucursal").click(function () {
  var dato_fotoSucursal = $('#foto-Sucursal').prop("files")[0];
  console.log(dato_fotoSucursal);
  var infoSucursal = new FormData();
  infoSucursal.append("foto-Sucursal", dato_fotoSucursal);
  $("form#form-sucursal :input").each(function () {
    if ($(this).attr("type") != "file") {
      console.log($(this).attr("name") + " " + ":" + " " + $(this).val());
      infoSucursal.append($(this).attr("name"), $(this).val());
    }
  });
  $(this).attr('disabled', true);
  $(this).html('Cargando...');
  console.log(infoSucursal);
  $.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/sucursal.php?accion=registro",
    method: "POST",
    data: infoSucursal,
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

$("#btn-registrarPromocion").click(function () {
  var dato_fotoPromocion = $('#imagenPromocion').prop("files")[0];
  console.log(dato_fotoPromocion);
  var infoPromocion = new FormData();
  infoPromocion.append("imagenPromocion", dato_fotoPromocion);
  $("form#form-promocion :input").each(function () {
    if ($(this).attr("type") != "file") {
      console.log($(this).attr("name") + " " + ":" + " " + $(this).val());
      infoPromocion.append($(this).attr("name"), $(this).val());
    }
  });
  $(this).attr('disabled', true);
  $(this).html('Cargando...');
  console.log(infoPromocion);
  $.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/promocion.php?accion=registro",
    method: "POST",
    data: infoPromocion,
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

function selectProducto(jsonProducto) {
  document.getElementById("selectProducto").innerHTML+= `
  <option price="${jsonProducto["precio"]}" value="${jsonProducto["id"]}">${jsonProducto["nombreProducto"]}</option>
  `;

}
$("#selectProducto").change(function(){
  $("#precioNormal").val($(this).find(":selected").attr("price")); 
  $("#descuento").change();
});

$("#descuento").change(function(){
  var inversoDescuento = 1 - ($(this).val()/100);
  var precioOferta = inversoDescuento *  $("#precioNormal").val();
  $("#precioOferta").val(precioOferta); 
});

$("#descuento").keyup(function(){
  var inversoDescuento = 1 - ($(this).val()/100);
  var precioOferta = inversoDescuento *  $("#precioNormal").val();
  $("#precioOferta").val(precioOferta); 
});



function selectSucursal(jsonSucursal) {
  document.getElementById("selectSucursal").innerHTML+= `
  <option value="${jsonSucursal["id"]}">${jsonSucursal["codigoSucursal"]}</option>
  `;

}
/*function cambiarProducto () {
  let productoSeleccionado = document.querySelector('#selectProducto').value;
  $('#precioNormal').attr("value", productoSeleccionado.precio);

  return productoSeleccionado;
}*/
function tarjetaProducto(jsonProducto) {
  var tarjeta = `
  <div class="col-12 col-sm-6">
    <div class="card" style="padding: 10px; height: 500px;">
      <img class="card-img-top" src="${jsonProducto["fotoProducto"]}" >
        <div class="card-block">
          <img class="img-profile-folow" src=${jsonProducto["logotipo"]} alt="">
            <h4>${jsonProducto["nombreProducto"]}</h4>
            <p class="card-text">${jsonProducto["descripcion"]}</p>
            <p class="category">Precio: <span> ${jsonProducto["precio"]}</span></p>
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
        <img class="img-profile-folow" src="${jsonPromocion["logotipo"]}" alt="">
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
          <div class="card carta-empres " style="padding: 10px;">
            <img class="card-img-top" src="${jsonPromocion["imagenPromocion"]}" alt="Camisa Barsa">
            <div class="card-block">
              <img class="img-profile-folow" src="${jsonPromocion["logotipo"]}" alt="">
              <h4>${jsonPromocion["nombrePromocion"]}</h4>
              <p class="card-text">${jsonPromocion["descripcionPromocion"]}</p>
              <p class="category"><span>Precio Normal: ${jsonPromocion["precioNormal"]}</span>  | <span>Oferta: ${jsonPromocion["descuento"]} </span> </p>
              <p class="category"><span>Precio Oferta: ${jsonPromocion["precioOferta"]} </span> | <span>Fecha Inicio: ${jsonPromocion["fechaInicio"]}</span>  </p>
              <p class="category">Fecha Vencimiento: ${jsonPromocion["fechaVencimiento"]}</p>

            </div>
          </div>
        </div>
      </div>
    </div>
  `;
  return tarjeta;

}
function tarjetaSucursal(jsonSucursal) {
  
  var tarjeta = `
    <div class="col-12 col-sm-6">
      <div class="card " style="padding: 10px; height:450px;">
        <div id="mapa-sucural-${jsonSucursal["id"]}" style="height: 250px; width: 250px;">

        </div>
        <div class="card-block">
          <img class="img-profile-folow" src=${jsonSucursal["fotoSucursal"]} alt="">
          <h4>${jsonSucursal["codigoSucursal"]}</h4>
          <p class="card-text">${jsonSucursal["direccionSucursal"]}.</p>
        </div>
      </div>
    </div>
  `;
  return tarjeta;
}
function llenarMapa(jsonSucursal){
  const tilesProvider = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
  var latitud = jsonSucursal["latitud"];
  var longitud = jsonSucursal["longitud"];
  let miMapa = L.map('mapa-sucural-'+jsonSucursal["id"]).setView([latitud, longitud], 10)
  L.tileLayer(tilesProvider, {
    maxZoom: 20
  }).addTo(miMapa)
  let marker = L.marker([latitud, longitud]).addTo(miMapa);
}
$("#btn-actualizarEmpresa").click(function () {
  var dato_logotipo = $('#logotipo').prop("files")[0];
  var dato_banner = $('#banner').prop("files")[0];
  var fd = new FormData();
  fd.append("fotoPerfil", dato_logotipo);
  fd.append("fotoPortada", dato_banner);
  $("form#form-actualizarEmpresa :input").each(function () {
    if ($(this).attr("type") != "file"){
      fd.append($(this).attr("name"), $(this).val());
    }
  });
  $(this).attr('disabled', true);
  $(this).html('Cargando...');
  console.log(fd);
  $.ajax({
    url: "http://localhost/POO/Proyecto/AstroPromo/api/empresa.php?accion=actualizarEmpresa",
    method: "PUT",
    data: fd,
    contentType: false,
    processData: false,
    success: (res) => {
      console.log(res);
      if (res.valido) {
        window.location.href = 'perfilEmpresa.html';
      } else {
        alert(res.mensaje)
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
