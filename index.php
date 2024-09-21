<!DOCTYPE html>
<html>
<head>
    <title>Admin || Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <style>
        /* Reset some basic styles */
        body, h1, h4 {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('background.jpg'); /* Optional background image */
            background-size: cover;
            background-position: center;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            text-align: center;
            position: fixed;
            top: 0;
        }

        #branding h1 {
            font-size: 28px;
            font-weight: bold;
            color: #fff;
        }

        #branding .highlight {
            color: #FFD700; /* Highlighted color */
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            margin-top: 100px;
            background-color: rgba(0, 0, 0, 0.7); /* Transparent background */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .clsDiv h4 {
            margin-bottom: 20px;
            text-align: center;
            color: #FFD700;
            font-size: 22px;
        }

        .clsDiv label {
            color: #fff;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .clsTxt {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: #FFD700;
            color: #333;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #f0a500;
        }

    </style>
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1> 
                <span class="highlight">Cleanpro</span> |
                 ServicesS
                </h1>
            </div>
        </div>
        <br/>  
    </header>
    <div class="container">
        <div class="clsDiv">
            <h4>Admin</h4>
            <hr/>
            <form id="frmLogin" method="post" action="login.php">
    <label for="email">Email</label>
    <input class="clsTxt" type="text" name="email" placeholder="Enter email"> <!-- Changed from 'username' to 'email' -->
    <label for="password">Password</label>
    <input class="clsTxt" type="password" name="password" placeholder="Enter password">
    <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
</form>

        </div>
    </div>
</body>
</html>
