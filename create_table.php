<?header("content-type:text/html; charset=UTF-8");

include("./lib/dbconnection.php");
$connect = dbconn();

$sql="CREATE TABLE member
    (no int not null auto_increment,
    PRIMARY KEY(no),
    id char(15),
    user_id char(15),
    name char(15),
    nick_name char(15),
    birth char(8),
    sex char(6),
    tel char(12),
    email char(30),
    pw char(30),
    regdate char(20),    //php로 mysql테이블 만드는 거라는데 쓰잘데기없나 ? 모르겟음
    ip char(20)
    )";

    mysqli_query($connect,$sql);
    if(!$sql)die("테이블 생성에 실패 하였습니다." .mysqli_error());


?>
