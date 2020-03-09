$("#btn-login").click(function(){
   let parametros = $("#form-login").serialize();
   $.ajax({
       url:"../ajax/cliente/?action=login",
       method:"POST",
       data:parametros,
       dataType:"json",
       success:(res)=>{
            console.log(res);
       },
       error:(error)=>{
            console.log(error);
       }
   });
});