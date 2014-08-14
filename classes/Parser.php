<?php
/**This class cleans a html format address and returns a valid street address
*@author     Ismail Sallami <sallami.ismail@gmail.com>
*/
class Parser {

private $pattern1= '/<\/strong>|<\/h1>|<\/h2>|<\/h3>|<br>|<br \/>|<br\/>/';
private $replacement1= ', ';
private $pattern2= '/^\s*|&nbsp;|\s*$/';
private $replacement2= '';
private $pattern3='/strasse|straße/i'; 
private $replacement3 = 'str.';


//Parser constructor
	 function __construct() {
		
   	 }


//replace all HTML <\strong>, <br> tags by ',' then delete all speaces befor and after and return a clean address format 
public function cleanHtml($addressArray)
{
    
    $cleanedTags= preg_replace($this->pattern1, $this->replacement1, $addressArray, -1 );
    return preg_replace($this->pattern2, $this->replacement2, $cleanedTags, -1 );
}
//replace all "strasse", "straße" with "str." to avoid any duplication
public function unifyStrasse($addressArray)
{
    return preg_replace($this->pattern3, $this->replacement3, $addressArray, -1 );
}
//the whole process
public function cleanTags($addressArray)
{
    $target1=$this->cleanHtml($addressArray);
    $target2=$this->unifyStrasse($target1);
    return $target2;
}

}
?>
