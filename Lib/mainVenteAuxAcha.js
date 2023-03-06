

$(document).ready(function() {

 

$('#quantite').keyup(function() {
                  var quantiKey= $(this).val();
                 var unit =$('#unitaire').val();
                 var montant=unit*quantiKey;
                  $('#montant').val(montant) 
              });



  $('#unitaire').keyup(function() {
              
          $('#montant').val('');
           $('#quantite').val('');
           
       });

  
    
 });



