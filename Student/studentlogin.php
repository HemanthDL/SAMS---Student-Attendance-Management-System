<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            animation: backgroundGradient 10s ease infinite;
            background-size: 400% 400%;
        }

        @keyframes backgroundGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
            animation: fadeIn 1s ease-out;
            height:250px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        h1 {
            margin-bottom: 2rem;
            font-size: 1.8rem;
            color: #333;
        }

        table {
            width: 100%;
            margin-bottom: 1.5rem;
        }

        td {
            padding: 0.8rem;
        }

        input[type="text"] {
            width: 100%;
            padding: 0.8rem;
            margin: 0.5rem 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #007BFF;
            outline: none;
        }

        input[type="submit"] {
            padding: 0.7rem 2.5rem;
            border: none;
            border-radius: 5px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
        }

        .alert {
            margin-top: 1rem;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Student Login</h1>
        <form method="post" action="studentlogin.php">
            <table>
                <tr>
                    <td align="right"><label for="usn">Student USN:</label></td>
                    <td><input type="text" id="usn" name="usn" required></td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Login">
        </form>
        <?php
            include ('../connection.php');
            if(isset($_POST['submit'])){
                $usn = $_POST['usn'];
                
                $sql = "SELECT usn FROM Student WHERE usn='$usn'";
                $res = $conn->query($sql);
                if($res->num_rows > 0){
                    session_start();
                    $_SESSION['usn'] = $usn;
                    echo "Logged In!";
                    header('Location:studentmain.php');
                    exit(); 
                } else {
                    echo "<div class='alert'>Invalid Username or Password</div>";
                }
            }
        ?>
    </div>
</body>
</html>
