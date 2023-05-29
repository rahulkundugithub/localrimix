<?php
require './aws-autoloader.php';
	
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $video = $_FILES['video'];
    $thumbnail = $_FILES['thumbnail'];
    $channel_img = $_POST['channel_img'];
    $channel_name = $_POST['channel_name'];
    $username = $_POST['username'];
    $user_id = $_POST['user_id'];
    $pcat_id=$_POST['pcat_id'];
    $pcat_val=$_POST['pcat_val'];
// echo $description;
    // Check if all required fields are filled
    if (empty($title)) {
        die('Title is required!');
    } // Check if all required fields are filled
    if (empty($video)) {
        die('Video field is required!');
    } // Check if all required fields are filled
    if (empty($thumbnail)) {
        die('Thumbnail field is required!');
    }
    //check if category is selected
    if ($pcat_id<=0 || empty($pcat_val)) {
        die('Category is required!');
    }
    

   // Check if all sub category fields are filled
    if(empty($_POST['categories'])) {
        die('Subcategories are required!');
    } 
    
   // Check if all sub category fields are filled
   if(empty($_POST['tags'])) {
    die('Atleast one Tag is required!');
} 

    // Check if all required fields are filled
    if(empty($description)) {
        die('Description is required!');
    } 


    // Check if the video file is valid
    if (!is_uploaded_file($video['tmp_name']) || $video['error'] !== UPLOAD_ERR_OK) {
        die('Invalid video file');
    }

    // Check if the thumbnail file is valid
    if (!is_uploaded_file($thumbnail['tmp_name']) || $thumbnail['error'] !== UPLOAD_ERR_OK) {
        die('Invalid thumbnail file');
    }

     $scat_id = implode(',', $_POST['categoriesid']);
     $scat_value = implode(',', $_POST['categories']);
     $tagid=implode(',',$_POST['tagid']);
     $tags=implode(',',$_POST['tags']);
    // Move the uploaded files to the desired location
    //$videoPath = 'upload/' . uniqid('', true) . '_' . $video['name'];
    $videoPath = 'https://researchremix.s3.amazonaws.com/upload/' . uniqid('', true) . '_' . $video['name'];
    $thumbnailPath = 'thumbnail/' . uniqid('', true) . '_' . $thumbnail['name'];
    if(!move_uploaded_file($video['tmp_name'], $videoPath)){
        die('Unable to move video file');
    }
    if(!move_uploaded_file($thumbnail['tmp_name'], $thumbnailPath)){
        die('Unable to move thumbnails file');
    }

    // Insert the video information into the database
     $db = new mysqli('localhost', 'root', '', 'u151549897_research');
    // $db = new mysqli('localhost', 'phpmyadmin', 'nfe', 'research');
    if ($db->connect_errno) {
        die('Failed to connect to database');
    }
    //$query = "INSERT INTO video (title, description,thumbnail ,video, vd_path, thumb_path) VALUES (?, ?, ?, ?)";
    //$stmt = $db->prepare($query);
    //$stmt->bind_param('ssss', $title, $description, $thumbnailPath, $videoPath, $videoPath, $thumbnailPath);

    $date = date("j-m-Y G:i:s");
    // $category = array('Atomistic models','Applied optics','Biomaterials');
    
    $name = $_FILES["video"]["name"];
    $size_vd = $_FILES["video"]["size"];
    $type = $_FILES["video"]["type"];

    // die($date);
    // die($categories);
    // die($name);
    // die($size);
    // die($type);

    $vid_built=time().'-video';


    // $sql = "INSERT INTO videos SET vid_path = '".$videoPath."', thumbnial_path = '" . $thumbnailPath . "', date='".$date."', title = '" . $title . "' , descrip = '" . $description . "', categories='".$categories."', username='".$username."', user_id='".$user_id."', channel_name='".$channel_name."', channel_img='".$channel_img."',  name='".$name."', size='".$size_vd."', type='".$type."'";

// $sql = "INSERT INTO `videos`(`vid_path`, `thumbnail_path`, `date`, `title`, `descrip`, `categories`, `username`, `user_id`, `channel_name`, `channel_img`, `name`, `size`, `type`,`parent_category`,`parent_category_id`,`categories_value`) VALUES ('$videoPath','$thumbnailPath','$date','$title','$description','$scat_id','$username','$user_id','$channel_name','$channel_img','$name','$size_vd','$type','$pcat_val','$pcat_id','$scat_value')";

    $sql = "INSERT INTO `videos`(`vid_path`, `thumbnail_path`, `date`, `title`, `descrip`, `categories_value`, `username`, `user_id`, `channel_name`, `channel_img`, `name`, `size`, `type`,`parent_category`,`parent_category_id`,`categories`,`vid_built`,`tag_id`,`tags`) VALUES ('$videoPath','$thumbnailPath','$date','$title','$description','$scat_id','$username','$user_id','$channel_name','$channel_img','$name','$size_vd','$type','$pcat_val','$pcat_id','$scat_value','$vid_built','$tagid','$tags')";


    foreach($_POST['categoriesid'] as $arr_video)
    {
        foreach($_POST['tagid'] as $tagid)
        {
             $sqll="SELECT cat_id FROM tag where id=".$tagid;
             $resultt=$db->query($sqll);
              while($ar=mysqli_fetch_assoc($resultt))
              {
                //echo $ar['cat_id'];
                 if($arr_video==$ar['cat_id'])
                 {
                    //echo $arr_video."and".$ar['cat_id'];
        $video_subcategory="INSERT INTO `video_subcategory`(`vid_built`, `parent_categorty_id`, `subcategory_id`,`tag_id`) VALUES ('$vid_built','$pcat_id','$arr_video','$tagid')";
        $db->query($video_subcategory);
                 }
             }
        }
    }
    

    if ($db->query($sql) === TRUE) {
        echo 'video uploaded successfully';
    } else {
        die('Failed to insert video into database');
    }
    

    exit;
}

die('Invalid request');
?>