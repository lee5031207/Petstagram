<?header("content-type:text/html; charset=UTF-8");

include("../lib/dbconnection.php");
$connect = dbconn();  //db함수 호출


$nick_name=$_REQUEST['nickdata'];

$query = "select * from member where nick_name = '$nick_name'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);


if(!$nick_name){
   echo "닉네임을 입력해 주십시오";
}else if($data){
    echo $nick_name;
    echo"는(은) 이미 존재하는 닉네임 입니다";
}else{
    echo $nick_name;
    echo "는(은) 사용 가능한 닉네임 입니다.";
}

?>
