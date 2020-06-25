<?header("content-type:text/html; charset=UTF-8");

$id = $_POST['id'];
$user_id = $_POST['user_id'];
$name = $_POST['name'];
$nick_name = $_POST['nick_name'];
$birth = $_POST['birth'];
$sex = $_POST['sex'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$pws = $_POST['pw'];
$addr_1 = $_POST['addr_1'];
$addr_2 = $_POST['addr_2'];
$regdate = date("YmdHis",time());  //날짜 시간
$ip = getenv("REMOTE_ADDR");  // ip주소


$pw = md5($pws);  //비밀번호 암호화

include("../lib/dbconnection.php");
$connect = dbconn();  //db함수 호출


if(!$user_id)error("아이디를 입력하세요");
/////////////////////////////////////////////////
if(substr($user_id,"15"))error("아이디는 15자를 초과하면 안됩니다");
if(preg_match("/[^a-z 0-9]/",$user_id))error("아이디는 영어 소문자와 숫자의 조합만 허용됩니다");
///////////////////////////////////////////////// 조건문이 들어가야하는거 아닌가 ? 이해가안감
// 저함수의 반환 값이 있으면  에러가 나는것 같다
//   $test = substr("lee5031207lee5031207","15");
//   echo $test;  -> 이러면 결과가 31207 즉, 15자 이후의 문자가 반환된다
//  (preg_match("/[^a-z 0-9]/",$user_id) 여기서는 논리값 1 즉,참이 반환되면 에러가 나고 아니면은 0 즉 에러안난다
//  a-z 0-9 이외의 것들이 있다면 1을 반환해서 에러가 발생 오오미
if(strlen($name)<6 || strlen($name)>15)error("이름은 2~5자 까지 허용합니다");
// srtlen 문자열의 길이?를 반환한다. 한글은 한글자당 3byte이므로 6~15 이면 2글자~5글자 사이만 허용
if(!$pws)error("비밀번호를 입력하세요");
if(!$name)error("이름을 입력하세요");
if(!$nick_name)error("닉네임을 입력하세요");
if(!$birth)error("생년월일을 입력하세요");
if(strlen($birth)!=6)error("생년월일을 6자로 입력해주세요"); //6자로만 입력
if(!$sex)error("성별을 입력하세요");
if(!$tel)error("전화 번호를 입력하세요");
if(strlen($tel)<8 || strlen($tel)>15)error("전화번호는 8~15자리 숫자로 입력해 주십시오"); //8~15
if(!$email)error("이메일을 입력하세요");
//if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))error("올바른 이메일 형식이 아닙니다");
//이메일 정규식 함수 사용
if(!$addr_1)error("주소를 입력하세요");
if(!$addr_2)error("상세주소를 입력하세요");


$query= "Insert into member
(id, user_id, name, nick_name, birth, sex, tel, email, pw, addr_1, addr_2, regdate, ip)
values('$id', '$user_id', '$name', '$nick_name', '$birth', '$sex',
        '$tel', '$email', '$pw', '$addr_1', '$addr_2', '$regdate', '$ip')";

$query1 = "Create table ".$user_id."_follower (
    user_id varchar(15),
    name varchar(15),
    PRIMARY KEY ( user_id )
    )";
$query2 = "Create table ".$user_id."_following (
    user_id varchar(15),
    name varchar(15),
    PRIMARY KEY ( user_id ) 
    )";

mysqli_query($connect, $query);
mysqli_query($connect, $query1);
mysqli_query($connect, $query2);

mysqli_close($connect);

?>

<script>
    window.alert("회원가입 되셨습니다.");
    location.href="../index.php";
</script>
