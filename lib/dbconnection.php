<?
//db연동하는 함수
function dbconn(){
    $host_name="localhost";
    $db_user_id="root";
    $db_name="petsta";
    $db_pw="548568";
    $connect = mysqli_connect($host_name,$db_user_id,$db_pw,$db_name);

    if(!$connect)die("연결에 실패하였습니다." .mysqli_error());
    return $connect;
}

//에러메시지 출력
function error($msg){  //다른파일에서 error("아이디를 입력하시오"); 같이 함수를 가져와서 사용가능
    echo"
    <script>
    window.alert('$msg');
    history.back(1);
    </script>
    ";
    exit; //위에 에러 메시지만 띄운다
}

//로그인 쿠키 함수
function member(){

    global $connect; //전역변수로써 $connect 사용한다
    $temps = $_COOKIE["COOKIES"]; //쿠키 가져온다
    $cookies=explode("//",$temps);  //explode("구분 기준문자","처리할 내용");
    //$cookies[0]:아이디
    //$cookies[1]:비밀번호
    $query = "select * from member where user_id = '$cookies[0]'";

    $result = mysqli_query($connect, $query);
    $member = mysqli_fetch_array($result);   //이거에러나서 찾아보니깐 @붙이믄 된다는데 왜그러는지는 모름
    return $member;
}

?>
