<?header("content-type:text/html; charset=UTF-8");

include("../../lib/dbconnection.php");
$connect = dbconn();
$member=member();

if(!$member['user_id'])error("로그인 후 이용해 주세요");

$subject = $_POST['subject'];
$story = $_POST['story'];
$id = $_POST['id'];
$no = $_POST['no'];

if(!$subject)error("제목을 입력해 주십시오");
if(!$story)error("내용을 입력해 주십시오");


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


        $query = "update qna set file01 = '$newfile01' where id='$id' and no='$no' ";
        mysqli_query($connect,$query);

    }

$query="update qna set
        subject='$subject',
        story='$story'
        where id='$id' and no='$no' ";
mysqli_query($connect, "set names utf8");
mysqli_query($connect, $query);

mysqli_close($connect);
?>
<script>
window.alert('수정되었습니다')
location.href="./qna_view.php?id=<?=$id?>&no=<?=$no?>"
</script>
