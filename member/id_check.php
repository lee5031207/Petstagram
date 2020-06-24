<?header("content-type:text/html; charset=UTF-8");

include("../lib/dbconnection.php");
$connect = dbconn();  //db함수 호출


$user_id=$_REQUEST['userdata'];

$query = "select * from member where user_id = '$user_id'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);


if(!$user_id){
   echo "아이디를 입력해 주십시오";
}else if($data){
    echo $user_id;
    echo"는(은) 이미 존재하는 아이디 입니다";
}else{
    echo $user_id;
    echo "는(은) 사용 가능한 아이디 입니다.";
}

?>
