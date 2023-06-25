<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            body{
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background: black;
            }

            a
            {
                text-decoration: none ;
                color: black;

            }

            .box {
                font-size: 20px;
                color: white;
                height: 250px;
                width: 350px;
                border-radius: 10px;
                background: #191919;
                flex-direction: column;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .buttons-container {
                display: flex;
                justify-content: space-around;
                height: 50px;
                width: 150px;
            }
            
            button{
                height: 30px;
                width: 50px;
                background: white;
                border-radius: 5px;
                font-weight: 800;
                
            }

        </style>
    </head>
    <body>
        <div class="box">
            <p>Queres namorar comigo?</p>
            <div class="buttons-container">
                <button>
                    <a href="#">Sim</a>
                </button>
                <button id="no">Não</button>
            </div>
        </div>
    </body>
    <script>
        let button = document.getElementById("no");
        let height = window.innerHeight - 50;
        let width = window.innerWidth - 50;

        button.addEventListener('mouseover', function(){
            button.style.position="absolute";
            button.style.top = Math.random()*height + "px";
            button.style.left = Math.random()*width + "px";
        });
    </script>
</html>