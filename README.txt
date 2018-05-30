
cURL and REGEX project
======================

This code browses HTML content and search for German street address.
The main techniques used are REGEX and cURL.


To be able to run this code please make sure :


** That your server is able to send mails, even thought this will not disturb the rest of the code.

** That the cURL library is available in your server (which is the case in almost of the server nowadays) (you can use phpinfo(); to do it)

** Execute the sql file "regis.sql"

** If by accident you got a "500 internal error" when in the lookup page, please make sure that the file permissions is set at "757".
 


_____________________________

NB: Flash and images address identification:

The code that I provided doesn't treat the flash and images scraping due to time and complexity reason.
Flash scraping can be done with Google swiffy tool or Macromedia Flash Search Engine SDK.
These tools allows to decompile the swf animation and extract the text.
Swiff works a little bit different from adobe decompiler, in fact, it converts the swf to HTML5 and then we can scrap it using cURL and pass it through the provided implementation.


