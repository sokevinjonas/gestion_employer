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

<form method="post" action="{{route('EmailvalidateAccess', )}}">

    @csrf
    @method('POST')

    {{-- {{Hash::make('123456')}} --}}
    <div class="box">
        <h1>Espace de Validation</h1>
        @if (Session::get('error_msg'))
            <b style="color: rgb(199, 81, 81)">{{Session::get('error_msg')}}</b>
        @endif
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{$email}}"  class="email" readonly/>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" class="password"/>
            @error('password')
            <span class="text-danger">
                {{ $message }}
                @enderror
            </span>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe de confirmation:</label>
            <input type="password" name="confirm_password" class="password"/>
            @error('confirm_password')
            <span class="text-danger">
                {{ $message }}
                @enderror
            </span>
        </div>
        <div class="btn-container">
            <button type="submit"> Valider </button>
        </div>

        <!-- End Btn -->
        <!-- End Btn2 -->
    </div>
    <!-- End Box -->
</form>
<style>
    .text-danger{
       color:  rgb(196, 21, 21);
    }
</style>
</body>
</html>