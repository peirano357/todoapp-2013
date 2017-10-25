<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] != 'josue@webstreaming.com.ar'){
    header('Location: index.php');
}

include($_SERVER['DOCUMENT_ROOT'] . "/config_todo.php");
include_once('lib/mygen_framework.php');
include_once('lib/mygen_mysql.php');
include_once('lib/DBConn.php');
include_once('classes/event.class.php');

function ShowList() {
    $array = eventCollection::showList('date',1 );

    foreach ($array as $object) {

        // PRIORITY
        if ($object['PRIORITY'] == '1') {
            $priorityIcon = 'red-exclamation.png';
            $prioritylabel = 'HIGH priority task! (click to change)';
        }

        if ($object['PRIORITY'] == '2') {
            $priorityIcon = 'yellow-exclamation.png';
            $prioritylabel = 'MEDIUM priority task (click to change)';
        }

        if ($object['PRIORITY'] == '3' || $object['PRIORITY'] == '') {
            $priorityIcon = 'green-exclamation.png';
            $prioritylabel = 'LOW priority task (click to change)';
        }

        // STATUS
        if ($object['STATUS'] == '1') {
            $statusIcon = 'checked.png'; 
            $add_class = ' crossline ';
        }
        else{
            $statusIcon = 'unchecked.png';
            $add_class = ' ';
        }


        echo '<div id="event-' . $object['ID'] . '"><div id="eventdate-' . $object['ID'] . '" data-idevent="' . $object['ID'] . '"  class="dateContent '.$add_class.'" ><i id="date-show-' . $object['ID'] . '">' . date('D M d', strtotime($object['DATE'])) . '<br/>' . date('h:i a', strtotime($object['DATE'])) . '</i> <input data-idevent="' . $object['ID'] . '" class="input-edition-date" id="edit-date-' . $object['ID'] . '" value="' . date('D M d', strtotime($object['DATE'])) . ' ' . date('h:i a', strtotime($object['DATE'])) . '" style="display:none" /> </div>
                <div class="taskContent"><div data-idevent="' . $object['ID'] . '" class="reminder '.$add_class.'" style="vertical-align:top" id="eventtitle-' . $object['ID'] . '" >' . $object['TITLE'] . '</div> <input data-idevent="' . $object['ID'] . '" class="input-edition" id="edit-' . $object['ID'] . '" value="' . $object['TITLE'] . '" style="display:none" /> </div>
                <div class="priorityContent"><img  data-value="'.$object['PRIORITY'].'" data-id="' . $object['ID'] . '" class="priority" src="images/' . $priorityIcon . '" height="25" title="'.$prioritylabel.'" /></div>
                <div class="deleteContent"><img  data-id="' . $object['ID'] . '" class="remove" src="images/delete-icon.png" height="25" title="click to remove this task" /></div>
                <div class="statusContent "><img data-value="'.$object['STATUS'].'"  data-id="' . $object['ID'] . '" class="status" src="images/'.$statusIcon.'" height="30" title="click to change task status" /></div>
                <div class="clear"></div>
                <div class="separator"></div>
                
                <div id="fademenu-' . $object['ID'] . '" class="fademenu " style=""></div>
                </div>';
    }
}
?>