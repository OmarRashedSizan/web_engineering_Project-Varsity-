<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stored Form Data</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }
        .data-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .data-item {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        .data-item strong {
            font-weight: bold;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="data-container">
        <h2>Stored Form Data</h2>
        <?php
        // Database credentials
        $servername = "localhost"; // Replace with your server name
        $username = "your_username"; // Replace with your MySQL username
        $password = "your_password"; // Replace with your MySQL password
        $dbname = "your_database";   // Replace with your MySQL database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to retrieve data
        $sql = "SELECT * FROM form_data";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class='data-item'>";
                echo "<strong>ID:</strong> " . $row["id"] . "<br>";
                echo "<strong>Name:</strong> " . $row["name"] . "<br>";
                echo "<strong>Comments:</strong> " . $row["comments"] . "<br>";
                echo "<strong>Agreed:</strong> " . $row["agreed"] . "<br>";
                echo "<strong>Skills:</strong> " . $row["skills"] . "<br>";
                echo "<strong>Gender:</strong> " . $row["gender"] . "<br>";
                echo "<strong>Occupation:</strong> " . $row["occupation"] . "<br>";
                echo "<strong>Favorite Tools:</strong> " . $row["favorite_tools"] . "<br>";
                echo "</div>";
            }
        } else {
            echo "No data found.";
        }
        $conn->close();
        ?>
        <p><a href="index.html">Go back to the form</a></p>
    </div>
</body>
</html>