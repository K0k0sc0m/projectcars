<?php

include("./json.php");


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])){
    session_start();

}

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])){
    $car = edit();

}

if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["id"])){
    store();
    header("location:./");
    die;
}

if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["manufacturer"])){
    destroy();
    header("location:./");
    die; 
}
  
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])  ){
    update();
    header("location:./");
    die;
}

//  echo "<pre>";
//  print_r($_SESSION);
//  echo "</pre>";
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style>

@font-face {
    font-family: popins;
    src: url("fonts/Poppins-Bold.ttf");
}


body {
    background: rgba(0,0,0, .2);
    font-family: popins;

}

.hdr {
    background: rgba(46,186,200, .5);

}


.center{
    text-align: center;
}

.container {
    margin-top: 5rem;
    margin-bottom: 2rem;
    
}

</style>

<body>

<nav class="navbar navbar-dark bg-primary fixed-top">
    <div class="col-md-12 center">
        <h2 style="color:black;">
            CARS FOR SALE
        </h2>
    </div>
</nav>




<div class="container">
    <div class="row">    
        <div class="col-4">
            <form class="form" action="" method="POST">
    



            <div class="form-group row">
                <label class="col-sm-4 col-form-label" >Manufacturer</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="manufacturer" value="<?= (isset($car))? $car["manufacturer"] : "" ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" >Model</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="model" value="<?= (isset($car))? $car["model"] : "" ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" >Year</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="year" value="<?= (isset($car))? $car["year"] : "" ?>">
                </div>  
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" >Color</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="color" value="<?= (isset($car))? $car["color"] : "" ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" >Milage</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="milage" value="<?= (isset($car))? $car["milage"] : "" ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" >Fuel</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="fuel" value="<?= (isset($car))? $car["fuel"] : "" ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" >Technical inspection</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="techinspection" value="<?= (isset($car))? $car["techinspection"] : "" ?>">
                </div>
            </div>





            <?php if(!isset($car)){
            echo '<button class="btn btn-primary" type="submit">Add Car</button>';
            }else{
            echo '
            <input type="hidden" name="id" value="'. $car["id"].' ">
            <button class="btn btn-info" type="submit">Renew data of Your car</button>';
            } ?>

    

    


            </form>
        </div>

        <div class="col-4">
        
        </div>

        <div class="col-4">
            <img src="img/car.jpg" height="250px">
        </div>

    </div>    
</div>


    <table class="table hdr">
        <tr>
        <th>Nr</th> 
        <th>Manufacturer</th> 
        <th>Model</th>
        <th>Year</th>
        <th>Color</th>
        <th>Milage</th>
        <th>Fuel</th>
        <th>Technical inspection</th>
        <th>Edit</th> 
        <th>Sold</th> 
        </tr>


        <?php $count = 0; foreach (getData() as $car) {  ?>
            <tr>
                <td> <?= ++$count ?> </td>
                <td> <?= $car["manufacturer"]  ?> </td>
                <td> <?= $car["model"]  ?> </td>
                <td> <?= $car["year"]  ?> </td>
                <td> <?= $car["color"]  ?> </td>
                <td> <?= $car["milage"]  ?> </td>
                <td> <?= $car["fuel"]  ?> </td>
                <td> <?= $car["techinspection"]  ?> </td>

                <td><a class="btn btn-warning" href="?id=<?= $car["id"]  ?>">edit</a></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?=$car["id"]?>"  >
                        <button class="btn btn-danger" type="submit">Sold</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>






    
</body>
</html>