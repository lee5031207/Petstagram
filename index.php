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
    <link rel="stylesheet" href="./lib/mycss.css">

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
                            ?><li><a><?echo $member['name']?>(<?echo $member['user_id']?>)님 환영합니다.</a></li>

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
     <div class="mainbox">

     </div>
</body>
</html>
