<?header("content-type:text/html; charset=UTF-8");

include ( "../../lib/dbconnection.php");
$connect = dbconn();  //db연결함수 호출
$member = member();  //로그인함수 호출

if(!$member['user_id'])error("로그인 후 이용해 주세요");
$no=$_GET['no'];

$query = "select * from bbs1 where no='$no' and user_id='$member[user_id]'";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);

if(!$result)die("연결에 실패".mysqli_error($connect));


// 수정하기에서 삭제와 그냥 글삭제가 다른점은 수정하는것은 데베에서 컬럼전체를 삭제하는게 아니고
// 그냥 글삭제는 데베에서 전체 컬럼을 삭제한다 그래서 여기서는 update로 file01에 들어있는 파일명을 ''공백으로 만들어준다


if($data['file01']){     //데이터 베이스의 파일이름을 삭제하는것
    $query_db_del = "update bbs1 set file01='' where no='$no' and user_id='$data[user_id]'";
    mysqli_query($connect, $query_db_del);
}

//실제 파일 삭제
$del_file = "./data/".$data['file01'];  //삭제할파일 디렉토리 지정
if($data['file01'] && is_file($del_file)){  //is_file = 파일이 존재하는지 확인하는 함수
    unlink($del_file);  //실제 파일을 삭제하는 함수
}

mysqli_close($connect);
?>

<script>
alert("파일이 삭제되었습니다.")
history.go(-1); //삭제하고 돌아가서 모달까지 열어주고 싶은데 어찌할까요 여기서 열 수 있을까?

window.close();
</script>
