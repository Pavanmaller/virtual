<?php
$time= time();


session_start();
if (!isset($_SESSION['uid'])) {
  header("Location:../register/");
}
if (!isset($_GET['id'])) {
  header("Location:../mainpage/index.php");
}
include '../sessionTime.php';

$pbid=$_GET['id'];
include '../db_connect.php';
$sql="SELECT * FROM codedb where id='$pbid' ";
$result=mysqli_query($conn, $sql);
$data=mysqli_fetch_assoc($result);

$UserSql="SELECT * from users where uid=".$_SESSION['uid']." ";
$UserSqlQuery=mysqli_query($conn,$UserSql);
$UserData=mysqli_fetch_assoc($UserSqlQuery);


 ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <title>CodeIt-
      <?php echo $data['pbName'];?>
    </title>
    <link rel="stylesheet" type="text/css" href="./extracss.css"/>
<?php include '../commonIncludes.php'; ?>

<script src="../notify/bootstrap-notify.min.js"></script>
<link rel="stylesheet" type="text/css" href="../loaderGIF/loading.css"/>
<link rel="stylesheet" type="text/css" href="../loaderGIF/loading-btn.css"/>

    <style type="text/css" media="screen">
          html{
            height: 100%;
            margin: 0;
            padding:0;
          }
          body{
            height: 100%;
            margin: 0;
            padding:0;
            background: #cfdce1;
          }

        #editor {

            height: 450px;
            width: auto;
        }
        #editor1 {

            height:450px;
            width: auto;
        }
        .loader {
          position: fixed;
          left: 0px;
          top: 0px;
          width: 100%;
          height: 100%;
          z-index: 9999;
          background: url('../loaderGIF/spinner.gif') 50% 50% no-repeat rgb(249,249,249);
          opacity: .8;
}
    </style>
    <script type="text/javascript">
        $(window).ready(function() {
            $(".loader").fadeOut("slow");
        });
      </script>

  </head>

  <body>
    <div class="loader"> </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-info" style="margin:0px;">
  <div class="container" style="padding:0px;">
    <a class="navbar-brand" href="#"><b style="font-size:18px;">CodeIt</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor03">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item" >
          <a class="nav-link" href="../mainpage/index.php">Home</a>
          <li class="nav-item active">
            <a href="#" class="nav-link" style="text-transform:none;">
              <?php echo $data['pbName'];?>
            </a>
          </li>
        </li>
        </ul>
        <form class="form-inline ml-auto">
            <div class="form-group has-white">
        <ul class="nav navbar-nav navbar-right" >
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:white;">Account
                <b class="caret"></b></a>
                <ul class="dropdown-menu" style="left:-30%">
                    <li>
                        <div class="navbar-content">
                            <div class="row">

                                <div class="col-md-12">
                                    <span style="text-transform:capitalize;"><?php echo $UserData['uname']; ?></span>
                                    <p class="text-muted small">
                                        <?php echo $UserData['uemail']; ?></p>
                                    <div class="divider">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="navbar-footer">
                            <div class="navbar-footer-content">
                                <div class="row">

                                    <div class="col-md-6">
                                        <a href="../logout.php" class="btn btn-default btn-sm pull-left">Sign Out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
      </li>
    </div>
  </form>

    </div>
  </div>
</nav>

  <!-- Modal -->
  <div class="modal fade"  id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-left:200px;margin-top:50px;max-width:1000px;min-width:1000px;min-height:500px;max-height:500px;">
      <div class="modal-content" style="width:1000px;min-height:400px;overflow-y:auto;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Result</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding-top:10px;padding-bottom:10px;">
          <p>
        <button class="btn btn-default btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          Inputs
        </button>
      </p>
      <div class="collapse" id="collapseExample">
        <div class="card card-body"  style="margin:0px auto 10px auto;padding:10px;overflow-y:auto;">
        <div id="inputs"></div>
        </div>
      </div>
          <div class="row">
          <div class="card col" style="margin-top:10px;">
            <div class="card-body" style="padding:0px;max-height:300px;overflow-y:auto;">
              <h6 class="card-title">Expected correct Output</h6>

              <div class="actualOutput">
                  <button class="btn btn-default btn-sm" style="padding:4px;text-transform:none;width:90%;" type="button" data-toggle="collapse" data-target="#actualOutput1Card" aria-expanded="false" aria-controls="collapseExample">
                    <b>Test Case 1:</b></button>

                    <div class="collapse" id="actualOutput1Card">
                      <div class="card card-body" id="actualOutput1" style="padding:8px;margin:0px;">

                      </div>
                    </div>
                  <button class="btn btn-default btn-sm" style="padding:4px;text-transform:none;width:90%;" type="button" data-toggle="collapse" data-target="#actualOutput2Card" aria-expanded="false" aria-controls="collapseExample">
                    <b>Test Case 2:</b></button>

                    <div class="collapse" id="actualOutput2Card">
                      <div class="card card-body" id="actualOutput2" style="padding:8px;margin:0px;">

                      </div>
                    </div>
                  <button class="btn btn-default btn-sm" style="padding:4px;text-transform:none;width:90%;" type="button" data-toggle="collapse" data-target="#actualOutput3Card" aria-expanded="false" aria-controls="collapseExample">
                    <b>Test Case 3:</b></button>

                    <div class="collapse" id="actualOutput3Card">
                      <div class="card card-body" id="actualOutput3" style="padding:8px;margin:0px;">

                      </div>
                    </div>

                  <button class="btn btn-default btn-sm" style="padding:4px;text-transform:none;width:90%;" type="button" data-toggle="collapse" data-target="#actualOutput4Card" aria-expanded="false" aria-controls="collapseExample">
                    <b>Test Case 4:</b></button>

                    <div class="collapse" id="actualOutput4Card">
                      <div class="card card-body" id="actualOutput4" style="padding:8px;margin:0px;">

                      </div>
                    </div>
                </div>


              <pre style="overflow:visible;"><pre>


            </div>
          </div>
          <div class="card col"style="margin-top:10px;">
            <div class="card-body" style="padding:0px;max-height:300px;overflow-y:auto;">
              <h6 class="card-title">Your Output</h6>
              <div id="userOutput">
                <button class="btn btn-default btn-sm" style="padding:4px;text-transform:none;width:90%;" type="button" data-toggle="collapse" data-target="#userOutput1Card" aria-expanded="false" aria-controls="collapseExample">
                  <img src="" width="20px" height="20px" id="img1"><b>Test Case 1:</b></button>

                  <div class="collapse" id="userOutput1Card">
                    <div class="card card-body" id="userOutput1" style="padding:8px;margin:0px;">

                    </div>
                  </div>
                  <button class="btn btn-default btn-sm" style="padding:4px;text-transform:none;width:90%;" type="button" data-toggle="collapse" data-target="#userOutput2Card" aria-expanded="false" aria-controls="collapseExample">
                    <img src="" width="20px" height="20px" id="img2">
                    <b>Test Case 2:</b></button>

                    <div class="collapse" id="userOutput2Card">
                      <div class="card card-body" id="userOutput2" style="padding:8px;margin:0px;">

                      </div>
                    </div>
                    <button class="btn btn-default btn-sm" style="padding:4px;text-transform:none;width:90%;" type="button" data-toggle="collapse" data-target="#userOutput3Card" aria-expanded="false" aria-controls="collapseExample">
                      <img src="" width="20px" height="20px" id="img3">
                          <b>  Test Case 3:</b>  </button>

                      <div class="collapse" id="userOutput3Card">
                        <div class="card card-body" id="userOutput3" style="padding:8px;margin:0px;">

                        </div>
                      </div>
                      <button class="btn btn-default btn-sm" style="padding:4px;text-transform:none;width:90%;" type="button" data-toggle="collapse" data-target="#userOutput4Card" aria-expanded="false" aria-controls="collapseExample"><img src="" width="20px" height="20px" id="img4">
                      <b>Test Case 4:</b>
                      </button>

                        <div class="collapse" id="userOutput4Card">
                          <div class="card card-body" id="userOutput4" style="padding:8px;margin:0px;">

                          </div>
                        </div>

              </div>
              <pre style="overflow:visible;"><pre>

            </div>
          </div>
        </div>
        </div>
        <div class="modal-footer" style="padding:10px;">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

    <div style="margin:0px;padding:0px;">
    <div class="card" style="margin:0px;background:#002b36;" id="EditorCard">
      <div id="error"></div>

    <div class="card-body" style="padding:0px;">

    <div class="row" style="margin:10px;">
      <button type="button" name="button" class="btn btn-link" id="show_hide"><font size="2" style="font-weight:bold;text-transform:capitalize;"   face="Arial">Problem Info</font></button>
    <div class="dropdown">
      <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><font size="2" style="font-weight:bold;text-transform:capitalize;"   face="Arial">Themes</font>
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="themeSelector">
        <a class="dropdown-item active" value="solarized_dark" href="#">Solarized Dark</a>
        <a class="dropdown-item" value="chrome" href="#">Chrome</a>
        <a class="dropdown-item" value="monokai" href="#">Monokai</a>
      </div>
    </div>
      <div class="dropdown">
      <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><font size="2" style="font-weight:bold;text-transform:capitalize;"   face="Arial">Font Size</font>
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="fontSizeSelector">
      <a class="dropdown-item active" value="17" href="#">1</a>
      <a class="dropdown-item" value="18" href="#">2</a>
      <a class="dropdown-item" value="19" href="#">3</a>
      <a class="dropdown-item" value="20" href="#">4</a>
      </div>
      </div>
      <div class="dropdown">
      <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><font size="2" style="font-weight:bold;text-transform:capitalize;"   face="Arial">Set Language</font>
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="languageSelector">
      <a class="dropdown-item active" value="c_cpp" href="#">C and C++</a>
      <a class="dropdown-item" value="html" href="#">HTML</a>
      <a class="dropdown-item" value="python" href="#">Python</a>
      </div>
      </div>
        </div>

        <div class="side-panel" id="side-panel" style="border:3px solid #00bcd4;overflow:auto;">
        <div id="sidepanel-heading" class="heading">
          <center><span id="content-heading">EXERCISE</span></center>

        </div >
        <span style="color:black; padding:15px;">
                <div class="content">
                <section>

                  <h4 style="color:black; padding:15px;">Problem Statement:<br><?php echo $data['pbName'];  ?> </h4>
                  <h5 style="color:black;padding:15px;">Problem Info:<br><?php echo $data['pbStat']; ?></h5>
                  <h5 style="color:black;padding:15px;">Sample Input:<?php echo $data['ips1'];  ?></h5>
                  <h5 style="color:black;padding:15px;">Sample Output:<?php echo $data['expop1'];  ?> </h5>

                </section>

              </div>
              <span>
        </div>
        </div>

    <div class="row" style="margin:0px;">
        <div class="col-md-6" id="editor1"></div>
        <div class="col-md-6" id="editor"></div>
    </div>


    <div style="float:right;margin:10px;">
      <button class="btn btn-info btn-sm ld-ext-right" id="compileBtn" style="float:right;"><font size="2" style="font-weight:bold;text-transform:capitalize;"  face="Arial">Compile & Run</font>
    <div class="ld ld-ring ld-spin"></div>
  </button>
    </div>

  </div>
  </div>
  </div>

    <script src="../ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <script>
      var editor = ace.edit("editor");
      editor.setTheme("ace/theme/solarized_dark");
      editor.getSession().setMode("ace/mode/c_cpp");
      editor.resize();
      editor.setShowPrintMargin(false);
      document.getElementById('editor').style.fontSize = '17px';

      var editorheader = ace.edit("editor1");
      editorheader .setTheme("ace/theme/solarized_dark");
      editorheader.getSession().setMode("ace/mode/c_cpp");
      editorheader.setShowPrintMargin(false);
      editorheader.resize();
      document.getElementById('editor1').style.fontSize = '17px';
      editorheader.setHighlightActiveLine(false);
      editorheader.getSession().setUseSoftTabs(true);
      editorheader.clearSelection();
    </script>
    <script src="testcaseExaminer.js"> </script>

    <script type="text/javascript">

          $('#compileBtn').on('click', function() {
            var code = editor.getValue();
            $(this).addClass("running");
            $.ajax({
              type: "POST",
              url: "processCompile.php?id=<?php echo $pbid;?> ",
              cache: false,
              data: {
                codeData: code
              },
              success: function(data, status) {
                $('#compileBtn').removeClass("running");
                testcaseExaminer(data);
              }
            });

          });
    $.get("getData.php?id=<?php echo $pbid; ?>", function(data) {
      var data = JSON.parse(data);
        editorheader.setValue(data.code);
        editorheader.clearSelection();

        editorheader.setReadOnly(true);
        editor.setValue(data.userCode);
        editor.clearSelection();
    });
    // editor.on('change',function () {
    //   var userCode = editor.getValue();
    //   $.ajax({
    //     type:"POST",
    //     url:"setUserCode.php",
    //     cache:false,
    //     data:{
    //       userCode:userCode
    //     },
    //     success:function(data,status){
    //       alert("success");
    //     }
    //   });
    // });
    $('#languageSelector').on("click", 'a', function() {
      var lng = $(this).attr('value');
      editor.getSession().setMode("ace/mode/" + lng);
      editorheader.getSession().setMode("ace/mode/" + lng);
      $('#languageSelector a').removeClass("active");
      $(this).addClass("active");
    });
    $('#fontSizeSelector').on("click", 'a', function() {
      var siz = $(this).attr('value');
      document.getElementById('editor').style.fontSize = siz + 'px';
      document.getElementById('editor1').style.fontSize = siz + 'px';
      $('#fontSizeSelector a').removeClass("active");
      $(this).addClass("active");
    });
    $('#themeSelector').on("click", 'a', function() {
      var thm = $(this).attr('value');
      editor.setTheme("ace/theme/" + thm);
      editorheader.setTheme("ace/theme/" + thm);
      if (thm=="solarized_dark") {
        thmColor="#002b36";
      }
      if (thm=="chrome") {
        thmColor="rgba(235,235,235,1)";
      }
      if (thm=="monokai") {
        thmColor="#2f3129";
      }
      $("#EditorCard").css("background",thmColor);
      $('#themeSelector a').removeClass("active");
      $(this).addClass("active");
    });
    </script>
    <script >
  var EventHandler = {
      ShowHideSideBar: function () {
          if (document.getElementById("side-panel").className.indexOf("open") !== -1) {
              document.getElementById("side-panel").className = "side-panel";
              document.getElementById("side-panel").className += " close";
              document.getElementById('show_hide').childNodes[0].className = "fa fa-angle-double-right";
              return;
          }
          document.getElementById("side-panel").className = "side-panel";
          document.getElementById("side-panel").className += " open";
          document.getElementById('show_hide').childNodes[0].className = "fa fa-angle-double-left";
      }
  };
  window.onload = function () {
      document.getElementById('show_hide').onclick = EventHandler.ShowHideSideBar;
  };
</script>
  </body>

  </html>
