
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
    <h1 class="sign-up-title">Add New Company</h1>
    
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

    //Save the new company name in the database
    $company = $_POST['company'];
    if ($company){
        try
        {
        // query database
        $query = "INSERT INTO company VALUES ('','$company')";
        $request = $db->query($query);
        if ($request){
            echo '<img src="https://mgmt.ravenhq.com/Content/css/images/check-ico.png"> &nbsp; <font size="4" color="red" align="center">New company has been added successfully!</font> ';
            }else{
            echo '<img src="http://cdn.tennisearth.com/images/alert-ico.png">&nbsp;<font size="4" color="red" align="center">An error has occured !</font> ';
            }
        }
        catch (Erreur $e) {
            echo $e -> RetourneErreur();
        } 
    }

    ?>
    <input type="text" name="company" class="sign-up-input" placeholder="Company name"  autofocus required="required" >
    <input type="submit" value="Save" class="sign-up-button">
    <a href="index.php">&#8592; Home</a> 
 </form>
</body>
</html>
