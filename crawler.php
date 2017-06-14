<?php
/**
*@author 		:Farsheel
*@Date 			:26/05/2017
*@LastModified 	:27/05/2017
*/
class Crawler
{


	/**
	*scrapURL() downloads HTML source code of given URL
	*@param1 URL to download in string
	*@returns HTML source code of given URL in string
	*/
	function scrapURL($url)
	{
		$ch = curl_init($url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	$curl_scraped_page = curl_exec($ch);

    	return $curl_scraped_page;
	}

	/**
	*stopCrawl() stops crawling and printing products if specefied no.of of products are printed
	*@param1 user specified count of products in integer
	*@param2 current product count in integer
	*@returns void
	*/
	function stopCrawl($count,$i)
	{
		if(gettype($count)=='integer' && gettype($i)=='integer')
		{
			if($i>=$count) // checking the count
		  		{	
				  	die(); // stoping the execution
				}
		}
		else
		{
			die('Invalid parameters passed');
		}	  		
	}


	/******************* EndOf stopCrawl() *********************/


	/**
	*printRow() prints product title as table row
	*@param1 data to print in the table row in string
	*@param2 row count in integer
	*@returns void
	*/
	function printRow($data,$i)
	{

		echo "<tr><td>$i</td><td>$data</td></tr>";

	}
	/******************* EndOf printRow() *********************/


	/**
	*filterURL() filters none product list links
	*@param1 none filtered URL as string
	*@returns filtered URL as string
	*/
	function filterURL($url)
	{

		//Removing none product list URLs from amazon 
		if (stripos($url, 'gp')==false && stripos($url, 'www')==false && stripos($url, 'B0')==false && stripos($url, 'amazon')==false && stripos($url, 'video')==false && stripos($url, 'p2p')==false && stripos($url, 'kdl')==false && stripos($url, 'app')==false && stripos($url, 'pop')==false && stripos($url, 'children-books/b')==false && stripos($url, 'ebooks-kindle/b')==false && stripos($url, '-Movies-')==false && stripos($url, 'mobile-phones/b')==false && stripos($url, 'mobile-phone-accessories/b')==false && stripos($url, 'Cases-Covers/b')==false && stripos($url, 'Power-Banks/b')==false && stripos($url, 'Tablets/b')==false && stripos($url, 'computers-and-accessories/b')==false && stripos($url, 'Laptops/b')==false && stripos($url, 'pen-drive/b')==false && stripos($url, 'memory-cards/b')==false && stripos($url, 'printers-scanners/b')==false && stripos($url, 'Computer-Accessories/b')==false && stripos($url, 'Software/b')==false)
		{

			return $url; //returns filtered URL

		}

	}
	/******************* EndOf filterURL() *********************/

}
?>