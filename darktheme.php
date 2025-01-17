<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Theme</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Verdana;
        }

        body {
            background-color: #EFEFEF;
        }

        .conteudo {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .titulos {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .checkbox {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .modo-escuro {
            background-color: #212123;
            color: #fff;
        }

        .checkbox input {
            opacity: 1;
            width: 0;
            height: 0;
        }

        .check-deslizante {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .check-deslizante:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.check-deslizante {
            background-color: white;
        }

        input:checked+.check-deslizante::before {
            background-color: black;
        }

        input:focus+.check-deslizante {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.check-deslizante:before {
            transform: translateX(26px);
        }

        .check-deslizante.arredondado {
            border-radius: 34px;
        }

        .check-deslizante.arredondado:before {
            border-radius: 50%;
        }

        .grafico {
            width: 600px;
            height: auto;
            border: 1px solid #8980F1;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <main class="conteudo">
        <div class="titulos">
            <label class="checkbox">
                <input type="checkbox" id="js-checkbox">
                <span class="check-deslizante arredondado"></span>
            </label>
            <a>teste dark theme</a>
        </div>
        <div class="grafico">
            <canvas id="canvas"></canvas>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script>
        let modoEscuro = false;
        let elementoCheckbox = document.querySelector('#js-checkbox');

        elementoCheckbox.addEventListener('change', function () {
            if (this.checked) {
                modoEscuro = true;
            } else {
                modoEscuro = false;
            }
            mudarThema();
            inicializarChart();
        });


        function mudarThema() {
            var elementoCorpo = document.body;
            elementoCorpo.classList.toggle("modo-escuro");
        }


        function inicializarChart() {

            var randomScalingFactor = function () {
                return Math.round(Math.random() * 100);
            };
            var chartColors = {
                red: 'rgb(255, 99, 132)',
                orange: 'rgb(255, 159, 64)',
                yellow: 'rgb(255, 205, 86)',
                green: 'rgb(75, 192, 192)',
                blue: 'rgb(54, 162, 235)',
                purple: 'rgb(153, 102, 255)',
                grey: 'rgb(231,233,237)'
            };

            var color = Chart.helpers.color;
            var config = {
                type: 'radar',
                data: {
                    labels: [
                        ["Comer", "janta"],
                        ["Beber", "Água"], "Dormir", ["Programar", "HTML"], "Malhar", ["Preparar", "Refeições"], "Estudar"
                    ],
                    datasets: [{
                        label: "Primeiro nível",
                        backgroundColor: color(chartColors.red).alpha(0.2).rgbString(),
                        borderColor: chartColors.red,
                        pointBackgroundColor: chartColors.red,
                        data: [
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor()
                        ]
                    }, {
                        label: "Segundo nível",
                        backgroundColor: color(chartColors.blue).alpha(0.2).rgbString(),
                        borderColor: chartColors.blue,
                        pointBackgroundColor: chartColors.blue,
                        data: [
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor(),
                            randomScalingFactor()
                        ]
                    },]
                },
                options: {
                    legend: {
                        position: 'top',
                        labels: {
                            fontColor: modoEscuro ? 'white' : '#68686c'
                        }
                    },
                    scale: {
                        ticks: {
                            beginAtZero: true,
                            fontColor: modoEscuro ? '#EFEFEF' : '#68686c', 
                            showLabelBackdrop: false 
                        },
                        pointLabels: {
                            fontColor: modoEscuro ? 'white' : '#68686c' 
                        },
                        gridLines: {
                            color: modoEscuro ? 'rgba(255, 255, 255, 0.2)' : 'rgba(104, 104, 108, 0.2)'
                        },
                        angleLines: {
                            color: modoEscuro ? 'rgba(255, 255, 255, 0.2)' : 'rgba(104, 104, 108, 0.2)' 
                        }
                    }
                }
            };


            Chart.plugins.register({
                beforeDraw: function (chartInstance) {
                    var ctx = chartInstance.chart.ctx;
                    ctx.fillStyle = modoEscuro ? '#212123' : '#EFEFEF';
                    ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height);
                }
            })
            window.myRadar = new Chart(document.getElementById("canvas"), config);
        }
        inicializarChart();


    </script>
</body>

</html>