<?php 
    ob_start();
    if(!session_start()){
      session_start();
    }
    include("template/front/header.php");
    include("template/front/navbar.php");
    include("config/database.php");
?>
<?php
    $i=1;
    $statement = $conn->prepare('SELECT * FROM about ORDER BY about_id DESC');
    $statement->execute();
    $about = $statement->fetchAll(PDO::FETCH_ASSOC);
    $sNo  = 1;
    foreach ($about as $about);
?>

<section class="about">

    <h1 class="heading"> Об <span> меня </span> </h1>

    <div class="row">
        <div class="info-container">
            <h1> Личная информация </h1>
            <div class="box-container">

                <div class="box">
                    <h3> <span style="color: #CB2729;font-weight: lighter;"> Моя имя : </span> <?php echo $about['about_name']; ?> </h3>
                    <h3> <span style="color: #CB2729;font-weight: lighter;"> Возрасть : </span> <?php echo $about['about_age']; ?> </h3>
                    <h3> <span style="color: #CB2729;font-weight: lighter;"> Мой почта : </span> <?php echo $about['about_email']; ?> </h3>
                    <h3> <span style="color: #CB2729;font-weight: lighter;"> Мой адрес : </span><?php echo $about['about_address']; ?> </h3>
                </div>

                <div class="box">
                    <h3> <span style="color: #CB2729;font-weight: lighter;"> Фрилансер : </span> <?php echo $about['about_free']; ?> </h3>
                    <h3> <span style="color: #CB2729;font-weight: lighter;"> Разработка : </span> <?php echo $about['about_skill']; ?> </h3>
                    <h3> <span style="color: #CB2729;font-weight: lighter;"> Мой Опыт : </span> <?php echo $about['about_exp']; ?> </h3>
                    <h3> <span style="color: #CB2729;font-weight: lighter;"> Знание Языков : </span> <?php echo $about['about_lang']; ?></h3>
                </div>

            </div>

            <a target="_blank" href="https://<?php echo $about['about_button']; ?>" class="btn"> Скачать (РЕЗЮМЕ) CV <i
                    class="fas fa-download"></i> </a>

        </div>
        <div class="count-container">
            <div class="box">
                <p style="color: #fff;"> Годы опыта: </p>
                <h3><?php echo $about['about_exp_yrs'];?>+</h3>
            </div>

            <div class="box">
                <p style="color: #fff;"> Счастливые клиенты: </p>
                <h3><?php echo $about['about_happy']; ?>+</h3>
            </div>

            <div class="box">
                <p style="color: #fff;"> Завершённые проекты: </p>
                <h3><?php echo $about['about_project']; ?>+</h3>
            </div>

            <div class="box">
                <p style="color: #fff;"> Награды об Завершённые проекты: </p>
                <h3><?php echo $about['about_awards']; ?>+</h3>
            </div>
        </div>
    </div>
</section>

<!-- Языки программирования -->
<section class="skills">
    <h1 class="heading"> <span> МОИ знание </span> Языки программирования </h1>
</section>
<!-- Языки программирования -->

<!-- FRONT-END разработка -->
<section class="skills">
        <h1 class="heading"> <span> FRONT-END </span> разработка </h1>
        <div class="box-container">
            <div class="box">
                <img src="storage/skills/front-end-development/001.png">
                <h3> HTML 5 </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/002.png">
                <h3> CSS 3 </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/003.png">
                <h3> JavaScript </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/004.png">
                <h3> jQuery </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/005.png">
                <h3> Bootstrap 5 </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/006.png">
                <h3> Sass </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/007.png">
                <h3> TypeScript </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/008.png">
                <h3> PHP 8.1 </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/009.png">
                <h3> React </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/010.png">
                <h3> Redux </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/011.png">
                <h3> VUE.JS </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/012.png">
                <h3> Vuetify 3 </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/013.png">
                <h3> Angular.js </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/014.png">
                <h3> Angular </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/015.png">
                <h3> Backbone.js </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/016.png">
                <h3> GULP </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/017.png">
                <h3> WEBPACK </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/018.png">
                <h3> TAILWIND </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/019.png">
                <h3> MATERIALIZE </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/020.png">
                <h3> EMBER </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/021.png">
                <h3> REST API </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/022.png">
                <h3> POSTMAN </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/023.png">
                <h3> SWAGGER </h3>
            </div>
            <div class="box">
                <img src="storage/skills/front-end-development/024.png">
                <h3> JEKYLL </h3>
            </div>
        </div>
    </section>
<!-- FRONT-END разработка -->

<!-- BACK-END разработка -->
<section class="skills">
        <h1 class="heading"> <span> BACK-END </span> разработка </h1>
        <div class="box-container">
            <div class="box">
                <img src="storage/skills/back-end-development/001.png">
                <h3> NODE.JS </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/002.png">
                <h3> SPRING </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/003.png">
                <h3> EXPRESS.JS </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/004.png">
                <h3> GraphQL </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/005.png">
                <h3> Kafka </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/006.png">
                <h3> RabbitMQ </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/007.png">
                <h3> Nginx </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/008.png">
                <h3> NEST.JS </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/009.png">
                <h3> LANGUAGE C </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/010.png">
                <h3> C# </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/011.png">
                <h3> GOLANG </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/012.png">
                <h3> RUBY </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/013.png">
                <h3> SCALA </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/014.png">
                <h3> PYTHON </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/015.png">
                <h3> CREATE API </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/016.png">
                <h3> RUST </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/017.png">
                <h3> HASKELL </h3>
            </div>
            <div class="box">
                <img src="storage/skills/back-end-development/018.png">
                <h3> COFFEESCRIPT </h3>
            </div>
        </div>
    </section>
<!-- BACK-END разработка -->

<!-- Разработка FRAMEWORK -->
<section class="skills">
        <h1 class="heading"> Разработка <span> FRAMEWORK </span> </h1>
        <div class="box-container">
            <div class="box">
                <img src="storage/skills/frameworks/001.png">
                <h3> CodeIgniter 4 </h3>
            </div>
            <div class="box">
                <img src="storage/skills/frameworks/002.png">
                <h3> LARAVEL 9 </h3>
            </div>
            <div class="box">
                <img src="storage/skills/frameworks/003.png">
                <h3> Symfony </h3>
            </div>
            <div class="box">
                <img src="storage/skills/frameworks/004.png">
                <h3> ELECTRON </h3>
            </div>
            <div class="box">
                <img src="storage/skills/frameworks/005.png">
                <h3> DJANGO </h3>
            </div>
            <div class="box">
                <img src="storage/skills/frameworks/006.png">
                <h3> R.O.R </h3>
            </div>
            <div class="box">
                <img src="storage/skills/frameworks/007.png">
                <h3> .NET </h3>
            </div>
            <div class="box">
                <img src="storage/skills/frameworks/008.png">
                <h3> FLASK </h3>
            </div>
        </div>
    </section>
<!-- Разработка FRAMEWORK -->

<!-- Разработка DATABASE -->
<section class="skills">
    <h1 class="heading"> Разработка <span> DATABASE </span> </h1>
    <div class="box-container">
        <div class="box">
            <img src="storage/skills/database/001.png">
            <h3> MONGO.DB </h3>
        </div>
        <div class="box">
            <img src="storage/skills/database/002.png">
            <h3> MYSQL </h3>
        </div>
        <div class="box">
            <img src="storage/skills/database/003.png">
            <h3> PostgreSQL </h3>
        </div>
        <div class="box">
            <img src="storage/skills/database/004.png">
            <h3> Redis </h3>
        </div>
        <div class="box">
            <img src="storage/skills/database/005.png">
            <h3> ORACLE </h3>
        </div>
        <div class="box">
            <img src="storage/skills/database/006.png">
            <h3> MARIA.DB </h3>
        </div>
        <div class="box">
            <img src="storage/skills/database/007.png">
            <h3> SQLITE </h3>
        </div>
        <div class="box">
            <img src="storage/skills/database/008.png">
            <h3> MS.SQL </h3>
        </div>
        <div class="box">
            <img src="storage/skills/database/009.png">
            <h3> FIREBASE </h3>
        </div>
        <div class="box">
            <img src="storage/skills/database/010.png">
            <h3> HEROKU </h3>
        </div>
    </div>
</section>
<!-- Разработка DATABASE -->

<!-- Разработка DEVOPS -->
<section class="skills">
    <h1 class="heading"> Разработка <span> DEVOPS </span> </h1>
    <div class="box-container">
        <div class="box">
            <img src="storage/skills/devops/001.png">
            <h3> AMAZON.AWS </h3>
        </div>
        <div class="box">
            <img src="storage/skills/devops/002.png">
            <h3> DOCKER </h3>
        </div>
        <div class="box">
            <img src="storage/skills/devops/003.png">
            <h3> JENKINS </h3>
        </div>
        <div class="box">
            <img src="storage/skills/devops/004.png">
            <h3> KUBERNETES </h3>
        </div>
        <div class="box">
            <img src="storage/skills/devops/005.png">
            <h3> BASH </h3>
        </div>
        <div class="box">
            <img src="storage/skills/devops/006.png">
            <h3> AZURE </h3>
        </div>
    </div>
</section>
<!-- Разработка DEVOPS -->

<!-- Разработка MOBILE APP -->
<section class="skills">
    <h1 class="heading"> Разработка <span> MOBILE APP </span> </h1>
    <div class="box-container">
        <div class="box">
            <img src="storage/skills/mobile-app-development/001.png">
            <h3> ANDROID.SDK </h3>
        </div>
        <div class="box">
            <img src="storage/skills/mobile-app-development/002.png">
            <h3> ANDROID </h3>
        </div>
        <div class="box">
            <img src="storage/skills/mobile-app-development/003.png">
            <h3> OBJ-C </h3>
        </div>
        <div class="box">
            <img src="storage/skills/mobile-app-development/004.png">
            <h3> SWIFT </h3>
        </div>
        <div class="box">
            <img src="storage/skills/mobile-app-development/005.png">
            <h3> FLUTTER </h3>
        </div>
        <div class="box">
            <img src="storage/skills/mobile-app-development/006.png">
            <h3> DART </h3>
        </div>
        <div class="box">
            <img src="storage/skills/mobile-app-development/007.png">
            <h3> KOTLIN </h3>
        </div>
        <div class="box">
            <img src="storage/skills/mobile-app-development/008.png">
            <h3> NATIVESCRIPT </h3>
        </div>
        <div class="box">
            <img src="storage/skills/mobile-app-development/009.png">
            <h3> XAMARIN </h3>
        </div>
        <div class="box">
            <img src="storage/skills/mobile-app-development/010.png">
            <h3> REACTNATIVE </h3>
        </div>
        <div class="box">
            <img src="storage/skills/mobile-app-development/011.png">
            <h3> IONIC </h3>
        </div>
        <div class="box">
            <img src="storage/skills/mobile-app-development/012.png">
            <h3> CORDOVA </h3>
        </div>
        <div class="box">
            <img src="storage/skills/mobile-app-development/013.png">
            <h3> JAVA </h3>
        </div>
    </div>
</section>
<!-- Разработка MOBILE APP -->

<section class="education">
    <h1 class="heading"> <span> МОЕ </span> ОБРАЗОВАНИЕ </h1>
    <div class="box-container">
        <?php
            $a=1;
            $stmt = $conn->prepare("SELECT * FROM education");
            $stmt->execute();
            $education = $stmt->fetchAll();
            foreach($education as $row)
            {
        ?>
        <div class="box">
            <i class="fas fa-graduation-cap"></i>
            <span><?php echo $row['education_year']; ?></span>
            <h3><?php echo $row['education_title']; ?></h3>
            <p><?php echo $row['education_desc']; ?></p>
        </div>
        <?php } ?>
    </div>
</section>

<?php include("template/front/navbar.php"); ?>