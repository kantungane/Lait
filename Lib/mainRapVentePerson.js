

$(document).ready(function() {

  $('#nom').change(function() {
              
          $('#prenom').val('');
           $('#debut').val('');
            $('#fin').val('');
           
       });

 $('#prenom').change(function() {
              
           $('#debut').val('');
            $('#fin').val('');
           
       });
  $('#debut').change(function() {
        
            $('#fin').val('');
           
       });

$('#fin').change(function() {

                  var fin= $(this).val();
                   var prenom= $('#prenom').val();
                 var nom =$('#nom').val();
                 var debut =$('#debut').val();

 $.get("../Script/VentePerson.php", {fin: fin,prenom:prenom,nom: nom,debut:debut},function(VentePerson){
                   
    $('#repo').html(VentePerson); 
              });
        });



 });



