
<?php  
 //filter.php  
require('../app/init.php');
$output = '';

$query1 = "select count(DISTINCT email) from sample ";
$query2 = "select count(DISTINCT location) from sample ";

if($_POST["action"] == "filter") {
	if (isset($_POST["searchQuery"])) {
		$query1 .= "Where ".$_POST['searchColumn']." LIKE '%".$_POST['searchQuery']."%' ";
	}
	/*if(isset($_POST["orderColumn"])) {
		$query1 .= "ORDER BY '".$_POST['orderColumn']."' ".$_POST['orderDirection'];
	}*/
}


   try {
       	    
      		$result1 = $db->prepare($query1); 
			$result1->execute(); 
			$rows1 = $result1->fetchColumn(); 

			if(isset($result1))  
			{  
		            $output .= '<h6>'.number_format($rows1).' records found . </h6>';  
      		}  
		    else {  
		           $output .= ' <tr> <td colspan="5">No Records Found</td>  </tr>  ';  
		    }  

       }catch (PDOexception $e) {
	    echo "Error is: " . $e->getmessage();
		} 
      echo $output;  
      //echo $query1;
   
 ?>
