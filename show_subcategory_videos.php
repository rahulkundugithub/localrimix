<?php
require_once 'config.php';
include('time_ago.php');





if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // if(empty($_POST['categoriesid'])) {
    //     die('Atleast one filter selection is required!');
    // } 
    $id=$_POST['id'];
    if ($id != "f") {
        require_once 'User.class.php';
    }
    
    if ($id == "f")
        require_once('user_auth.php');
    
    if ($id != "f") {
        // session_start();
        $userData = $_SESSION['userData'];
    }
    $pid=$_POST['pid'];
    $item=$_POST['item'];
    // $categoriesid=implode(",",$temp);
    //echo $pid;
    //var_dump($categoriesid);
    //echo $categoriesid;
    
    // $sql = "select * from videos where vid_built COLLATE utf8mb4_general_ci in (SELECT distinct(vid_built) from video_subcategory where subcategory_id in (".$categoriesid."))";
    $sql="select * from videos where parent_category_id=".$pid." and tags like '%".$item."%'";
    $result = mysqli_query($conn,$sql);
   //echo $sql;
   if ($result->num_rows > 0)
   {
       while ($arr = mysqli_fetch_assoc($result)) 
       {

           ?>
                   <div class="col-lg-3 col-md-6 col-sm-6" id="tube-parent">
                       <div class="tube-post">
                           <a href="researchvideo.php?id=<?= $id ?>&vd=<?= $arr['vid_id'] ?>" title="">
                               <figure>
                                   <img src="<?= $arr['thumbnail_path'] ?>" style=" object-fit: cover; width:252px; height:154px; " alt="<?= $arr['title'] ?>">
                               </figure>
                               <div class="tube-title">
                                   <h6>
                                       <?= $arr['title'] ?>
                           </a></h6>
                           <div class="user-fig">
                               <img alt="<?= $arr['channel_name'] ?>" src="<?= $arr['channel_img'] ?>">
                               <a title="<?= $arr['channel_name'] ?>" href="research-channel.php?id=<?= $id ?>&chnl=<?= $arr['username'] ?>"><?= $arr['channel_name'] ?></a>
                           </div>
                           <span class="upload-time">
                               <?php echo time_elapsed_string($arr['date']); ?>
                           </span>
                       </div>
                   </div>
               </div>
               
           <?php
       }
   }
   else
   {
       die ("<h3>No videos found</h3>");
   }
    exit;
}
    die('Invalid request');
?>