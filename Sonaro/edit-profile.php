<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = $new_email = $new_name = $new_surname = "";
$new_password_err = $confirm_password_err = $new_email_err = $new_name_err = $new_surname_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Įveskite slaptažodį.";     
    } elseif(!preg_match('/^(?=.*?[A-Z])(?=.*?[0-9]).*$/' , trim($_POST["new_password"]))){
        $new_password_err = "Slaptažodis turi turėti mažiausiai vieną didžiąją raidę ir vieną skaičių.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
     
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

     // Validate email
     if(empty(trim($_POST["new_email"]))){
        $new_email_err = "Įveskite El. paštą.";     
    } else{
        $new_email = trim($_POST["new_email"]);
    }

     // Validate name
     if(empty(trim($_POST["new_name"]))){
        $new_name_err = "Įveskite savo vardą.";     
    } else{
        $new_name = trim($_POST["new_name"]);
    }

     // Validate surname
     if(empty(trim($_POST["new_surname"]))){
        $new_surname_err = "Įveskite savo pavardę.";     
    } else{
        $new_surname = trim($_POST["new_surname"]);
    }
 
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err) && empty($new_email_err) && empty($new_name_err) && empty($new_surname_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? , email = ? , name = ? , surname = ? WHERE id = ?";
       
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_password, $param_email, $param_name, $param_surname, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_email = $new_email;
            $param_name = $new_name;
            $param_surname = $new_surname;
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profilio redagavimas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class= "bg-secondary">

<?php
include_once "navbar.php";
?>

    <div class="container text-white">
        <div class="row justify-content-center  pt-3">
            <div class="col-sm-12 col-md-10 col-lg-4" >
                <h2 class='text-white text-center'>Profilio redagavimas</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                    <div class="form-group mb-3">
                        <label>Naujas slaptažodis</label>
                        <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                        <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                    </div>
                    <div class="form-group mb-3">
                        <label>Patvirtinkite slaptažodį</label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div class="form-group mb-3">
                        <label>Naujas El. paštas</label>
                        <input type="email" name="new_email" class="form-control <?php echo (!empty($new_email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_email; ?>">
                        <span class="invalid-feedback"><?php echo $new_email_err; ?></span>
                    </div>
                    <div class="form-group mb-3">
                        <label>Naujas Vardas</label>
                        <input type="text" name="new_name" class="form-control <?php echo (!empty($new_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_name; ?>">
                        <span class="invalid-feedback"><?php echo $new_name_err; ?></span>
                    </div>
                    <div class="form-group mb-3">
                        <label>Nauja Pavardė</label>
                        <input type="text" name="new_surname" class="form-control <?php echo (!empty($new_surname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_surname; ?>">
                        <span class="invalid-feedback"><?php echo $new_surname_err; ?></span>
                    </div>
                    <div class="form-group mb-3 text-center">
                        <input type="submit" class="btn btn-primary m-3" value="Redaguoti">
                        <a class="btn btn-danger" href="list.php">Atšaukti</a>
                    </div>
                </form>
            </div>
        </div>
    </div>    
</body>
</html>