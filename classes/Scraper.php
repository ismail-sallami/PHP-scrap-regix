<?php	
	/**This class is a curl HTML scraper that recognizes all German street addresses 
	*@author     Ismail Sallami <sallami.ismail@gmail.com>
	*/
class Scraper {
	//scaper constructor
	 function __construct() {
		
   	 }

	// Function to make GET request using cURL
	public function curlGet($url) {
		$ch = curl_init(); // Initialising cURL session
		// Setting cURL options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
		$results = curl_exec($ch); // Executing cURL session
		curl_close($ch); // Closing cURL session
		
		return $results; // Return the results
	}

	public function addressExtractor($url){
		$packtContactPage = $this->curlGet($url);
		// Calling function curlGet() and storing returned results in $packtContactPage variable
		$addressRegex = '/([A-ZÄÖÜa-zäöüß0-9;&.-]\s*)*(<\/strong>|<\/h1>|<\/h2>|<\/h3>|<br>|<br \/>|,)*([A-ZÄÖÜa-zäöüß;&.]*\s)+[0-9]{2,3}(-[0-9]{2,3})*\s*[a-zA-Z]*(<br>|<br \/>|,)\s*[0-9]{5}\s*(\w|-|\/)*((\s|,)(\([a-zA-Z]*\))*(\w|-)*)*/'; 
		// Regex pattern to match German street addresses
		preg_match_all($addressRegex, $packtContactPage, $scrapedAddress);
		// Matching regex patterns and assigning results to array
		$Addresses = array_values(array_unique($scrapedAddress[0]));
		// Extracting unique entries in $scrapedEmails into $emailAddresses array
		return $Addresses;
	}

}
?>
