<?php
$data = [
    ["name"=>"田中", "age"=>"25", "gender"=>"男"],
    ["name"=>"鈴木", "age"=>"20", "gender"=>"男"],
    ["name"=>"佐藤", "age"=>"23", "gender"=>"女"],
];

foreach($data as $value){
    foreach($value as $obj){
        echo $obj;
    }
    echo "</br>";

}

echo $data[1]["age"];
?>
