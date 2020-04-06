<?php
$database = new SQLite3('db.sqlite');

$database -> exec('CREATE TABLE IF NOT EXISTS user (id INTEGER PRIMARY KEY, first_name varchar(255), last_name varchar(255), dob varchar(255))');

// Accesing the table
$result = $database->query("SELECT * FROM user");

echo "
    <h1 style='text-align:center'>WELCOME TO SQLite DATABASE</h1>
    <h1 style='text-align:center'>User Table</h1>
    <table style='width:50%; margin:0 auto'>
        <tr>
            <th style='border:1px black solid; width:25%'>S No.</th>
            <th style='border:1px black solid; width:25%'>First Name</th>
            <th style='border:1px black solid; width:25%'>Last Name</th>
            <th style='border:1px black solid; width:25%'>Date of Birth</th>
        </tr>
    </table>
";
// By using the while loop fetching the data from the table
while($row = $result->fetchArray()) {

    // Store the table into variable
    $row = (object) $row;

    // Store the table column into variables
    $user_id = $row->id;
    $first_name = $row->first_name;
    $last_name = $row->last_name;
    $dob = $row->dob;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View The Table</title>
</head>
<body>
    <table style="width:50%; margin:0 auto">
       
        
        <!-- Table data will be show Here -->
        <tr>
            <td style="width: 25%; border:1px black solid"><?php echo $user_id; ?></td>
            <td style="width: 25%; border:1px black solid"><?php echo $first_name; ?></td>
            <td style="width: 25%; border:1px black solid"><?php echo $last_name; ?></td>
            <td style="width: 25%; border:1px black solid"><?php echo $dob; ?></td>
        </tr>
    </table>
</body>
</html>

<?php
} #End While Loop
?>