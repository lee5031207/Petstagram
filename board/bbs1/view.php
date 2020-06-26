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
        include ( "../../lib/dbconnection.php");
        $connect = dbconn();  //db연결함수 호출
        if(!$_COOKIE){
            $member = 0;
        }
        else{
          $member = member();  //로그인함수 호출
        }
        $no = $_GET['no'];
        $id = $_GET['id'];


        $hit_query = "update bbs1 set hit = hit+1 where no = '$no' and id = '$id' "; //조회수 증가
        $hit_result = mysqli_query($connect, $hit_query);

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
                      <li class="active">
                          <a href="#">자유게시판</a>
                      </li>
                      <li>
                          <a href="./qnalist.php">Q&A</a>
                      </li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                  <?
                      if($member){
                          ?><li><a href="../../member/member_info.php?user_id=<?=$member['user_id']?>"><?echo $member['name']?>(<?echo $member['user_id']?>)님 환영합니다</a></li>
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
        <?
        $query = "select * from bbs1 where no='$no' and id='$id' ";
        mysqli_query($connect, "set names utf8");
        $result = mysqli_query($connect, $query);
        $data = mysqli_fetch_array($result);
        ?>
        <div style="border:1px solid gray;" align="center">
            <h4 style="text-align:center;  font-size: x-large;"><?=$data['subject']?></h4>
            <a href='../../member/member_info.php?user_id=<?=$data['user_id']?>'>
              <h5><?=$data['name']?>&nbsp;(<?=$data['user_id']?>)
            </a>
            &nbsp;&nbsp;&nbsp;조회수:<?=$data['hit']?></h5>
            <hr width="95%" color='94a0fc'>
            <?if($data['file01']){?><img src="./data/<?=$data['file01']?>" alt="<?=$data['file01']?>" width="50%" style="margin:5%;"><?}?>
            <p><?=$data['story']?></p>
        </div><br>
        <div>
            <?
            // 댓글 자체를 가져온다.
            $comment_query = "select * from bbs_comment where bbs1_no = '$no' order by no asc ";
            $comment_result = mysqli_query($connect, $comment_query);
            $nowtime = date("YmdHis",time());  //날짜 시간
            ?>
            <div style="border:1px solid lightgrey; margin:10px; background-color:white;">
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
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span style="font-size:11px; color:gray;">
                <?
                if($nowtime_year == $year && $nowtime_month == $month && $nowtime_day == $day){
                    echo $time?>시<?=$minute?>분 [new]<?
                }else{
                    echo $year?>.<?=$month?>.<?=$day?><?
                }
                ?>
                </span>
                </p><br>
                <p style="margin-left:1%;"><?=$comment['comment']?></p>
                <hr>
            <?
            }?>
            </div>

        </div>
        <div align="center">
        <?
        if($member['user_id']==$data['user_id']){
            ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
            글수정
            </button>
            <button type="button" class="btn btn-danger" onclick="location.href='./delete.php?no=<?=$data['no']?>&id=<?=$data['id']?>'">
            글삭제
            </button>
            <?
        }
        ?>
        </div>


        <?if($member){?>
        <div>
            <form name="comment" action="comment_post.php?no=<?=$no?>" method="POST">
            <?=$member['user_id']?>(<?=$member['name']?>):
            <input type="text" name="comment" style="width:80%">&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-primary">입력</button>
            </form>
        </div>
        <?}else{?>
            <div style="text-align:center;">
            <form name="comment" action="comment_post.php?no=<?=$no?>" method="POST">

            <input type="text" name="comment" style="width:80%">&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-primary">입력</button>
            </form>
        </div>
        <?}?>
        <!---------------------------------------------글수정모달------------------------------------------->

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">글쓰기</h4>
                    </div>
                <div class="modal-body">
                    <form name="edit" action="edit_post.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?=$data['id']?>">
                        <input type="hidden" name="no" value="<?=$data['no']?>">
                        아이디&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;
                        <?=$data['user_id']?><br><br>
                        이름&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;
                        <?=$data['name']?>&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;
                        닉네임&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;
                        <?=$data['nick_name']?><br><br>
                        제목&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" name="subject" size='50' value="<?=$data['subject']?>"><br><br>
                        <?if($data['file01']){?>
                        파일명 : <a style="color:gray;"><?=$data['file01']?></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="" onclick="window.open('./file_del.php?no=<?=$no?>','open')">삭제하기</a>
                        <?}?><br><br>
                        <input type="file" name="file01"><br>
                        <textarea name="story"  style="width:100%; height:300px;"><?=nl2br($data['story'])?></textarea>
                        <!--nl2br br태그 만드는 php 함수-->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                    <button type="submit" class="btn btn-primary">완료</button>
                    </form>
                </div>
            </div>
        </div>
     </div>

</body>
</html>
