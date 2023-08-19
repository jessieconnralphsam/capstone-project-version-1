<!DOCTYPE html>
<!--
Author: Jessie Conn Ralph M. Sam
Contact: jessieconnralph.sam@msugensan.edu.ph
         jcmanzosam@gmail.com
Capstone Group: Capstonics(2023)
-->
<!-- database connection -->
<?php include "data_con.php";?>
<!--login validation-->
<?php 
session_start(); 
if(!isset($_SESSION['user_id'])){ 
    header('Location: index.php'); 
    exit;
}
?>
<!--C.R acidity -->
<?php
      $query = "SELECT * FROM acidity ORDER BY acid_cdate DESC LIMIT 1";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
         $data_acidity[] = $row['acid_readings'];
         $data_date[] = $row['acid_cdate'];
      }
   ?>

<!--Current Readings TDS -->
<?php
      $query = "SELECT * FROM total_dissolved_solids ORDER BY tds_cdate DESC LIMIT 1";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
         $data_TDS[] = $row['tds_readings'];
      }
   ?>

<!-- split datetime-->
<?php
$date_str = $data_date[0]; // assuming $data_date[0] contains the datetime string
$datetime = new DateTime($date_str);
$date = $datetime->format('F-d-Y');
?>

<!-- Notification-->
<?php $sql = "SELECT * FROM notifications WHERE status='0' ORDER BY id DESC";
        $res = mysqli_query($conn, $sql); ?>

<!-- TDS fetch value -->
<?php
  // Get the value of $data_TDS[0]
  $value = $data_TDS[0];

  // Set the class based on the value
  if ($value < 300) {
    $class = 'red-text';
  } else if ($value >= 300 && $value <= 800) {
    $class = 'green-text';
  } else {
    $class = 'red-text';
  }
?>
<?php 
$curdata = $data_acidity[0]; // assuming $data_acidity[0] contains the value to be displayed
$color = "";
if ($curdata < 7) {
    $color = "red";
} elseif ($curdata > 7) {
    $color = "red";
} else {
    $color = "green"; // if value is exactly 7, set color to green
}
?>

<!-- data for table -->
<?php
  $datequery="SELECT * FROM temperature ORDER BY temp_cdate DESC";
  $dateconnect=mysqli_query($conn,$datequery);
  $datenum=mysqli_num_rows($dateconnect);

  $flquery = "SELECT * FROM waterflow ORDER BY flow_cdate DESC";
  $flconnect = mysqli_query($conn, $flquery);
  $flnum = mysqli_num_rows($flconnect);

  $levelquery = "SELECT * FROM waterlevel ORDER BY level_cdate DESC";
  $levelconnect = mysqli_query($conn, $levelquery);
  $levelnum = mysqli_num_rows($levelconnect);

  $tdsquery = "SELECT * FROM total_dissolved_solids ORDER BY tds_cdate DESC";
  $tdsconnect = mysqli_query($conn, $tdsquery);
  $tdsnum = mysqli_num_rows($tdsconnect);

  $phquery = "SELECT * FROM acidity ORDER BY acid_cdate DESC";
  $phconnect = mysqli_query($conn, $phquery);
  $phnum = mysqli_num_rows($phconnect);
?>




<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Hydroponics NFT Decision Support System">
    <meta name="keywords" content="Hydroponics, NFT, Decision Support System">
    <meta name="author" content="Capstonics">
    <title>Dashboard | Hydroponics</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: CSS-->
    <link rel="stylesheet" type="text/css" href="css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/chartist.min.css">
    <link rel="stylesheet" type="text/css" href="css/chartist-plugin-tooltip.css">
    <!-- END: CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="css/materialize.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/dashboard-modern.css">
    <link rel="stylesheet" type="text/css" href="css/intro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- END: Page Level CSS-->
  </head>
  <!-- END: Head-->
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns"> 
    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
      <div class="navbar navbar-fixed"> 
        <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-blue no-shadow">
          <div class="nav-wrapper">
            <ul class="navbar-list right">
              <li class="hide-on-large-only search-input-wrapper"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>
              <li>
                 <a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown" href="#" id="notifications"><i  class="fa fa-bell-o" aria-hidden="true" style="font-size: 20px;"><small class="count"><?php echo mysqli_num_rows($res); ?></small></i></a>
              </li>
              <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="image/hydroponicslogo.jpeg" alt="avatar"><i></i></span></a></li>           
            </ul>
            <!-- notifications-dropdown-->
            <ul class="dropdown-content" id="notifications-dropdown">
              <li>
                <h6><strong style="color:black;">NOTIFICATIONS</strong><span class="new badge"><?php echo mysqli_num_rows($res); ?></span></h6>
              </li>
              <li class="divider"></li>
              <?php
              if (mysqli_num_rows($res) > 0) {
                foreach ($res as $item) {
                  $formatted_date = date("F-d-Y h:i A", strtotime($item["cdate"]));
                  ?>
                  <li>
                    <span style="color: red;">Critical <?php echo $item["notif_sname"]; ?>! Reading: <?php echo $item["readings"]; ?></span>
                    <?php echo $formatted_date; ?>
                  </li>
                  <li class="divider"></li>
                  <?php
                }
              }
              ?>
            </ul>
            <!-- profile-dropdown-->
            <ul class="dropdown-content" id="profile-dropdown">
              <li><a class="grey-text text-darken-1" href="logout.php"><i class="material-icons">keyboard_tab</i> Logout</a></li>
            </ul>
          </div>
          <nav class="display-none search-sm">
            <div class="nav-wrapper">
              <form id="navbarForm">
                <div class="input-field search-input-sm">
                  <input class="search-box-sm mb-0" type="search" required="" id="search" placeholder="Explore Materialize" data-search="template-list">
                  <label class="label-icon" for="search"><i class="material-icons search-sm-icon">search</i></label><i class="material-icons search-sm-close">close</i>
                  <ul class="search-list collection search-list-sm display-none"></ul>
                </div>
              </form>
            </div>
          </nav>
        </nav>
      </div>
    </header>
    <!-- END: Header-->
    <ul class="display-none" id="page-search-title">
      <li class="auto-suggestion-title"><a class="collection-item" href="#">
          <h6 class="search-title">PAGES</h6></a></li>
    </ul>
    <ul class="display-none" id="search-not-found">
      <li class="auto-suggestion"><a class="collection-item display-flex align-items-center" href="#"><span class="material-icons">error_outline</span><span class="member-info">No results found.</span></a></li>
    </ul>
    <!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark sidenav-active-normal">
      <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="ph.php"><span class="logo-text hide-on-med-and-down"style="font-size:25px;">Hydroponics NFT</span></a><a class="navbar-toggler" href="#"></a></h1>
      </div>
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="active bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">dashboard</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge pill blue float-right mr-10">1</span></a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li class=""><a class="" href="main.php"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modern">Main</span></a>
              </li>
            </ul>
          </div>
      </ul>
      <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>
    <!-- END: SideNav-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-blue"></div>
        <div class="col s12">
          <div class="container">
            <div class="section">
   <!-- Search Bar-->
   <div class="row vertical-modern-dashboard">
      <!--<p style="color:white;">Search Anything About NFT Hydroponics below</p>           
      <div class="gcse-search"></div> -->
      <div class="col s12 m8 l8 animate fadeLeft">
         <!-- pH Level -->
         <div class="card">
          <div class="card-move-up waves-effect waves-block waves-light">
            <div class="move-up cyan darken-1">
               <div>
                  <span class="chart-title white-text"> <strong>Water Quality</strong></span>
                  <div class="chart-revenue cyan darken-2 white-text">
                     <p class="chart-revenue-total"><?php echo $date; ?></p>
                     <p class="chart-revenue-per"><i class="material-icons">arrow_drop_up</i> <strong>Readings</strong></p>
                  </div>                 
               </div>
               <div class="trending-line-chart-wrapper"><canvas id="revenue-line-chart" height="180"></canvas>
               </div>               
            </div>
         </div>
         <div class="card-content">
                  <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                     <i class="material-icons activator">folder</i>
                  </a>
                  <div class="col s12 m3 l3">
                    
                  </div>                  
                  <div class="col s12 m5 l6">                     
                  </div>
          </div>
          <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4">Readings: <i
                        class="material-icons right">close</i> <br>
                        <a href="download.php" style="text-decoration: underline;">Download CSV</a>
                  </span>
                  <table class="responsive-table">
                     <thead>
                        <tr>
                           <th>Date & Time</th>
                           <th>Acidity</th>
                           <th>Total Dissolved Solids</th>
                           <th>Temperature</th>
                           <th>Water Flow</th>
                           <th>Water Level</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php
                        if ($datenum > 0){
                           while($data=mysqli_fetch_assoc($dateconnect)){
                              $flowdata = mysqli_fetch_assoc($flconnect);
                              $ldata = mysqli_fetch_assoc($levelconnect);
                              $acdata = mysqli_fetch_assoc($phconnect);
                              $tddata = mysqli_fetch_assoc($tdsconnect);
                              // color sa data 
                              $phColor = ($acdata['acid_readings'] < 7 || $acdata['acid_readings'] > 7) ? 'color: red;' : 'color: green;';
                              $tdsColor = ($tddata['tds_readings'] > 500 || $tddata['tds_readings'] < 300) ? 'color: red;' : 'color: green;';
                              $tempColor = ($data['temp_readings'] > 25) ? 'color: red;' : 'color: green;';
                              $flowColor = ($flowdata['flow_readings'] < 1) ? 'color: red;' : 'color: green;';
                              $levelColor = ($ldata['level_readings'] <= 10) ? 'color: red;' : 'color: green;';                            
                              echo "
                              <tr>
                              <td> ".date('F-d-Y H:i A', strtotime($data['temp_cdate']))."</td>
                              <td style='$phColor'>pH of " . $acdata['acid_readings'] . "</td>
                              <td style='$tdsColor'>" . $tddata['tds_readings'] . " ppm</td>
                              <td style='$tempColor'>" . $data['temp_readings'] . " °C</td>
                              <td style='$flowColor'>" . $flowdata['flow_readings'] . " L/min</td>
                              <td style='$levelColor'>" . $ldata['level_readings'] . " m</td>
                              ";
                           }
                        }
                     ?>
                     </tbody>
                  </table>
            </div>
         </div>
      </div>
      <div class="col s12 l3 " >
         <div class="card animate fadeRight">
            <div class="card-content">
               <h4 class="card-title mb-0">pH Conversion</h4>
               <div class="conversion-ration-container mt-8">
                  <img src="image/pH scale.png" alt="Description of the image" width="205" height="410">                
               </div>
               <p class="medium-small center-align">Current Reading</p>
               <h5 class="center-align mb-0 mt-0">pH of <span style="color:<?php echo $color; ?>"><?php echo $curdata; ?></span></h5>
            </div>
         </div>
      </div>
   </div>
   <!--Dissolved Solids-->
   <div class="row">
      <div class="col s12 l5">
         <!-- Conversion TDS -->
         <div class="card user-statistics-card animate fadeLeft">
            <div class="card-content" style>
              <div id="dual_x_div" style="width: 300px; height: 300px;"></div>
            </div>
         </div>
      </div>
      <div class="col s12 l4">
         <!-- Reading TDS -->
         <div class="card recent-buyers-card animate fadeUp"style="width: 500px;">
            <div class="card-content">
               <h4 class="card-title mb-0">Total Dissolved Solids Conversion</h4>
               <img src="image/TDS.png" alt="Description of the image" width="460" height="230">
               <h4 class="card-title mb-0">Current Reading: <span class="<?php echo $class; ?>"><?php echo $value; ?> </span> ppm</h4>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Intro -->
<div id="intro">
    <div class="row">
        <div class="col s12">

            <div id="img-modal" class="modal white">
                <div class="modal-content">
                    <div class="bg-img-div"></div>
                    <p class="modal-header right modal-close">
                        Skip Introduction <span class="right"><i class="material-icons right-align">clear</i></span>
                    </p>
                    <div class="carousel carousel-slider center intro-carousel">
                        <div class="carousel-fixed-item center middle-indicator">
                            <div class="left">
                                <button class="movePrevCarousel middle-indicator-text btn btn-flat purple-text waves-effect waves-light btn-prev">
                                    <i class="material-icons">navigate_before</i> <span class="hide-on-small-only">Prev</span>
                                </button>
                            </div>

                            <div class="right">
                                <button class=" moveNextCarousel middle-indicator-text btn btn-flat purple-text waves-effect waves-light btn-next">
                                    <span class="hide-on-small-only">Next</span> <i class="material-icons">navigate_next</i>
                                </button>
                            </div>
                        </div>
                        <div class="carousel-item slide-1">
                            <img src="image/intro-slide-1.png" alt="" class="responsive-img animated fadeInUp slide-1-img">
                            <h5 class="intro-step-title mt-7 center animated fadeInUp">Welcome to NFT Hydroponics Decision Support System</h5>
                            <p class="intro-step-text mt-5 animated fadeInUp">NFT (Nutrient Film Technique) hydroponics is a 
                               method of growing plants in a soilless
                               system where a thin film of nutrient-rich water flows over the roots of the plants. 
                              A Decision Support System (DSS) is a computerized system that helps users make decisions 
                              by providing them with information and tools to analyze data.</p>
                        </div>
                        <div class="carousel-item slide-1">
                            <img src="image/nft.jpg" alt="nft system"  style="width: 380px; height: 220px;">
                            <h5 class="intro-step-title mt-7 center animated fadeInUp">NFT Hydroponics</h5>
                            <p class="intro-step-text mt-5 animated fadeInUp">NFT hydroponics is a popular choice among indoor growers because 
                               it is a relatively simple and low-maintenance system that requires minimal water usage. Additionally, 
                               the lack of soil makes it easier to control the nutrient levels and pH balance of the water, 
                               leading to healthier and more productive plants.</p>
                        </div>
                        <div class="carousel-item slide-3">
                            <img src="image/intro-app.png" alt="" class="responsive-img slide-1-img">
                            <h5 class="intro-step-title mt-7 center">Showcase Application Features</h5>
                            <div class="row">
                                <div class="col m5 offset-m1 s12">
                                    <ul class="feature-list left-align">
                                        <li><i class="material-icons">check</i> Dashboard
                                        </li>
                                        <li><i class="material-icons">check</i> Realtime Sensor Readings</li>
                                    </ul>
                                </div>
                                <div class="col m6 s12">
                                    <ul class="feature-list left-align">
                                        <li><i class="material-icons">check</i>System Activity</li>
                                        <li><i class="material-icons">check</i> Reports</li>
                                    </ul>
                                </div>
                                <div class="row">
                                    <div class="col s12 center">
                                        <button class="get-started btn waves-effect waves-light gradient-45deg-purple-deep-orange mt-3 modal-close">Get
                                            Started</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Intro -->
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->    
    <!-- BEGIN: Footer-->
    <!-- END: Footer-->
<!------------------------------------------------------------------------------->
    <!-- BEGIN VENDOR JS-->
    <script src="js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="js/chart.min.js"></script>
    <script src="js/chartist.min.js"></script>
    <script src="js/chartist-plugin-tooltip.js"></script>
    <script src="js/chartist-plugin-fill-donut.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="js/plugins.js"></script>
    <script src="js/search.js"></script>
    <script src="js/customizer.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="js/dashboard-modern.js"></script>
    <script src="js/intro.js"></script>
    <script src="js/welcome_message.js"></script>
    <!-- END PAGE LEVEL JS-->
    <!--APIS-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script async src="https://cse.google.com/cse.js?cx=62e63539c10b34139"></script>
  </body>
</html>

<!-- Script: Notifications-->
<script>
    $(document).ready(function() {
      $("#notifications").on("click", function() {
        $.ajax({
          url: "readNotifications.php",
          success: function(res) {
            console.log(res);
          }
        });
      });
    });
  </script>
<!-- Script: Bargraph-->
<!------------------------------------------------------------------------------>
<script type="text/javascript">
   google.charts.load('current', {'packages':['bar']});
   google.charts.setOnLoadCallback(drawStuff);

   function drawStuff() {
     var data = new google.visualization.arrayToDataTable([
       ['Date&Time', 'TDS', 'Temp'],
       //data config php
       <?php
          $queryTDS = "SELECT * FROM total_dissolved_solids ORDER BY tds_cdate DESC LIMIT 1";
          $resTDS = mysqli_query($conn, $queryTDS);

          while ($dataTDS = mysqli_fetch_array($resTDS)) {
              $datetime = date('m-d-Y h:i A', strtotime($dataTDS['tds_cdate'])); // add "AM" or "PM"
              $electric_con = $dataTDS['tds_readings'];
          ?>

          <?php
              $queryTemperature = "SELECT * FROM temperature ORDER BY temp_cdate DESC LIMIT 1";
              $resTemperature = mysqli_query($conn, $queryTemperature);

              while ($dataTemperature = mysqli_fetch_array($resTemperature)) {
                  $temperature = $dataTemperature['temp_readings'];
          ?>

          ['<?php echo $datetime;?>', <?php echo $electric_con;?>, <?php echo $temperature;?>],

          <?php   
              }
          }
        ?>                
     ]);
     var options = {
       width: 300,
       chart: {
         title: 'Temperature & Total Dissolved Solids',
       },
       bars: 'vertical',
       series: {
         0: { axis: 'distance' }, 
         1: { axis: 'brightness' } 
       },
       axes: {
         x: {
           distance: {label: 'parsecs'},
           brightness: {side: 'top', label: 'apparent magnitude'}
         }
       }
     };
   var chart = new google.charts.Bar(document.getElementById('dual_x_div'));
   chart.draw(data, options);  
 };  
 </script>
<!-- End Script: Bargraph-->
<!------------------------------------------------------------------------------> 
<!-- Script: line chart-->
 <script>
    (function (window, document, $) { 
   var revenueLineChartCTX = $("#revenue-line-chart");
   //option block
   var revenueLineChartOptions = {
      responsive: true,
      // maintainAspectRatio: false,
      legend: {
         display: false
      },
      hover: {
         mode: "label"
      },
      scales: {
         xAxes: [
            {
               display: true,
               gridLines: {
                  display: false
               },
               ticks: {
                  fontColor: "#fff"
               }
            }
         ],
         yAxes: [
            {
               display: true,
               fontColor: "#fff",
               gridLines: {
                  display: true,
                  color: "rgba(255,255,255,0.3)"
               },
               ticks: {
                  beginAtZero: true,
                  fontColor: "#fff"
               }
            }
         ]
      }
   };
   //data block
   var labels = [];
   var data = [];
   var flowdata = [];
   var leveldata = [];
  <?php
      $query = "SELECT * FROM acidity ORDER BY acid_cdate DESC LIMIT 5";
      $result = mysqli_query($conn, $query);
      $labels = [];
      $data = [];

      while ($row = mysqli_fetch_assoc($result)) {
          $labels[] = date('h:i A', strtotime($row['acid_cdate']));
          $data[] = $row['acid_readings'];
      }

      $flowquery = "SELECT * FROM waterflow ORDER BY flow_cdate DESC LIMIT 5";
      $flowresult = mysqli_query($conn, $flowquery);
      $flowdata = [];

      while ($flowrow = mysqli_fetch_assoc($flowresult)) {
          $flowdata[] = $flowrow['flow_readings'];
      }

      $levelquery = "SELECT * FROM waterlevel ORDER BY level_cdate DESC LIMIT 5";
      $levelresult = mysqli_query($conn, $levelquery);
      $leveldata = [];

      while ($levelrow = mysqli_fetch_assoc($levelresult)) {
          $leveldata[] = $levelrow['level_readings'];
      }
  ?>
   
   var revenueLineChartData = {
      labels:['Current Readings', <?php echo json_encode($labels[0]); ?>,<?php echo json_encode($labels[1]); ?>, <?php echo json_encode($labels[2]); ?>,<?php echo json_encode($labels[3]); ?>],
      datasets: [
         {
            label: "Acidity",
            data: <?php echo json_encode($data); ?>,
            backgroundColor: "rgba(128, 222, 234, 0.6)",
            borderColor: "white",
            pointBorderColor: "white",
            pointBackgroundColor: "#00bcd4",
            pointHighlightFill: "white",
            pointHoverBackgroundColor: "white",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            pointRadius: 4
         },
         {
            label: "Water Flow",
            data: <?php echo json_encode($flowdata); ?>,
            borderDash: [15, 5],
            backgroundColor: "rgba(128, 222, 234, 0.4)",
            borderColor: "black",
            pointBorderColor: "black",
            pointBackgroundColor: "#00bcd4",
            pointHighlightFill: "black",
            pointHoverBackgroundColor: "black",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            pointRadius: 4
         },
         {
            label: "Water Level",
            data: <?php echo json_encode($leveldata); ?>,
            borderDash: [15, 5],
            backgroundColor: "rgba(128, 222, 234, 0.2)",
            borderColor: "blue",
            pointBorderColor: "blue",
            pointBackgroundColor: "#00bcd4",
            pointHighlightFill: "blue",
            pointHoverBackgroundColor: "blue",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            pointRadius: 4
         }
         
        ]
   };
   //config block
   var revenueLineChartConfig = {
      type: "line",
      options: revenueLineChartOptions,
      data: revenueLineChartData
   };
   // Create the chart
   window.onload = function () {
      revenueLineChart = new Chart(revenueLineChartCTX, revenueLineChartConfig);
   };
})(window, document, jQuery);
</script>
<!-- End Script: line chart-->