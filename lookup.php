
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
    <form class="sign-up">
    <h1 class="sign-up-title">Daily Addresses Lookup</h1>
    <?php
	
require_once ('classes/Scraper.php');
require_once ('classes/Parser.php');
require_once ('classes/Database.php');
require_once ('classes/Mailer.php');
    try
    {
        $db = new Database();
    }catch (Erreur $e) {
        echo $e -> RetourneErreur();
    } 
$scraper = new Scraper();
$parser = new Parser();
$mailer = new Mailer();

try
{
    $query = "SELECT DISTINCT `url` FROM `address` where (active='1')";
    $requestURL = $db->query($query);
    if ($db->num_rows($requestURL) > 0) {
        while ($res = $db->fetch_array_assoc($requestURL)) {


        //process for every url
        $url= $res['url'];
        echo '<hr><font size="3" color="red" align="center">'.$url."</font><br>";
        //extract addresses from the URL
        $extractedAddresses =$scraper->addressExtractor($url);
        //parse the extracted array
        $extractedParsedAddresses = $parser->cleanTags($extractedAddresses);
        //print_r ($extractedParsedAddresses)."<br/>";

        //get the list of saved addresses
        $addressArray=array();

        //SQL request to get addresses list
        try
        {
            $query = "SELECT * FROM `address` where (url='$url' and active='1')";
            $request = $db->query($query);

            if ($db->num_rows($request) > 0) {
                while ($a = $db->fetch_array_assoc($request)) {
                  array_push ($addressArray,$a['address']);
                  $associatedEmail=$a['e-mail'];
                  $companyId=$a['company_id'];
                }
                //print_r($addressArray);
                //calculate difference between detected addresses array and saved addresses array
                //reset indexes of arrays with array_values after array_diff (!!!important!!!)
                $DBresult = array_values(array_diff($addressArray, $extractedParsedAddresses)); //array of changed addresses in the DB
                $URLresult = array_values(array_diff($extractedParsedAddresses,$addressArray)); //array of the new addresses found in the URL
               
                if ($DBresult)
                    {//if result array not empty, loop and send emails
                    foreach ($DBresult as $index=>$value) {
                        //Display the changes
                        $myMessage ='The address "'.$value .'" has been replaced by "'.$URLresult[$index].'"';
                        echo "<img src='http://cdn.tennisearth.com/images/alert-ico.png' style='vertical-align:middle'><font color='red'>".$myMessage."</font><br />";
                        //Email the changes
                        try 
                        {
                            $mailer->addRecipient("$associatedEmail");
                            $mailer->fillSubject("Address changed");
                            $mailer->fillMessage($myMessage);
                            // now we send it!
                            $mailer->send();
                        } catch (Exception $e) {
                            echo $e->getMessage();
                        }
                        //insert the new address
                        $query_new = "INSERT INTO `regis`.`address` VALUES (NULL,'$companyId','$url','$URLresult[$index]','$associatedEmail','1');";
                        $request_new = $db->query($query_new);

                        //save the changes
                        $query_change = "INSERT INTO `regis`.`change` VALUES (NULL,(select `address`.`id` from `address`
        where `address`='$value'),(select `address`.`id` from `address` where `address`='$URLresult[$index]'),NULL);";
                        $request_change = $db->query($query_change);

                        // desactivate the old address
                        $query_desactivate="UPDATE `address` SET `active`='0' where `address`='$value'";
                        $request_desactivate = $db->query($query_desactivate);

                    }
                }
                else
                {
                    echo "<img src='https://mgmt.ravenhq.com/Content/css/images/check-ico.png' style='vertical-align:middle'> $nbsp No addresses changes have been detected !";
                }
            }
        }catch (Erreur $e) {
		echo $e -> RetourneErreur();
	} 
//end of process for the url

        }

    }
}catch (Erreur $e) {
        echo $e -> RetourneErreur();
} 
?>
    
    <a href="index.php"><br /><br />&#8592; Home</a> 
 </form>
</body>
</html>
