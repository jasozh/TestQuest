<?php

@sqlStatement = "SELECT * FROM `table1` WHERE
$result = $conn->query($sqlStatement);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Name: ". $row['name'];
    }
}
?>