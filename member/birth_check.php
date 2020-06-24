<?header("content-type:text/html; charset=UTF-8");

include("../lib/dbconnection.php");
$connect = dbconn();  //db함수 호출

$birth=$_REQUEST['userdata'];
$cnt=strlen($birth);
if($cnt==6){
    echo "";
}else if($cnt!=6){
    echo "6자로 입력해 주십시오";
}

?>
