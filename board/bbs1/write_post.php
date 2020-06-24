<?header("content-type:text/html; charset=UTF-8");

include("../../lib/dbconnection.php");
$connect = dbconn();  //DB연동
$member = member();   //회원정보 가지고 오기

$id = $_POST['id'];
$user_id = $_POST['user_id'];
$name = $_POST['name'];
$nick_name = $_POST['nick_name'];
$subject = $_POST['subject'];  //게시판 제목
$story = $_POST['story'];   //게시판 내용

if($_FILES['file01']['name']){
    $size = $_FILES['file01']['size'];
    if($size > 2097152)error('사진 파일만 올릴 수 있습니다.');
    $file01_name = strtolower($_FILES['file01']['name']); //소문자로 바꾸는것
    $file01_split = explode(".",$file01_name);  // 파일명과 확장자를 분리
    $file_name = $file01_split[0];  //파일명
    $file_ext = $file01_split[1];  //확장자명
    $img_ext = array('jpg','jpeg','gif','png'); //이미지 확장자 종류를 배열에 넣는다.
    if(array_search($file_ext,$img_ext) === false)error("이미지 파일이 아닙니다");

    //파일 중복 방지하기 위해 이름을 따로 생성한다.
    $tates = date("mdhis",time()); //날짜 (월,일,시간,분,초)
    $newfile01 = chr(rand(97,122)).chr(rand(97,122)).$tates.rand(1,9).rand(1,9).".".$file_ext; //파일명 생성;

    $dir = "./data/";  // 업로드할 디렉토리 지정
    move_uploaded_file($_FILES['file01']['tmp_name'],$dir.$newfile01); // 파일 업로드 함수
    chmod($dir.$newfile01,0777);  //읽기 쓰기 최고권한 주는거 ?

}


if(!$subject)error("제목을 입력하세요");
if(!$story)error("내용을 입력하세요");

$regdate = date("YmdHis",time());  //날짜 시간
$ip = getenv("REMOTE_ADDR");  // ip주소
$level = $member['level']; //회원레벨 3=일반 2=관리자 1=최고관리자

//쿼리 전송

$query= "Insert into bbs1(nick_name,id,user_id,name,subject,story,level,file01,regdate,ip)
                    values('$nick_name','$id','$user_id','$name','$subject','$story','$level','$newfile01','$regdate','$ip')";

mysqli_query($connect, "set names utf8");  //mysql에 한글 세팅?
mysqli_query($connect, $query);

mysqli_close($connect); //mysql 끝내기
?>

<script>
    window.alert('글이 정상적으로 작성되었습니다.');
    location.href="./list.php";
</script>
