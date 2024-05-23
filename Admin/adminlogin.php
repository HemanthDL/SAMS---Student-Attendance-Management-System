<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
            height:350px;
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

        h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            margin-bottom: 1.5rem;
        }

        td {
            padding: 0.8rem;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            margin: 0.5rem 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus {
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
        <h2>LOGIN</h2>
        <form method="post" action="adminlogin.php">
            <table>
                <tr>
                    <td align="right"><label for="username">Username:</label></td>
                    <td><input type="text" id="username" name="username" required></td>
                </tr>
                <tr>
                    <td align="right"><label for="password">Password:</label></td>
                    <td><input type="password" id="password" name="password" required></td>
                </tr>
            </table>
            <input type="submit" value="Login">
        </form>
        <?php
            include ('../connection.php');
            if(isset($_POST['username'], $_POST['password'])){
                $user = $_POST['username'];
                $password = $_POST['password'];

                $sql = "SELECT * FROM admin WHERE username='$user' AND password='$password'";
                $res = $conn->query($sql);
                if($res->num_rows > 0){
                    echo "Logged In!";
                    header('Location:admin.html');
                    exit(); 
                } else {
                    echo "<div class='alert'>Invalid Username or Password</div>";
                }
            }
            $conn->close();
        ?>
    </div>
</body>
</html>
