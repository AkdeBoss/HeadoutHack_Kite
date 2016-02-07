<?php
session_start();
include_once("server.php");
include_once("functions.php");


$userid = $_SESSION['userid'];
$sql = "SELECT place_x, place_y FROM users
 WHERE id=$userid";

  $result = mysql_query($sql);
  while($data = mysql_fetch_object($result)){
    $posts[] = array(   'place_x' => $data->place_x, 
              'place_y' => $data->place_y
            
          );
  }

$lat =  $posts['0']['place_x'];
$lng =  $posts['0']['place_y'];


?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Material Design Lite</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    --><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="material.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
     #map {
        height: 100%;
      }
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
  </head>
<body>
  <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
          <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">Home</span>
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
              <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
                <i class="material-icons">search</i>
              </label>
              <div class="mdl-textfield__expandable-holder">
                <input class="mdl-textfield__input" type="text" id="search">
                <label class="mdl-textfield__label" for="search">Enter your query...</label>
              </div>
            </div>
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
              <i class="material-icons">more_vert</i>
            </button>
            <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
              <li class="mdl-menu__item">About</li>
              <li class="mdl-menu__item">Contact</li>
              <li class="mdl-menu__item">Legal information</li>
            </ul>
          </div>
        </header>
        <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <img src="images/user.jpg" class="demo-avatar">
          <div class="demo-avatar-dropdown">
            <span>hello@example.com</span>
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons" role="presentation">arrow_drop_down</i>
              <span class="visuallyhidden">Accounts</span>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
              <li class="mdl-menu__item">hello@example.com</li>
              <li class="mdl-menu__item">info@example.com</li>
              <li class="mdl-menu__item"><i class="material-icons">add</i>Add another account...</li>
            </ul>
          </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
          <a class="mdl-navigation__link" href="add_places.php">add place</a>
          <a class="mdl-navigation__link" href="get_places.php">places visited</a>
          
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
        </nav>
      </div>
        <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            
            <h3>Wanna explore but confused ?  common upload your photo we will recommend you</h3>
            <form action="recommends.php" enctype="multipart/form-data" method="POST">
              <input name="img" size="35" type="file"/><br/>
              <input type="submit" name="submit" value="Upload"/>
                </form>
            <form action="trips.php">
<a class="waves-effect waves-light btn" href="trips.php">Plan a trip/a>
</form>
          </div>
          <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
            <div id="map"></div>
          </div>
          <div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
            <div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
              <div class="mdl-card__title mdl-card--expand mdl-color--teal-300">
                <h2 class="mdl-card__title-text">Updates</h2>
              </div>
              <div class="mdl-card__supporting-text mdl-color-text--grey-600">
                Get here the latest updates of what you do
              </div>
              <div class="mdl-card__actions mdl-card--border">
               <?php
               
$sql = "SELECT activity_type, friend_id  FROM activity
   WHERE user_id = '$userid'";
  $result = mysql_query($sql);
$posts = array();
  while($data = mysql_fetch_object($result)){
    $posts[] = array(   'activity' => $data->activity_type, 
              'friend_id' => $data->friend_id
              
          );
  }
  if(empty($posts))
  {
    echo " sorry no new updates";
  }
  else{
    echo"<ul>";
    foreach ($posts as $key => $value) {
      echo "<li>";
      echo "you ";
      echo $value['activity'] ;
      echo " with ";
      echo $value['friend_id'];
      echo "</li>";
    }
  echo "</ul>";

}               ?>
              </div>
            </div>
            <div class="demo-separator mdl-cell--1-col"></div>
            <div class="demo-options mdl-card mdl-color--deep-purple-500 mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--3-col-tablet mdl-cell--12-col-desktop">
              <div class="mdl-card__supporting-text mdl-color-text--blue-grey-50">
                <h3>List of friends</h3>
                 
<?php
$users = show_users();
$following = following($_SESSION['userid']);

if (count($users)){
?>
<ul>
<?php
foreach ($users as $key => $value){
  echo "<li>";
  echo "<label>";
  echo $value;
  if (in_array($key,$following)){
    echo " <small>
    <a href='action.php?id=$key&do=unfollow'>cancel</a>
    </small>";
  }else{
    echo " <small>
    <a href='action.php?id=$key&do=follow'>plan</a>
    </small>";
  }
  echo "</label>";
  echo "</li>\n";

 
}
?>
</table>
<?php
}else{
?>
<p><b>There are no users in the system!</b></p>
<?php
}
?>
                  
                  </ul>
              </div>
              <div class="mdl-card__actions mdl-card--border">
                <a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--blue-grey-50">Change location</a>
                <div class="mdl-layout-spacer"></div>
                <i class="material-icons">location_on</i>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
 <form>
      <input type="hidden" id="latss" value=<?php echo $lat;?>>
      <input type="hidden"  id="lngss" value=<?php echo  $lng;?>>
    </form>
<script>
      var map;
      var x =  document.getElementById('latss').value;

var y = document.getElementById('lngss').value;
      function initMap() {
var pyrmont = new google.maps.LatLng(x,y);
         map = new google.maps.Map(document.getElementById('map'));
    map.setZoom(13);      // This will trigger a zoom_changed on the map
map.setCenter(new google.maps.LatLng(x, y));

      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA84DmOq0GA7J3Pp1ikXA7gPZg7FHzqxo0&callback=initMap"
    async defer></script>


   



</body>
</html>
