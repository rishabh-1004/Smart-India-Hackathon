<?php
require_once('config.php');
  $empid = $_GET['id'];
  echo $empid;
  $block=1;

  $query = $connection->prepare("SELECT block FROM bemp_registration WHERE empid=?");
  $query->bind_param('s',$empid);
  $query->execute();
  $query->store_result();
  $query->bind_result($ans['block']);
  $j=$query->num_rows;
  for ($i=0;$i<$j;$i++)
  {
    $query->data_seek($i);
    $query->fetch();
    foreach ($ans as $key=>$value)
    {
      $result[$i][$key]=$value;
    }
  $res =  $result[$i]['block'];
}
  if ($res == 0)
  {
    $block=1;
    $query = $connection->prepare (" UPDATE bemp_registration SET block=? WHERE empid=?");
  $query->bind_param('ss',$block,$empid);
  $query->execute();
  $query->store_result();
  $numRows = $query->affected_rows;
          if($numRows>0)
          {
              header('Location: bhaemployee.php');
          }
          else
              echo " this is wrong ";
                   $query->close();
    }
    else if($res==1)
    {
      $block=0;
      $query = $connection->prepare (" UPDATE bemp_registration SET block=? WHERE empid=?");
    $query->bind_param('ss',$block,$empid);
    $query->execute();
    $query->store_result();
    $numRows = $query->affected_rows;
            if($numRows>0)
            {
                header('Location: bhaemployee.php');
            }
            else
                setcookie ( "msg", "Error Unknown.", time()+60 );
                     $query->close();
    }
 ?>
