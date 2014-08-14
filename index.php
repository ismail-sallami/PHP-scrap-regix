
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
<script type="text/javascript">
function display(el) {

	el.innerHTML = 'Please Wait ...';
 
}
</script>
</head>
<body>
    <form class="sign-up">
    <h1 class="sign-up-title">Admin space</h1>
    <button type="button" class="sign-up-button" onclick="self.location.href='new_company.php'" >New Company</button><br/><br/>
    <button type="button" class="sign-up-button" onclick="self.location.href='new_address.php'" >New Address </button><br/><br/>
    <button type="button" class="sign-up-button" onclick="self.location.href='update_email.php'" >Update E-mail</button><br/><br/>
    <button  class="sign-up-button" type="button" onclick="self.location.href='lookup.php', display(this)">Daily Lookup</button><br/><br/>
    </form>


</body>
</html>
