
<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>

    <style>
        body {
            background-color: lightyellow;
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        form {
            width: 500px;
            margin: auto;
            background-color: #fff9cc;
            padding: 25px;
            border: 2px solid #e6d65c;
            border-radius: 10px;
        }

        label {
            display: inline-block;
            margin-top: 10px;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            width: auto;
            margin-right: 5px;
        }

        button {
            background-color: #f0d84a;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #e6c900;
        }
    </style>
</head>

<body>

<form action="process.php" method="POST">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name">

    <label for="email">Email:</label>
    <input type="email" id="email" name="email">

    <label for="mobile">Mobile:</label>
    <input type="text" id="mobile" name="mobile">

    <label for="pincode">Pincode:</label>
    <input type="text" id="pincode" name="pincode">

    <label for="message">Message:</label>
    <textarea id="message" name="message"></textarea>

    <label for="address">Address:</label>
    <textarea id="address" name="address"></textarea>

    <label for="gender">Gender:</label>

    <input type="radio" id="male" name="gender" value="male">
    <label for="male">Male</label>

    <input type="radio" id="female" name="gender" value="female">
    <label for="female">Female</label>

    <br><br>

    <button type="submit">Submit</button>

</form>

</body>
</html>

