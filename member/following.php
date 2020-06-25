<?header("content-type:text/html; charset=UTF-8");

include("../lib/dbconnection.php");
$connect = dbconn();  //db함수 호출



///////////////////////팔로잉 테이블 작업///////////////////////

$following_id=$_GET['follow_data'];     
$user_id = $_GET['userdata'];   

$choose = "select * from member where user_id = '$following_id'";
$choose_result = mysqli_query($connect, $choose);
$choose_data = mysqli_fetch_array($choose_result);

$following_query = "insert into ".$user_id."_following (user_id, name) values('$choose_data[user_id]','$choose_data[name]')";


//////////////////////팔로워 테이블 작업/////////////////////// 

$choose2  = "select * from member where user_id = '$user_id'";
$choose2_result = mysqli_query($connect, $choose2);
$choose2_data = mysqli_fetch_array($choose2_result);

$follower_query = "insert into ".$following_id."_follower (user_id, name) values('$choose2_data[user_id]','$choose2_data[name]')";

mysqli_query($connect, $following_query);
mysqli_query($connect, $follower_query);


?>

<script>
    location.href="./member_info.php?user_id=<?=$following_id?>"
</script>
