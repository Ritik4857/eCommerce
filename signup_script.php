<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['name']) && isset($_POST['password']) &&
        isset($_POST['email']) && isset($_POST['contact']) &&
        isset($_POST['city']) && isset($_POST['address'])) {
        
        $username = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $contact = $_POST['contact'];
        $city = $_POST['city'];
        $address = $_POST['address'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "store";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM users WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO users(name,email,password,contact,city,address) values(?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
               $stmt->bind_param("sssiss",$username,$email,$password,$contact,$city,$address);
                if ($stmt->execute()) {
                    echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "<div class='form'>
                  <h3>Someone already registers using this email.</h3><br/>
                  <p class='link'>Click here to <a href='signup.php'>registrationp</a></p>
                  </div>";
            }
            $stmt->close();
            $conn->close();
        }
        }
    else {
        echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='signup.php'>registration</a> again.</p>
                  </div>";
        }  
}
else {
    echo "Submit button is not set";
}
?>