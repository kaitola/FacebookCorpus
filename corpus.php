<?php
header("Content-Type:text/html; charset=utf-8");
session_start();
require_once 'facebook-php-sdk-v4-5.0-dev/src/Facebook/autoload.php';
require_once 'FacebookLogin.php';
require_once 'JsonParser.php';

define("MAX", 100);
define("GRAPH_API_URL", "https://graph.facebook.com/");

$handler = new FacebookLogin();
$isAccessToken = $handler->getAccessToken();

if(isset($isAccessToken)){
  $_SESSION['facebook_access_token'] = (string)$handler->getAccessToken();
  $handler->getfbuse()->setDefaultAccessToken($_SESSION['facebook_access_token']);
}

$pages = [
      'Pxmart' => '134004310003557',
      'Albertsons' => '105371386162705',
      'Kroger' => '60686173217',
      'Wellcome' => '121431141207349',
    ];

$fbpageid = $pages['Kroger'];

?>

<!DOCTYPE html>
<html>
<head></head>
<body>
  <div class="col-md-12">
    <?php
    
      $url = constant("GRAPH_API_URL").$fbpageid."/posts?fields=id,created_time,message,link&limit=".constant("MAX")."&access_token=".$_SESSION['facebook_access_token'];
      $handler = new JsonParser($url);

      //var_dump($handler->objectArray);

      $count = count($handler->nextArray);
      for($i=1;$i<=$count;$i++){
        echo $handler->nextArray[$i]."<br>";
        //echo "<a href='".$handler->nextArray[$i]."'>".$i."</a>";

      }


/*

      echo "<table border='1'>";
      echo "<tr>";
        echo "<th>NO</th>";
        echo "<th width='190'>DATETIME</th>";
        echo "<th>POST</th>";
      echo "</tr>";

        $post_per_page=50;

        $count=1;
        for($i=21;$i<$post_per_page;$i++){

            echo "<tr>";
            echo "<td>".$count."</td>";
            echo "<td>".@$obj1->data[$i]->created_time."</td>";
            echo "<td>".@$obj1->data[$i]->message."</td>";
            echo "</tr>";

            $count++;

            echo "</tr>";

        }
      echo "</table>";  
*/



    ?>
  </div>
</body>
</html>