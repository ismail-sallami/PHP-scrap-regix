<?php
require_once ('../classes/Scraper.php');

    class ParserTest extends phpunit_framework_testcase {
       
        public $test;
        public function setUp()
        {
            $this->test = new Scraper ();
        }
        //test if the parser really deletes all the HTML tags
        public function testAddressExtractor(){
            
            $result = $this->test->addressExtractor("http://www.regis24.de/impressum/");
            $this->assertTrue ($this->arrays_are_similar($result,["Regis24 GmbH <br />Zehdenicker Str. 21 <br />10119 Berlin "]));
          
        }
        
        /**
         * Determine if two associative arrays are similar
         *
         * Both arrays must have the same indexes with identical values
         * without respect to key ordering 
         * 
         * @param array $a
         * @param array $b
         * @return bool
         */
            public function arrays_are_similar($a, $b) {
            // if the indexes don't match, return immediately
                if (count(array_diff_assoc($a, $b))) {
                  return false;
                }
            // we know that the indexes, but maybe not values, match.
            // compare the values between the two arrays
                foreach($a as $k => $v) {
                  if ($v !== $b[$k]) {
                    return false;
                  }
                }
            // we have identical indexes, and no unequal values
            return true;
            }


    }

?>
