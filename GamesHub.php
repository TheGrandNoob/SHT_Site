<html>
    <head>
        <title>Game</title>
        <script src="jQuery.js"></script>
        <style>
            body
{
    padding: 0%;
    margin: 0%;
    background-color: yellow;
    width: 100%;
    height: auto;
}
.Fraza
{
    font-size:3vh;
}
.content
{
    background-color: white;
    width: 120vh;
    height: auto;
    margin-left:20%;
    margin-top:15%;
}
.spacer1
{
    width: auto;
    height: 5vh;
}
.about
{
    width: auto;
    height:auto;
    font-size:2vh;
    margin: 1vh;
}
.footer
{
    margin-top:7vh;
    text-align: center;
}
.title
{
    font-size: 5vh;
    font-weight:bold;
    text-align: center;
}

.gButtons
{
    margin-left: 12.5vh;
    width:12vh;
    font-size:auto;
    height:5vh;
    color: white;
    background-color: yellowgreen;
    
}


        </style>
    </head>
    <body>
        <div class="content">
            <div class="spacer1"></div>
            <div class="title">
                Викторина
            </div>
            <div class="about">
                <h1>Условия викторины:</h1>
                    Играть в Викторину можно командами, либо в одиночку. Минимальный состав команды – один человек(а)
                <h2>Цель викторины:</h2>
                    развитие эрудиции, памяти, интеллектуальных способностей участников. Знакомство с предпринимателями-меценатами, прославившими Пензенский регион и объектами меценатства.
                <h2>Суть викторины:</h2>
                    отгадывание (выборе верного ответа) загадок, ребусов, кроссвордов, задач. Игра проводится через интернет, никаких миссий в реальном мире выполнять не нужно.
                <h2></h2>
                <p1>
                    Игра может проходить в линейной или штурмовой последовательности прохождения заданий. При линейной последовательности все команды проходят уровни в том порядке, в котором они введены на сайте. То есть команда, сначала проходит первый, затем второй, третий и т.д. задания. При штурмовой последовательности все задания выдаются сразу.
                    - Для начала игры команде необходимо открыть любую вкладку викторины.
                    - В процессе игры команда должна пройти все вкладки викторины.
                    - За каждый пройденную вкладку команда получает ключевые слова из фразы, которую в конце нужно будет собрать в единое высказывание.
                    - По умолчанию побеждает команда, у которой итоговое время выполнения всех заданий минимально. </p1>
            </div>
            <div class="GamePanel">
                <button onclick="document.location='Sootnesiv2.html'" class = "gButtons" >Соотнеси</button>
                <button onclick="document.location='Crosswords.html'" class = "gButtons">кросcворд</button> 
                <button onclick="document.location='Pazls.php'" class = "gButtons">Пазлы</button> 
                <button onclick="document.location='index.php'" class = "gButtons">На карту</button>    
            </div>
            <div class="word" style="height:20vh; background:white; padding-left:1vh;">
                <p1 style="font-size:5vh;">фраза:</p1>
            <div class="Fraza">
                <?php

function getIp() 
{
    $keys = [
    'HTTP_CLIENT_IP',
    'HTTP_X_FORWARDED_FOR',
    'REMOTE_ADDR'
    ];
    foreach ($keys as $key) {
    if (!empty($_SERVER[$key])) 
        {
            $ip = trim(end(explode(',', $_SERVER[$key])));
            if (filter_var($ip, FILTER_VALIDATE_IP))
                return $ip;
        }
    }
}
                $Link = mysqli_connect("localhost","root","","gameshub");
                if ($Link == false){
                    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
                }
                else {
                    $sql = 'SELECT ip,w1,w2,w3 FROM words';
                    $result = mysqli_query($Link, $sql);
                    $Ip =getIp();
                    $Finded = false;
                    $Stage = 0;
                    $words = "Кто одел голого, накормил голодного, посетил заключённого, тот Меня одел , Меня накормил,Меня посетил.";
                    while ($row = mysqli_fetch_array($result)) {
                        if($row['ip'] == $Ip)
                        {
                            $Stage = $row['w1']+$row['w2']+$row['w3'];
                            $Finded = true;
                        }
                    }
                    
                    if($Finded)
                        if($Stage == 0)
                        {
                            echo("Выйграйте хотя бы 1 игру ");
                        }
                        else
                        {
                            if($Stage != 3)
                            {
                                $buff = str_split($words);
                                for($i = 0;$i <count($buff)/3*($Stage) -1;$i+=1)
                                {
                                    echo($buff[$i]);
                                }
                                echo("...");
                            }
                            else
                                echo($words);
                        }
                    else
                    {
                        echo("Выйuрайте хотя бы 1 игру ");
                        $sql = 'INSERT INTO words(ip,w1,w2,w3) VALUES ("'.$Ip.'","0","0","0")';
                        $result = mysqli_query($Link, $sql);
                        if ($Link == false){
                            print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
                        }
                    }
                    
                }
                ?>
            </div>
            </div>
        </div>
        </div>
        <div class="footer">

        </div>
    </body>
</html>
