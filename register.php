<?php

if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
session_start();
require_once './classes/Auth.class.php';

?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Форма</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body>

    <div class="container">

      <?php if (Auth\User::isAuthorized()): ?>
    
      <h1>Вы уже зарегистрированы!</h1>

      <form class="ajax" method="post" action="./ajax.php">
          <input type="hidden" name="act" value="logout">
          <div class="form-actions">
              <button class="btn btn-large btn-primary" type="submit">Выйти</button>
          </div>
      </form>

      <?php else: ?>

      <form class="form-signin ajax" method="post" action="./ajax.php">
        <div class="main-error alert alert-error hide"></div>

        <h2 class="form-signin-heading">Зарегистировать команду</h2>
        <input name="username" type="text" class="input-block-level" required="true" placeholder="Имя команды" autofocus>
        <input name="phone" type="text" class="input-block-level" required="true" placeholder="Телефон">
        <input name="email" type="text" class="input-block-level" placeholder="Почта">
        <input name="password1" type="password" class="input-block-level" required="true" placeholder="Пароль">
        <input name="password2" type="password" class="input-block-level" required="true" placeholder="Повторите пароль">
        <input type="hidden" name="act" value="register">
        <button class="btn btn-large btn-primary" type="submit">Зарегистировать команду</button>
        <div class="alert alert-info" style="margin-top:15px;">
            <p>Уже зарегистрирована? <a href="/">Войти.</a>
        </div>
      </form>

      <?php endif; ?>

    </div> <!-- /container -->

    <script src="./vendor/jquery-2.0.3.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./js/ajax-form.js"></script>

  </body>
</html>
