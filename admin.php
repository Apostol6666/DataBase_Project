<?php 
include_once('app/formclass.php');

mb_internal_encoding('UTF-8');

$dbname   = 'calendar';
$dbusername = 'katrinzxr40';
$dbpassword = 'tapok838';

$dbo = new PDO('mysql:host=127.0.0.1;dbname=katrinzxr40;charset=UTF8',$dbusername, $dbpassword);

use app\AdminForm;
$admin = new AdminForm;

$admin->select($dbo, $dbname);
$data = $admin->getAdmin($dbo,  $dbname);

?>

<!DOCTYPE html>
<html>
<head>
  <title> </title>
  <style>
    
    .input_it {
      width:40px;
      margin-right:15px;
    }
    
    .name_it2 {
      color: #ACA9D0;
      display:flex;
      align-items:center;
      font-size:20px;
    }
    
    .admin_form {
     font-family:inherit;
     color:white; 
    }
    
    .sel_id {
     font-family:inherit;
     margin-left:20px;
     height: 60px;
     width: 140px;
    }
    
    table {
      border-spacing: 11px 11px;
    }
    
    td {
      font-family:inherit;
    }
    
  </style>
</head>

<body>
  <h1 class="admin_zone"> TASK LIST</h1>

  <form method="POST" class="admin_form">
    <table> 
      <thead>
        <strong><th> ID </th></strong>
        <strong><th> Topic </th></strong>
        <strong><th> Type </th></strong>
        <strong><th> Place </th></strong>
        <strong><th> Date </th></strong>
        <strong><th> Time </th></strong>
        <strong><th> Duration </th></strong>
        <strong><th> Comment </th></strong>
        <strong><th> State </th></strong>
      </thead>
    <tbody>
      <?php foreach ($data as $id => $item): ?>
        <tr>
          <td>
          <div class="name_it2">
          <input type="checkbox" class="input_it" name="sel_ids_bd" value="<?= $item['id'] ?>"/>
          <?= $item['id'] ?> 
          </div>
          </td>
          <td> <?= $item['topic'] ?> </td>
          <td> <?= $item['type'] ?> </td>
          <td> <?= $item['place'] ?> </td>
          <td> <?= $item['date'] ?> </td>
          <td> <?= $item['time'] ?> </td>
          <td> <?= $item['duration'] ?> </td>
          <td> <?= $item['comment'] ?> </td>
          <td> <?= $item['state'] ?> </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
      <br>
    <input class="sel_id" type = "submit" value="UPDATE SELECTED" name="task">
  </body>
  </html>
