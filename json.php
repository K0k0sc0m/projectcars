<?php



init();

function init()
{
    if(!file_exists("./data.txt")){
        file_put_contents("./data.txt", "[]");
        file_put_contents("./id.txt", 0);
    }
}

function edit(){
    foreach (getData() as $car) {
        if($car["id"] == $_GET["id"]){
           return $car;
        }
     }
}

function store(){
    $data = getData();
    $car["id"] = newId();
    $car["manufacturer"] = $_POST["manufacturer"];
    $car["model"] = $_POST["model"];
    $car["year"] = $_POST["year"];
    $car["color"] = $_POST["color"];
    $car["milage"] = $_POST["milage"];
    $car["fuel"] = $_POST["fuel"];
    $car["techinspection"] = $_POST["techinspection"];
    $car["status"] = "";
    
    $data[] = $car;
    setData($data);

}

function getData(){
    $garage = json_decode( file_get_contents("./data.txt"), 1);
    foreach ($garage as &$entry){
        $entry = (array) $entry;
    }
    return $garage;
}

function setData($garage){
    file_put_contents("./data.txt",json_encode($garage));
}

function newId(){
    $id = file_get_contents("./id.txt");
    $id++;
    file_put_contents("./id.txt", $id);
    return $id;
}

function destroy(){
    $data = getData();
    foreach ($data as $key => $car) {
        if($car["id"] == $_POST["id"]){
         unset($data[$key]);
         setData($data);
         return;
        }
    }
}

function update(){
    $data = getData();
    foreach ($data as &$car) {
        if($car["id"] == $_POST["id"]){
            $car["manufacturer"] = $_POST["manufacturer"];
            $car["model"] = $_POST["model"];
            $car["year"] = $_POST["year"];
            $car["color"] = $_POST["color"];
            $car["milage"] = $_POST["milage"];
            $car["fuel"] = $_POST["fuel"];
            $car["techinspection"] = $_POST["techinspection"];
         setData($data);
         return;
        }  
    }
}

function sell(){
    $data = getData();
    foreach ($data as $key => &$car){
        if ($car['id'] == $_POST['id']){
            $car['status'] = 0;
            setData($data);

            echo "hi";
        }
    }  
}


?>