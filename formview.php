<?php

include_once('app/formclass.php');

use app\Form;

$form = new Form;

?>
<!DOCTYPE html>
<head>
	<title> From </title>
  <style>
  .forma3 {
      margin-left: 80px;
      margin-top: 70px;
    }
    

  .error {
      color: white;
    }

  label {
      font-size: 25px; 
      color: #D1D0E8;
  }
    
  .inpf3 , select {
    border:2px;
    background-color: #ACA9D0;
    color:#fff;
    opacity: 80%;
    font-family:inherit;
    margin-top:25px;
    margin-bottom:20px;
    font-size:20px;
    min-height:35px;
  }
    
  .norm {
    min-width:700px;
    max-width:800px;
  }
    
  .formdate {
    min-width:20%;
    max-width:800px;
  }
    
   .formtime {
    min-width:100px;
    max-width:200px;
  }
  
  .checkbox {
    margin:0px;
    height:22px;
    width:22px;
    margin-right:8px;
  }
  
  .check {
    display: flex;
    align-items: left;
    justify-content: left;
  }
    
  .gobutt {
    margin-top:30px;
    height:33px;
    width:200px;
  }
    
  </style>
     
</head>
<body>
 <form class="form" method="POST" action="" novalidate="" >
  <div class="form-group topicform">
		<label> Topic </label>
    <br>
		<input type="text" name="topic" class="inpf3 topicinp" required value="<?= !empty($_POST['topic']) ? $_POST['topic'] : '' ?>">
    <br>
		<span class="error"><?= $errors['topic'] ?></span>
	</div>
  
	<div class="form-group formtype">
		<label> Type </label>
    <br>
		<select name="type">
			<option value="">--</option>
      <?php foreach ($form->getTypes() as $typeId => $typeName): ?>
	    <option value="<?= $typeId ?>" <?=!empty($_POST['type']) && $_POST['type'] == $typeId ? 'selected' :'' ?>><?= htmlspecialchars($typeName) ?></option>
      <?php endforeach ?>
		</select>
    <br>
		<span class="error"><?= $errors['type'] ?></span>
	</div>

	<div class="form-group">
		<label> Place </label>
    <br>
		<input type="text" name="place" class="inpf3 norm" required value="<?= !empty($_POST['place']) ? $_POST['place'] : '' ?>">
    <br>
		<span class="error"><?= $errors['place'] ?></span>
	</div>
  
   
  <div class="form-group dateform">
		<label> Date </label>
    <br>
		<input type="text" name="mydate" class="inpf3 formdate" required value="<?= !empty($_POST['date']) ? $_POST['date'] : '' ?>">
    <br>
		<span class="error"><?= $errors['mydate'] ?></span>
	</div>
  
  <div class="form-group timeform">
		<label> Time </label>
    <br>
		<input type="text" name="mytime" class="inpf3 formtime" required value="<?= !empty($_POST['time']) ? $_POST['time'] : '' ?>">
    <br>
		<span class="error"><?= $errors['mytime'] ?></span>
	</div>
  

	<div class="form-group dateform">
		<label> Duration </label>
    <br>
		<select name="duration" class="inpf3">
			<option value="">--</option>
      <?php foreach ($form->getDurations() as $durationId => $durationName): ?>
	    <option value="<?= $durationId ?>" <?=!empty($_POST['duration']) && $_POST['duration'] == $topicId ? 'selected' :'' ?>><?= htmlspecialchars($durationName) ?></option>
      <?php endforeach ?>
		</select>
    <br>
		<span class="error"><?= $errors['duration'] ?></span>
	</div>
  
   <div class="form-group">
		<label> Comment </label>
    <br>
		<input type="textarea" name="comment" class="inpf3 norm" required value="<?= !empty($_POST['comment']) ? $_POST['comment'] : '' ?>">
    <br>
		<span class="error"><?= $errors['comment'] ?></span>
	</div>

		<input class="gobutt" type="submit" value="SEND" name="task"> 
</form>

</body>
</html>
