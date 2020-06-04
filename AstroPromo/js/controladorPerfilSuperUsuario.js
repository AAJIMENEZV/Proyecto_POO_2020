$(document).ready(function () {
    $.ajax({
        url: "http://localhost/POO/Proyecto/AstroPromo/api/usuario.php?accion=obtenerEmpresas",
        method: "GET",
        dataType: 'json',
        success: (res) => {
            if (res.valido) {
              if (res.empresas.length > 0) {
                var tarjetas = "";
                $.each(res.empresas, function (index, value) {
                  var jsonValue = value;
                  tarjetas += tarjetasEmpresas(jsonValue);
                });
                $("#tarjetasEmpresas").html(tarjetas);
              } else {
                $("#tarjetasEmpresas").html("Aún no hay empresas");
              }
            } else {
              $("#tarjetasEmpresas").html("Aún no hay empresas");
      
            }
        },
        error: (error) => {
            console.log(error);
            alert("Sucedió un error al cargar el perfil");
        }

    });

    $.ajax({
        url: "http://localhost/POO/Proyecto/AstroPromo/api/usuario.php?accion=obtenerClientes",
        method: "GET",
        dataType: 'json',
        success: (res) => {
            if (res.valido) {
              if (res.clientes.length > 0) {
                var tarjetas = "";
                $.each(res.clientes, function (index, value) {
                  var jsonValue = value;
                  tarjetas += tarjetasClientes(jsonValue);
                });
                $("#tarjetasClientes").html(tarjetas);
              } else {
                $("#tarjetasClientes").html("Aún no hay clientes");
              }
            } else {
              $("#tarjetasClientes").html("Aún no hay clientes");
      
            }
        },
        error: (error) => {
            console.log(error);
            alert("Sucedió un error al cargar el perfil");
        }

    });
});
function tarjetasEmpresas(jsonEmpresa) {
    var tarjeta = `
    <div class="col-12 col-sm-6">
        <div class="card" style="height: 450px !important;">
            <img class="card-img-top" src="${jsonEmpresa["banner"]}" >
            <div class="card-block">
                <img class="img-profile-folow" src="${jsonEmpresa["logotipo"]}" alt="">
                <h4 style="margin-bottom: 20px;">${jsonEmpresa["nombreEmpresa"]}</h4>
                <p class="category"><span>Pais: ${jsonEmpresa["pais"]}</span></p>
                <p class="category"> <span>Direccion: ${jsonEmpresa["direccion"]} </span></p>
            </div>
        </div>
    </div>
`;
return tarjeta;
}

function tarjetasClientes(jsonCliente) {
    var tarjeta = `
    <div class="col-12 col-sm-6">
        <div class="card" style="height: 450px !important;">
            <img class="card-img-top" src="${jsonCliente["fotoPortada"]}" >
            <div class="card-block">
                <img class="img-profile-folow" src="${jsonCliente["fotoPerfil"]}" alt="">
                <h4 style="margin-bottom: 20px;">${jsonCliente["nombre"]} ${jsonCliente["apellido"]}</h4>
                <p class="category"><span>Nacimiento: ${jsonCliente["fechaNacimiento"]}</span></p>
                <p class="category"> <span>Genero: ${jsonCliente["genero"]} </span></p>
            </div>
        </div>
    </div>
`;
return tarjeta;
}