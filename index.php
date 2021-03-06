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
    <link rel="stylesheet" href="./lib/mycss.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>
<body>
        <?
        include ( "./lib/dbconnection.php");
        $connect = dbconn();  //db연결함수 호출
        if(!$_COOKIE){
            $member = 0;
        }
        else{
          $member = member();  //로그인함수 호출
        }
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
                    <a class="navbar-brand" href="#">
						Petstagram
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="nav_menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="./board/bbs1/list.php">자유게시판</a>
                        </li>
                        <li>
                            <a href="./board/bbs1/qnalist.php">Q&A</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    <?
                        if($member){
                            ?><li><a href="./member/member_info.php?user_id=<?=$member['user_id']?>"><?echo $member['name']?>(<?echo $member['user_id']?>)님 환영합니다.</a></li>

                            <?
                        }else{?>
                        <li>
                            <a href="./member/join.php">SIGN IN</a>
                        </li>
                        <li>
                            <a href="./member/login.php">LOG IN</a>
                        </li>
                        <?}?>
                            <li><a href="./member/logout.php">
                            <?if($member){?>
                                LOG OUT
                                <?
                           }?>
                            </a></li>
                    </ul>
                </div>
            </div>
        </nav>
     </div>
     <?
     if(!$member){?>
     <div class="mainbox">
            <div class="form_box1">

            </div>
            <div class="form_box">
            <h2 style="color: black; font-family: 'Shadows Into Light', cursive; text-align:center;">Petstagram</h2>
            <form action="./member/login_post.php" name="login" method="post">
                <div class="form-group">
                <label>ID</label>
                <input type="text" name="user_id" size="15" class="form-control" style="background-color: #B7FFE8; border-bottom: 2px solid black;">
                </div>
                <div class="form-group">
                <label>Password</label>
                <input type="password" name="pw" size="15" class="form-control" style="background-color: #B7FFE8; border-bottom: 2px solid black;">
                </div>
                <div style="text-align:center;">
                <button type="submit" class="btn btn-primary" style="margin-bottom:20px; background-color:#00c183; border: 1px solid #00c183; width: 50%; border-radius: 48px; margin-top: 10%;">
                    로그인
                </button>
                </div>
             </form>
            </div>
     </div>
     <?}else{
        $following_query = "SELECT * FROM ".$member['user_id']."_following";
        $following_result = mysqli_query($connect,$following_query);
        $following_check_result = mysqli_query($connect,$following_query);
        $following_check = mysqli_fetch_array($following_check_result);

        $following_result = mysqli_query($connect,$following_query);
        if($following_check){
          while($following_data = mysqli_fetch_array($following_result)){
              $following_data_user_id = $following_data['user_id'];
              $board_query = " SELECT * FROM bbs1 WHERE user_id = '".$following_data_user_id."'";
              $board_result = mysqli_query($connect,$board_query);
              while($board_data = mysqli_fetch_array($board_result)){
                $year = substr($board_data['regdate'],0,4);
                $month = substr($board_data['regdate'],4,2);
                $day = substr($board_data['regdate'],6,2);
                $time = substr($board_data['regdate'],8,2);
                $minute =substr($board_data['regdate'],10,2);?>
              <div>
                  <table class="table table-borde#A4A4A4 table-hover" style="margin:auto; width:80%" >
                      <tr>
                        <td align="center" style="background-color:#b7ffe8; border:1px solid #b7FFE8;">
                          <strong><a href="./member/member_info.php?user_id=<?=$board_data['user_id']?>"><?=$board_data['name'];?>(<?=$board_data['nick_name'];?>)</a>&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                          <b style="font-weight: 100; font-size: 70%;"><?=$year?>.<?=$month?>.<?=$day?></b>
                        </td>
                      </tr>
                      <tr>
                        <td align="center" style="background-color:#f8f8f8;">
                          <a href="./board/bbs1/view.php?no=<?=$board_data['no']?>&id=<?=$board_data['id']?>" style="text-decoration: none; color:black;">
                          <img src="./board/bbs1/data/<?=$board_data['file01']?>" width="50%" height="40%">
                          <br><br><br><p width="50%"><?=$board_data['story']?></p>
                          </a>
                          <?
                          // 댓글 자체를 가져온다.
                          $comment_query = "select * from bbs_comment where bbs1_no = '$board_data[no]' order by no asc ";
                          $comment_result = mysqli_query($connect, $comment_query);
                          $nowtime = date("YmdHis",time());  //날짜 시간
                          ?>
                          <div style="width:80%; border:1px solid lightgrey; margin:10px; background-color:white; text-align:left; padding-left:4%;">
                          <?while($comment = mysqli_fetch_array($comment_result)){
                              $year = substr($comment['regdate'],2,2);
                              $month = substr($comment['regdate'],4,2);
                              $day = substr($comment['regdate'],6,2);
                              $time = substr($comment['regdate'],8,2);
                              $minute =substr($comment['regdate'],10,2);
                              ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?
                              //$nowtime = date("YmdHis",time());  //날짜 시간
                              $nowtime_year = substr($nowtime,2,2);
                              $nowtime_month = substr($nowtime,4,2);
                              $nowtime_day = substr($nowtime,6,2);
                              $nowtime_time = substr($nowtime,8,2);
                              $nowtime_minute =substr($nowtime,10,2);

                              ?>
                              <p style="margin:5px;"><span style="font-weight:bold;"><?=$comment['user_id']?>(<?=$comment['name']?>)</span>
                              &nbsp;
                              <span style="font-size:11px; color:gray;">
                              <?
                              if($nowtime_year == $year && $nowtime_month == $month && $nowtime_day == $day){
                                  echo $time?>시<?=$minute?>분 [new]<?
                              }else{
                                  echo $year?>.<?=$month?>.<?=$day?><?
                              }
                              ?>
                              </span>
                              &nbsp;:&nbsp;
                              <?=$comment['comment']?></p>
                              <hr>
                          <?
                        }?>

                        </td>
                      <tr>
                        <hr>
                  </table>
              </div>
              <?}?>
            <?}?>

        <?} else{?>
          <div align="center">
            <img src="./hide.png">
            <h1 style="font-family: 'Do Hyeon', sans-serif;">팔로우를 해보세요!</h1>
          <div>
        <?}?>
     <?}?>

</body>
</html>
