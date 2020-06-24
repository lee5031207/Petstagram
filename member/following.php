<?header("content-type:text/html; charset=UTF-8");

include("../lib/dbconnection.php");
$connect = dbconn();  //db함수 호출


$following_id=$_GET['follow_data'];
$user_id = $_GET['userdata'];

$choose = "select * from member where user_id = '$following_id'";
$choose_result = mysqli_query($connect, $choose);
$choose_data = mysqli_fetch_array($choose_result);

$query = "insert into ".$user_id."_following (user_id, name) values('$choose_data[user_id]','$choose_data[name]')";
mysqli_query($connect, $query);

?>

<script>
    window.alert("팔로우성공");
    history.back();
</script>
