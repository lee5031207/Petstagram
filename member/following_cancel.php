<?header("content-type:text/html; charset=UTF-8");

include("../lib/dbconnection.php");
$connect = dbconn();  //db함수 호출

///////////////////////팔로잉 테이블 작업///////////////////////

$following_id=$_GET['follow_data'];     
$user_id = $_GET['userdata'];   

$choose = "select * from member where user_id = '$following_id'";
$choose_result = mysqli_query($connect, $choose);
$choose_data = mysqli_fetch_array($choose_result);
$choose_data_user_id = (string)$choose_data['user_id'];

$following_query = "DELETE from ".$user_id."_following WHERE user_id = '".$choose_data_user_id."'";

$where_query = "where user_id =";


//////////////////////팔로워 테이블 작업/////////////////////// 

$choose2  = "select * from member where user_id = '$user_id'";
$choose2_result = mysqli_query($connect, $choose2);
$choose2_data = mysqli_fetch_array($choose2_result);
$choose2_data_user_id = (string)$choose2_data['user_id'];


$follower_query = "DELETE FROM ".$following_id."_follower WHERE user_id = '".$choose2_data_user_id."'";
 
$following = mysqli_query($connect, $following_query);
$follower =  mysqli_query($connect, $follower_query);


?>

<script>
    location.href="./member_info.php?user_id=<?=$following_id?>"
</script>
