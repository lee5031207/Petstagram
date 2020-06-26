<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PETSTAGRAM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <link rel="stylesheet" href="../lib/mycss.css">

    <style>

    </style>

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
                        <li class="active">
                            <a href="">SIGN IN</a>
                        </li>
                        <li>
                            <a href="./login.php">LOG IN</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="border:1px solid lightgrey; border-radius: 10px; " >
            <h2 style="text-align:center;">SIGN IN</h2>
            <form action="./join_post.php" name="member" method="post">
                <input type="hidden" name="id" value="test">
                <label>아이디</label>
                <input type="text" name="user_id"  id="user_id" class="form-control"><br>
                <input type="button" id="btn_id" value="중복확인" class="btn btn-primary" style="width:80px">
                <span class="double_result" style="color:gray;">(아이디는 영문,숫자 4~15자리)</span><br>
                <script>
                $(document).ready(function(){
                    $("#btn_id").click(function(){
                        $.ajax({
                            url:'./id_check.php?userdata='+$('#user_id').val(),
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
                </script>
                <br>
                <div class="form-group">
                <label >비밀번호</label>
                <input type="password" name="pw"  class="form-control">
                </div>
                <div class="form-group">
                <label>이름</label>
                <input type="text" name="name" class="form-control">
                </div>
                <!-- <div class="form-group"> -->
                <label>닉네임</label>
                <input type="text" name="nick_name" id="nick_name" size="10" class="form-control"><br>
                <input type="button" id="btn_nick" value="중복확인" class="btn btn-primary" style="width:80px">
                <span class="double_result2" style="color:gray;">(닉네임는 한글 1~5자 영문 4~15자)</span><br>
                <script>
                $(document).ready(function(){
                    $("#btn_nick").click(function(){
                        $.ajax({
                            url:'./nick_check.php?nickdata='+$('#nick_name').val(),
                            type:'post',
                            datatype : 'text',
                            success:function(data){
                                $('.double_result2').html(data);
                            },
                            error:function(xhr,textStatus,errorThrown){
                                $('.double_result2').html('ERROR');
                            }
                        })
                    })
                })
                </script>
                <br>
                <!-- </div> -->
                <div class="form-group">
                <label >생년월일</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="birth_result" style="color:gray;"></span>
                <input type="text" name="birth" class="form-control birth_check">
                <script>
                $(document).ready(function(){
                    $(".birth_check").on("keyup",function(){
                        $.ajax({
                            url:'./birth_check.php?userdata='+$('.birth_check').val(),
                            type:'post',
                            datatype:'text',
                            success:function(data){
                                $('.birth_result').html(data);
                            },
                            error:function(xhr,textStatus,errorThrown){
                                $('.birth_result').html('ERROR');
                            }
                        })
                    })
                })
                </script>
                </div>
                <div class="form-group">
                <label >성별</label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="male">남
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="female">여<br>
                </div>
                <div class="form-group">
                <label >전화 번호</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="tel_result" style="color:gray;">숫자만 입력하십시오</span>
                <input type="text" name="tel" class="form-control tel_check">
                <script>
                $(document).ready(function(){
                    $(".tel_check").on("keyup",function(){
                        $.ajax({
                            url:'./tel_check.php?userdata='+$('.tel_check').val(),
                            type:'post',
                            datatype:'text',
                            success:function(data){
                                $('.tel_result').html(data);
                            },
                            error:function(xhr,textStatus,errorThrown){
                                $('.tel_result').html('ERROR');
                            }
                        })
                    })
                })
                </script>
                </div>
                <div class="form-group">
                <label >E-mail</label>
                <input type="text" name="email" class="form-control">
                </div>
                <div class="form-group">
                <label >주소</label>
                <input type="text" name="addr_1"  class="form-control">
                </div>
                <div class="form-group">
                <label >상세주소</label>
                <input type="text" name="addr_2" class="form-control"><br>
                </div>
                <div style="text-align:center;">
                <button type="submit" class="btn btn-primary" style="margin-bottom:20px;">
                가입하기
                </button>
            </form>
        </div>
        <div class="col-md-3"></div>
        </div>

</div>
</body>
</html>
