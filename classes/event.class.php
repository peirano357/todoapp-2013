<?

$db = new mysql_db($db_host, $db_user, $db_pwd, $db_name, false);
add_database($db, $db_name);

class event extends BusinessObject {

    function event() {
        $this->table_name = "event";
        $this->field_metadata = array(
            "id" => array("int", true, false, false, false, false),
            "title" => array("text", false, true, false, false, true),
            "status" => array("int", false, true, false, false, true),
            "date" => array("datetime", false, true, false, false, true),
            "priority" => array("int", false, true, false, false, true)
        );
        parent::BusinessObject();
    }

    function fill_ids() {
        global $data_objects;

        $this->data["id"] = $data_objects[$this->db_key]->sql_nextid();
    }

    // DELETE ELEMENT BY ID METHOD
    public static function deleteEvent($id) {

        $reult = false;
        $data = new event();
        $data->add_filter("id", "=", $id);

        if ($data->load()) {
            $data->mark_deleted();
            $data->save();
            $result = true;
        }

        return $result;
    }

    // CHANGE STATUS METHOD
    public static function changeStatus($id, $actualStatus) {

        $result = false;
        $data = new event();
        $data->add_filter("id", "=", $id);
        if ($data->load()) {

            if ($actualStatus == 1) {
                $newStatus = 0;
            } else {
                $newStatus = 1;
            }
            $data->set_data('status', $newStatus);
            $data->save();
            $result = true;
        }
        return $result;
    }

    // CHANGE PRIORITY METHOD
    public static function changePriority($id, $actualPriority) {
        $result = false;
        $data = new event();
        $data->add_filter("id", "=", $id);
        if ($data->load()) {

            if ($actualPriority == 1) {
                $newPriority = 2;
            } elseif ($actualPriority == 2) {
                $newPriority = 3;
            } else {
                $newPriority = 1;
            }

            $data->set_data('priority', $newPriority);
            $data->save();

            $result = true;
        }
        return $result;
    }

    // UPDATE TITLE METHOD
    public static function changeTitle($id, $title) {
        $result = false;
        $data = new event();
        $data->add_filter("id", "=", $id);

        if ($data->load()) {
            $data->set_data('title', $title);
            $data->save();
            $result = true;
        }

        return $result;
    }

    // UPDATE DATE METHOD
    public static function changeDate($id, $date) {
        $result = false;
        $data = new event();
        $data->add_filter("id", "=", $id);
        if ($data->load()) {
            $data->set_data('date', $date);
            $data->save();
            $result = true;
        }
        return $result;
    }

    // SAVE NEW TASK METHOD
    public static function add($arrayParams) {
        $id = 0;
        $data = new event();

        // prepare date in correct format
        $dateSring = explode(' ', $arrayParams['DATE']);
        $montName = $dateSring[1];

        //print_r($dateSring);

        switch ($montName) {
            case 'Jan':
                $mm = '01';
                break;
            case 'Feb':
                $mm = '02';
                break;
            case 'Mar':
                $mm = '03';
                break;
            case 'Apr':
                $mm = '04';
                break;
            case 'May':
                $mm = '05';
                break;
            case 'Jun':
                $mm = '06';
                break;
            case 'Jul':
                $mm = '07';
                break;
            case 'Aug':
                $mm = '08';
                break;
            case 'Sep':
                $mm = '09';
                break;
            case 'Oct':
                $mm = '10';
                break;
            case 'Nov':
                $mm = '11';
                break;
            case 'Dec':
                $mm = '12';
                break;
        }

        $dd = $dateSring[2];
        $yyyy = date('Y');

        $hourString = $dateSring[3];
        $hourString = explode(':', $hourString);

        $hh = $hourString[0];
        $min = $hourString[1];

        if ($dateSring[4] == 'pm' && $hh != '00') {
            $hh = $hh + 12;
        }

        $formattedDate = $yyyy . '-' . $mm . '-' . $dd . ' ' . $hh . ':' . $min;

        $data->set_data("title", $arrayParams['TITLE']);
        $data->set_data("priority", $arrayParams['PRIORITY']);
        $data->set_data("date", $formattedDate);
        $data->set_data("status", '0');
        $data->save();
        $id = $data->get_data("id");

        return $id;
    }

}

class eventCollection extends BusinessObjectCollection {

    function eventCollection() {
        parent::BusinessObjectCollection();
    }

    function create_singular($row) {
        $obj = new event();
        $obj->load_from_list($row);

        return $obj;
    }

    // SHOW LIST SORTED METHOD
    public static function showList($field, $way) {

        $dataCollection = new eventCollection();
        $dataCollection->add_filter(1);
        $dataCollection->add_sort($field, $way);

        $dataCollection->load();
        $count = $dataCollection->get_count();

        if ($count != 0) {
            for ($i = 0; $i < $count; $i++) {
                $data = &$dataCollection->items[$i];

                $result[$i]['ID'] = $data->get_data("id");
                $result[$i]['TITLE'] = $data->get_data("title");
                $result[$i]['DATE'] = $data->get_data("date");
                $result[$i]['PRIORITY'] = $data->get_data("priority");
                $result[$i]['STATUS'] = $data->get_data("status");
            }
        } else {
            // EMPTY LIST
            $result = false;
        }

        return $result;
    }

}

?>
