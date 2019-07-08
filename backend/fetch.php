
<?php  
 //filter.php  
require('../app/init.php');
$output = '';
$dbdata = array();
$query1 = "select count(DISTINCT email) from sample	;";
$query2 = "select count(DISTINCT location) from sample	;";

 if($_POST["action"] == "filter" && isset($_POST["from_date"], $_POST["to_date"]) && !empty($_POST["from_date"] && !empty($_POST["to_date"]))) 
 {  
 	$query .= ""; 
    //$query .= " WHERE date BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]." ORDER BY id DESC' ";  
} 

   try {
       	    
      		$result1 = $db->prepare($query1); 
			$result1->execute(); 
			$rows1 = $result1->fetchColumn(); 

			$result2 = $db->prepare($query2); 
			$result2->execute(); 
			$rows2 = $result2->fetchColumn(); 
      		
      		
			if(isset($result1))  
			{  
		            $output .= '  
		                     <h6>'.number_format($rows1).' records found . </h6>
		                     <h6>'. number_format($rows2) .' cities found . </h6>
		                ';  
      		}  
		    else {  
		           $output .= '  
		                <tr>  
		                     <td colspan="5">No Records Found</td>  
		                </tr>  
		           ';  
		    }  

       }catch (PDOexception $e) {
	    echo "Error is: " . $e->getmessage();
		} 
      echo $output;  
   
 ?>
