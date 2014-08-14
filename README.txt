



The code is developer under 
Ubuntu Linux OS, 
MySql 5.5.38, 
Apache 2.4.7, 
PHP 5.5.9, 
cURL 7.35 
and PHPUnit 4.0.17



To be able to run this code please make sure :




** That your server is able to send mails, even thought this will not disturb the rest of the code.

** That the cURL library is available in your server (which is the case in almost of the server nowadays) (you can use phpinfo(); to do it)

** To modify the for variable in the Mailer class ($from = "Regis 24 admin <regis24admin@regis24.de>";)

** To modify your database parameters in the Database class ($host="localhost", $user="root", $pass="password", $name = "regis")
** Execute the sql file "regis.sql"

** If by accident you got a "500 internal error" when in the lookup page, please make sure that the file permissions is set at "757".
 


_____________________________

NB: Flash and images address identification:

The code that I provided doesn't treat the flash and images scraping due to time and complexity reason.
Flash scraping can be done with Google swiffy tool or Macromedia Flash Search Engine SDK.
These tools allows to decompile the swf animation and extract the text.
Swiff works a little bit different from adobe decompiler, in fact, it converts the swf to HTML5 and then we can scrap it using cURL
and pass it through the provided implementation.

Image scraping is more complicated, in fact, it needs OCR process (Optical character recognition) wich needs alot of work and time in
pattern recognition, artificial intelligence and computer vision.


