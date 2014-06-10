<?php

/**
 * Short Description :
 * This class detects referers from Russia and redirects them back home
 * 
 * Extended description:
 * As a part of a personal project serving my own analytics with PHP and Neo4j 
 * after examining several referers to my web site http://www.tsartsaris.gr
 * I came to a conclusion that there is no good referer from .ru domains
 * To work around the problem and not taking count of those hits I created 
 * this class to detect .ru domain referals and redirect them back home. 
 * This bad SEO technic depends on servers over the internet with exploited
 * analytics page. Web crawlers that crawls those analytics count as reference 
 * links from your site to all those .ru servers increasing their back link value. 
 *
 *
 *	 License:
 *	 This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *
 * @category   SEO
 * @author     Original Author Sotiris Tsartsaris <tsartsaris@gmail.com>
 * @copyright  2014 Tsartsaris.gr
 * @license    https://www.gnu.org/licenses/gpl.html
 * @version    Release: v 1.0.0
 * @link       https://github.com/tsartsaris/php-oop-class-monitor-referer-urls-and-redirect
 * @link       http://www.tsartsaris.gr/send-them-home-mama
 */ 


class DetectRu{

/**
*	This is the default txt file to hold all urls that should go back home
*	Remember to give write permissions for this file so PHP will be able to 
*	to update it. Feel free to change it with whatever you want as long as it
*	stays with a .txt extension.
*/
	public $file_to_write = "send_them_home_mama.txt";

/**
*	With $handle the contents of the txt file will be held for reading updating
*	using fopen later on 
*/
	public $handle;

/**
*	$urls_array is used to keep all urls read from the txt file in an array
*/
	public $urls_array = array();

/**
*	$input_url is the argument to be used as input
*/
	public $input_url;


/**
*	$double_flag will be used to state if the url is all ready blacklisted or not
*/
	protected $double_flag;

/**
*	This is the term to look in the url provided in the input
*	If you want to blacklist another domain extension ex www.example.cn (China)
*	change .ru to .cn. For future version this has to change to an array to include /ru
*/
	protected $exclude = ".ru";

/**
*	A flag to be used if the url referer comes from .ru domain and will be set from checkRu()
*/
	protected $check_ru_flag;

/**
*	This is the constructor of the class. Holds the logic of the entire process
*/
	public function __construct($input_url){
		$this->setInputUrl($input_url); //set the input url to be passed where needed
		$this->openFile(); //we open the file first
		$this->checkDouble(); //check if the referer url is all ready listed in our file
		if ($this->double_flag == 1) { //found in our list so go home
			$this->closeTxt(); //close the handler
			$this->sendThemHomeMama(); //send them home mama
		}elseif ($this->double_flag == 0) { //if not found in our list
			$this->checkRu(); //check to see if it comes from .ru domain
			if( $this->check_ru_flag ) { //if yes
				$this->writeToFile(); //add url to the list
				$this->closeTxt(); //close the handle
				$this->sendThemHomeMama(); //send them back home
			}
		}else{
				$this->closeTxt(); //url referer is fine, go on and browse the site
			}
				
	}

/**
*	openFile opens the .txt file provided in $file_to_write and passes all values
*	in the $urls_array. Reads line by line so make sure if you mess with the .txt
*	file to insert on record per line
*/
	public function openFile(){
		$this->handle = fopen($this->file_to_write, 'r+') or die('Cannot open file:  '.$this->file_to_write.' Please check your permissions');
		while (($line = fgets($this->handle)) !== false){
			array_push($this->urls_array,$line);
		}var_dump($this->urls_array);
	}


/**
*	checkDouble will check the provided url if it's allready blacklisted in the txt
*	file. The records are checked against the array from the openFile function and the 
*	double_flag is set to 0 then we must insert a new record, otherwise we close the $handle and
*	redirect the bad boy back to home
*/
	protected function checkDouble(){
		
		foreach ($this->urls_array as $key => $value) {
				//we trim the value here to clear the linebreak from the txt file
				//or else there will be no match.
			if (trim($value) == $this->input_url) {
				$this->double_flag = 1;
				break;
			}else{
				$this->double_flag = 0;

			}
		}
	}


/**
*	writeToFile will be called if .ru detected and the url must be saved in our txt 
*/
	protected function writeToFile(){
			fwrite($this->handle, "\n".$this->input_url);
	}

/**
*	Simple take the input url and assign it to our variable
*	that way we can use $this->input_url and not providing
*	input args in every function needed
*/
	protected function setInputUrl($input_url){
		$this->input_url = htmlentities($input_url, ENT_QUOTES, "KOI8-R");
	}

/**
*	This is the .ru checker in the input url. 
*	THIS IS A SUBJECT TO CHANGE to be used in the host of the parse_url only
*	to avoid blacklisting referers that are not from Russia but in the referer
*	url there is a .ru elsewhere ex. www.rumble.com
*/
	protected function checkRu(){
		if (strpos($this->input_url, $this->exclude) !== false ){
			$this->check_ru_flag = 1;
			}else{
			$this->check_ru_flag = 0;
			}
	}

/**
*	Simple close the txt handle since is not needed
*/
	public function closeTxt(){
		fclose($this->handle);
	}

/**
*	Simple redirect to the original url they came from
*/
	protected function sendThemHomeMama(){
		header('Location: http://' . $this->input_url, true, 303);
   			break;
	}

}
?>
