<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Update Word Dictionary</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <script src="Bootstrap/js/jquery.js"></script>     
    <script src="Bootstrap/js/bootstrap.min.js"></script>
    <style>
     .navbar{
      background-color:#092997;
      border-color:#092997;
      border-radius:0px;
     }
     .dropdown-menu>li>a {
      color:#34325E;
     }
     .navbar-inverse .navbar-toggle {
      border-color: #9D8F83;
     }
     .navbar-nav> li > a{
      padding:15px 10px;
      font-size: 16px;
      color:#AAE7F9 !important;
     }
     .navbar-nav> li > a:hover{
      padding:15px 10px;
      font-size: 16px;
      color:#fff !important;
     }     
     .navbar-nav> li.active > a{
      padding:15px 10px;
      font-size: 16px;
      color:#fff !important;
     } 
     .navbar-inverse .navbar-toggle:focus, .navbar-inverse .navbar-toggle:hover {
      background-color: #F0AD4E;
      color:#F0AD4E;
     }  
     .navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:focus, .navbar-inverse .navbar-nav>.active>a:hover {
      color: white;
      background-color:#F0AD4E;
     }
     .navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover {
      color: #fff;
      background-color: #9D8F83;
     }
     #logo{
      font-size:25px;
      font-weight:bold;
      letter-spacing: 2px;
      color:#AAE7F9
     }
     #logo:hover{
      color:#fff;
     }
     h3{
      color:#34325E; 
     }
    .container-bound{
     padding:150px  20px  20px 50px;
    }
    .container-bound > h1{
     font-family:fantasy;
     color:#34325E;
     color:#34325E;
     font-family:monospace;
    }
    .container-bound > p{
     color:#34325E;
     font-family:monospace;
    }
    .footer {
     position: fixed;
     left: 0;
     bottom: 0;
     margin-top: 200px;
     width: 100%;
     margin-top:20px;
     background-color:#092997;
     color: #AAE7F9;
     text-align: center;
    }
    footer > p{
     margin-top:50px;
    }
    #searchResult{
      margin-top:220px;
    }
    #searchMessage{
     margin-top:240px;
     text-align:center;
    }
    @media only screen and (max-width : 319px) {
     img{
      width:100%;
     }
     .container-bound{
      width:100%;
      margin-bottom:100px;
     }
     #submitButton{
      float:right;
      clear:right;
      margin-top: 5px;
     }
     #searchResult{
      margin-top:0;
      margin-left:15px;

     }
     #submitUpdate, #submitDelete{
      margin-bottom: 5px;
     }
     #searchMessage{
      text-align:center;
      margin-right: 50px;
     }     
    }     
    @media only screen and (min-width : 320px) and (max-width : 480px){
     img{
      width:100%;
     }
     .container-bound{
      width:95%;
      margin-left:2.5%;
      margin-right:2.5%;
     }
     #submitButton{
      float:right;
      clear:right;
      margin-top: 5px;
     }
     #searchResult{
      margin-top:0;
      margin-bottom:80px;
     }
     #searchMessage{
      text-align:center;
      margin-top:10px;
     }     
    }      
    @media only screen and (min-width : 480px) and (max-width : 595px) {
     img{
      width:100%;
     }
     .container-bound{
      width:80%;
      margin-left:30px
     }
     #submitButton{
      float:right;
      clear:right;
      margin-top: 5px;
     }
     #searchResult{
      margin-top:0;
      margin-left:65px;
      margin-bottom:80px;
     }
     #searchMessage{
      text-align:center;
      margin-right: 50px;
      margin-top:10px;
     }     
    }
    @media only screen and (min-width : 595px) and (max-width : 690px) {
     img{
      width:100%;
     }
     .container-bound{
       width:80%;
       margin-left:30px;
     }
     #submitButton{
      float:right;
      clear:right;
      margin-top: 5px;
     }        
     #searchResult{
      margin-top:0;
      margin-left:65px;
      margin-bottom:80px;
     }
     #searchMessage{
      text-align:center;
      margin-right: 100px;
      margin-top:10px;
     }     
    }    
    @media only screen and (min-width : 690px) and (max-width : 800px) {
     img{
      width:80% !important;
      margin-top: 60px;
      margin-left:10%;
      margin-right:10%;
      float:left !important;
      clear:left !important;
     }
     .container-bound{
      width:80% !important;

      margin-left:10%;
      margin-right:10%;
     }
     #submitButton{
      float:right;
      clear:right;
      margin-top: 5px;
     }
     #searchResult{
      margin-top:0;
      margin-left:100px;
      margin-bottom:80px;
     }
     #submitUpdate, #submitDelete{
      margin-bottom: 5px;
     }
     #searchMessage{
      text-align:center;
      margin-left: 130px;
      margin-top:10px;
     }     
    }    
    @media only screen and (min-width : 800px) and (max-width : 1024px) {
     img{
      width:60% !important;
      margin-top: 60px;
      margin-left:20%;
      margin-right:20%;
     }
     .container-bound{
      width:70%;
      margin-left:15%;
      margin-right:15%;
     }
     #searchResult{
      margin-top:0;
      margin-left:155px;
     }
     #submitUpdate, #submitDelete{
      margin-bottom: 5px;
     }
     #searchMessage{
      text-align:center;
      margin-left: 130px;
      margin-top:10px;
     }
    }
    @media only screen and (min-width : 1025px) {
     img{
      width:50%;
      margin-top:60px;
      margin-left:50px;
     }
     .container-bound{
      margin-top:40px;
      width:40%;
     }
     #searchResult{
     margin-top:245px;
     }
     #submitUpdate, #submitDelete{
      margin-bottom: 5px;
     }
     #searchMessage{
      margin-top:240px;
      text-align:center;
     }
    }     
   </style>
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="index.php" id="logo" style="font-family:monospace;">USTACKY</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php" style="font-family:monospace">Home</a></li>                     
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="new-word.php" style="font-family:monospace">New</a></li> 
          </ul>
        </div>
      </div>
    </nav>      
    <div class="container-fluid" style="margin-bottom:20px">
        <form  class="well" style="height:520px">              
            <div class="container-bound col-md-12 col-sm-12">
                <div class="row col-md-12 col-sm-12"><label style="color:maroon; font-size:40px">Get Your Word Updated</label></div>
                <div class="row">
                    <div class="col-md-10 col-sm-10">
                     <div class="form-group">
                      <input type="text" name="nameOfWord" readonly="readyonly" id="nameOfWord" class="form-control" value="" placeholder="Search Meaning Of Any Word">                  
                     </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6" id="searchResult">
                <div class="row">
                    <div class="col-md-10 col-sm-10">
                     <div class="form-group">
                        <textarea class="form-control" name="meaningOfWord" id="meaningOfWord" style="height:100px"></textarea>
                     </div>                     
                    </div>
                    <div class="col-md-2 col-sm-2">
                     <div class="form-group">
                        <button type="button"  class="btn btn-warning btn-md" id="submitButton"  style="font-weight:bold;font-size:16px;">Save</button>
                     </div>                      
                    </div>
                </div>
            </div>
        </form>
    </div>
    <span class="footer">
      <p style="margin-top:15px;font-family:monospace">All right reserved @Ustacky <?php echo date('Y') ?></p>
    </span>   
  </body>
</html>
