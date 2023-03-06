

$(document).ready(function() {

 

$('#fin').change(function() {
                  var fin= $(this).val();
                 var debut =$('#debut').val();

 $.get("../Script/PayTempo.php", {debut:debut,fin: fin},function(Tempo){
                   
    $('#repo').html(Tempo); 
              });
        });





