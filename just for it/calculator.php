<?php
// DATABASE CONNECTION
$conn = new mysqli("localhost", "root", "", "calculator_db2");
if ($conn->connect_error) {
    die("Database connection failed");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Simple Calculator</title>

<style>
body {
    background: white;
    font-family: Arial;
}
.main-box {
    width: 70%;
    margin: 40px auto;
    padding: 25px;
    background: lightgray;
    border-radius: 12px;
    text-align: center;
}
h1 {
    color: black;
    font-weight: bold;
    font-style: italic;
}
input[type="number"] {
    width: 80%;
    padding: 12px;
    margin: 12px 0;
    border-radius: 6px;
    border: 1px solid #999;
    font-size: 16px;
}
.calc-btn {
    margin-top: 20px;
    background: red;
    color: black;
    padding: 12px 40px;
    font-size: 18px;
    font-weight: bold;
    font-style: italic;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
.result-box {
    margin-top: 20px;
    padding: 15px;
    background: black;
    color: white;
    border-radius: 10px;
    font-size: 20px;
}
</style>
</head>

<body>

<div class="main-box">
    <h1>SIMPLE CALCULATOR</h1>

    <form method="POST">
        <input type="number" name="num1" placeholder="Enter number 1" required><br>
        <input type="number" name="num2" placeholder="Enter number 2" required><br>

        <button type="submit" name="calculate" class="calc-btn">
            CALCULATE
        </button>
    </form>

    <div class="result-box">
        <?php
        if (isset($_POST['calculate'])) {

            $a = $_POST['num1'];
            $b = $_POST['num2'];

            // ADDITION
            $ans = $a + $b;

            // INSERT INTO DATABASE
            $sql = "INSERT INTO calculations (num1, num2, result)
                    VALUES ('$a', '$b', '$ans')";

            if ($conn->query($sql)) {
                echo "Your Answer is: <b>$ans</b>";
            } else {
                echo "Database Error";
            }
        }
        ?>
    </div>
</div>

</body>
</html>
