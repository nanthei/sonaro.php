<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POKE 3000</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class='bg-secondary text-center'>
<?php
include_once "navbar.php";
?>

<div class="container g-0">
    <div class="row pt-3">
        <div class="col">
            <h2 class='text-white'> Vartotojų Sąrašas </h2>
        </div>
        </div>

    <?php
require_once "config.php";

        // Check connection
        if ($link->connect_error) {
            die("Connection failed: " . $link->connect_error);
        }

        # Fetch records 
        $sql = "SELECT name as Vardas, surname as 'Pavardė', email as 'El. paštas', pokes as Pokes  FROM users";

        $result = $link->query($sql);
        $columns = array();
        $resultset = array();

        # Set columns and results array
        while ($row = mysqli_fetch_assoc($result)) {
            if (empty($columns)) {
                $columns = array_keys($row);
            }
            $resultset[] = $row;
        }


        # If records found
        if($resultset) {
?>  
            <div class="row pt-3">
                <div class="col">
            <table class="table table-striped table-secondary" >
                <thead>
                    <tr class='info';>
                        <?php foreach ($columns as $k => $column_name ) : ?>
                            <th> <?php echo $column_name;?> </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>

                    <?php

                        // output data of each row
                        foreach($resultset as $index => $row) {
                        $column_counter =0;
                    ?>
                        <tr class='success';>
                            <?php for ($i=0; $i < count($columns); $i++):?>
                                <td> <?php echo $row[$columns[$column_counter++]]; 
                                if($i == count($columns)-1) { ?> <button type="button" class="btn btn-sm bg-primary text-white ml-5">Poke</button> <?php };
                                ?></td>
                                <!-- <?php if($i == count($columns)-1) {echo '<script>alert("kazkas")</script>';}; ?> -->
                            <?php endfor;?>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
            </div>
            </div>
                      

    <?php }else{ ?>
        <h4> Informacija Nepasiekiama </h4>
    <?php } ?>


    </div>  
</body>
</html>