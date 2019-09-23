<?php
//Test Connection
require_once("isdk.php");	
$app = new iSDK;

if( $app->cfgCon("ov677")){ 

//random key = 49ffcabf-f2ed-4ecf-9732-eecd1bd87102

	$email = $_REQUEST['email'];
	$cartsessionURL = $_REQUEST['cartsessionURL'];
	$firstname = $_REQUEST['firstname'];
	$lastname = $_REQUEST['lastname'];
	$orderitem1name = $_REQUEST['orderitem1name'];
	$orderitem1imageURL = $_REQUEST['orderitem1imageURL'];
	$api_key = $_REQUEST['api_key'];
	$apikey = '49ffcabf-f2ed-4ecf-9732-eecd1bd87102';
  
	  if($apikey == $api_key AND $orderitem1name != null AND $cartsessionURL != null AND $email != null){
		  
		  //
		  $returnFields = array('Id');
			$data = $app->findByEmail($email, $returnFields);
			
			foreach($data as $datas){
				$user_id = $datas['Id'];
			}  
			
				 //If contact not exist 
				if($user_id == null){		
					//Create contact		
					$contactData = array('FirstName' => $firstname,
					  'LastName'  => $lastname,
						'Email'     => $email);
						$conID = $app->addCon($contactData);
							
					//Get contact Id
						$returnFields = array('Id');
						$data_id = $app->findByEmail($email, $returnFields);
						
						foreach($data_id as $datas){
							$user_id = $datas['Id'];
						} 
					//Insert into custom fields
					$grp = array('_Orderitem1name'  => $orderitem1name,
								 '_Orderitem1image'  => $orderitem1imageURL,
								 '_CartSessionURL'  => $cartsessionURL);
						
					$grpID = $app->updateCon($user_id, $grp);
					
					//Trigger api call
					$Integration = 'pg2019';
					$callName = 'abandoncart';

					$app->achieveGoal($Integration, $callName, $user_id);
					
					echo "Success!"."<br>";
					echo $user_id;
					
				}
				
				//insert into the found contact
				else{
					$grp = array('_Orderitem1name'  => $orderitem1name,
								 '_Orderitem1image'  => $orderitem1imageURL,
								 '_CartSessionURL'  => $cartsessionURL);
					 
					 $grpID = $app->updateCon($user_id, $grp);
					 
					//Trigger Api call
					$Integration = 'pg2019';
					$callName = 'abandoncart';

					$app->achieveGoal($Integration, $callName, $user_id);
					echo "Success!"."<br>";
					echo $user_id;
				}
				
		// 
	  }else{
			echo "failed. missing fields";
		}
}
//
?>

