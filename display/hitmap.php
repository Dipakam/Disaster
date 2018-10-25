<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "location";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = " select * from loc ";
$result = $conn->query($sql);
/*if($result){

    /*$array = $result->fetch_assoc();
    echo $array['longitude'];
    echo "<br>";
    $row = $result->fetch_assoc();
    echo $row['longitude'];
}
else{
    echo 'There is a problem';
}*/
$i = 0;
$row = $result->fetch_assoc();
while($row){
    
    $longitudes[$i] = $row['longitude'];
    $lattitudes[$i] = $row['lattitude'];
    $row = $result->fetch_assoc();
    $i = $i + 1;
}
$length = $i;
echo $length."<br>";
echo $longitudes[0];
echo "<br>".$longitudes[1];
$index = 0;
?>
<html>
<head>
<script src='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.css' rel='stylesheet' />
</head>
    <body>
        <p id="demo1"></p>
        <p id="demo2"></p>
        <div id='map' style='width: 400px; height: 300px;'></div>
            <script>
                var index = 1;
                var length = <?php echo $length; ?>;
                var longitude = new Array();
                var lattitude = new Array();
                <?php for ($index = 0;$index<$length;$index++){ ?>
                longitude.push('<?php echo $longitudes[$index]; ?>');
                lattitude.push('<?php echo $lattitudes[$index]; ?>');
                <?php } ?>
                mapboxgl.accessToken = 'pk.eyJ1IjoiZGlwYWthbSIsImEiOiJjam5tNnZ4NnEwMjI3M2ttbnF0ZDduNW5qIn0.WcGAmwlNApA5ZiFd2h23Tg';
                var map = new mapboxgl.Map({
                    container: 'map',
                    center: [80.2368039,26.513967299999997],
                    zoom:  13,
                    style: 'mapbox://styles/mapbox/streets-v10'
                });
                //var obj = <?php echo json_encode($result); ?>;
             
                //document.getElementById("demo1").innerHTML = longitude[0];
                //document.getElementById("demo2").innerHTML = longitude[1];
                var row = 0;
                for (row = 0;row < length;row ++) {
                
                var marker = new mapboxgl.Marker()
                .setLngLat([lattitude[row], longitude[row]])
                .addTo(map);
                }

            </script>
    </body>
    <?php
    
    
    
    ?>
</html>
