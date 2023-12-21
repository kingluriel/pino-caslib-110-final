<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Social App</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Urbanist', sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f0f2f5;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 80%;
        }

        .auth-box, .post-container {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            background-color: #ffffff;
            max-width: 400px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .auth-box:hover, .post-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .auth-box {
            background-color: #1877f2;
            color: #fff;
            text-align: center;
        }

        input, textarea, button {
            width: 100%;
            margin-bottom: 15px;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            background-color: #42b72a;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background-color: #398922;
        }

        a {
            color: #1877f2;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        a:hover {
            color: #0e5a8a;
        }
    </style>
</head>
<body>
    @auth
        <div class="container">
            <div class="auth-box">
                <p>LOGGED IN</p>
                <form action="/logout" method="POST">
                    @csrf
                    <button>Log out</button>
                </form>
            </div>

            <div class="post-container">
                <h2>Create a New Post</h2>
                <form action="/create-post" method="POST">
                    @csrf
                    <input type="text" name="title" placeholder="What's on your mind?">
                    <textarea name="body" placeholder="Share your thoughts..."></textarea>
                    <button>Post</button>
                </form>
            </div>

            <div class="post-container">
                <h2>News Feed</h2>
                @foreach ($posts as $post)
                    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; margin-bottom: 15px; background-color: #ffffff; transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;">
                        <h3>{{$post['title']}} by {{$post->user->name}}</h3>
                        {{$post['body']}}
                        <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
                        <form action="/delete-post/{{$post->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button>Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @else
    <div class="container">
        <div class="auth-box">
            <h2>Create an Account</h2>
            <form action="/register" method="POST">
                @csrf
                <input name="name" type="text" placeholder="Full Name">
                <input name="email" type="text" placeholder="Email">
                <input name="password" type="password" placeholder="Password">
                <button>Sign Up</button>
            </form>
            <p>Already have an account? <a href="#login">Log in here</a>.</p>
        </div>

        <div class="auth-box" id="login">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <input name="loginname" type="text" placeholder="Email or Phone">
                <input name="loginpassword" type="password" placeholder="Password">
                <button>Log In</button>
            </form>
        </div>
    </div>
@endauth
</body>
</html>
