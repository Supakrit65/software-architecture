<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Info</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
                font-family: 'figtree', sans-serif;
                background-color: #f0f2f5;
            }

            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
            }

            form {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            label {
                font-size: 14px;
                font-weight: 600;
                color: #1877f2; /* Facebook blue color */
            }

            input, select {
                width: 100%;
                padding: 10px;
                margin-top: 5px;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
            }

            /* Style for error messages */
            ul.error-messages {
                color: red;
                list-style-type: none;
                padding: 0;
            }

            ul.error-messages li {
                margin: 5px 0;
            }

            button {
                background-color: #1877f2; /* Facebook blue color */
                color: #fff;
                padding: 10px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }

            button:hover {
                background-color: #165499; /* Darker shade for hover effect */
            }
        </style>
    </head>

    <body class="antialiased">
        <div class="container">
            <h1>User Info</h1>
            <form action="/userform" method="post">
                @csrf <!-- Laravel CSRF token -->

                <!-- Display general error messages -->
                @if($errors->any())
                    <div>
                        <ul class="error-messages">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <label for="username">Username:</label>
                <input type="text" id="username" name="username">

                <label for="email">Email:</label>
                <input type="text" id="email" name="email">

                <label for="password">Password:</label>
                <input type="password" id="password" name="password">

                <label for="password_confirm">Confirm Password:</label>
                <input type="password" id="password_confirm" name="password_confirm">

                <label for="color">Select Color:</label>
                <select id="color" name="color">
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="yellow">Yellow</option>
                    <option value="green">Green</option>
                </select>

                <button type="submit">Submit</button>
            </form>
        </div>
    </body>
</html>
