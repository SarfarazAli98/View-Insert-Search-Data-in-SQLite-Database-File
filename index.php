<?php
// Creating the database
$database = new SQLite3('db.sqlite');

// creating the table in database
$database -> exec('CREATE TABLE IF NOT EXISTS user (id INTEGER PRIMARY KEY, first_name varchar(255), last_name varchar(255), dob varchar(255))');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TASK SQLite Database</title>
</head>
<body>
    <h1 style="text-align: center;">Welcom to MySQLite!</h1>
    <h1 style="text-align: center;">Task No.1</h1>

    <!-- Crating the form to dtore data into database -->
    <form method="POST">
        <table style="width:50%; margin:0 auto; text-align:center">
           
            <tr>
                <td style="border:1px solid black; width:50%; margin:0 auto; text-align:center"><h3>Enter Your First Name</h4></td>
                <td style="border:1px solid black; width:50%; margin:0 auto; text-align:center"><input type="text" name="first_name"></td>
            </tr>
            
            <tr>
            <td style="border:1px solid black; width:50%; margin:0 auto; text-align:center"><h3>Enter Your Last Name</h4></td>
                <td style="border:1px solid black; width:50%; margin:0 auto; text-align:center"><input type="text" name="last_name"></td>
            </tr>
            
            <tr>
            <td style="border:1px solid black; width:50%; margin:0 auto; text-align:center"><h3>Enter Your Date of Birth</h4></td>
                <td style="border:1px solid black; width:50%; margin:0 auto; text-align:center"><input type="date" name="dob"></td>
            </tr>
            </table>
            
        <table style="width:50%; margin:0 auto; text-align:center;">
            <tr>
                <td style="border:1px solid black; width:100%; margin:0 auto; text-align:center; padding:10px 0"><input type="submit" name="submit" value="Submit"></td>
            </tr>
        </table>
    </form>

    <!-- Search engine section -->
    <h1 style="text-align: center;">Search Engine!</h1>
    <h1 style="text-align: center;">Task No.2</h1>

    <!-- Crating the form to dtore data into database -->
    <form method="POST">
            
        <table style="width:50%; margin:0 auto; text-align:center;">
            <tr>
                <td style="border:1px solid black; width:100%; margin:0 auto; text-align:center; padding:10px 0"><input type="text" name="search_box" placeholder="Search Anything..."><input type="submit" name="search" value="search"></td>
            </tr>
        </table>

    </form>
</body>
</html>

<!-- Store the data into database -->
<?php
    // if the submit button is clicked so this condition will be run
    if(isset($_POST['submit'])){
        
        // geting data from the input boxex
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $dob = $_POST['dob'];

        // Now store the data into database
        $database->exec("INSERT INTO user (first_name, last_name, dob) VALUES ('$first_name', '$last_name', '$dob')");

        // If the data is store into table
        if($database){
            echo "<script>alert('Data has been successfully stored!')</script>";
        }
        else {
            echo "<script>alert('Data has been failed stored!')</script>";
        }
    }
?>

<!-- Search data from the database -->
<?php
    // if the submit button is clicked so this condition will be run
    if(isset($_POST['search'])){
        
        // geting data from the search box
        $search = $_POST['search_box'];

        // Now accessing the data from database
        // % is used for upper and lower case search
        $result = $database->query("SELECT * FROM user WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%'");
        
        // If access the table
        if($result){
            echo "
                <h1 style='text-align:center'>Here is search Result!</h1>
                <table style='width:50%; margin:0 auto'>
                    <tr>
                        <th style='border:1px black solid; width:25%'>S No.</th>
                        <th style='border:1px black solid; width:25%'>First Name</th>
                        <th style='border:1px black solid; width:25%'>Last Name</th>
                        <th style='border:1px black solid; width:25%'>Date of Birth</th>
                    </tr>
                </table>
                ";

            // After accessing the table fetch all data from the table
            while($row = $result->fetchArray()) {
                // Store the table into variable
                $row = (object) $row;
                    
                // Store the table's columns into variables
                $user_id = $row->id;
                $first_name = $row->first_name;
                $last_name = $row->last_name;
                $dob = $row->dob;
                
                // Showing the data from the database
                echo "
                <table style='width:50%; margin:0 auto'>
                    <tr>
                        <td style='border:1px black solid; width:25%'>$user_id</td>
                        <td style='border:1px black solid; width:25%'>$first_name</td>
                        <td style='border:1px black solid; width:25%'>$last_name</t>
                        <td style='border:1px black solid; width:25%'>$dob</td>
                    </tr>
                </table>
            ";
            }
        }
    }
?>