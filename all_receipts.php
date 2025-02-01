<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Receipts</title>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    .view-button {
        margin-top: 20px;
    }
</style>
</head>
<body>
    <h1>Receipts</h1>
    <table>
        <tr>
            <th>Date</th>
            <th>Order ID</th>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php
        // Database credentials
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "coffee";

        try {
            // Connect to the database
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Retrieve all receipts from the database
            $stmt = $conn->query("SELECT * FROM detail");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>".$row['date']."</td>";
                echo "<td>".$row['orderId']."</td>";
                echo "<td>".$row['item']."</td>";
                echo "<td>".$row['price']."</td>";
                echo "<td>".$row['quantity']."</td>";
                echo "<td>".$row['total']."</td>";
                echo "<td><a href='display.php?id=".$row['id']."'>View Receipts</a></td>";
                echo "</tr>";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Close the database connection
        $conn = null;
        ?>
    </table>
</body>
</html>