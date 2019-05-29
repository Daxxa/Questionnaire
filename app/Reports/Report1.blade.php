<?php
use koolreport\KoolReport;
use \koolreport\widgets\koolphp\Table;
use \koolreport\codeigniter\Friendship;
use \koolreport\widgets\google\BarChart;
require_once "app/Reports/Report1.php"
?>
<?php
Table::create(array(
    "dataStore"=>$this->dataStore(),
    "options"=>array(
        "searching"=>true,
        "paging"=>true,
        "orders"=>array(
            array(1,"desc")
        )
    ),
    "cssClass"=>array(
        "table"=>"table table-hover table-bordered"
    )
));
?>
