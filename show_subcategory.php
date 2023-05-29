<?php
require_once 'config.php';

//fetching category data from ajax
$parent_id=!empty($_POST['parent_id'])?$_POST['parent_id']:'';
//fetching subcategory data from database
if(!empty($parent_id)){
    $sub_category="SELECT id,category FROM category WHERE parent_cat=".$parent_id;
    $result=mysqli_query($conn,$sub_category);
    while($arr=mysqli_fetch_assoc($result)){
        //echo "<option value='".$arr['id']."'>".$arr['category']."</option><br>";//this is the result that will be sent to ajax

        echo "<input type='checkbox' id='".$arr['id']."' name='categories[]' value='".$arr['category']."' class='myCheckbox'>
        <label for='".$arr['id']."'>".$arr['category']."</label><br>";
    //    echo "<h1>pi pi</h1>";
    }
}


//echo $parent_id;



?>
