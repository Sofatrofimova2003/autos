<?php
session_start();
// Подключение к базе данных MySQL через phpMyAdmin
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "regis";

// Создание подключения к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}


// Проверяем авторизацию пользователя
$isUserLoggedIn = isset($_SESSION['user_id']);

// Получаем ник авторизованного пользователя
$username = ""; // по умолчанию пустая строка
if ($isUserLoggedIn) {
    $username = $_SESSION['username'];
}







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автономные системы</title>
    <link rel="stylesheet" href="styless.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel=" shortcut icon" href="img/logo.png" />


    <style>
        /* Стили для модального окна */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
          background-color: #ddf4fb;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #000;
            border-radius:15px;
            width: 80%;

            max-width: 400px;
            text-align: center;
        }

        .modal-content input,
        .modal-content textarea {
            width: 100%;
            margin-bottom: 15px;
            padding: 5px;
            box-sizing: border-box;
            font-size: 16px;
            color: #000;
            border-radius: 10px;
    background-color: white;
        }

        .modal-content textarea {
            resize: vertical; /* Разрешает растягивание текстового поля только по вертикали */
        }

        .close {
          margin-left: 330px;
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover, .close:focus {
            color: #000;
            text-decoration: none;
        }

        .message {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            z-index: 9999;
        }
        .registrBtn{
    padding: 5px 10px;
    background-color: #64d6f9;
    color:  #000;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-family: 'WoobBurnRegular', sans-serif;
    margin-right: 2%; /* Добавим отступ справа для выравнивания */
}

        /* Медиа-запрос для адаптивности */
        @media (max-width: 768px) {
            .article {
                width: 100%; /* При разрешении экрана до 768px блоки статей займут всю ширину */
            }
        }
    </style>
</head>

<body>
    <div class="fon">
        <div class="hover-image-scale">
            <img src="img/fon.png" width="110%" height="500px" class="hover-image-scale">
        </div>

    </div>
    <div class="menu">
<!-- Добавляем кнопку "Регистрация/Вход" -->
<button class="login-button"  style="
    display: flex;
    margin-top: 20px;
    margin-left: 1030px;
    padding: 5px 10px;
    background-color: #26AFD9;
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-family: 'Oswald', sans-serif;
    margin-right: 30px;
    height: 40%">
   <?= $isUserLoggedIn ? $username : 'Регистрация/Вход' ?></button>
        
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Регистрация / Вход</h3>

<div class="user-info">
        <span><?= $isUserLoggedIn ? $username : 'Зарагестрируйтесь, если у вас еще нет аккаунта' ?></span>
        <?php if ($isUserLoggedIn): ?>
            <button id="logoutButton" class="b1" style="background-color:#64d6f9;border:none;border-radius:3px;    display: flex;
    margin-left: 150px;">Выход</button>
        <?php endif; ?>
    </div>
    <!-- Кнопки для выбора "Зарегистрироваться" и "Войти" -->
        <button id="registerBtn" class="b2" style="background-color:#64d6f9;border:none;border-radius:3px;margin-bottom: 3px;width: 250px;display: flex;align-content: space-around;margin-left: 50px;justify-content: center;">Зарегистрироваться</button>
        <button id="loginBtn" class="b3" style="background-color:#64d6f9;border:none;border-radius:3px;margin-bottom: 3px;width: 250px;display: flex;align-content: space-around;margin-left: 50px;justify-content: center;">Войти</button>
<!-- Форма для регистрации -->
        <form action="register_process.php" method="POST" id="registerForm" style="display: none;">
            <label for="username">Имя пользователя:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit"  class="registrBtn">Зарегистрироваться</button>
        </form>

        <!-- Форма для входа -->
        <form action="login_process.php" method="POST" id="loginForm" style="display: none;">
            <label for="email_login">Email:</label>
            <input type="email" id="email_login" name="email" required>
            
            <label for="password_login">Пароль:</label>
            <input type="password" id="password_login" name="password" required>
            
            <button type="submit" class="registrBtn">Войти</button>
        </form>
        </div>
</div>

<script>
// Открытие модального окна при клике на кнопку
var loginButton = document.querySelector('.login-button');
var loginModal = document.getElementById('loginModal');
var closeLoginModal = document.querySelector('.close');
var registerBtn = document.getElementById('registerBtn');
var loginBtn = document.getElementById('loginBtn');
var registerForm = document.getElementById('registerForm');
var loginForm = document.getElementById('loginForm');

loginButton.addEventListener('click', function() {
    loginModal.style.display = 'block';
});

// Закрытие модального окна при клике на крестик
closeLoginModal.addEventListener('click', function() {
    loginModal.style.display = 'none';
});

// Закрытие модального окна при клике за пределами окна
window.onclick = function(event) {
    if (event.target === loginModal) {
        loginModal.style.display = 'none';
    }
};

// Переключение между формами "Регистрации" и "Входа"
registerBtn.addEventListener('click', function() {
    registerForm.style.display = 'block';
    loginForm.style.display = 'none';
});

loginBtn.addEventListener('click', function() {
    loginForm.style.display = 'block';
    registerForm.style.display = 'none';
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var logoutButton = document.getElementById('logoutButton');

    if (logoutButton) {
        logoutButton.addEventListener('click', function() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'logout_process.php', true); // Создаем GET-запрос на logout_process.php
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        window.location.href = "index.php"; // Перенаправляем на index.php после успешного выхода
                    } else {
                        console.error('Произошла ошибка при выходе');
                    }
                }
            };
            xhr.send();
        });
    }
});
</script>
    </div>
    <div class="img"><a href="index.php"><img src="img/logo.png" alt="*"></a></div>
    <div class="text"><a href="index.php">
            <h1>H2O35.RU</h1>
        </a></div>
    <div class="nav">
        <div class="text1"><a href="index.php">Главная</a></div>
        <div class="text2"><a href="products.php">Товары</a></div>
        <div class="text3"><a href="rabot.php">Наши работы</a></div>
        <div class="text4"><a href="dostavka.php">Доставка и оплата</a></div>
        <div class="text5"><a href="contact.php">Контакты</a></div>
        
    </div>
    <div class="block">
        <div class="text8">
            Оформить заказ можно только <br>
по телефону:<br>
<br>
8-921-063-17-15
        </div>

    <div class="product">
        <img src="img/product.jpg" width="250px">
        <div class="name"><h3>Насосы дренажные AQUATECHNICA серии SUB xxxCS<br>
             для чистой воды, с компактным поплавковым выключателем</h3>
        </div>
        <div class="text9">Описание и предназначение данного товара:</div>
        <div class="ul">
            <li>Произведены компанией ООО ПТФ Акватехника, Россия.</li>
            <li>Глубина погружения не более 0.7м.</li>
            <li>Содержание механических примесей в воде (по объему) не более 3%.</li>
            <li>Размер частиц примесей не более 5мм.</li>
            <li>Электропитание 220 В ~ 50 Гц.</li>
            <li>Рабочая среда - вода, максимальной температурой не более 40°С.</li>
            <li>Содержание механических примесей;- не более 100 г/м3.</li>
            <li>Материал корпуса насоса - пластик (РРО). Рабочее колесо из устойчивого к эрозии пластика (РА).</li>
            <li>Электродвигатель без масла, с двойным уплотнением вала через заполненную маслом камеру.</li>
            <li>Уплотнения вала - керамика / графит + манжета. Электродвигатель оснащен тепловой защитой.</li>
        </div>
        <div class="block1">
          <h4>  от 2290 руб.</h4>
        </div>
        <div class="block2">
            <div class="text10"><h5>Бесплатная доставка оборудования до терминала транспортных компаний <br>
                (г. Вологда): ПЭК, Автотрейдинг, Деловые линии, Желдорэкспедиция. Стоимось доставки по
                <br> России можно уточнить у нас или на сайте транспортной компании.</h5>
            </div>
        </div>
    </div>
    
    <div class="products">
        <div class="block3">
            <div class="text11">
              <h2>Смотрите также</h2>
            </div>
          </div>
        
    </div>
    <div class="product1">
    <div class="p">
            <div class="carta">
                <div class="zent">
                    <a>от 9990 руб.</a>
                </div>
            <img src="img/t4.png" height="150px">
            <h4><a href="product5.php">Системы обратного<br>
            осмоса-99,9% очистки
              
            </a></h4>
           <a href="product5.php">   <button class="button12">Посмотреть</button></a>
            </div>
    
            <div class="p1">
              <div class="carta1">
                  <div class="zent">
                      <a>от 2290 руб.</a>
                  </div>
              <img src="img/17.png" height="150px">
              <h4><a href="product.php">Насосы дренажные<br>
              AQUATECHNICA серии SUB</a></h4>
               <a href="product.php"> <button class="button12">Посмотреть</button></a>
              </div>
    
              <div class="p2">
                <div class="carta2">
                    <div class="zent">
                        <a>1770 руб.</a>
                    </div>
                <img src="img/t3.png" height="150px" style="margin-left:-15px">
                <h4><a >Наборы для населения<br>
                МЭТ-Скважина-1</a></h4>
                 <a href="product4.php"> <button class="button12">Посмотреть</button></a>
                </div>
    
                <div class="p3">
                  <div class="carta3">
                      <div class="zent">
                          <a>от 3900 руб.</a>
                      </div>
                  <img src="img/t2.png" height="150px" style="margin-left:20px">
                  <h4><a href="product3.php">Системы ультрафильтрации<br>
                  питьевой воды</a></h4>
                    <button class="button12"><a href="product3.php">Посмотреть</a></button>
                  </div>
</div>
    
    </div>    
    
</body>
<div class="footer">
        <div class="text"><a href="*">
          <h1>H2O35.RU</h1>
        </a></div>
        <div class="img11"><a href="index.php"><img src="img/logo.png" alt="*"></a></div>
        <div class="contact">
            <div class="adres"><a>ООО “Автономные системы”<br>
              г. Вологда ул. Клубова д.7.</a> </div>
            <div class="tel"><a>тел: 8(8172)50-40-89, 8-921-063-17-15</a></div>
          </div>
        <div class="infa">
          <a>Продажа, установка, монтаж и обслуживание автономных систем<br>
             для частных домов, коттеджей и организаций на всей территории<br>
              Вологодской области.</a>
        </div>
      
        <div class="btn-up btn-up_hide"></div>
      
        <script>
          const btnUp = {
            el: document.querySelector('.btn-up'),
            show() {
              // удалим у кнопки класс btn-up_hide
              this.el.classList.remove('btn-up_hide');
            },
            hide() {
              // добавим к кнопке класс btn-up_hide
              this.el.classList.add('btn-up_hide');
            },
            addEventListener() {
              // при прокрутке содержимого страницы
              window.addEventListener('scroll', () => {
                // определяем величину прокрутки
                const scrollY = window.scrollY || document.documentElement.scrollTop;
                // если страница прокручена больше чем на 400px, то делаем кнопку видимой, иначе скрываем
                scrollY > 400 ? this.show() : this.hide();
              });
              // при нажатии на кнопку .btn-up
              document.querySelector('.btn-up').onclick = () => {
                // переместим в начало страницы
                window.scrollTo({
                  top: 0,
                  left: 0,
                  behavior: 'smooth'
                });
              }
            }
          }
          btnUp.addEventListener();
        </script>
      </div>

</html>