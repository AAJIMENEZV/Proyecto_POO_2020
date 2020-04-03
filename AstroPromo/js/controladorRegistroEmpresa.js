
(function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
  
function traerDatoEmpresa() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open('GET', 'data/dataEmpresa.json', true);
  xmlhttp.send();
  xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
           let data = JSON.parse(this.responseText);
          
          return data;
      }
  };
  
}
 var leerdatos = traerDatoEmpresa();
console.log(leerdatos);

function guardarEmpresa() {
  let empresa = {
      nombreEmpresa: document.getElementById('nombreEmpresa').value,
      pais: document.getElementById('paisEmpresa').value,
      direccion: document.getElementById('direccionEmpresa').value,
      logotipo:document.getElementById('logotipoEmpresa').value,
      telefono:document.getElementById('telefonoEmpresa').value,
      correo:document.getElementById('correoEmpresa').value,
      contrasena:document.getElementById('contrasenaEmpresa').value
  };
  console.log(empresa);
}
