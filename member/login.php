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
                    <ul class="nav navbar-nav navbar-right">
                        <!-- <li>
                            <a href="../board/bbs1/list.php">자유게시판</a>
                        </li> -->
                        <li>
                            <a href="./join.php">SIGN IN</a>
                        </li>
                        <li class="active">
                            <a href="#">LOG IN</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="border:1px solid lightgrey; border-radius: 10px;">
             <h2 style="text-align:center;">LOG IN</h2>
             <form action="login_post.php" name="login" method="post">
                <div class="form-group">
                <label>아이디</label>
                <input type="text" name="user_id" size="15" class="form-control">
                </div>
                <div class="form-group">
                <label>비밀번호</label>
                <input type="password" name="pw" size="15" class="form-control">
                </div>
                <div style="text-align:center;">
                <button type="submit" class="btn btn-primary" style="margin-bottom:20px; background-color:#00c183; border:1px solid #00c183;">
                    로그인
                </button>
                </div>
             </form>
        </div>
        <div class="col-md-3"></div>
        </div>
</body>
</html>
