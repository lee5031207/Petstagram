<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PETSTAGRAM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../lib/mycss.css">


</head>
<body>
        <?
        include ("../../lib/dbconnection.php");
        $connect = dbconn();  //db연결함수 호출
        if(!$_COOKIE){
            $member = 0;
        }
        else{
          $member = member();  //로그인함수 호출
        }  //로그인함수 호출
        ?>

    <div class="container" style="padding-top: 10px">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#nav_menu" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../../index.php">
                    Petstagram
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="nav_menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="./list.php">자유게시판</a>
                        </li>
                        <li class="active">
                            <a href="#">Q&A</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    <?
                        if($member){
                            ?><li><a href="../../member/member_info.php?user_id=<?=$member['user_id']?>"><?echo $member['name']?>(<?echo $member['user_id']?>)님 환영합니다.</a></li>

                            <?
                        }else{?>
                        <li>
                            <a href="../../member/join.php">SIGN IN</a>
                        </li>
                        <li>
                            <a href="../../member/login.php">LOG IN</a>
                        </li>
                        <?}?>
                            <li><a href="../../member/logout.php">
                            <?if($member){?>
                                LOG OUT
                                <?
                           }?>
                            </a></li>
                    </ul>
                </div>
            </div>
        </nav>
<!------------------------------------------------hot게시판------------------------------------------------------------------------>
</br>
<?
   $query_hot = 'select * from QnA order by hit desc limit 3';
   $result_hot = mysqli_query($connect,$query_hot);
?>
 <table class="table table-borde#A4A4A4 table-hover">
            <tr>
                <th style="text-align:center; width:7%; background-color:#A4A4A4;"></th>
                <th style="text-align:center; width:16%; background-color:#A4A4A4;"></th>
                <th style="text-align:center; width:40%; background-color:#A4A4A4;">QnA 인기글</th>
                <th style="text-align:center; width:20%; background-color:#A4A4A4;"></th>
                <th style="text-align:center; width:7%; background-color:#A4A4A4;"></th>
            </tr>
            <tr>
                <th style="text-align:center; width:7%; background-color:#A4A4A4;">no</th>
                <th style="text-align:center; width:16%; background-color:#A4A4A4;">이름</th>
                <th style="text-align:center; width:40%; background-color:#A4A4A4;">제목</th>
                <th style="text-align:center; width:20%; background-color:#A4A4A4;">날짜</th>
                <th style="text-align:center; width:7%; background-color:#A4A4A4;">조회수</th>
            </tr>
<?


    $cnt=1;
    while($temp_hot = mysqli_fetch_array($result_hot)){
        $year_hot = substr($temp_hot['regdate'],2,2);
        $month_hot = substr($temp_hot['regdate'],4,2);
        $day_hot = substr($temp_hot['regdate'],6,2);
?>
            <tr>
                <td style="text-align:center; background-color:#FAFAFA;"><?=$cnt?></td>
                <td style="text-align:center; background-color:#FAFAFA;">
                <? if($member['user_id']){?>
                    <!-- <a href='' data-toggle="modal" data-target="#followingModal"> -->
                    <a href="../../member/member_info.php?user_id=<?=$temp_hot['user_id']?>">
                      <?=$temp_hot['name']?>
                    </a>
                    <?}else{?>
                        <?=$temp_hot['name']?>
                    <?}?>
                </td>
                <td style="background-color:#FAFAFA;"><a href='./qna_view.php?no=<?=$temp_hot['no']?>&id=<?=$temp_hot['id']?>'><?=$temp_hot['subject']?></a></td>
                <!--위에줄 문법? url로 파라미터 받아오는 거 같은데  -->
                <td style="text-align:center;background-color:#FAFAFA;"><?=$year_hot?>.<?=$month_hot?>.<?=$day_hot?>.</td>
                <td style="text-align:center;background-color:#FAFAFA;"><?=$temp_hot['hit']?></td>
                <?
                    $cnt++;
                }?>
            </tr>
            <!-- <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td style="text-align:center;"><?include("./list_page.php");?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>  -->


</table>
</br>

<!------------------------------------------------게시판------------------------------------------------------------------------>
<?
    $_page=$_GET['_page'];
    $view_total = 2; //한 페이지에 5개의 게시글이 보인다
    if(!$_page)($_page=1); //페이지 번호가 지정이 안되었을 경우
    $page=($_page-1)*$view_total;

    $query = "select count(*) from QnA ";
    mysqli_query($connect,"set names utf8");
    $result = mysqli_query($connect,$query);
    $temp=mysqli_fetch_array($result);
    $totals = $temp[0];

?>

        <table class="table table-borde#A4A4A4 table-hover">
            <tr>
                <th style="text-align:center; width:7%; background-color:#A4A4A4;"></th>
                <th style="text-align:center; width:16%; background-color:#A4A4A4;"></th>
                <th style="text-align:center; width:40%; background-color:#A4A4A4;">QnA 게시판</th>
                <th style="text-align:center; width:20%; background-color:#A4A4A4;"></th>
                <th style="text-align:center; width:7%; background-color:#A4A4A4;"></th>
            </tr>
            <tr>
                <th style="text-align:center; width:7%; background-color:#A4A4A4;">no</th>
                <th style="text-align:center; width:16%; background-color:#A4A4A4;">이름</th>
                <th style="text-align:center; width:40%; background-color:#A4A4A4;">제목</th>
                <th style="text-align:center; width:20%; background-color:#A4A4A4;">날짜</th>
                <th style="text-align:center; width:7%; background-color:#A4A4A4;">조회수</th>
            </tr>
<?
    $query="select * from QnA order by no desc limit $page,$view_total ";
    // desc내림차순 asc오름차순  limit view_total개의 게시물 만 가지고 온다

    $result=mysqli_query($connect, $query);
    $cnt=1;
    while($data=mysqli_fetch_array($result)){
        $year = substr($data['regdate'],2,2);
        $month = substr($data['regdate'],4,2);
        $day = substr($data['regdate'],6,2);
?>
            <tr>
                <td style="text-align:center; background-color:#FAFAFA;"><?=$cnt?></td>
                <td style="text-align:center; background-color:#FAFAFA;">
                <? if($member['user_id']){?>
                      <a href='../../member/member_info.php?user_id=<?=$data['user_id']?>'>
                        <?=$data['name']?>
                    </a>
                    <?}else{?>
                        <?=$data['name']?>
                    <?}?>
                </td>
                <td style="background-color:#FAFAFA;"><a href='./qna_view.php?no=<?=$data['no']?>&id=<?=$data['id']?>'><?=$data['subject']?></a></td>
                <!--위에줄 문법? url로 파라미터 받아오는 거 같은데  -->
                <td style="text-align:center;background-color:#FAFAFA;"><?=$year?>.<?=$month?>.<?=$day?>.</td>
                <td style="text-align:center;background-color:#FAFAFA;"><?=$data['hit']?></td>
                <?
                    $cnt++;
                }?>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td style="text-align:center;"><?include("./qnalist_page.php");?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>

        </table>

        <!-----------------------------------------글쓰기 버튼----------------------------------------------------------------------->
        <?
        if($member){
        ?>
        <div class="col-sm-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
            글쓰기
            </button>
        </div>
        <?}else{?>
        <div class="col-sm-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">
            글쓰기
            </button>
        </div>
        <?}?>
        <!---------------------------------------------로그인후 이용하세요 >> 로그인페이지 이동 ----------------------------------------->
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">로그인 후 이용해 주세요</h4>
                    </div>
                    <div class="modal_body">
                        <button type="button" class="btn btn-primary" style="margin:30px;" onclick="location.href='../../member/login.php'">
                            로그인
                        </button>
                        <button type="button" class="btn btn-primary" style="margin:30px;" onclick="location.href='../../member/join.php'">
                            회원가입
                        </button>
                    </div>
                </div>
            </div>
        </div>

            <!-------------------------------------------글작성 모달----------------------------------------------------------------->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Q&A게시판 글쓰기</h4>
                    </div>
                <div class="modal-body">
                    <form name="write" action="qna_write_post.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="bbs1" class="form-control" >
                        아이디&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;
                        <input type="text" name="user_id" size='15' value="<?=$member['user_id'];?>" readonly='readonly'><br><br>
                        이름&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" name="name" size='16' value="<?=$member['name'];?>" readonly='readonly'>&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;
                        닉네임&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;
                        <input type="text" name="nick_name" size='15' value="<?=$member['nick_name'];?>" readonly='readonly'><br><br>
                        제목&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" name="subject" size='50'><br><br>
                        <input type="file" name="file01"><br>
                        <textarea name="story"  style="width:100%; height:300px;"  placeholder="내용을 입력하시오"></textarea>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                    <button type="submit" class="btn btn-primary">완료</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-------------------------------------------팔로윙 모달----------------------------------------------------------------->
    <!-- <div class="modal fade" id="followingModal" tabindex="-1" role="dialog" aria-labelledby="followingModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel"><?//=$member['name'];?>의 정보</h4>
          </div>
          <div class="modal-body">
            <form name="write" action="qna_write_post.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="id" value="bbs1" class="form-control" >
              아이디&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;
              <input type="text" name="user_id" size='15' value="<?//=$member['user_id'];?>" readonly='readonly'><br><br>
              이름&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" name="name" size='16' value="<?//=$member['name'];?>" readonly='readonly'>&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;
              닉네임&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;
              <input type="text" name="nick_name" size='15' value="<?//=$member['nick_name'];?>" readonly='readonly'><br><br>
              제목&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="text" name="subject" size='50'><br><br>
              <input type="file" name="file01"><br>
              <textarea name="story"  style="width:100%; height:300px;"  placeholder="내용을 입력하시오"></textarea>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
              <button type="submit" class="btn btn-primary">완료</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
</body>
</html>
