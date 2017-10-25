<?php ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>My To-Do list 1.0</title>
            <link rel="stylesheet" href="css/main.css" type="text/css" media="screen" /> 
            <link rel="stylesheet" href="css/grid.css" type="text/css" media="screen" /> 
            <link rel="stylesheet" href="css/jqueryui.css" type="text/css" media="screen" /> 
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
            <script src="js/datetimepicker.js"></script>
            <script src="js/scripts.js"></script>
    </head>
    <body>

        <div class="tooltip">&nbsp;</div><div class="tooltipInputs">&nbsp;</div>

        <div id="topBar"></div>

        <div class="container_12 clearfix">

            <h1>Login</h1>
            <div class="grid_10" >


                <div>
                    <div class="floatLeft w50 rightAlign">
                        Email:
                    </div>
                    <div class="floatLeft">
                        <input class="new-input med-imput" id="email" name="email"  />
                    </div> 

                    <div class="clear"></div>
                    <br/>

                    <div class="floatLeft w50 rightAlign">
                        Password:
                    </div>
                    <div class="floatLeft">
                        <input class="new-input med-imput" id="password" name="password" type="password" />
                    </div> 

                    <div class="clear"></div>
                    <br/>
                    <div class="floatLeft w50 rightAlign">
                        &nbsp;
                    </div>
                    <div class="floatLeft ">
                        <input type="button" class="new-button" id="login-btn" name="login-btn" value="&nbsp; &nbsp; Login &nbsp; &nbsp;" />
                    </div> 

                    <div class="clear"></div>




                </div>

            </div> 
        </div> 

        <div id="footer-area" class="container_12" >
            by josue@webstreaming.com
        </div>

        <div id="topBarFake" style="position:fixed;bottom:0;"></div>

</html>
