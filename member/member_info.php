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
    <link rel="stylesheet" href="../lib/mycss.css">


</head>
<body>
        <?
        include ("../lib/dbconnection.php");
        $connect = dbconn();  //db연결함수 호출
        if(!$_COOKIE){
            $member = 0;
        }
        else{
          $member = member();  //로그인함수 호출
        }  //로그인함수 호출
        $user_id = $_GET['user_id'];
        $query="select * from member where user_id='$user_id'";
        $result=mysqli_query($connect, $query);
        $info_member=mysqli_fetch_array($result);
        ?>
    <!-------------------------------------------글작성 모달----------------------------------------------------------------->
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
                  <a class="navbar-brand" href="../index.php">
                  Petstagram
                  </a>
              </div>
              <div class="collapse navbar-collapse" id="nav_menu">
                  <ul class="nav navbar-nav">
                      <li>
                          <a href="../board/bbs1/list.php">자유게시판</a>
                      </li>
                      <li>
                          <a href="../board/bbs1/qnalist.php">Q&A</a>
                      </li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                  <?
                      if($member){
                          ?><li><a href="member_info.php?user_id=<?=$member['user_id']?>"><?echo $member['name']?>(<?echo $member['user_id']?>)님 환영합니다</a></li>
                          <?
                      }else{?>
                      <li>
                          <a href="../member/join.php">SIGN IN</a>
                      </li>
                      <li>
                          <a href="../member/login.php">LOG IN</a>
                      </li>
                      <?}?>
                          <li><a href="../member/logout.php">
                          <?if($member){?>
                              LOG OUT
                              <?
                         }?>
                          </a></li>
                  </ul>
              </div>
          </div>
    </nav>
    <? if($info_member["user_id"] == $member["user_id"]){ ?>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" onclick="location.href='../index.php'"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel" style="text--align:center;">내 정보</h4>
          </div>
          <div class="modal-body">
          <table class="table table-borde#A4A4A4 table-hover member_info_table">
            <tr>
              <td style="text-align:center; vertical-align: inherit; text-align: center; border-top: 0px" rowspan="2">
                <img src="../profile.png" width="120px" height="120px">
              </td>
              <td style="text-align:center; vertical-align: inherit; text-align: center; border-top: 0px"><strong>게시물</strong></td>
              <td style="text-align:center; vertical-align: inherit; text-align: center; border-top: 0px"><strong>팔로워</strong></td>
              <td style="text-align:center; vertical-align: inherit; text-align: center; border-top: 0px"><strong>팔로잉</strong></td>
            </tr>
            <tr>
              <td style="text-align:center; vertical-align: top; text-align: center; border-top: 0px"><strong>
                <?
                $info_user_id = $info_member['user_id'];
                $cnt_query = "SELECT count(*) FROM bbs1 WHERE user_id = '".$info_user_id."'";
                $cnt_result = mysqli_query($connect, $cnt_query);
                $cnt_data = mysqli_fetch_array($cnt_result); 
                ?>
                <?print_r($cnt_data[0])?>
              </strong></td>
              <td style="text-align:center; vertical-align: top; text-align: center; border-top: 0px"><strong>
                <?
                $follower_query = "SELECT count(*) FROM ".$info_user_id."_follower";
                $follower_result = mysqli_query($connect, $follower_query);
                $follower_data = mysqli_fetch_array($follower_result); 
                ?>  
                <?print_r($follower_data[0])?>
              </strong></td>
              <td style="text-align:center; vertical-align: top; text-align: center; border-top: 0px"><strong>
                <?
                $following_query = "SELECT count(*) FROM ".$info_user_id."_following";
                $following_result = mysqli_query($connect, $following_query);
                $following_data = mysqli_fetch_array($following_result); 
                ?>  
                <?print_r($following_data[0])?>
              </strong></td>
            </tr>
          </table>
          <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$info_member['name'];?></strong>&nbsp;&nbsp;(<?=$info_member['nick_name'];?>)
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" onclick="history.back(); return false;">닫기</button>
          </div>
        </div>
      </div>

    <? } else { ?> 
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" onclick="history.back(); return false;"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel" style="text-align:center;"><?=$info_member['name'];?> 님의 프로필</h4>
        </div>
        <div class="modal-body">
          <table class="table table-borde#A4A4A4 table-hover member_info_table">
            <tr>
              <td style="text-align:center; vertical-align: inherit; text-align: center; border-top: 0px" rowspan="2">
                <img src="../profile.png" width="120px" height="120px">
              </td>
              <td style="text-align:center; vertical-align: inherit; text-align: center; border-top: 0px"><strong>게시물</strong></td>
              <td style="text-align:center; vertical-align: inherit; text-align: center; border-top: 0px"><strong>팔로워</strong></td>
              <td style="text-align:center; vertical-align: inherit; text-align: center; border-top: 0px"><strong>팔로잉</strong></td>
            </tr>
            <tr>
              <td style="text-align:center; vertical-align: top; text-align: center; border-top: 0px"><strong>
                <?
                $info_user_id = $info_member['user_id'];
                $cnt_query = "SELECT count(*) FROM bbs1 WHERE user_id = '".$info_user_id."'";
                $cnt_result = mysqli_query($connect, $cnt_query);
                $cnt_data = mysqli_fetch_array($cnt_result); 
                ?>
                <?print_r($cnt_data[0])?>
              </strong></td>
              <td style="text-align:center; vertical-align: top; text-align: center; border-top: 0px"><strong>
                <?
                $follower_query = "SELECT count(*) FROM ".$info_user_id."_follower";
                $follower_result = mysqli_query($connect, $follower_query);
                $follower_data = mysqli_fetch_array($follower_result); 
                ?>  
                <?print_r($follower_data[0])?>
              </strong></td>
              <td style="text-align:center; vertical-align: top; text-align: center; border-top: 0px"><strong>
                <?
                $following_query = "SELECT count(*) FROM ".$info_user_id."_following";
                $following_result = mysqli_query($connect, $following_query);
                $following_data = mysqli_fetch_array($following_result); 
                ?>  
                <?print_r($following_data[0])?>
              </strong></td>
            </tr>
          </table>
          <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$info_member['name'];?></strong>&nbsp;&nbsp;(<?=$info_member['nick_name'];?>)
          <br><br>
          <div class="modal-footer" text-align='center'>
            <?
            $member_user_id = $member['user_id'];
            $info_user_id = $info_member['user_id'];
            $follow_check = "SELECT * FROM ".$member_user_id."_following WHERE user_id = '".$info_user_id."'";
            $check = mysqli_query($connect, $follow_check);
            $checked = mysqli_fetch_array($check);
            if(!$checked){
            ?>
              <input type="button" id="btn_id" value="팔로우" class="btn btn-primary" style="width:100px; background-color: #00c183; border: 1px solid #00c183;" 
              onClick="location.href='./following.php?follow_data=<?=$info_member['user_id']?>&userdata=<?=$member['user_id']?>'">
              <!-- <script>
              $(document).ready(function(){
                  $("#btn_id").click(function(){
                      $.ajax({
                          url:'./following.php?follow_data=<//?=$info_member['user_id']?>&id=<//?=$member['user_id']?>',
                          type:'post',
                          datatype : 'text',
                          success:function(data){
                              $('.double_result').html(data);
                          },
                          error:function(xhr,textStatus,errorThrown){
                              $('.double_result').html('ERROR');
                          }
                      })
                  })
              })
              </script> -->
           <?}else{?>
            <input type="button" value="팔로우 취소" class="btn btn-danger" style="width:100px; background-color: #00c183; border: 1px solid #00c183;" 
            onClick="location.href='./following_cancel.php?follow_data=<?=$info_member['user_id']?>&userdata=<?=$member['user_id']?>'">
           <?}?>
          </div>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="history.back(); return false;">닫기</button>
        </div> -->
      </div>
    </div>
    <?}?>
</body>
</html>
