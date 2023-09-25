<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>authentification</title>
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
</head>
<body>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />

<form method="post" action="{{route('login_traitement')}}">

    @csrf
    @method('POST')

     <!-- {{Hash::make('1234')}}  -->
    <div class="box">
        <h1>Espace de Connexion</h1>
        @if (Session::get('error_msg'))
            <b style="color: rgb(199, 81, 81)">{{Session::get('error_msg')}}</b>
        @endif
        @if (Session::get('message_success'))
            <b style="color: rgb(38, 156, 8)">{{Session::get('message_success')}}</b>
        @endif
        <div class="mail">
            <label for="email">Adress mail:</label>
            <input type="email" name="email" value="{{old('email')}}"  class="email" placeholder="Votre email"  />
            @error('email')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="pass">
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" class="password" placeholder="Votre mot de passe"/>
            @error('password')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="btn-container">
            <button type="submit"> Login</button>
        </div>

        <!-- End Btn -->
        <!-- End Btn2 -->
    </div>
    <!-- End Box -->
</form>
<style>
    .text-danger{
        color: rgb(199, 81, 81);
    }
</style>
</body>
</html>