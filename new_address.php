
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
    <form class="sign-up" method="post" action="new_address_added.php">
    <h1 class="sign-up-title">Add New Address</h1>
    
    <?php

    // start database connection
    require_once ('classes/Database.php');
    try
    {
        $db = new Database();
    }
    catch (Erreur $e) {
        echo $e -> RetourneErreur();
    } 

    
     //SQL request to get companies list
     try
    {
      $query = "SELECT `name` FROM `company`";
      $request = $db->query($query);
    }
    catch (Erreur $e) {
        echo $e -> RetourneErreur();
    } 
    
     //Display result in listbox
     echo '<select name="company" class="sign-up-input" size="1">
         <option value="" disabled selected>Select Company</option>';
    
     //Display result in listbox
           
       if ($db->num_rows($request) > 0) {
        while ($a = $db->fetch_array_assoc($request)) {
          echo '<option>'.$a['name'].'</option>';
            }
        }

     echo '</select>';

    ?>
    <input type="url" name="url" class="sign-up-input" placeholder="URL (e.g. http://www.regis24.de/impressum/)"  autofocus required="required" >
    <input type="email" name="email" class="sign-up-input" placeholder="E-mail" required="required">
    <input type="submit" value="Extract & Save" class="sign-up-button">
    <a href="index.php">&#8592; Home</a> 
 </form>
</body>
</html>
