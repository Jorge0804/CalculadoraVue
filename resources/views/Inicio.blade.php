<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calculadora</title>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

        <style>
            body{
                background-color: #282525;
            }
            div{
                border-radius: 30px;
            }
            #app{
                background-color: #494984;
                width: 400px;
                height: 560px;
                margin-left: auto;
                margin-right: auto;
                padding: 8px;
            }

            #panel{
                background-color: rgba(140, 186, 140, 0.87);
                width: 100%;
                height: 70px;
                display: flex;
                border-radius: 15px;
                flex-direction: column;
            }

            #teclado{
                margin: 10px;
                height: 100%;
                display: block;
                float: top;
            }
            #numeros{
                background-color: gray;
                text-align: center;
                width: 260px;
                display: inline-block;
            }
            #operaciones{
                text-align: center;
                display: inline-block;
                width: 108px;
                background-color: rgba(128, 128, 128, 0.36);
            }
            label{
                font-size: 21px;
                margin-left: 12px;
                horiz-align: center;
                font-family: "Times New Roman", Times, serif;
            }
            button{
                width: 68px;
                font-size: 40px;
                border-radius: 30px;
                height: 110px;
                margin: 3px;
            }
            #operaciones > button{
                background-color: darkblue;
                color: white;
            }
            #btn_igual{
                color: white; background-color: green
            }

            input{
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
                font-size: 34px;
                padding-left: 10px;
                padding-right: 10px;
                background-color: rgba(255, 0, 0, 0);
                max-height: 34px;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <div id="panel">
                <input v-model="valores" type="text">
                <label v-text="resultado"></label>
            </div>
            <div id="teclado">
                <div id="numeros">
                    @for($i = 1; $i <= 9; $i++):
                        <button v-on:click="Escribir({{$i}})">{{ $i  }}</button>
                    @endfor;
                    <button v-on:click="Escribir('0')">0</button>
                    <button v-on:click="Escribir('.')">.</button>
                    <button id="btn_igual" v-on:click="Terminar()">=</button>
                </div>
                <div id="operaciones">
                    <button v-on:click="Escribir('+')">+</button>
                    <button v-on:click="Escribir('-')">-</button>
                    <button v-on:click="Escribir('*')">x</button>
                    <button v-on:click="Escribir('/')">÷</button>
                </div>
            </div>
        </div>

        <script>
            new Vue({
                el: '#app',
                data:{
                    valores: '',
                    op: false,
                    ultRes: 0
                },
                computed:{
                  resultado:function(){
                      var res = '';
                      if(this.op){
                          var st = new String(this.valores);
                          this.ultRes = eval(st.valueOf());
                          return '= '+this.ultRes;
                      } else{
                          return '= '+this.ultRes+'...';
                      }
                  }
                },
                watch:{
                    valores:function(cadena){
                        this.valores = this.Validar(cadena);
                    },
                },
                methods:{
                    Escribir:function (val){
                        this.valores = this.valores += val;
                    },
                    Validar: function (cadena){
                        var arrCar = cadena.split('');
                        var ultCar = arrCar[arrCar.length-1];

                        this.op = (ultCar != '+' && ultCar != '-' && ultCar != '/' && ultCar != '*')?
                            true:false;

                        var res = '';
                        var filtro = '1234567890+-/*.';

                        for (var i=0; i<cadena.length; i++){
                            if (filtro.indexOf(cadena.charAt(i)) != -1){
                                res += cadena.charAt(i);
                            }
                        }

                        return res;
                    },
                    Terminar:function (){
                        this.valores = this.ultRes.toString();
                    }
                }
            })
        </script>
    </body>
</html>
