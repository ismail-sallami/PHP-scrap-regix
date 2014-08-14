
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Regis 24</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
    <form class="sign-up" method="post">
    <h1 class="sign-up-title">Add New Address</h1>
    
<?php
//new scraper object  
require_once ('classes/Scraper.php');
$scraper = new Scraper();	
//new parser object
require_once ('classes/Parser.php');
$parser = new Parser();
// start database connection
require_once ('classes/Database.php');
    try
    {
        $db = new Database();
    }
    catch (Erreur $e) {
        echo $e -> RetourneErreur();
    } 

//Save the new address in the database
$company = $_POST['company'];
$url     = $_POST['url'];
$email  = $_POST['email'];

  
    try
    {
    $addressArray= ($scraper->addressExtractor($url));

    if (sizeof($addressArray) > 0){
        echo '<font size="4" color="red" align="center">New address(es) have been detected and added successfully!</font><br /><br />  ';
        foreach ($addressArray as $value){
                $address= $parser->cleanTags($value);
                echo "<img src='http://wiki.csexport.org/public/images/a/a1/Checkmark_icon.png' style='vertical-align:middle'>&nbsp;".$address."<br /> <br />";
               // query database
              $query = "INSERT INTO address VALUES (NULL,(select id from company where name='$company'),'$url','$address','$email','1')";
              $request = $db->query($query);
        }
    }
    else
    {
     echo '<font size="4" color="red" align="center">No addresses have been detected in the given URL!</font><br />  ';
    }

     
    }
    catch (Erreur $e) {
        echo $e -> RetourneErreur();
    } 

    ?>
   
    <a href="index.php">&#8592; Home</a> |  <a href="new_address.php">Add New Address</a>
 </form>
</body>
</html>
