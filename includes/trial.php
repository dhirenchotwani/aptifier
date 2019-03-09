<?php
$arrray = array();
array_push($arrray,1);
array_push($arrray,2);
array_push($arrray,3);
array_push($arrray,4);
call($arrray);

function call($arrray){
    foreach($arrray as $id){
        echo $id;
    }
}
?>