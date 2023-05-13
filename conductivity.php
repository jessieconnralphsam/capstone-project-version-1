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
    <title>Conductivity | Hydroponics Report</title>
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
              <li><a href="water_metrics.php"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Analytics">Water Metrics</span></a>
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
   <!-- Search Bar-->
   <div class="row vertical-modern-dashboard">
   </div>
   <!--Dissolved Solids-->
   <div class="row">
      <div class="col s12 l4">
         <!-- Reading TDS -->
         <div class="card recent-buyers-card animate fadeUp"style="width: 950px;">
          <span class="card-title grey-text text-darken-4">Conductivity</span>
            <div class="card-content" style="max-height: 500px; overflow-y: scroll;">               
                  <table>
                     <thead>
                        <tr>                           
                           <th>Sensor Name</th>
                           <th>Date & Time</th>
                           <th>Readings</th>
                        </tr>
                     </thead>
                     <tbody>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 08:45 AM</td>
                        <td>500 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 09:00 AM</td>
                        <td>300 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 09:00 AM</td>
                        <td>1000 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 08:45 AM</td>
                        <td>500 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 09:00 AM</td>
                        <td>300 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 09:00 AM</td>
                        <td>1000 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 08:45 AM</td>
                        <td>500 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 09:00 AM</td>
                        <td>300 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 09:00 AM</td>
                        <td>1000 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 08:45 AM</td>
                        <td>500 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 09:00 AM</td>
                        <td>300 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 09:00 AM</td>
                        <td>1000 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 08:45 AM</td>
                        <td>500 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 09:00 AM</td>
                        <td>300 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 09:00 AM</td>
                        <td>1000 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 08:45 AM</td>
                        <td>500 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 09:00 AM</td>
                        <td>300 ppm</td>
                      </tr>
                      <tr>
                        <td>Total Dissolved Solids</td>
                        <td>March 30, 2023 09:00 AM</td>
                        <td>1000 ppm</td>
                      </tr>                  
                     </tbody>
                  </table>
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