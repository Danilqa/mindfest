<?php

if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}

session_start();
require_once 'classes/Auth.class.php';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/mindfest.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>MindFest</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/landing-page.css" rel="stylesheet" />
    <link href="assets/css/custom-checkboxes.css" rel="stylesheet" />
    <link href="assets/css/progress-bar.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link href="assets/css/counter.css" rel="stylesheet">

    <!--     Owl-Carousel     -->
    <link href="assets/js/owl-carousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/js/owl-carousel/assets/owl.theme.default.min.css" rel="stylesheet" />

</head>

<body class="landing-page landing-page1">
    <nav class="navbar navbar-transparent navbar-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button id="menu-toggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                </button>
                <a href="http://www.creative-tim.com">
                    <div class="logo-container">
                        <!--<div class="logo">
                            <img src="assets/img/new_logo.png" alt="Creative Tim Logo">
                        </div>-->
                        <div class="brand">
                            MINDFEST
                        </div>
                    </div>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="example">
                <ul class="nav navbar-nav navbar-right">
                    <?php if (Auth\User::isAuthorized()): ?>
                    <?php $user = new Auth\User; ?>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#modalPC">
                            <i class="fa enter"></i> Личный кабинет 
                        </a>
                    </li>  
                    <?php else: ?>   
                    <li>
                        <a href="#" data-toggle="modal" data-target="#modalAuth">
                            <i class="fa enter"></i> Войти
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#modalRegistration">
                            <i class="fa register"></i> Регистрация
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>
    </nav>
    <div class="wrapper">
        <div class="parallax filter-gradient gray" data-color="gray">
            <div class="parallax-background">
                <img class="parallax-background-image" src="assets/img/template/bg_nev.jpg">
            </div>
            <div class="container">
                <div class="row">

                    <div class="col-md-6 col-md-offset-1">
                        <div class="description tex-center">
                            <h2>Квест начнется через</h2>
                            <br>
                            <div class="countdown-timer" data-date="2017-05-01"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <?php if (Auth\User::isAuthorized()): ?>
        <div class="section">
            <h4 class="text-progress header-text text-center">ВАШ ПРОГРЕСС</h4>
            <div class="progress mt-20">
                <div class="one primary-color"></div><div class="two primary-color"></div><div class="three no-color"></div>
                <div class="progress-bar" style="width: 70%;"></div>
            </div>
            <div class="container text-center">
                <h4 class="header-text">Вопросы</h4>
                <p>
                    Сколько раз вашему маму чпокали за гаражами бомжы?
                    <input type="text" class="form-input-underline mt-20" placeholder="Ваш ответ"><br>
                    <a href="#" class="btn btn-large btn-primary mt-20">Ответить</a>
                </p><br>
                
            </div>
        </div>       
        <?php endif; ?>
        
        <div class="section section-gray">
            <div class="container text-center">
                <h4 class="header-text whatisit">Что такое </h4>
                <p>
                    Build customer confidence by listing your users! Anyone who has used your service and has been pleased with it should have a place here! From Fortune 500 to start-ups, all your app enthusiasts will be glad to be featured in this section. Moreover, users will feel confident seing someone vouching for your product!
                    <br>
                </p>

            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="description text-center">
                            <h4 class="header-text partners">Партнёры</h4>
                            <div class="owl-carousel owl-theme">
                                <div><a href="http://varggrad.ru/"><img class="logotip" height=200 src="assets/img/logos/vargrad.png"></a></div>
                                <div><a href="http://ziferblat.net/"><img class="logotip" height=200 src="assets/img/logos/cifer.png"></a></div>
                                <div><a href="http://www.ipm.ru/"><img class="logotip" height=200 src="assets/img/logos/imp.png"></a></div>
                                <div><a href="http://hardysbarbershop.ru/"><img class="logotip" height=200 src="assets/img/logos/hardys.png"></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <footer class="footer">
            <div class="container for_footer">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Об организаторе
                                </a>
                        </li>
                    </ul>
                </nav>
                <div class="social-area pull-right">
                    <a class="btn btn-social btn-vk btn-simple" href="https://vk.com/mind_guests">
                        <i class="fa fa-vk"></i>
                    </a>
                    <!--<a class="btn btn-social btn-twitter btn-simple">
                        <i class="fa fa-twitter"></i>
                    </a>-->
                    <a class="btn btn-social btn-instagram btn-simple" href="https://www.instagram.com/mind_guests/">
                        <i class="fa fa-instagram"></i>
                    </a>
                </div>
                <div class="copyright">
                    &copy; 2017 <a href="#">Креативные парни</a>
                </div>
            </div>
        </footer>

<?php if (Auth\User::isAuthorized()): ?>
        <!-- Личный кабинет -->
        <div id="modalPC" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Личный кабинет</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-edit ajax text-center" method="post" action="./ajax.php">
                        <div class="main-error alert alert-error hide"></div>

                        <input name="username" type="text" value="<?php echo $user->getName(); ?>" class="input-block-level form-input-underline" required="true" placeholder="Имя команды" autofocus>
                        <input name="phone" type="text" value="<?php echo $user->getPhone(); ?>" class="input-block-level form-input-underline" required="true" placeholder="Телефон">
                        <input name="email" type="text" value="<?php echo $user->getEmail(); ?>" class="input-block-level form-input-underline" placeholder="Почта">
                        <input type="hidden" name="act" value="edit">
                        <button class="btn btn-large btn-primary mt-20" type="submit">Изменить данные</button>

                      </form>
                      <form class="ajax text-right" method="post" action="./ajax.php">
                          <input type="hidden" name="act" value="logout">
                          <div class="form-actions">
                              <button class="btn btn-large btn-primary mt-20" type="submit">Выйти</button>
                          </div>
                      </form>
                    </div>
                </div>

            </div>
        </div>
        <?php endif; ?>
        <!-- Всплывающее окно авторизации -->
        <div id="modalAuth" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Войти</h4>
                    </div>
                    <div class="modal-body text-center">
                      <form class="form-signin ajax" method="post" action="./ajax.php">
                        <div class="main-error alert alert-error hide"></div>

                        <input name="username" type="text" class="input-block-level form-input-underline" placeholder="Имя команды" autofocus><br><br>
                        <input name="password" type="password" class="input-block-level form-input-underline" placeholder="Пароль"><br><br>
    
                        <div class="checkbox checkbox-success">
                            <input id="checkbox3" name="remember-me" value="remember-me" type="checkbox">
                            <label for="checkbox3">
                                Запомнить меня
                            </label>
                        </div>
                        <input type="hidden" name="act" value="login">
                        <button class="btn btn-large btn-primary" type="submit">Войти</button>
                      </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- Всплывающее окно регистрации -->
        <div id="modalRegistration" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Зарегистрировать команду</h4>
                        </div>
                        <div class="modal-body">
                          <form class="form-signin ajax text-center" method="post" action="./ajax.php">
                            <div class="main-error alert alert-error hide"></div>

                            
                            <input name="username" type="text" class="input-block-level form-input-underline" required="true" placeholder="Имя команды" autofocus><br><br>
                            <input name="phone" type="text" class="input-block-level form-input-underline" required="true" placeholder="Телефон"><br><br>
                            <input name="email" type="text" class="input-block-level form-input-underline" placeholder="Почта"><br><br>
                            <input name="password1" type="password" class="input-block-level form-input-underline" required="true" placeholder="Пароль"><br><br>
                            <input name="password2" type="password" class="input-block-level form-input-underline" required="true" placeholder="Повторите пароль"><br><br>
                            <input type="hidden" name="act" value="register">
                              <button class="btn btn-large btn-primary" type="submit">Зарегистировать команду</button>
                          </form>
                        </div>
                </div>

            </div>
        </div>

</body>
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.js" type="text/javascript"></script>
<script src="assets/js/awesome-landing-page.js" type="text/javascript"></script>
<script src="assets/js/counter.js"></script>
<script src="assets/js/owl-carousel/owl.carousel.min.js"></script>
<script src="assets/js/ajax-form.js"></script>
<script>
    $(function () {
        $('.countdown-timer').bs_countdown_timer();
    });
</script>
<script>
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 4,
        loop: true,
        margin: 60,
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true
    });
    $('.play').on('click', function () {
        owl.trigger('play.owl.autoplay', [1000]);
    });
    $('.stop').on('click', function () {
        owl.trigger('stop.owl.autoplay');
    });
</script>

</html>