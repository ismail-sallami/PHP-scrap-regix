
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
    <h1 class="sign-up-title">Update E-mail Address</h1>
    
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

    //Update the email address
    $old_email = $_POST['old_email'];
    $new_email  = $_POST['new_email'];
   
    if ($new_email)
    try
    {
      $query = "UPDATE address SET `e-mail`='$new_email' where `e-mail`='$old_email'";
      $request = $db->query($query);
    
      echo '<font size="4" color="red" align="center">E-mail has been updated successfully!</font> ';
    }
    catch (Erreur $e) {
        echo $e -> RetourneErreur();
    } 
      //SQL request to get emails list
     try
    {
      $query = "SELECT DISTINCT`e-mail` FROM `address`";
      $request = $db->query($query);
    }
    catch (Erreur $e) {
        echo $e -> RetourneErreur();
    } 
    
     //Display result in listbox
     echo '<select name="old_email" class="sign-up-input" size="1">
            <option value="" disabled selected>Choose Email To Update</option>';
    
     //Display result in listbox
           
       if ($db->num_rows($request) > 0) {
        while ($a = $db->fetch_array_assoc($request)) {
          echo '<option>'.$a['e-mail'].'</option>';
            }
        }

     echo '</select>';

    ?>
    <input type="email" name="new_email" class="sign-up-input" placeholder="New E-mail" required="required">
    <input type="submit" value="Update" class="sign-up-button">
    <a href="index.php">&#8592; Home</a> 
 </form>
</body>
</html>
