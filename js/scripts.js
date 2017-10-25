$(document).ready(function(){
    
    site_url = 'http://localhost/todo/';
    site_url = '/';
    var f = new Date();
    //console.log(f);
    
    
    $('#new-date').datetimepicker({
        ampm: true,
        /* minDate: new Date(f.getFullYear(), f.getMonth(), f.getDate(), f.getHours(), 0), */
        separator: ' ',
        dateFormat: 'D M dd',
        timeFormat: 'hh:mm tt',
        setDate:  new Date(),
       
        onSelect: function( selectedDate ) {

        }
    });


  

    // JQUERY FUNCTION TO DELETE AN ELEMENT FROM THE LIST
    $( "#content-list" ).on( "click", ".remove", function( e ) {
    
        e.preventDefault();
        e.stopPropagation();
        $this = $(this);
        idElement = $this.attr('data-id');
      
        url = site_url+'api/todo/delete';
        
        params = 'event='+idElement;
        
        func_response = $.ajax({
            type: "DELETE",
            data: params,
            url: url,
            beforeSend: function(){
     
            },
            success: function(data){  
                
                // UPDATE UI
                $('#event-'+idElement).fadeOut('slow');
        
            }
        });
   
    });



    // BEGIN - DATE EDITION FROM POPUPCALENDAR
    $( "#content-list" ).on( "click", ".dateContent", function( e ) {
    
        e.preventDefault();
        e.stopPropagation();
        $this = $(this);
        
        idEvent = $this.attr('data-idevent');
        $('#date-show-'+idEvent).hide();
            
        $('#edit-date-'+idEvent).show();
        $('#edit-date-'+idEvent).focus();
    });
    
    $( "#content-list" ).on( "blur", ".input-edition-date", function( e ) {
    
        e.preventDefault();
        e.stopPropagation();
        $this = $(this);
        
        idEvent = $this.attr('data-idevent');
        
        
        $('#edit-date-'+idEvent).hide();
            
        $('#date-show-'+idEvent).show();
    });




    $("#content-list" ).on( "focus", ".input-edition-date", function( e ) {

        $('.input-edition-date').datetimepicker({
 
            ampm: true,
            separator: ' ',
            dateFormat: 'D M dd',
            timeFormat: 'hh:mm tt',
            setDate:  new Date(),
       
            onSelect: function( selectedDate ) {
            
                // UPDATE DATE IN FIELD IN LIST
                $this = $(this);
                idEvent = $this.attr('data-idevent');

                $('#date-show-'+idEvent).html(selectedDate);

            },
            
            onClose: function( selectedDate ) {
                
                // SAVE VALUE IN DB
                $this = $(this);
                idEvent = $this.attr('data-idevent');
                
                datestring = selectedDate;
                datestring2 = datestring.split(' ');
                month = MonthNumber(datestring2[1]);
                montName = datestring2[1];
                year = f.getFullYear();
                day = datestring2[2];
                ampm = datestring2[4];
                timestring = datestring2[3];
                timestring2 = timestring.split(':');

                hour = parseInt(timestring2[0]);
                minute = timestring2[1];

                if (ampm== 'pm') {

                    if (hour == '12') {
                        hour = '00';
                    }
                    else{
                        hour = hour+12;
                    }

                }

                formattedtime = year+'-'+month+'-'+day+' '+hour+':'+minute;
                // perform API CALL to update value
                
                
                url = site_url+'api/todo/updatedate';
                params = 'event='+idEvent+'&date='+formattedtime;
                func_response = $.ajax({
                    type: "POST",
                    data: params,
                    url: url,
                    beforeSend: function(){
     
                    },
                    success: function(data){   
                
                        console.log(data);
        
                    }
                });

            }
        });

    });

    // END - DATE EDITION FROM POPUPCALENDAR

    // BEGIN - TITLE UPDATE FUNCTIONS 
    $( "#content-list" ).on( "click", ".reminder", function( e ) {
    
        e.preventDefault();
        e.stopPropagation();
        $this = $(this);
        $this.hide();
       
        idEvent = $this.attr('data-idevent');
        $('#edit-'+idEvent).show();
        $('#edit-'+idEvent).focus();
    });
    

    $( "#content-list" ).on( "blur", ".input-edition", function( e ) {

        e.preventDefault();
        e.stopPropagation();
        $this = $(this);
        
        value = $this.val();
        if (value == ''){
            alert('Please input a title for the task!');
            return false;
        }
            
        // API CALL TO UPDATE VALUE
        
        url = site_url+'api/todo/updatetitle';
        params = 'event='+idEvent+'&title='+value;
        func_response = $.ajax({
            type: "POST",
            data: params,
            url: url,
            beforeSend: function(){
     
            },
            success: function(data){   
                
                console.log(data);
                // UPDATE UI
                $this.hide();
       
                idEvent = $this.attr('data-idevent');
                $('#eventtitle-'+idEvent).html(value);
                $('#eventtitle-'+idEvent).show();
        
            }
        });
   
    });
    
    
    $( "#content-list" ).on( "keypress", ".input-edition", function( e ) {
        if(e.which == 13) {
            e.preventDefault();
            e.stopPropagation();
            $this = $(this);
        
            value = $this.val();
            
            if (value == ''){
                alert('Please input a title for the task!');
                return false;
            }

            // API CALL TO UPDATE VALUE
        
            url = site_url+'api/todo/updatetitle';
            params = 'event='+idEvent+'&title='+value;
            func_response = $.ajax({
                type: "POST",
                data: params,
                url: url,
                beforeSend: function(){
     
                },
                success: function(data){   
                
                    console.log(data);
                    // UPDATE UI
                    $this.hide();
       
                    idEvent = $this.attr('data-idevent');
                    $('#eventtitle-'+idEvent).html(value);
                    $('#eventtitle-'+idEvent).show();
        
                }
            });
        }
    });
    // END - TITLE UPDATE FUNCTIONS 


    

    // JQUERY FUNCTION TO CHANGE THE STATUS OF AN ELEMENT FROM THE LIST
    $( "#content-list" ).on( "click", ".status", function( e ) {
        
        e.preventDefault();
        e.stopPropagation();
        $this = $(this);
        idElement = $this.attr('data-id');
        value = $this.attr('data-value');
        url = site_url+'api/todo/changestatus';
        params = 'event='+idElement+'&status='+value;
        func_response = $.ajax({
            type: "POST",
            data: params,
            url: url,
            beforeSend: function(){
     
            },
            success: function(data){        
                
                // UPDATE UI 
                if (value == 1){
            
                    $this.attr('src','images/unchecked.png');
                    $('#eventtitle-'+idElement).removeClass('crossline');
                    $('#eventdate-'+idElement).removeClass('crossline');
            
                    // UPDATE UI ELEMENT VALUE
                    $this.attr('data-value','0');
                }
                else{
                    $this.attr('src','images/checked.png');
                    $('#eventtitle-'+idElement).addClass('crossline');
                    $('#eventdate-'+idElement).addClass('crossline');
            
                    // UPDATE UI ELEMENT VALUE
                    $this.attr('data-value','1');          
                }
        
        
            }
        });

    });

    // JQUERY FUNCTION TO CHANGE THE PRIORITY OF AN ELEMENT FROM THE LIST
    $( "#content-list" ).on( "click", ".priority", function( e ) {
        
        e.preventDefault();
        e.stopPropagation();
        $this = $(this);
        idElement = $this.attr('data-id');
        value = $this.attr('data-value');
        url = site_url+'api/todo/changepriority';
        params = 'event='+idElement+'&priority='+value;
        func_response = $.ajax({
            type: "POST",
            data: params,
            url: url,
            beforeSend: function(){
     
            },
            success: function(data){   
                
                // UPDATE UI
                if (value == 1){
            
                    $this.attr('src','images/yellow-exclamation.png');
                    $this.attr('title','MEDIUM priority task (click to change)');
                    stringPri = 'MEDIUM';
                    bgClass = ' yellow ';
            
                    // UPDATE UI ELEMENT VALUE
                    $this.attr('data-value','2');
                }
                else{
                    if (value == 2){

                        $this.attr('src','images/green-exclamation.png');
                        $this.attr('title','LOW priority task (click to change)');
                        stringPri = 'LOW';
                        bgClass = ' green ';
            
                        // UPDATE UI ELEMENT VALUE
                        $this.attr('data-value','3');
            
                    }
                    else{
                        $this.attr('src','images/red-exclamation.png');
                        $this.attr('title','HIGH priority task! (click to change)');
                        stringPri = 'HIGH';
                        bgClass = ' red ';
            
                        // UPDATE UI ELEMENT VALUE
                        $this.attr('data-value','1');             
                    }
                }
                
                // INFO FADE MENU
                $('#fademenu-'+idElement).hide();
                $('#fademenu-'+idElement).html('Task priority changed to '+stringPri+'!');
                $('#fademenu-'+idElement).removeClass();
                
                $('#fademenu-'+idElement).addClass(bgClass);
                $('#fademenu-'+idElement).addClass('fademenu');
                $('#fademenu-'+idElement).show();
                
                $('#fademenu-'+idElement).delay(2000).fadeOut('slow');

            }
        });
        
    });
    
    /* BEGIN - ORDER LIST FUNCTIONS */
    $('.sortList').on('click', function(e){
       
        e.preventDefault();
        e.stopPropagation();
        $this = $(this);
            
        field = $this.attr('data-field');
        way = $('#order-'+field+'-way').attr('data-way');
            
        if (way == '1'){
            // FIRST SORT

            arrow = '&DoubleDownArrow;';
            newway = '0';
        }
        else{
            arrow = '&DoubleUpArrow;'; 
            newway = '1';

        }
            
        // PERFORM API CALL TO SHOW SORTED LIST
        url = site_url+'api/todo/list';
        params = 'field='+field+'&way='+way;
        func_response = $.ajax({
            type: "GET",
            data: params,
            url: url,
            beforeSend: function(){
     
            },
            success: function(data){  
                
                htmlContent = '';
                resultObj = data.HResponse.data;                    
                variable = JSON.parse(JSON.stringify(resultObj));
     
                // PROCESS OBJECT LIST
                $.each(variable, function(k,v){
                  
                    title = v.TITLE;
                    
                    dateStr = v.DATE;
                    timeStr = v.DATE;
                    priority = v.PRIORITY;
                    status = v.STATUS;
                    idNewTask = v.ID;  // unchecked.png
                    
                    if (status==1){
                        statusIMG = 'checked.png';
                        addClass = ' crossline ';
                    }
                    else{
                        statusIMG = 'unchecked.png';
                        addClass = '  ';
                    }

                    priorityICN = 'green-exclamation.png';
                    prioritylabel = 'LOW priority task (click to change)';
  
                    if(priority == '1'){
                        priorityICN = 'red-exclamation.png';
                        prioritylabel = 'HIGH priority task! (click to change)';
                    }

                    if(priority == '2'){
                        priorityICN = 'yellow-exclamation.png';
                        prioritylabel = 'MEDIUM priority task (click to change)';
                    }
                    
                    pDateJS = processDate(v.DATE);
                    pTimeJS = processTime(v.DATE);
                    pDay= pDateJS['DAY'];
                    pMonthStr = pDateJS['MONTH'];
                    pYear = pDateJS['YEAR'];
                    pHour =  pTimeJS['HOUR'];
                    pMinute =  pTimeJS['MINUTE'];
                    pAMPM =  pTimeJS['AMPM'];
 
                    dateStr = $.datepicker.formatDate('D M dd', new Date(pDay+" "+pMonthStr+", "+pYear+" "+pHour+":"+pMinute+":00"));
                    timeStr = pHour+':'+pMinute+' '+pAMPM;

                    htmlContent+= '<div id="event-'+idNewTask+'"><div data-idevent="'+idNewTask+'"  id="eventdate-'+idNewTask+'" class="dateContent '+addClass+'" ><i id="date-show-'+idNewTask+'" >' +dateStr+ '<br/>'  +timeStr+'</i> <input data-idevent="'+idNewTask+'" class="input-edition-date" id="edit-date-'+idNewTask+'" value="' +dateStr+ ' '  +timeStr+'" style="display:none" /> </div>';
                    htmlContent+= '<div class="taskContent"><div data-idevent="' +idNewTask+ '" class="reminder '+addClass+'" style="vertical-align:top" id="eventtitle-'+idNewTask+'" >' +title+ '</div><input data-idevent="'+idNewTask+'" class="input-edition" id="edit-'+idNewTask+'" value="' +title+ '" style="display:none" /></div>';
                    htmlContent+= '<div class="priorityContent"><img  data-value="'+priority+'" data-id="'+idNewTask+'" class="priority" src="images/'+priorityICN+ '" height="25" title="'+prioritylabel+'" /></div>';
                    htmlContent+= '<div class="deleteContent"><img  data-id="'+idNewTask+'" class="remove" src="images/delete-icon.png" height="25" title="click to remove this task" /></div>';
                    htmlContent+='<div class="statusContent "><img data-value="'+status+'"  data-id="'+idNewTask+'" class="status" src="images/'+statusIMG+'" height="30" title="click to change task status" /></div>';
                    htmlContent+='<div class="clear"></div>';
                    htmlContent+='<div class="separator"></div>';
                    htmlContent+= '<div id="fademenu-'+idNewTask+'" class="fademenu " style=""></div>';
                    htmlContent+= '</div>';
                });

                // UPDATE UI 
                $('#content-list').html(htmlContent);
                
            
                $('#order-'+field+'-way').attr('data-way',newway);
                $('#order-'+field+'-way').html(arrow);
            }
        });
                
    });

    /* END - ORDER LIST FUNCTIONS */


    ///// BEGIN - ADD NEW TASK JQUERY FUNCTIONS
    
    $('#new-priority').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        $this = $(this);
        value = $this.attr('data-value');
        
        if (value == 1){
            
            $this.attr('src','images/yellow-exclamation.png');
            $this.attr('title','MEDIUM priority task (click to change)');
            $this.attr('data-value','2');
        }
        else{
            if (value == 2){

                $this.attr('src','images/green-exclamation.png');
                $this.attr('title','LOW priority task (click to change)');
                $this.attr('data-value','3');
            
            }
            else{
                $this.attr('src','images/red-exclamation.png');
                $this.attr('title','HIGH priority task! (click to change)');
                $this.attr('data-value','1');             
            }
        }

    });


    // FOR KEYPRESS ENTER ON INPUT
    $('#new-title').keypress(function(e) {
        if(e.which == 13) {
      
            e.preventDefault();
            e.stopPropagation();
            $this = $(this);
        
            // THIS FUNCTION DOES THE PUT BY AJAX CALL
            AddNewTask();
        }
    });
    
    // FOR CLICKING THE BUTTON
    $('#add').on('click', function(e){
         
        e.preventDefault();
        e.stopPropagation();
        $this = $(this);
        
        // THIS FUNCTION DOES THE PUT BY AJAX CALL
        AddNewTask();
    });


    // PERFORM SAVE/ADD NEW TASK
    function AddNewTask(){
     
     
        title = $('#new-title').val();
        date = $('#new-date').val();
        priority = $('#new-priority').attr('data-value');
        priorityICN = 'green-exclamation.png';
        prioritylabel = 'LOW priority task (click to change)';
        
        if (priority == '1'){
            priorityICN = 'red-exclamation.png';
            prioritylabel = 'HIGH priority task! (click to change)';
        }
        if (priority == '2'){
            priorityICN = 'yellow-exclamation.png';
            prioritylabel = 'MEDIUM priority task (click to change)';
        }

        if (title == '' || date == ''){
            alert('Please input a title or name for the task and a due date.');
            return false;
        }
        
        // PERFORM API CALL
        url = site_url+'api/todo/add';
        params = 'title='+title+'&priority='+priority+'&date='+date;
        func_response = $.ajax({
            type: "PUT",
            data: params,
            url: url,
            beforeSend: function(){
     
            },
            success: function(data){  
                idNewTask = data.HResponse.data;     
                 
                // UPDATE UI
                dateArray = date.split(" ");
               
                dateStr = dateArray[0]+' '+dateArray[1]+' '+dateArray[2];
                timeStr =  dateArray[3]+' '+dateArray[4];

                htmlContent = '<div id="event-'+idNewTask+'"><div id="eventdate-'+idNewTask+'" class="dateContent " data-idevent="'+idNewTask+'"  ><i id="date-show-'+idNewTask+'" >' +dateStr+ '<br/>'  +timeStr+'</i> <input data-idevent="'+idNewTask+'" class="input-edition-date" id="edit-date-'+idNewTask+'" value="' +dateStr+ ' '  +timeStr+'" style="display:none" /> </div>';
                htmlContent+= '<div class="taskContent"><div data-idevent="' +idNewTask+ '" class="reminder" style="vertical-align:top" id="eventtitle-'+idNewTask+'" >' +title+ '</div><input data-idevent="'+idNewTask+'" class="input-edition" id="edit-'+idNewTask+'" value="' +title+ '" style="display:none" /></div>';
                htmlContent+= '<div class="priorityContent"><img  data-value="'+priority+'" data-id="'+idNewTask+'" class="priority" src="images/' +priorityICN+ '" height="25" title="'+prioritylabel+'" /></div>';
                htmlContent+= '<div class="deleteContent"><img  data-id="'+idNewTask+'" class="remove" src="images/delete-icon.png" height="25" title="click to remove this task" /></div>';
                htmlContent+='<div class="statusContent "><img data-value="0"  data-id="'+idNewTask+'" class="status" src="images/unchecked.png" height="30" title="click to change task status" /></div>';
                htmlContent+='<div class="clear"></div>';
                htmlContent+='<div class="separator"></div>';
                htmlContent+= '<div id="fademenu-'+idNewTask+'" class="fademenu " style=""></div>';
                htmlContent+= '</div>';
    
                $(htmlContent).hide().appendTo('#content-list').fadeIn('slow');
                //$('#content-list').append(htmlContent).fadeIn('slow');
        
                // CLEAN INPUTS
                title = $('#new-title').val('');
                date = $('#new-date').val('');      
                $('#new-priority').attr('src','images/green-exclamation.png');
                $('#new-priority').attr('title','LOW priority task (click to change)');
                $('#new-priority').attr('data-value','3');
            }
        });
        
    }
    
    
    ///// END - ADD NEW TASK JQUERY FUNCTIONS


    $('#login-btn').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        $this = $(this);
        email = $('#email').val();
        password = $('#password').val();
        
        if (email!='josue@webstreaming.com.ar' || password!= 'josuepass'){
            alert('Please input a valid email and password!');
            return false;
        }
        
        
        // PERFORM LOGIN VIA API
      
        url = site_url+'api/todo/loginApp';
        params = 'email='+email+'&password='+password;
        
        func_response = $.ajax({
            type: "GET",
            data: params,
            url: url,
            beforeSend: function(){
     
            },
            success: function(data){    
                // UPDATE UI
                message= data.HResponse.message;
                if (message == 'login success'){
                    
                    // REDIRECT
                    $(location).attr('href','/application.php');
                    
                }
            }
        });

    });
    
    
    
    $('#logout-btn').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        
        // PERFORM LOGOUT VIA API
      
        url = site_url+'api/todo/logoutApp';
        params = '';
        
        func_response = $.ajax({
            type: "GET",
            data: params,
            url: url,
            beforeSend: function(){
     
            },
            success: function(data){    

                // REDIRECT
                $(location).attr('href','/index.php');
                    
             
            }
        });

    });
    
    
    
});


function processTime(date)
{    
    var timeSTR = new Array();
    newDateArr = date.split(' ');
    newDateArr2 = newDateArr[1];
                    
    onlyTime = newDateArr2.split(':');
                    
    pHour = onlyTime[0];
    pMinute = onlyTime[1];
    
    if (parseInt(onlyTime[0])>12){
        pAMPM = 'pm';
        pHour = parseInt(onlyTime[0])-12;
        if (pHour<=9){
            pHour = '0'+pHour;
        }
    }
    else{
        pAMPM = 'am'; 
        pHour = onlyTime[0];
    
        if (onlyTime[0]=='00'){
            pHour = '12';
        }
    }

    timeSTR['HOUR'] = pHour;
    timeSTR['MINUTE'] = pMinute;
    timeSTR['AMPM'] = pAMPM;
    
    return timeSTR;
    
}

function processDate(date)
{    
    var dateSTR = new Array();
    newDateArr = date.split(' ');
    newDateArr2 = newDateArr[0];
                    
    onlyDate = newDateArr2.split('-');
                    
    pYear = onlyDate[0];
    pMonth = onlyDate[1];
                    
    //console.log(onlyDate);
                    
    if (pMonth=='01'){
        pMonthStr = 'Jan';
    }
                    
    if (pMonth=='02'){
        pMonthStr = 'Feb';
    }
                    
    if (pMonth=='03'){
        pMonthStr = 'Mar';
    }
                    
    if (pMonth=='04'){
        pMonthStr = 'Apr';
    }
                    
    if (pMonth=='05'){
        pMonthStr = 'May';
    }
                    
    if (pMonth=='06'){
        pMonthStr = 'Jun';
    }
                    
    if (pMonth=='07'){
        pMonthStr = 'Jul';
    }
                    
    if (pMonth=='08'){
        pMonthStr = 'Aug';
    }
                    
    if (pMonth=='09'){
        pMonthStr = 'Sep';
    }
                    
    if (pMonth=='10'){
        pMonthStr = 'Oct';
    }
                    
    if (pMonth=='11'){
        pMonthStr = 'Nov';
    }
                    
    if (pMonth=='12'){
        pMonthStr = 'Dec';
    }
                    
    pDay = onlyDate[2];
    
    dateSTR['DAY'] = pDay;
    dateSTR['YEAR'] = pYear;
    dateSTR['MONTH'] = pMonthStr;
    
    return dateSTR;
    
}

function MonthNumber(value)
{
    number = '0';
    if (value == 'January' || value == 'Jan') number = '01';
    if (value == 'February' || value == 'Feb') number = '02';
    if (value == 'March' || value == 'Mar') number = '03';
    if (value == 'April' || value == 'Apr') number = '04';
    if (value == 'May' || value == 'May') number = '05';
    if (value == 'June' || value == 'Jun') number = '06';
    if (value == 'July' || value == 'Jul') number = '07';
    if (value == 'August' || value == 'Aug') number = '08';
    if (value == 'September' || value == 'Sep') number = '09';
    if (value == 'October' || value == 'Oct') number = '10';
    if (value == 'November' || value == 'Nov') number = '11';
    if (value == 'December' || value == 'Dec') number = '12';

    return number;

}