<?header("content-type:text/html; charset=UTF-8");
'ob_start';//뭔지모르겠음 이해가안감 왜쓴느지

include("../lib/dbconnection.php");
$connect = dbconn();

$user_id=$_POST['user_id'];
$pws=$_POST['pw'];

$pw = md5($pws);   //md5(암호화하는함수)

$query = "select * from member where user_id='$user_id'";
//앞에것은 데베의 필드값 뒤에것은 로그인 입력시 들어오는값 이런식으로 대조하여 아이디가 있는지 확인한다

$result= mysqli_query($connect, $query);  //여기서 mysql쿼리가 실행되는거자나 만약 입력아디값이 데베에없으면 empty가 반환된는거자나
$member= mysqli_fetch_array($result);  //그럼 여기서도 member는 empty?
//user_id[lee5031207],name[이성욱]...pw[1234]...... 이런식으로 값이 나오는건가?

if(!$user_id){
    error("아이디를 입력하시오");
}else if(!$member['user_id']){
    error("아이디가 존재 하지 않습니다.");
}

if(!$pw){
        error("비밀번호를 입력하시오");
}else if($member['pw']!=$pw){
        error("비밀번호가 같지 않습니다.");
}
if($member['user_id'] and $member['pw']==$pw){
    $tmp=$member['user_id']."//".$member['pw'];
    setcookie("COOKIES",$tmp,time()+60*60*24,"/" );  //24시간동안 유효
    }
?>
<script>
    // window.alert("로그인되셨습니다.");
    location.href = "../index.php";
</script>
