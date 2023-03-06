


$(document).ready(function() {

  $('#cash').keyup(function() {
                var idCash =$(this).val();
                 var idPaie=$("#idpaiement").val();
                
               
                 $.get("../Script/ChangeReste.php", {idPaie:idPaie,idCash:idCash},function(reste){
                 	
                  $("#reste").val(reste);
                         }); 


                }); 
});
