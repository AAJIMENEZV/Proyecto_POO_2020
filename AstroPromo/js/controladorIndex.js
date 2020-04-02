function inicio(){
    function traerDatoEmpresa(){
      var xmlhttp = new XMLHttpRequest();
     
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          console.log(data);
        }
      };
      xmlhttp.open('GET', 'data/dataEmpresa.json', true);
      xmlhttp.send();
    }
    function traerDatoCliente(){
      var xmlhttp = new XMLHttpRequest();
     
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          console.log(data);
        }
      };
      xmlhttp.open('GET', 'data/dataCliente.json', true);
      xmlhttp.send();
    }
    function traerDatoLogin(){
      var xmlhttp = new XMLHttpRequest();
     
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          console.log(data);
        }
      };
      xmlhttp.open('GET', 'data/dataLogin.json', true);
      xmlhttp.send();
    }
    traerDatoEmpresa();
    traerDatoCliente();
    traerDatoLogin();
  
  }
  inicio();
  