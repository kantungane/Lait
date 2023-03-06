

$(document).ready(function() {

 $('#prenom').change(function() {
                var prenom =$(this).val();
                 var nom =$('#nom').val();
                 var cate =$('#categorie').val();
                     $.get("../Script/AboLivraison.php", {cate:cate,nom: nom, prenom : prenom},function(repos){
                     $('#periode').html(repos); 
                          });
              });


 $('#montant').click(function() {
                var periode =$('#periode').val();
                 var nom =$('#nom').val();
                 var cate =$('#categorie').val();
                 var prenom =$('#prenom').val();
                 
  $.get("../Script/AboMontant.php", {cate:cate,nom: nom, prenom : prenom,periode : periode},function(monta){
                    
    $('#montant').val(monta); 
                          });

  $.get("../Script/AboReste.php", {cate:cate,nom: nom, prenom : prenom,periode : periode},function(resta){
                    
    $('#reste').val(resta); 
                          });

   });

$('#cash').keyup(function() {
                  var CashKey= $(this).val();
                 var periode =$('#periode').val();
                 var nom =$('#nom').val();
                 var cate =$('#categorie').val();
                 var prenom =$('#prenom').val();
              

  $.get("../Script/AboCash.php",{CashKey : CashKey,cate : cate,nom: nom, prenom : prenom,periode : periode},function(mycash){              
 
  $('#reste').val(mycash); 
          
  if($('#reste').val() < 0){alert("Kirazira Kuriha Ifaranga Zirenga!")}
                              });
});


 $('#categorie').change(function() {
    $('#nom').val('');             
  $('#prenom').val('');
   $('#periode').val('');
    $('#montant').val('');
     $('#reste').val('');
      $('#cash').val('');
                              });

  $('#nom').change(function() {
              
          $('#prenom').val('');
           $('#periode').val('');
            $('#montant').val('');
            $('#reste').val('');
            $('#cash').val('');
       });

    $('#prenom').change(function() {
     
           $('#periode').val('');
            $('#montant').val('');
            $('#reste').val('');
            $('#cash').val('');
       });

    $('#periode').change(function() {
            $('#montant').val('');
            $('#reste').val('');
            $('#cash').val('');
       });

 });


