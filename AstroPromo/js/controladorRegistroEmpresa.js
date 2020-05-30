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
    var dato_logotipo = $('#logotipo').prop("files")[0];
    var dato_banner = $('#banner').prop("files")[0];
    var fd = new FormData();
    fd.append("logotipo", dato_logotipo);
    fd.append("banner", dato_banner);
    $("form#form-empresa :input").each(function () {
      if ($(this).attr("id") != "logotipo" && $(this).attr("id") != "banner") {
        fd.append($(this).attr("name"), $(this).val());
      }
    });
    $(this).attr('disabled',true);
    $(this).html('Cargando...');
    $.ajax({
      url: "http://localhost/POO/Proyecto/AstroPromo/api/usuario.php?accion=registro&tipo=empresa",
      method: "POST",
      data: fd,
      contentType: false,
    processData: false,
      success: (res) => {
        if (res.valido) {
          window.location.href = 'perfilEmpresa.html';
        } else {
          alert($res.mensaje);
        }
        console.log(res);
      },
      error: (error) => {
        console.log(error);
      }
    });
    $(this).attr('disabled',false);
    $(this).html('Registrate');
});