<!Doctype html>
<!DOCTYPE html>
<html>
<head>
  <title>Página de Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    .login-form {
      width: 300px;
      margin: 0 auto;
      margin-top: 150px;
    }
    .login-form form {
      margin-bottom: 15px;
      background: #f7f7f7;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      padding: 30px;
    }
    .login-form h2 {
      margin: 0 0 15px;
    }
    .form-control,
    .btn {
      min-height: 38px;
      border-radius: 2px;
    }
    .btn {
      font-size: 15px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="login-form">
    <form>
      <h2 class="text-center">Login</h2>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Usuário" required="required">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Senha" required="required">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
      </div>
    </form>
  </div>
</body>
</html>