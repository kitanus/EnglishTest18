<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Тест</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="src/View/bootstrap/css/bootstrap.min.css?<?= round(time()/20) ?>" rel="stylesheet">
    <link href="src/View/css/main.css?<?= round(time()/20) ?>" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-inverse navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Меню</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-main">
                <ul class="nav navbar-nav">

                    <!-- Ссылки -->
                    <li><a href="/">Стартовая страница</a></li>
                    <li><a href="/statistics">Статистика</a></li>
                    <li><a href="/setting">Настройка</a></li>

                    <!-- Выпадающий список -->
                    <li class="dropdown">
                        <ul class="dropdown-menu">
                            <li><a href="/">Стартовая страница</a></li>
                            <li><a href="/statistics">Статистика</a></li>
                            <li><a href="/setting">Настройка</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid main">
        <?php include __DIR__.'/'.$content_view; ?>
    </div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="src/View/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>