<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style>

	</style>


<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<script src="../Lib/jquery.js"type="text/javascript"></script>
<script src="../Lib/mainDropdown.js"type="text/javascript"></script>
	
<script src="../Lib/Chart_3.9.1.js"type="text/javascript"></script>


</head>
<body>
<?php 
  require("../Header.php");
  if(isset($_SESSION['username'])){
?>
<div style=" background-image:radial-gradient(pink 10%,steelblue);margin-top: -20px;height: 40px; ">                
<center><h3>Tableau de bord</h3></center>
</div>
  
<?php 
  require("../Side/Sidebar.php");
  require("../Side/database.php");
setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');
?>
 <div class="container" style="height: 625px; margin-top: -650px;margin-left:350px;overflow-y: scroll;position: relative;" id="section">

<div style="height: 650px;width: 600px;">
<canvas id="PayChart"></canvas>
</div>
<?php

$yearnow= date('Y');
$repons=$pdo->prepare("SELECT MONTHNAME(Date_Paiement) as mois,SUM(Cash) as Somme FROM Paiements WHERE YEAR(Date_Paiement) =? GROUP BY mois");
    $repons->execute(array($yearnow));
  

    while( $data1=$repons->fetch(PDO::FETCH_ASSOC)){

          $date1=$data1['mois'];
        $date1fr = utf8_encode(strftime("%B %Y", strtotime($date1)));
        $data1X[]=$date1fr;
        $data1Y[]=$data1['Somme'];
       }
      
    $encod1X = json_encode($data1X);
        $encod1Y = json_encode($data1Y);

        ?>

<script type="text/javascript">

var xValues1 = <?php echo $encod1X?>;
var yValues1 = <?php echo $encod1Y?>;


const myChart = document.getElementById('PayChart').getContext('2d');
  const barChart = new Chart(myChart,{
  type: "line",
   data: {
    labels: xValues1,
    datasets: [{
      fill: false,
      lineTension: 0,
     backgroundColor:["pink","lightgreen","violet","teal","lightblue","rgb(64, 0, 255)","DeepSkyBlue","BlueViolet ","LightSkyBlue","Cyan","SteelBlue","MediumPurple"],
      borderColor: "black",
      pointRadius: 20,
      data: yValues1,
     
    }]
  },
  options: {
        responsive: true,
                                              plugins: {
                                                  legend: {
                                                      position: "top",
                                                       },
                                title: {
                                    display: true,
                                    text: "Paiement mensuel",
                                            },
                                        },

                  scales:{
                    x:{
                      ticks:{
                          font:{
                            size:15
                                }
                            }
                          },

                          y:{
                              ticks:{
                                  font:{
                                    size:15
                                        }
                                  }
                          },
                        }
    },
});


</script>

<div style="height: 650px;width: 600px;margin-left: 700px;margin-top: -650px;">
<canvas id="SpendChart"></canvas>
</div>
<?php
$repons=$pdo->prepare("SELECT MONTHNAME(Date_Paiement) as mois,SUM(Cash) as Somme FROM Paiements WHERE YEAR(Date_Paiement) =? GROUP BY mois");

    $repons->execute(array($yearnow));

    while($data1=$repons->fetch(PDO::FETCH_ASSOC)){

        $reponse=$pdo->prepare("SELECT MONTHNAME(Date_enreg) as month, SUM(Montant) as depense FROM Depenses WHERE YEAR(Date_enreg) =? AND MONTHNAME(Date_enreg)=?");
        $reponse->execute(array($yearnow,$data1['mois']));
         while($data2=$reponse->fetch(PDO::FETCH_ASSOC)){
        $date2=$data1['mois'];
        $date2fr = utf8_encode(strftime("%B %Y", strtotime($date2)));
        $data2X[]=$date2fr;
        $data2Y[]=$data1['Somme']-$data2['depense'];
       }
      }
    $encod2X = json_encode($data2X);
    $encod2Y = json_encode($data2Y);

        ?>

<script type="text/javascript">

var xValues2 = <?php echo $encod2X?>;
var yValues2 = <?php echo $encod2Y?>;


const otherChart = document.getElementById('SpendChart').getContext('2d');
  const pieChart = new Chart(otherChart,{
  type: "line",
   data: {
    labels: xValues2,
    datasets: [{
      fill: false,
      lineTension: 0,
       backgroundColor:["pink","lightgreen","violet","teal","lightblue","rgb(64, 0, 255)","DeepSkyBlue","BlueViolet ","LightSkyBlue","Cyan","SteelBlue","MediumPurple"],
      borderColor: "black",
      pointRadius: 20,
      data: yValues2,
     
    }]
  },
  options: {
        responsive: true,
                                              plugins: {
                                                  legend: {
                                                      position: "top",
                                                       },
                                title: {
                                    display: true,
                                    text: "Chiffre d'affaire mensuel",
                                            },
                                        },

                  scales:{
                    x:{
                      ticks:{
                          font:{
                            size:15
                                }
                            }
                          },

                          y:{
                              ticks:{
                                  font:{
                                    size:15
                                        }
                                  }
                          },
                        }
    },
});


</script>

<div style="height: 600px;width: 600px;margin-top: -300px;">
<canvas id="quantityChart"></canvas>
</div>
<?php
$quantites=$pdo->prepare("SELECT MONTHNAME(Date_Vente) as monthquantity,SUM(Quantite) as AllQuantity FROM Ventes WHERE YEAR(Date_Vente) =? GROUP BY monthquantity");

    $quantites->execute(array($yearnow));

    while($data3=$quantites->fetch(PDO::FETCH_ASSOC)){
        $date3=$data3['monthquantity'];
        $date3fr = utf8_encode(strftime("%B %Y", strtotime($date3)));
        $data3X[]=$date3fr;
        $data3Y[]=$data3['AllQuantity'];
       }
      
    $encod3X = json_encode($data3X);
    $encod3Y = json_encode($data3Y);

        ?>

<script type="text/javascript">

var xValues3 = <?php echo $encod3X?>;
var yValues3 = <?php echo $encod3Y?>;


const ThirdChart = document.getElementById('quantityChart').getContext('2d');
  const lineChart = new Chart(ThirdChart,{
  type: "line",
   data: {
    labels: xValues3,
    datasets: [{
      fill: false,
      lineTension: 0,
       backgroundColor:["pink","lightgreen","violet","teal","lightblue","rgb(64, 0, 255)","DeepSkyBlue","BlueViolet ","LightSkyBlue","Cyan","SteelBlue","MediumPurple"],
      borderColor: "black",
      pointRadius: 20,
      data: yValues3,
     
    }]
  },
  options: {
        responsive: true,
                                              plugins: {
                                                  legend: {
                                                      position: "top",
                                                       },
                                title: {
                                    display: true,
                                    text: "Quantité de lait par mois",
                                            },
                                        },

                  scales:{
                    x:{
                      ticks:{
                          font:{
                            size:15
                                }
                            }
                          },

                          y:{
                              ticks:{
                                  font:{
                                    size:15
                                        }
                                  }
                          },
                        }
    },
});


</script>


<div style="height: 600px;width: 600px;margin-top: -600px;margin-left: 700px;">
<canvas id="depenseChart"></canvas>
</div>
<?php
$depenses=$pdo->prepare("SELECT MONTHNAME(Date_enreg) as monthdepense,SUM(Montant) as AllMontant FROM Depenses WHERE YEAR(Date_enreg) =? GROUP BY monthdepense");

    $depenses->execute(array($yearnow));

    while($data4=$depenses->fetch(PDO::FETCH_ASSOC)){
       $date4=$data4['monthdepense'];
        $date4fr = utf8_encode(strftime("%B %Y", strtotime($date4)));
        $data4X[]=$date4fr;
        $data4Y[]=$data4['AllMontant'];
       }
      
    $encod4X = json_encode($data4X);
    $encod4Y = json_encode($data4Y);

        ?>

<script type="text/javascript">

var xValues4 = <?php echo $encod4X?>;
var yValues4 = <?php echo $encod4Y?>;


const FourChart = document.getElementById('depenseChart').getContext('2d');
  const otherlineChart = new Chart(FourChart,{
  type: "line",
   data: {
    labels: xValues4,
    datasets: [{
      fill: false,
      lineTension: 0,
       backgroundColor:["pink","lightgreen","violet","teal","lightblue","rgb(64, 0, 255)","DeepSkyBlue","BlueViolet ","LightSkyBlue","Cyan","SteelBlue","MediumPurple"],
      borderColor: "black",
      pointRadius: 20,
      data: yValues4,
     
    }]
  },
  options: {
        responsive: true,
                                              plugins: {
                                                  legend: {
                                                      position: "top",
                                                       },
                                title: {
                                    display: true,
                                    text: "Toute Charge mensuele",
                                            },
                                        },

                  scales:{
                    x:{
                      ticks:{
                          font:{
                            size:15
                                }
                            }
                          },

                          y:{
                              ticks:{
                                  font:{
                                    size:15
                                        }
                                  }
                          },
                        }
    },
});


</script>

<div style="height: 400px;width: 400px;margin-top: -200px;">
<canvas id="workerChart"></canvas>
</div>
<?php
$statut="1";
$workers=$pdo->prepare("SELECT Categorie_Travailleur,COUNT(Id_Travailleur) as Nombre FROM Travailleurs WHERE Statut =? GROUP BY Categorie_Travailleur");

    $workers->execute(array($statut));

    while($data5=$workers->fetch(PDO::FETCH_ASSOC)){

        $data5X[]=$data5['Categorie_Travailleur'];
        $data5Y[]=$data5['Nombre'];
       }
      
    $encod5X = json_encode($data5X);
    $encod5Y = json_encode($data5Y);

        ?>

<script type="text/javascript">

var xValues5 = <?php echo $encod5X?>;
var yValues5 = <?php echo $encod5Y?>;


const FiveChart = document.getElementById('workerChart').getContext('2d');
  const WorkersChart = new Chart(FiveChart,{
  type: "pie",
   data: {
    labels: xValues5,
    datasets: [{
      fill: false,
      lineTension: 0,
       backgroundColor:["pink","lightgreen","violet","teal","lightblue","rgb(64, 0, 255)","DeepSkyBlue","BlueViolet ","LightSkyBlue","Cyan","SteelBlue","MediumPurple"],
      borderColor: "black",
      pointRadius: 10,
      data: yValues5,
     
    }]
  },
  options: {
        responsive: true,
                                              plugins: {
                                                  legend: {
                                                      position: "top",
                                                       },
                                title: {
                                    display: true,
                                    text: "Nos Travailleurs Actifs",
                                            },
                                        },

                  scales:{
                    x:{
                      ticks:{
                          font:{
                            size:15
                                }
                            }
                          },

                          y:{
                              ticks:{
                                  font:{
                                    size:15
                                        }
                                  }
                          },
                        }
    },
});


</script>

<div style="height: 400px;width: 400px;margin-top: -400px;margin-left: 700px;">
<canvas id="clientChart"></canvas>
</div>
<?php
$Clients=$pdo->prepare("SELECT Categorie_Abonne,COUNT(Id_Abonnement) as Numbers FROM Abonnements GROUP BY Categorie_Abonne");

    $Clients->execute(array());

    while($data6=$Clients->fetch(PDO::FETCH_ASSOC)){

        $data6X[]=$data6['Categorie_Abonne'];
        $data6Y[]=$data6['Numbers'];
       }
      
    $encod6X = json_encode($data6X);
    $encod6Y = json_encode($data6Y);

        ?>

<script type="text/javascript">

var xValues6 = <?php echo $encod6X?>;
var yValues6 = <?php echo $encod6Y?>;


const SixChart = document.getElementById('clientChart').getContext('2d');
  const AboChart = new Chart(SixChart,{
  type: "pie",
   data: {
    labels: xValues6,
    datasets: [{
      fill: false,
      lineTension: 0,
       backgroundColor:["pink","lightgreen","violet","teal","lightblue","rgb(64, 0, 255)","DeepSkyBlue","BlueViolet ","LightSkyBlue","Cyan","SteelBlue","MediumPurple"],
      borderColor: "black",
      pointRadius: 10,
      data: yValues6,
     
    }]
  },
  options: {
        responsive: true,
                                              plugins: {
                                                  legend: {
                                                      position: "top",
                                                       },
                                title: {
                                    display: true,
                                    text: "Nos Clients Abonnés",
                                            },
                                        },

                  scales:{
                    x:{
                      ticks:{
                          font:{
                            size:15
                                }
                            }
                          },

                          y:{
                              ticks:{
                                  font:{
                                    size:15
                                        }
                                  }
                          },
                        }
    },
});


</script>


<?php
   
 }else{
    ?>
    <center><p style= "color: red;letter-spacing: 1px;" > Vous n'etes pas connectés!! <a href="../Index.php">Connectez-vous</a></p></center>
    <?php
  }
  ?>
</div>
<?php
 require("../Footer.php");
?>
</body>
</html>