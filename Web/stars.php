<!DOCTYPE html>
<html lang="zh">

<head>
    <title>home</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans TC', sans-serif;
            margin: 0;
            padding: 0;
            background: url('assets/cat2.jpg') no-repeat center center / cover;
            color: white;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        header, footer {
            text-align: center;
            padding: 20px 0;
            background-color: rgba(0, 0, 0, 0.5);
        }

        section {
            background-color: rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            flex-grow: 1;
            padding: 20px;
        }

        .content {
            background-color: rgba(255, 255, 255, 0.1);
            margin: 20px;
            padding: 20px;
            border-radius: 10px;
            max-width: 80%;
            text-align: justify;
        }

        .buttons {
            text-align: center;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        button {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: rgba(0, 0, 0, 0.6);
            transform: scale(1.05);
        }

        button:active {
            transform: scale(0.95);
        }

    </style>
</head>

<body>
    <header>
        <h1>寵物管家iPet-智慧寵物監測系統</h1>
    </header>

    <section>
        <div class="content">
            <p>
                當您無法隨時隨地陪伴您的愛貓，您是否擔心牠的安全與健康？
                讓我們的寵物智能監控服務為您解除憂慮。我們專注於提供全
                方位的寵物照顧，讓您可以輕鬆安心。從即時監控到健康管理，
                我們致力於成為您最可靠的寵物伙伴。選擇我們，讓您的貓咪
                擁有最好的照顧，讓牠們活得更健康、更幸福。
            </p>
        </div>
        <div class="buttons">
            <button class="login-button" onclick="window.location='index.php'">登入</button>
            <button class="register-button" onclick="window.location='register.html'">註冊</button>
        </div>
    </section>

    <footer>
        <p>與我們聯繫<br>411021233@gms.ndhu.edu.tw<br>411021246@gms.ndhu.edu.tw</p>
    </footer>
</body>

</html>