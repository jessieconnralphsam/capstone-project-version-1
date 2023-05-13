<!DOCTYPE html>
<!--
Author: Jessie Conn Ralph M. Sam
Contact: jessieconnralph.sam@msugensan.edu.ph
Capstone Group: Capstonics(2023)
-->
<!-- database connection -->
<?php include "database_connection.php";?>
<!--login validation-->
<?php 
session_start(); // start the session
if(!isset($_SESSION['user_id'])){ // check if the session variable is set
    header('Location: index.php'); // redirect to the login page if it's not set
    exit;
}
?>
<!--watermetrics-->
<?php
      $query = "select * from ectemp ORDER BY cdate DESC LIMIT 1";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
         $cr_date[] = $row['cdate'];
      }
   ?>
<!--waterfl table-->   
<?php
$query="Select * from watermetrics ORDER BY cdate DESC";
$connect=mysqli_query($conn,$query);
$num=mysqli_num_rows($connect);
?>
<!--temp table-->   
<?php
$query="Select * from ectemp ORDER BY cdate DESC";
$connect2=mysqli_query($conn,$query);
$num2=mysqli_num_rows($connect2);
?>
<!--split datatime-->
<?php
$datestr = $cr_date[0]; // assuming $data_date[0] contains the datetime string
$date_time = new DateTime($datestr);
$crdate = $date_time->format('F-d-Y');
?>
<!-- Notification-->
<?php $sql = "SELECT * FROM notifications WHERE status='0' ORDER BY id DESC";
        $res = mysqli_query($conn, $sql); ?>
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <!-- END: Page Level CSS-->
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
                 <a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown" href="#" id="notifications"><i  class="fa fa-bell-o" aria-hidden="true"style="font-size: 20px;"><small class="count"><?php echo mysqli_num_rows($res); ?></small></i></a>
              </li>
              <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><img src="image/profile.jpg" alt="avatar"><i></i></span></a></li>           
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
                  <li><?php echo $item["text"]; ?></li>
                  <li style="color:blue;"><?php echo $formatted_date; ?></li>
                  <li class="divider"></li> <!-- Add this line after each notification -->
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
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="ph.php"><span class="logo-text hide-on-med-and-down"tyle="font-size:25px;">Hydroponics NFT</span></a><a class="navbar-toggler" href="#"></a></h1>
      </div>
      <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="active bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">dashboard</i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge pill blue float-right mr-10">2</span></a>
          <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
              <li class=""><a class="" href="main.php"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modern">Main</span></a>
              <li><a href="Water_metrics.php"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Analytics">Water Metrics</span></a>
              </li>
            </ul>
          </div>
        </li>        
        <li class="navigation-header"><a class="navigation-header-text">Applications</a><i class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        
          <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i class="material-icons">folder</i><span class="menu-title" data-i18n="Invoice">Report</span></a>
            <div class="collapsible-body">
              <ul class="collapsible collapsible-sub" data-collapsible="accordion">
               <li><a href="system_activity_list.php"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Invoice View">System Activity</span></a>
               </li>
                <li><a href="acidity.php"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Invoice View">pH Level</span></a>
                </li>
                <li><a href="temperature.php"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Invoice Edit">Temperature</span></a>
                </li>
                <li><a href="conductivity.php"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Invoice Add">Conductivity</span></a>
                </li>
                <li><a href="waterflow.php"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Invoice Add">Waterflow</span></a>
                </li>
                <li><a href="waterlevel.php"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Invoice Add">Waterlevel</span></a>
                </li>
              </ul>
            </div>
          </li>
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
   <!-- Charts-->
   <div id="chart-dashboard">
      <div class="row">
         <div class="col s12 m8 l8">
            <div class="card animate fadeUp">
               <div class="card-move-up waves-effect waves-block waves-light">
                  <div class="move-up cyan darken-1">
                     <div>
                        <span class="chart-title white-text">Water Flow & Water Level</span>
                        <div class="chart-revenue cyan darken-2 white-text">
                           <p class="chart-revenue-total"><?php echo $crdate; ?></p>
                           <p class="chart-revenue-per"><i class="material-icons">arrow_drop_up</i> Reading</p>
                        </div>
                     </div>
                     <div class="trending-line-chart-wrapper"><canvas id="revenue-line-chart" height="205"></canvas>
                     </div>                    
                  </div>
               </div>
               <div class="card-content">
                  <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                     <i class="material-icons activator">folder</i>
                  </a>
                  <div class="col s12 m3 l3">
                     <p>Readings Report</p>
                  </div>                  
                  <div class="col s12 m5 l6">                     
                  </div>
               </div>
               <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4">Data Readings <i
                        class="material-icons right">close</i>
                  </span>
                  <table class="responsive-table">
                     <thead>
                        <tr>
                           <th>Date & Time</th>
                           <th>Water Flow</th>
                           <th>Water Level</th>
                        </tr>
                     </thead>
                     <tbody>
                     <?php
                        if ($num > 0){
                           while($data=mysqli_fetch_assoc($connect)){
                              echo "
                              <tr>
                              <td> ".date('F-d-Y H:i A', strtotime($data['cdate']))."</td>
                              <td> ".$data['waterflow']." L/min</td>
                              <td> ".$data['waterlevel']." m</td>
                              ";
                           }
                        }
                     ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="col s12 m4 l4">
            <div class="card animate fadeUp">
               <div class="card-move-up teal accent-4 waves-effect waves-block waves-light">
                  <div class="move-up">
                     <p class="margin white-text">Water Status</p>
                     <canvas id="trending-radar-chart" height="342"></canvas>
                  </div>
               </div>
               <div class="card-content  teal">
                  <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                     <i class="material-icons activator">done</i>
                  </a>
                  <div class="line-chart-wrapper">
                     <p class="margin white-text">Water Temperature</p>
                     <canvas id="line-chart" height="160"></canvas>
                  </div>
               </div>
               <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4">Data Readings<i
                        class="material-icons right">close</i>
                  </span>
                  <table class="responsive-table">
                     <thead>
                        <tr>
                           <th>Date & Time</th>
                           <th>Temperature</th> 
                        </tr>
                     </thead>
                     <tbody>
                     <?php
                        if ($num2 > 0){
                           while($data=mysqli_fetch_assoc($connect2)){
                              echo "
                              <tr>
                              <td> ".date('F-d-Y H:i A', strtotime($data['cdate']))."</td>
                              <td> ".$data['Temperature']." °C</td>
                              ";
                           }
                        }
                     ?>                        
                     </tbody>
                  </table>
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
    <!-- BEGIN VENDOR JS-->
    <script src="js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="js/jquery.sparkline.min.js"></script>
    <script src="js/chart.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="js/plugins.js"></script>
    <script src="js/search.js"></script>
    <script src="js/customizer.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="js/dashboard-analytics.js"></script>
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
<!--Dashboard - Water Metrics-->
<script>
(function (window, document, $) {
// Check first if any of the task is checked
$("#task-card input:checkbox").each(function () {
   checkbox_check(this);
});
// Task check box
$("#task-card input:checkbox").change(function () {
   checkbox_check(this);
});
// Check Uncheck function
function checkbox_check(el) {
   if (!$(el).is(":checked")) {
      $(el)
         .next()
         .css("text-decoration", "none"); // or addClass
   } else {
      $(el)
         .next()
         .css("text-decoration", "line-through"); //or addClass
   }
}
//watermetrics line chart
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
               beginAtZero: false,
               fontColor: "#fff"
            }
         }
      ]
   }
};
//data block
var labels = [];
var wfdata = [];
var wldata = [];
  <?php
      $query = "select * from watermetrics ORDER BY cdate DESC LIMIT 7";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
         $labels[] = $labels[] = date('h:i A', strtotime($row['cdate']));
         $wfdata[] = $row['waterflow'];
         $wldata[] = $row['waterlevel'];
      }
   ?>
var revenueLineChartData = {
   labels: ["current", <?php echo json_encode($labels[2]); ?>, <?php echo json_encode($labels[4]); ?>, <?php echo json_encode($labels[6]); ?>, <?php echo json_encode($labels[8]); ?>, <?php echo json_encode($labels[10]); ?>, <?php echo json_encode($labels[12]); ?>],
   datasets: [
      {
         label: "Water Flow",
         data: <?php echo json_encode($wfdata); ?>,
         backgroundColor: "rgba(128, 222, 234, 0.5)",
         borderColor: "#d1faff",
         pointBorderColor: "#d1faff",
         pointBackgroundColor: "#00bcd4",
         pointHighlightFill: "#d1faff",
         pointHoverBackgroundColor: "#d1faff",
         borderWidth: 2,
         pointBorderWidth: 2,
         pointHoverBorderWidth: 4,
         pointRadius: 4
      },
      {
         label: "Water Level",
         data: <?php echo json_encode($wldata); ?>,
         borderDash: [15, 5],
         backgroundColor: "rgba(128, 222, 234, 0.2)",
         borderColor: "#80deea",
         pointBorderColor: "#80deea",
         pointBackgroundColor: "#00bcd4",
         pointHighlightFill: "#80deea",
         pointHoverBackgroundColor: "#80deea",
         borderWidth: 2,
         pointBorderWidth: 2,
         pointHoverBorderWidth: 4,
         pointRadius: 4
      }
   ]
};
var revenueLineChartConfig = {
   type: "line",
   options: revenueLineChartOptions,
   data: revenueLineChartData
};

/*
Doughnut Chart Widget
*/
/*
var doughnutSalesChartCTX = $("#doughnut-chart");
var browserStatsChartOptions = {
   cutoutPercentage: 70,
   legend: {
      display: false
   }
};

var doughnutSalesChartData = {
   labels: ["Mobile", "Kitchen", "Home"],
   datasets: [
      {
         label: "Sales",
         data: [3000, 500, 1000],
         backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"]
      }
   ]
};

var doughnutSalesChartConfig = {
   type: "doughnut",
   options: browserStatsChartOptions,
   data: doughnutSalesChartData
};
*/
/*
Monthly Revenue : Trending Bar Chart
*/
/*
var monthlyRevenueChartCTX = $("#trending-bar-chart");
var monthlyRevenueChartOptions = {
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
            }
         }
      ],
      yAxes: [
         {
            display: true,
            fontColor: "#fff",
            gridLines: {
               display: false
            },
            ticks: {
               beginAtZero: true
            }
         }
      ]
   },
   tooltips: {
      titleFontSize: 0,
      callbacks: {
         label: function (tooltipItem, data) {
            return tooltipItem.yLabel;
         }
      }
   }
};
var monthlyRevenueChartData = {
   labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept"],
   datasets: [
      {
         label: "Sales",
         data: [6, 9, 8, 4, 6, 7, 9, 4, 8],
         backgroundColor: "#46BFBD",
         hoverBackgroundColor: "#009688"
      }
   ]
};

var nReloads1 = 0;
var min1 = 1;
var max1 = 10;
var monthlyRevenueChart;
function updateMonthlyRevenueChart() {
   if (typeof monthlyRevenueChart != "undefined") {
      nReloads1++;
      var x = Math.floor(Math.random() * (max1 - min1 + 1)) + min1;
      monthlyRevenueChartData.datasets[0].data.shift();
      monthlyRevenueChartData.datasets[0].data.push([x]);
      monthlyRevenueChart.update();
   }
}
setInterval(updateMonthlyRevenueChart, 5000);

var monthlyRevenueChartConfig = {
   type: "bar",
   options: monthlyRevenueChartOptions,
   data: monthlyRevenueChartData
};
*/
/*
Trending Bar Chart
*/

var browserStatsChartCTX = $("#trending-radar-chart");

var browserStatsChartOptions = {
   responsive: true,
   // maintainAspectRatio: false,
   legend: {
      display: false
   },
   hover: {
      mode: "label"
   },
   scale: {
      angleLines: { color: "rgba(255,255,255,0.4)" },
      gridLines: { color: "rgba(255,255,255,0.2)" },
      ticks: {
         display: false
      },
      pointLabels: {
         fontColor: "#fff"
      }
   }
};
var browserStatsChartData = {
   labels: ['Temperature', "Conductivitiy", "Acidity", "Waterflow", "Waterlevel"],
   datasets: [
      {
         data: [1, 10, 10, 10, 10],
         fillColor: "rgba(255,255,255,0.2)",
         borderColor: "#fff",
         pointBorderColor: "#fff",
         pointBackgroundColor: "#00bfa5",
         pointHighlightFill: "#fff",
         pointHoverBackgroundColor: "#fff",
         borderWidth: 2,
         pointBorderWidth: 2,
         pointHoverBorderWidth: 4
      }
   ]
};

var browserStatsChartConfig = {
   type: "radar",
   options: browserStatsChartOptions,
   data: browserStatsChartData
};

/*
Revenue by country - Line Chart
*/

var countryRevenueChartCTX = $("#line-chart");

var countryRevenueChartOption = {
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
               display: false
            },
            ticks: {
               beginAtZero: false,
               fontColor: "#fff"
            }
         }
      ]
   }
};
//data block
var Tdata = [];
var Cdata = [];
  <?php
      $query = "select * from ectemp ORDER BY cdate DESC LIMIT 3";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
         $Tdata[] = $Tdata[] = date('h:i A', strtotime($row['cdate']));
         $Cdata[] = $row['Temperature'];
      }
   ?>
var countryRevenueChartData = {
   labels: [<?php echo json_encode($Tdata[0]); ?>, <?php echo json_encode($Tdata[1]); ?>, <?php echo json_encode($Tdata[2]); ?>],
   datasets: [
      {
         label: "Temperature",
         data: [ <?php echo json_encode($Cdata[0]); ?>, <?php echo json_encode($Cdata[1]); ?>, <?php echo json_encode($Cdata[2]); ?>],
         fill: false,
         lineTension: 0,
         borderColor: "#fff",
         pointBorderColor: "#fff",
         pointBackgroundColor: "#009688",
         pointHighlightFill: "#fff",
         pointHoverBackgroundColor: "#fff",
         borderWidth: 2,
         pointBorderWidth: 2,
         pointHoverBorderWidth: 4,
         pointRadius: 4
      }
   ]
};
var countryRevenueChartConfig = {
   type: "line",
   options: countryRevenueChartOption,
   data: countryRevenueChartData
};
// Create the chart
window.onload = function () {
   revenueLineChart = new Chart(revenueLineChartCTX, revenueLineChartConfig);
   //monthlyRevenueChart = new Chart(monthlyRevenueChartCTX, monthlyRevenueChartConfig);
   //var doughnutSalesChart = new Chart(doughnutSalesChartCTX, doughnutSalesChartConfig);
   browserStatsChart = new Chart(browserStatsChartCTX, browserStatsChartConfig);
   var countryRevenueChart = new Chart(countryRevenueChartCTX, countryRevenueChartConfig);
};
$(function () {
   /*
    * STATS CARDS
    */
   // Bar chart ( New Clients)
   $("#clients-bar").sparkline([70, 80, 65, 78, 58, 80, 78, 80, 70, 50, 75, 65, 80, 70, 65, 90, 65, 80, 70, 65, 90], {
      type: "bar",
      height: "25",
      barWidth: 7,
      barSpacing: 4,
      barColor: "#b2ebf2",
      negBarColor: "#81d4fa",
      zeroColor: "#81d4fa"
   });
   // Total Sales - Bar
   $("#sales-compositebar").sparkline([4, 6, 7, 7, 4, 3, 2, 3, 1, 4, 6, 5, 9, 4, 6, 7, 7, 4, 6, 5, 9], {
      type: "bar",
      barColor: "#F6CAFD",
      height: "25",
      width: "100%",
      barWidth: "7",
      barSpacing: 4
   });
   //Total Sales - Line
   $("#sales-compositebar").sparkline([4, 1, 5, 7, 9, 9, 8, 8, 4, 2, 5, 6, 7], {
      composite: true,
      type: "line",
      width: "100%",
      lineWidth: 2,
      lineColor: "#fff3e0",
      fillColor: "rgba(255, 82, 82, 0.25)",
      highlightSpotColor: "#fff3e0",
      highlightLineColor: "#fff3e0",
      minSpotColor: "#00bcd4",
      maxSpotColor: "#00e676",
      spotColor: "#fff3e0",
      spotRadius: 4
   });
   // Tristate chart (Today Profit)
   $("#profit-tristate").sparkline([2, 3, 0, 4, -5, -6, 7, -2, 3, 0, 2, 3, -1, 0, 2, 3, 3, -1, 0, 2, 3], {
      type: "tristate",
      width: "100%",
      height: "25",
      posBarColor: "#ffecb3",
      negBarColor: "#fff8e1",
      barWidth: 7,
      barSpacing: 4,
      zeroAxis: false
   });
   // Line chart ( New Invoice)
   $("#invoice-line").sparkline([5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7, 5, 6, 7, 9, 9, 5], {
      type: "line",
      width: "100%",
      height: "25",
      lineWidth: 2,
      lineColor: "#E1D0FF",
      fillColor: "rgba(255, 255, 255, 0.2)",
      highlightSpotColor: "#E1D0FF",
      highlightLineColor: "#E1D0FF",
      minSpotColor: "#00bcd4",
      maxSpotColor: "#4caf50",
      spotColor: "#E1D0FF",
      spotRadius: 4
   });

   /*
    * Project Line chart ( Project Box )
    */
   $("#project-line-1").sparkline([5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7, 5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7], {
      type: "line",
      width: "100%",
      height: "30",
      lineWidth: 2,
      lineColor: "#00bcd4",
      fillColor: "rgba(0, 188, 212, 0.2)"
   });
   $("#project-line-2").sparkline([6, 7, 5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7, 5, 6, 7, 9, 9, 5, 3, 2, 2, 4], {
      type: "line",
      width: "100%",
      height: "30",
      lineWidth: 2,
      lineColor: "#00bcd4",
      fillColor: "rgba(0, 188, 212, 0.2)"
   });
   $("#project-line-3").sparkline([2, 4, 6, 7, 5, 6, 7, 9, 5, 6, 7, 9, 9, 5, 3, 2, 9, 5, 3, 2, 2, 4, 6, 7], {
      type: "line",
      width: "100%",
      height: "30",
      lineWidth: 2,
      lineColor: "#00bcd4",
      fillColor: "rgba(0, 188, 212, 0.2)"
   });
   $("#project-line-4").sparkline([9, 5, 3, 2, 2, 4, 6, 7, 5, 6, 7, 9, 5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7], {
      type: "line",
      width: "100%",
      height: "30",
      lineWidth: 2,
      lineColor: "#00bcd4",
      fillColor: "rgba(0, 188, 212, 0.2)"
   });
});
})(window, document, jQuery);
</script>
 