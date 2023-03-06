

$(document).ready(function() {

 

$('#fin').change(function() {
                  var fin= $(this).val();
                 var debut =$('#debut').val();

 $.get("../Script/VenteTempo.php", {debut:debut,fin: fin},function(Tempo){
                   
    $('#repo').html(Tempo); 
              });
        });


  
 });



