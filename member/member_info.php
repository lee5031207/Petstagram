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
      <nav class="navbar navbar-inverse" bgcolor="#00C183">
          <div class="container-fluid">
              <div class="navbar-header">
                  <button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#nav_menu" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="../index.php">
                  PETSTAGRAM
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
                          ?><li><a><?echo $member['name']?>(<?echo $member['user_id']?>)님 환영합니다</a></li>
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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">내 정보</h4>
          </div>
          <div class="modal-body">

              <img src="../profile.png" width="100px" height="100px"><br><br><br>
              <strong>아이디&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<?=$info_member['user_id'];?></strong><br><br>
              <strong>이름&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?=$info_member['name'];?></strong>&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;
              <strong>닉네임&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?=$info_member['nick_name'];?></strong><br><br>
              <strong>이메일&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<?=$info_member['email'];?></strong><br><br>
              <strong>생일&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?=$info_member['birth'];?></strong><br><br>
              <div class="modal-footer" align='center'>
                <button type="button" class="btn btn-default">팔로우 하기</button>
              </form>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" onclick="history.back(); return false;">닫기</button>
            </form>
          </div>
        </div>
      </div>
    <? } else { ?>

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel"><?=$info_member['name'];?>님의 프로필</h4>
        </div>
        <div class="modal-body">

            <img src="../profile.png" width="100px" height="100px"><br><br><br>
            <strong>아이디&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<?=$info_member['user_id'];?></strong><br><br>
            <strong>이름&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?=$info_member['name'];?></strong>&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;
            <strong>닉네임&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?=$info_member['nick_name'];?></strong><br><br>
            <strong>이메일&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<?=$info_member['email'];?></strong><br><br>
            <strong>생일&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?=$info_member['birth'];?></strong><br><br>
            <div class="modal-footer" align='center'>
              <button type="button" class="btn btn-default">팔로우 하기</button>
            </form>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" onclick="history.back(); return false;">닫기</button>
          </form>
        </div>
      </div>
    </div>
    <?}?>
</body>
</html>
