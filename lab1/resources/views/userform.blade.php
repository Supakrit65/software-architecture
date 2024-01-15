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
        <link href="{{ asset('css/userform.css') }}" rel="stylesheet">
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
    
                <div class="captcha">
                    <div id="captcha-image-container">
                        {!! Captcha::img() !!}
                    </div>
                    <button type="button" class="btn btn-danger" id="refresh-captcha">Refresh</button>
                    <input type="text" name="captcha" class="form-control" placeholder="Enter Captcha"/>
                </div>
                
                <button type="submit">Submit</button>
            </form>
        </div>
        <script type="text/javascript">
            document.getElementById('refresh-captcha').addEventListener('click', function(){
                fetch('/refresh-captcha')
                    .then(response => {
                        if(response.ok) {
                            return response.text();
                        }
                        throw new Error('Network response was not ok.');
                    })
                    .then(data => {
                        document.getElementById('captcha-image-container').innerHTML = data;
                    })
                    .catch(error => {
                        console.error('There has been a problem with your fetch operation:', error);
                    });
            });
        </script>
    </body>
</html>
