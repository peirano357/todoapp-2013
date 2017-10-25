<?php include_once('index.inc.php'); ?>
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

            <h1>To-do List</h1>
            <div class="grid_10" >

                <div class="dateTitle"><b class="pointer sortList" data-field="date">Date <span id="order-date-way" data-way="1" ></span></b></div>
                <div class="taskTitle"><b class="pointer sortList" data-field="title">Task <span id="order-title-way" data-way="1" ></span></b></div>
                <div class="priorityTitle"><b class="pointer sortList" data-field="priority" >Priority <span id="order-priority-way" data-way="1"></span></b></div>
                <div class="deleteTitle"><b>Delete</b></div>
                <div class="statusTitle"><b>Completed</b></div>
                <div class="clear"></div>
                <div id="content-list">
                    <?php echo ShowList(); ?>
                </div>
                <br/>
                <br/>
                <div id="new-task">

                    <div class="floatRight">
                        <input type="button" class="new-button" id="add" name="add" value="Add new task" />
                    </div>  
                    <div class="floatRight img-padd">
                        <img id="new-priority" data-value="3" data-id="0" src="images/green-exclamation.png" height="25" title="LOW priority task (Click to change)" />
                    </div>  


                    <div class="floatRight">
                        <input class="new-input long-imput" id="new-title" name="new-title" placeholder="Task title" />
                    </div>  


                    <div class="floatRight">
                        <input readonly="readonly" class="new-input short-imput" id="new-date" name="new-date" placeholder="Date & time" />
                    </div>  
                    <div class="clear"></div>
                </div>

            </div> 
        </div> 


        <div class="clear"></div>
        <div id="footer-area" class="container_12" >

            <div class="floatRight ">
                <input type="button" class="new-button" id="logout-btn" name="logout-btn" value="&nbsp; &nbsp; Logout &nbsp; &nbsp;" />
            </div> 
            <div class="clear"></div><br/>
            by josue@webstreaming.com
        </div>

        <div id="topBarFake" style="position:fixed;bottom:0;"></div>

</html>