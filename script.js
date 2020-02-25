$(function($){
    console.log("ola");

     var name= $("#name").val();
     var email= $("#email").val();
     console.log("nome = " + nome + "email = " + email);

    $("form").submit(function(event) {

        event.preventDefault();

        $.ajax({
        url: "https://formspree.io/filipe.ferraz32@gmail.com", 
        method: "POST",
        data: {
            name: $("#name").val(),
            email: $("#email").val()
        },
        dataType: "json"
        }).done(function(){
            $("#name").val("");
            $("#email").val("");
            alert("Email enviado com sucesso!");
        }).fail(function(){
            alert("Erro ao enviar email!");
        });
        });

        
    
    
    
});