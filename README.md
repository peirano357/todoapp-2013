# todoapp-2013
I did this code challenge on february 2013 for the last step/interview in TopTal llc.




#API RESPONSE / GENERAL

API call will result a “success” message when performed successfully a change on the D,B. or an “error” message if there was a problem while doing the transaction. The element data in the response will contain null in case of an error or a specific message if the call was performed successfully.

SUCCESS API RESPONSE EXAMPLE:
{"HResponse":{"code":200,"message":"Success","data":"ADDED TASK: 81"}}

ERROR API RESPONSE EXAMPLE:
{"HResponse":{"code":200,"message":"Error","data":null}}


#LOG IN / OUT VIA API

1 – LOGIN

CALL METHOD: GET

RETURN DATA FORMAT: JSON

PARAMETERS: string email(“josue@webstreaming.com.ar”),  string password(“josuepass”)

EXAMPLE CALL:  /api/todo/loginApp?email=josue@webstreaming.com.ar&password=josuepass


#2 – LOGOUT

CALL METHOD: GET

RETURN DATA FORMAT: JSON

PARAMETERS: -

EXAMPLE CALL:  /api/todo/logoutApp


##TASK MANAGING API CALLS


#1 – GET SORTED TASK LIST

CALL METHOD: GET

RETURN DATA FORMAT: JSON

PARAMETERS: string field (“title”/”priority”/”date”), int way (1- Descending order/0-Ascending order)

EXAMPLE CALL: /api/todo/list?way=1&field=title

EXAMPLE RESPONSE: 

{"HResponse":{"code":200,"message":"Success","data":[{"ID":"60","TITLE":"Buy 5 boxes of .357 magnum rounds and some HKS speed loaders","DATE":"2013-02-16 15:18:00","PRIORITY":"3","STATUS":"1"},{"ID":"77","TITLE":"Buy new batteries for the Nightvision googles (ATN)","DATE":"2013-02-26 07:35:00","PRIORITY":"1","STATUS":"0"},{"ID":"62","TITLE":"Head to the RPD station, meet Leon and kill some zombies...","DATE":"2013-06-01 18:05:00","PRIORITY":"3","STATUS":"0"},{"ID":"68","TITLE":"NOT is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters","DATE":"2013-02-01 06:10:00","PRIORITY":"1","STATUS":"0"}]}}



#2 – DELETE TASK 

CALL METHOD: DELETE

RETURN DATA FORMAT: JSON

PARAMETERS: int id

EXAMPLE CALL: /api/todo/delete

EXAMPLE RESPONSE: 

{"HResponse":{"code":200,"message":"Success","data":"80"}}


#3 –ADD NEW TASK 

CALL METHOD: PUT

RETURN DATA FORMAT: JSON

PARAMETERS: string title, string date(Sat Jun 01 06:05 pm 2013), int priority

EXAMPLE CALL: /api/todo/add

EXAMPLE RESPONSE: 

{"HResponse":{"code":200,"message":"Success","data:81"}}



#4 – CHANGE TASK STATUS 

CALL METHOD: POST

RETURN DATA FORMAT: JSON

PARAMETERS: int id, int status(0-Completed, 1-Pending)  

EXAMPLE CALL: /api/todo/changestatus

EXAMPLE RESPONSE: 

{"HResponse":{"code":200,"message":"Success","data":"0"}}


#5 – CHANGE TASK PRIORITY

CALL METHOD: POST

RETURN DATA FORMAT: JSON

PARAMETERS: int id, int priority(1-Medium, 2-Low, 3-High)

EXAMPLE CALL: /api/todo/changepriority

EXAMPLE RESPONSE: 

{"HResponse":{"code":200,"message":"Success","data":"1"}}



#6 –CHANGE TASK NAME / TITLE

CALL METHOD: POST

RETURN DATA FORMAT: JSON

PARAMETERS: int id, string title

EXAMPLE CALL: /api/todo/updatetitle

EXAMPLE RESPONSE: 

{"HResponse":{"code":200,"message":"Success","data":"Buy new batteries for the nightvision googles (ATN supported)"}}



#7 –CHANGE TASK DUE DATE

CALL METHOD: POST

RETURN DATA FORMAT: JSON

PARAMETERS: int id, string date (yyyy-mm-dd h:ii)

EXAMPLE CALL: /api/todo/updatedate

EXAMPLE RESPONSE: 

{"HResponse":{"code":200,"message":"Success","data": "2013-06-22 1:10"}}

