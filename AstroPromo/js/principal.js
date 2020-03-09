// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    "use strict";
    window.addEventListener(
        "load",
        function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName(
                "needs-validation"
            );
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(
                forms,
                function (form) {
                    form.addEventListener(
                        "submit",
                        function (event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add("was-validated");
                        },
                        false
                    );
                }
            );
        },
        false
    );
})();

let mostrar = () => {
    let dRegistrar = document.querySelector("#registrar");
    dRegistrar.className = "d-block"
};

let previsualizacion = function(){
    document.getElementById("icono-empresa").onchange = function(e){
        let reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
        
        reader.onload = function(){
            let preview =document.getElementById('preview'),
            image= document.createElement('img');
            image.className = "img-fluid";
            image.src = reader.result;
            preview.innerHTML = '';
            preview.append(image);
        };
    }
    
}

document.addEventListener("DOMContentLoaded",previsualizacion);