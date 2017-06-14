<?php
/**
*@author 		:Farsheel
*@Date 			:26/05/2017
*@LastModified 	:27/05/2017
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Amazon Product crawler</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script type="text/javascript">
  	$('form#searchForm').submit(function() {
    $(':input', this).each(function() {
        this.disabled = !($(this).val());
    });
});
  </script>
</head>
<body>
<div class="container">
<div class="jumbotron text-center">
  <h1>Amazon Product Crawler</h1>
  <p>PHP application to crawl products from amazon</p>
  <form class="form-inline" action="index.php" method="get">
  <div class="form-group">
    
    <input type="text" class="form-control" name="count" placeholder="Count">
  </div>
  <div class="form-group">   
    <input type="text" class="form-control" name="s" placeholder="Search">
  </div>
 
  <button type="submit" class="btn btn-default">Crawl</button>
</form> 
</div>
<div class="row">
  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Product</th>
      </tr>
    </thead>
    <tbody>


<?php
include('simple_html_dom.php'); // Including DOM library file

include('crawler.php');

$crawl=new Crawler;

$count=isset($_GET['count']) ? (int)$_GET['count']: 10; //no of products to crawl .Default value=10

$i=1; // to count the products
    

    $html = new simple_html_dom();
    $html->load($crawl->scrapURL('http://www.amazon.in/gp/site-directory'));
//$html=file_get_html('http://www.amazon.in/gp/site-directory'); // loading the html source code from amazon
$url_decode;
foreach(@$html->find('a.nav_a') as $elm) //finding <a></a> tags with class=nav_a and looping through it 
{   
	$url_decode='http://www.amazon.in'.htmlspecialchars_decode($crawl->filterURL($elm->href)); //decoding the Category URL
	$html2 = new simple_html_dom();
 	$html2=$html2->load($crawl->scrapURL($url_decode)); //Loading source of category URL

 	foreach(@$html2->find('h2.s-access-title') as $elm) { // selection <h2></h2> tags with class=s-access-title 

	 		if (isset($_GET['s']) && isset($_GET['count'])) // if s and count parameter is present
	 		{
	 			if(stripos($elm->innertext, $_GET['s'])) // if the h2 text contains s paramater
	 			{
	 				$crawl->printRow($elm->innertext,$i); // printing n where <h2>n</h2>
		  			$crawl->stopCrawl($count,$i); 
		  			$i++;
	 			}
	 		}
	 		elseif (isset($_GET['count'])) // if only count parameter is present
	 		{
		 		$crawl->printRow($elm->innertext,$i); // printing n where <h2>n</h2>
		  		$crawl->stopCrawl($count,$i); 
		  		$i++;
	 		}
	 		elseif (isset($_GET['s'])) // if only s parameter is present
	 		{
	 			if(stripos($elm->innertext, $_GET['s'])) // if the h2 text contains s paramater
	 			{
	 				$crawl->printRow($elm->innertext,$i); // printing n where <h2>n</h2>
		  			$crawl->stopCrawl($count,$i); 
		  			$i++;
	 			}
	 		}
	 		else
	 		{
	 			$crawl->printRow($elm->innertext,$i); // printing n where <h2>n</h2>
		  		$crawl->stopCrawl($count,$i); 
		  		$i++;
		  		
	 		}
	 		
  		
		}//closing inner loop
	
} //closing outer loop

?>


    </tbody>
  </table>
  </div>
</div>
</body>
</html>