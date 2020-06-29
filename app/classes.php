<?php

namespace app;

class Form {
	public $topic;
	public $type;
	public $place;
	public $mydate;
	public $mytime;
	public $duration;
	public $comment;
  
	protected $user_id;
  protected $state = 0;

	protected $errors = [];
  
  protected static $types = [
	'1' => 'Meeting', 
  '2' => 'Training', 
	'3' => 'Working', 
	'4' => 'Project', 
	'5' => 'Сreativity',
	'6' => 'Relax',
	'7' => 'Communication',
	'8' => 'Sleep',
  ];
  
  protected static $durations = [
	'1' => '5 минут', 
	'2' => '10 минут', 
	'3' => '15 минут',  
	'4' => '30 минут',
	'5' => '45 минут',
	'6' => 'час',
	'7' => 'час 15 минут',
	'8' => 'час 30 минут',
	'9' => 'час 45 минут',
	'10' => '2 часа',
	'12' => '2 часа 15 минут',
	'13' => '2 часа 30 минут',
	'14' => '2 часа 45 минут',
	'15' => '3 часа',
	'16' => '3 часа 15 минут',
	'17' => '3 часа 30 минут',
	'18' => '3 часа 45 минут',
	'19' => '4 часа',
	'20' => '4 часа 15 минут',
	'21' => '4 часа 30 минут',
	'22' => '4 часа 45 минут',
	'23' => '5 часов',
  ];
  

	public function validate() {
		$errors = array('topic'=>'', 'type'=>'', 'place'=>'','mydate'=>'', 'mytime'=>'', 'duration'=>'', 'comment'=>'');
    
    foreach ($_POST as $id => $value) {
      $_POST[$id] = str_replace(' ','',$_POST[$id]); 
    }
    
		if (empty($_POST['topic'])) {
			$errors['topic'] = 'Topic is required!';
		} else if (mb_strlen($_POST['topic']) < 3) {
			$errors['topic'] = 'Topic must be more than 3 symbols';
		} else if (mb_strlen($_POST['topic']) > 100) {
			$errors['topic'] = 'Topic must be less than 100 symbols';
		}

		if (empty($_POST['place'])) {
			$errors['place'] = 'Place is required!';
		} else if (mb_strlen($_POST['place']) < 3) {
			$errors['place'] = 'Place must be more than 3 symbols';
    } else if (mb_strlen($_POST['place']) > 100) {
			$errors['place'] = 'Place must be less than 100 symbols';
		}
	  
	  	if (empty($_POST['mydate'])) {
			$errors['mydate'] = 'Date is required!';
		} else if (mb_strlen($_POST['mydate']) < 10) {
			$errors['mydate'] = 'Date must be more than 9 symbols';
		} else if (mb_strlen($_POST['mydate']) > 20) {
			$errors['mydate'] = 'Date must be less than 20 symbols';
		}
	  
	  	if (empty($_POST['mytime'])) {
			$errors['mytime'] = 'Time is required!';
		} else if (mb_strlen($_POST['mytime']) < 5) {
			$errors['mytime'] = 'Time must be more than 4 symbols';
		} else if (mb_strlen($_POST['mytime']) > 8) {
			$errors['mytime'] = 'Time must be less than 40 symbols';
		}
    
    if (empty($_POST['comment'])) {
      $errors['comment'] ='';
    } else if (mb_strlen($_POST['comment']) > 256) {
			$errors['comment'] = 'Comment must be less than 255 symbols';
		}
	  
		if (empty($_POST['type'])) {
			$errors['type'] = 'Type is required!';
		}
	  
	  if (empty($_POST['duration'])) {
			$errors['duration'] = 'Payment method is required!';
		} 
		$this->errors = $errors;
    //print_r ($this->errors);
		return $this->errors;
	}

	public function getErrors() {
		return $this->errors;
	}
  
  public function setState($state) {
    return $this->state = $state;
  }
  
  public function setUserId($user_id) {
    return $this->user_id = $user_id;
  }
  
  public function getState() {
    return $this->state;
  }
  
  public function getUserId() {
    return $this->user_id;
  }
  
   public function getDurations() {
    return static::$durations;
  }
  
  public function getTypes() {
    return static::$types;
  }
  
   public function getDuration($key) {
    return static::$durations[$key];
  }
  
   public function getType($key) {
    return static::$types[$key];
  }
  
  public function validateDateTime() {
    if (preg_match('/(\d{4}).(\d{1,2}).(\d{1,2})/' , $this->mydate, $matches)) {
      $this->mydate= $matches[1].'-'.$matches[2].'-'.$matches[3];
      echo $changedate;
    } else if (preg_match('/(\d{1,2}).(\d{1,2}).(\d{4})/' , $this->mydate, $matchess)) {
      $this->mydate= $matchess[3].'-'.$matchess[2].'-'.$matchess[1];
    }
    
    if (preg_match('/(\d+).(\d+).(\d*)/' , $this->mytime, $matches)) {
      $this->mytime = $matches[1].':'.$matches[2];
      if (!$matches[3]) {
        $matches[3] = '00';
      } 
      $this->mytime = $this->mytime.':'.$matches[3]; 
    }
  }
  
  public function addForm() {
    $this->topic = $_POST['topic'];
    $this->type = $_POST['type'];
    $this->place = $_POST['place'];
    $this->mydate = $_POST['mydate'];
    $this->mytime = $_POST['mytime'];
    $this->duration = $_POST['duration'];
    $this->comment = $_POST['comment'];
    $this->setUserId(getenv('REMOTE_ADDR'));
    
    $this->validateDateTime();
      
    /*if ($this->mydate==date('Y-m-d')) {
      $this->setState(1); } else $this->setState(2);*/
    
    return $this;
  }
  
  function getForm() {
    return $this;
  }
  
  
  public function saveBd($dbo) {
    $values = [];
    foreach ($this as $name=>$val) {
         if ($val) {
            array_push($values,$val);
      }
    }

    $intval = '`topic`, `type_id`, `place`, `date`, `time`, `duration_id`,`comment`,`user_id`,`state`';
    $as = ':topic, :type, :place, :mydate, :mytime, :duration, :comment, :user_id, :state';
    
    $dbohey = $dbo->prepare("INSERT INTO `calendar` ($intval) VALUES ($as)");
    $dbohey->bindParam(':topic', $topic);
    $dbohey->bindParam(':type', $type);
    $dbohey->bindParam(':place', $place);
    $dbohey->bindParam(':mydate', $mydate);
    $dbohey->bindParam(':mytime', $mytime);
    $dbohey->bindParam(':duration', $duration);
    $dbohey->bindParam(':comment', $comment);
    $dbohey->bindParam(':user_id', $user_id);
    $dbohey->bindParam(':state', $state);
    
    $noinsert = 1;
    
    foreach ($dbo->query('SELECT * FROM `calendar`;') as $row) {
      if (($row['type_id']==$this->type)&&($row['place']==$this->place)&&($row['topic']==$this->topic)&&
          ($row['date']==$this->mydate)&&($row['time']== $this->mytime)&&($row['duration']==$this->duration)&&
         ($row['comment']==$this->comment)&&($row['user_id']==$this->user_id)&&($row['state']==$this->state)) {
        $noinsert = 0;
      }
    }
    
    if ( $noinsert==1) {
       $dbohey ->execute();
    }
    //print_r($dbohey->errorInfo());
  }
  
}

class AdminForm extends Form {
  
  public $state;
  public $content;
  
  public function select($dbo, $dbname) {
    if (empty($_POST['task'])) {
      $_POST['task']='';
    }
    
    if ($_POST) {
      if ((!empty($_POST['sel_ids_bd']))&&($_POST['task']=='UPDATE SELECTED')) {
        $id = $_POST['sel_ids_bd'];
        $del_date = date('Y-m-d H:i:s ');
        $dbo->exec("UPDATE $dbname SET `state`= 2 WHERE `id` = $id;");
        /*echo '<p class="ptext"> ROW WITH ID = '.$id. ' UPDATED </p>';*/
      }
    }
  }
  
  public function setRow($row) {
    $this->topic = $row['topic'];
    $this->type = $row['type_id'];
    $this->place = $row['place'];
    $this->mydate = $row['date'];
    $this->mytime = $row['time'];
    $this->duration = $row['duration_id'];
    $this->comment = $row['comment'];
    $this->user_id = $row['user_id'];
    $this->state = $row['state'];
    $this->id = $row['id'];
    
  }
  
  public function getTypeName($dbo) {
    $sql = $dbo->prepare("SELECT * FROM `types` WHERE `id`= :type LIMIT 1;");
    $sql->execute([':type' =>  $this->type]);
    $user = $sql->fetch();
    $type =  $user['name'];
    return $type;
  }
  
  public function getStateName() {
    $stateName = '';
     switch ($this->state) {
      case 0: 
      	$stateName = '';
        break;
      case 1: 
       $stateName = 'Current Task';
       break;
      case 2:
       $stateName = 'Complete Task';
       break;
    }
    return $stateName;
  }
  
  public function getAdmin($dbo, $dbname) {
  $data = [];
    
  foreach ($dbo->query("SELECT * FROM $dbname;") as $row) {
    
  $this->setRow($row);
  $type = $this->getTypeName($dbo);
  $this->duration = $this->getDuration($this->duration);  
  $stateName = $this->getStateName();     	
    
  if($this->state!==0) {  
     $data[] = [
        'topic' => $this->topic,
        'type' => $this->type,
        'place' => $this->place,
        'date' => $this->mydate,
        'time' => $this->mytime,
        'duration' => $this->duration,
        'comment' => $this->comment,
        'user_id' => $this->user_id,
        'id' => $this->id,
        'state' => $stateName,
       ];
     }  
  }
 
  return $data;  
    
}
  
}

?>
