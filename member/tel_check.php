<?header("content-type:text/html; charset=UTF-8");

include("../lib/dbconnection.php");
$connect = dbconn();  //db함수 호출

$tel=$_REQUEST['userdata'];
$cnt=strlen($tel);
if($cnt!=11){
    echo "전화번호는 11자리 숫자로 입력해 주십시오";
}

?>