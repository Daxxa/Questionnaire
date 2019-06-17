<?php
use \koolreport\widgets\koolphp\Table;
?>

<select>
    <option></option>
</select>
<?php
Table::create(array(
    "dataStore"=>$this->dataStore("question"),

));
?>
