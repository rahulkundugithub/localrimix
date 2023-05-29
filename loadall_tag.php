<?php
require_once 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // //fetching search item from ajax
    // $item=!empty($_POST['item'])?$_POST['item']:'';
    // //echo "success";
    
    // if (empty($item)) {
    //     die('Search a valid tag!');
    // } // Check if all required fields are filled
    if (empty($_POST['categoriesid'])) {
        die('Atleast one Subcategory needs to be selected!');
    } // Check if all required fields are filled
    else
    {
        $categoriesid=!empty($_POST['categoriesid'])?$_POST['categoriesid']:'';
    // echo $categoriesid;
    }
foreach($categoriesid as $element){
    $query="SELECT * FROM tag WHERE cat_id=".$element;
    $result=mysqli_query($conn,$query);
    while($arr=mysqli_fetch_assoc($result))
    {
        // echo "got";
        echo "<li><input type='checkbox' id='".$arr['id']."' name='tags[]' value='".$arr['tag']."' class='myCheckbox_tag'>
        <label for='".$arr['id']."'>".$arr['tag']."</label></li>&nbsp;&nbsp;";
    }
}
}
else
{
    die('Invalid request');
}
