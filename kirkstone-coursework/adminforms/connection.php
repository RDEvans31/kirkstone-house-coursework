<html>
<head>
</head>
<body>
  <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "khs";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();

    }
  ?>
</body>
