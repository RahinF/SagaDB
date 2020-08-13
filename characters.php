<?php
include 'header.php';
include 'condb.php';
include 'functions.php';


// query db
$sql = "
SELECT C.Name, C.Gender, C.Series, A.STR, A.END, A.DEX, A.AGI, A.INT, A.WIL, A.LOV, A.CHA 
FROM characters C LEFT JOIN attributes A 
ON C.Name = A.Name
";

$result = mysqli_query($con, $sql);
?>

<table>
    <tr>
        <th>Name</th>
        <th>Gender</th>
        <th>Series</th>
        <th>STR</th>
        <th>END</th>
        <th>DEX</th>
        <th>AGI</th>
        <th>INT</th>
        <th>WIL</th>
        <th>LOV</th>
        <th>CHA</th>
    </tr>

    <?php 


// print all rows
while ($row = mysqli_fetch_assoc($result)){
    
    echo "<tr>";        
    
    foreach($row as $attribute => $value){
        
        if($attribute === 'Series'){
            $series = getSeriesName($row, $con);
            echo "<td>{$series}</td>";
        }
        else { echo "<td>{$value}</td>"; }
    }
    
    echo "</tr>";
}
?>

</table>

<?php include 'footer.php'; ?>