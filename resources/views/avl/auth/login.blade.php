<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Панель управления">
  <meta name="author" content="pandaprotect@yandex.ru">
  <meta name="keyword" content="">
  <link rel="shortcut icon" href="img/favicon.png">
  <title>Панель управления</title>

  <!-- Icons -->
  <link href="/avl/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="/avl/css/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

  <!-- Main styles for this application -->
  <link href="/avl/css/style.css" rel="stylesheet">
  <!-- Styles required by this views -->

</head>

<body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card-group">
            <div class="card p-4">

              <div class="card-body">

                  <form action="" method="post">
                      {{ csrf_field() }}
                    <h1>Вход</h1>
                    <p class="text-muted">Войдите под своим логином</p>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-user"></i></span>
                      </div>
                      <input type="text" name="email" class="form-control @if ($errors->has('email')) is-invalid @endif" placeholder="E-mail" value="{{ old('email') }}">
                      @if ($errors->has('email'))<div class="invalid-feedback">{{ $errors->first('email') }}</div>@endif
                    </div>
                    <div class="input-group mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-lock"></i></span>
                      </div>
                      <input type="password" name="password" class="form-control @if ($errors->has('password') || $errors->has('field')) is-invalid @endif" placeholder="Пароль">
                      @if ($errors->has('password') || $errors->has('field'))
                        @if ($errors->has('password'))<div class="invalid-feedback">{{ $errors->first('password') }}</div>@endif
                        @if ($errors->has('field'))<div class="invalid-feedback">{{ $errors->first('field') }}</div>@endif
                      @endif
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <button type="submit" class="btn btn-primary px-4">Войти</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
</body>
</html>
