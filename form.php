<?php 

echo '<p class="hClass"><strong> Form with Classes </strong></p>';

include_once('app/formclass.php');

$dbname   = 'calendar';
$dbusername = 'katrinzxr40';
$dbpassword = 'tapok838';

$dbo = new PDO('mysql:host=127.0.0.1;dbname=katrinzxr40',$dbusername, $dbpassword);
$errors = array('topic'=>'', 'type'=>'', 'place'=>'','mydate'=>'', 'mytime'=>'', 'duration'=>'', 'comment'=>'');

use app\Form;

$form = new Form;
$check = 0;
if (empty($_POST['task'])) {
	$_POST['task']='';
}

if (($_POST)&&($_POST['task']=='SEND')) {
  
	foreach($_POST as $key =>$value) {
		$_POST[$key] = trim($value);
  }

  
  $form = $form->addForm();
  
  if ($form->validate()) {
    	$form->addForm();
      $form->saveBd($dbo);
  } else {
    	$errors = $form->getErrors();
  } 
}

?>
