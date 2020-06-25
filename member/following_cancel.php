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
echo $choose_data_user_id;

$following_query = "delete from ".$user_id." following where user_id = ".$choose_data_user_id;

$where_query = "where user_id =";


//////////////////////팔로워 테이블 작업/////////////////////// 

$choose2  = "select * from member where user_id = '$user_id'";
$choose2_result = mysqli_query($connect, $choose2);
$choose2_data = mysqli_fetch_array($choose2_result);
$choose2_data_user_id = (string)$choose2_data['user_id'];

echo $choose2_data_user_id;

$follower_query = "delete from ".$following_id." _follower where user_id = ".$choose2_data_user_id;
 
$following = mysqli_query($connect, (string)$following_query);
$follower =  mysqli_query($connect, (string)$follower_query);


?>

<script>
    //window.alert("팔로우 취소");
    //history.back();
</script>
