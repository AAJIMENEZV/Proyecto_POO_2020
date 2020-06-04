var id;

$(document).ready(function () {
    var params = new URLSearchParams(window.location.search);
    if (params.has('id')) {
        if (params.get("id") != "") {
            id = params.get("id");
            $.ajax({
                url: "http://localhost/POO/Proyecto/AstroPromo/api/empresa.php?accion=perfilVista&id=" + id,
                method: "GET",
                dataType: 'json',
                success: (res) => {
                    if (!res.valido) {
                        window.location.href = 'perfilCliente.html';
                    } else {
                        console.log(res);
                        $('#perfil-nombre').html(res.nombreEmpresa);
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
                url: "http://localhost/POO/Proyecto/AstroPromo/api/empresa.php?accion=promocionesVista&id=" + id,
                method: "GET",
                dataType: 'json',
                success: (res) => {
                    if (!res.valido) {
                        window.location.href = 'perfilCliente.html';
                    } else {
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
                    }
                },
                error: (error) => {
                    alert("Sucedió un error al cargar el perfil");
                }

            });
            $.ajax({
                url: "http://localhost/POO/Proyecto/AstroPromo/api/empresa.php?accion=productosVista&id=" + id,
                method: "GET",
                dataType: 'json',
                success: (res) => {
                    if (!res.valido) {
                        window.location.href = 'perfilCliente.html';
                    } else {
                        if (res.productos.length > 0) {
                            var tarjetas = "";
                            $.each(res.productos, function (index, value) {
                              var jsonValue = value;
                              tarjetas += tarjetaProducto(jsonValue);
                            });
                            $("#tarjetasProductos").html(tarjetas);
                          } else {
                            $("#tarjetasProductos").html("Aún no tienes productos");
                          }
                    }
                },
                error: (error) => {
                    alert("Sucedió un error al cargar el perfil");
                }

            });
            $.ajax({
                url: "http://localhost/POO/Proyecto/AstroPromo/api/empresa.php?accion=sucursalesVista&id=" + id,
                method: "GET",
                dataType: 'json',
                success: (res) => {
                    if (!res.valido) {
                        window.location.href = 'perfilCliente.html';
                    } else {
                        if (res.sucursales.length > 0) {
                            var tarjetas = "";
                            $.each(res.sucursales, function (index, value) {
                              var jsonValue = value;
                              tarjetas += tarjetaSucursal(jsonValue);
                            });
                            $("#tarjetaSucursales").html(tarjetas);
                          } else {
                            $("#tarjetaSucursales").html("Aún no tienes sucursales");
                          }
                          if(res.sucursales.length != 0){
                            $.each(res.sucursales, function (index, value) {
                              llenarMapa(value);
                            });
                          }
                    }
                },
                error: (error) => {
                    alert("Sucedió un error al cargar el perfil");
                }

            });



            $.ajax({
                url: "http://localhost/POO/Proyecto/AstroPromo/api/empresa.php?accion=verificarSeguido&id=" + id,
                method: "GET",
                dataType: 'json',
                success: (res) => {
                    if (!res.valido) {
                        window.location.href = 'perfilCliente.html';
                    } else {
                        if (res.seguido) {
                            $("#btn-seguir").html("Dejar de seguir");
                        } else {
                            $("#btn-seguir").html("Seguir");
                        }
                    }
                },
                error: (error) => {
                    alert("Sucedió un error al cargar el perfil");
                }
            });
        } else {
            window.location.href = 'perfilCliente.html';
        }
    } else {
        window.location.href = 'perfilCliente.html';
    }

});

$("#btn-seguir").click(function () {
    $(this).attr("disabled", true);
    $.ajax({
        url: "http://localhost/POO/Proyecto/AstroPromo/api/empresa.php?accion=seguir&id=" + id,
        method: "POST",
        dataType: 'json',
        success: (res) => {
            if (!res.valido) {
                window.location.href = 'perfilCliente.html';
            } else {
                if (res.seguido) {
                    $("#btn-seguir").html("Dejar de seguir");
                } else {
                    $("#btn-seguir").html("Seguir");
                }
            }
            $(this).attr("disabled", false);
        },
        error: (error) => {
            alert("Sucedió un error al cargar el perfil");
            $(this).attr("disabled", false);
        }
    });
});

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