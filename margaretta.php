<?php
    session_start();
    error_reporting(0);
    if(isset($_POST['key']) && $_POST['key'] == "Giorgeta"){$_SESSION['key'] = 'Giorgeta';echo '<script>window.location = window.location</script>';}
    if(!isset($_SESSION['key'])){
        ?>
        <html>
            <head>
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
                <style>
                    body {
                        background: linear-gradient(to bottom right, #666, #333);
                        color: #fff;
                        font-family: 'Montserrat', sans-serif;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        height: 100vh;
                        margin: 0;
                        padding: 0;
                    }
                    form {
                        background: rgba(0,0,0,0.5);
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 0 20px rgba(0,0,0,0.5);
                        text-align: center;
                        width: 300px;
                    }
                    h1 {
                        margin: 0 0 20px 0;
                        font-weight: 600;
                        font-size: 24px;
                    }
                    input[type="password"] {
                        width: 100%;
                        padding: 10px;
                        margin-bottom: 20px;
                        border: none;
                        border-radius: 4px;
                        font-size: 14px;
                        font-family: 'Montserrat', sans-serif;
                        text-align: center;
                        background: rgba(255,255,255,0.1);
                        color: #fff;
                        transition: background 0.3s;
                    }
                    input[type="password"]:focus {
                        background: rgba(255,255,255,0.2);
                        outline: none;
                    }
                    canvas {
                        margin-bottom: 20px;
                        border-radius: 8px;
                    }
                </style>
            </head>
            <body>
                <form action="?" method="POST">
                    <h1>Margaretta</h1>
                    <canvas id="lienzo" width=512 height=512></canvas>
                    <input type="password" name="key" placeholder="Key">
                </form>
                <script>
                    var anchura = 512;
                    var altura = 512;
                    var contexto = document.getElementById("lienzo").getContext("2d")
                    for(var n = 0;n<5;n++){
                        numero = Math.round(Math.random()*10)+5
                        for(var i = 0;i<numero*n;i++){
                            contexto.fillStyle = "hsl("+(i/numero)*360+",75%,50%)"
                            contexto.beginPath();
                            contexto.moveTo(anchura/2,altura/2)
                            contexto.arc(anchura/2,altura/2,200-(n*30),(i/numero)*Math.PI*2,((i+1)/numero)*Math.PI*2,false)
                            contexto.moveTo(anchura/2,altura/2)
                            contexto.stroke();
                            contexto.fill();
                        }
                    }
                    contexto.fillStyle = "rgb(255,255,255)"
                    contexto.beginPath();
                    contexto.moveTo(anchura/2,altura/2)
                    contexto.arc(anchura/2,altura/2,50,0,Math.PI*2,false)
                    contexto.moveTo(anchura/2,altura/2)
                    contexto.stroke();
                    contexto.fill();
                </script>
            </body>
        </html>
        <?php
        die();
    }else{
?>

<html>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Montserrat', sans-serif;
                background: #2e2e2e;
                color: #fff;
                margin: 0; 
                padding: 0;
                overflow: hidden;
            }

            h1 {
                text-align: center;
                margin-top: 20px;
                font-weight: 600;
            }

            #contienelienzos {
                position: relative;
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
                height: 512px;
            }

            #contienelienzos canvas {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                filter: drop-shadow(0 0 28px rgba(0,0,0,0.5)) grayscale(0%);
                transition: all 1s;
            }

            #loading {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                animation: rueda 2s infinite linear;
                opacity: 1;
            }

            @keyframes rueda {
                0% {transform: translate(-50%, -50%) rotate(0deg);}
                100% {transform: translate(-50%, -50%) rotate(360deg);}
            }

            #informacion {
                width: 100%;
                max-width: 600px;
                height: 512px;
                margin: 20px auto;
                overflow-y: auto;
                background: #3a3a3a;
                border-radius: 8px;
                box-shadow: 0 0 20px rgba(0,0,0,0.5);
            }

            #informacion table {
                width: 100%;
                border-collapse: collapse;
                font-size: 12px;
            }

            #informacion th, #informacion td {
                padding: 8px 10px;
                text-align: left;
                border-bottom: 1px solid #555;
            }

            #informacion th {
                background: #444;
                font-weight: 600;
                position: sticky;
                top: 0;
                z-index: 10;
            }

            #informacion tr:hover {
                background: rgba(255,255,255,0.1);
            }

            .cuadrado {
                display: inline-block;
                width: 10px;
                height: 10px;
                margin-right: 5px;
                border-radius: 2px;
                vertical-align: middle;
            }

            .nivel1 .cuadrado, .nivel2 .cuadrado, .nivel3 .cuadrado, .nivel4 .cuadrado, .nivel5 .cuadrado {
                margin-left: 0;
            }

            .barra {
                height: 10px;
                background: #fff;
                border-radius: 2px;
                box-shadow: inset 0 0 5px rgba(0,0,0,0.3);
                transition: width 0.3s;
            }

            .tamanio {
                text-align: right;
            }

            .numero {
                text-align: right;
            }

            a {
                color: #dcdcdc;
                text-decoration: none;
                transition: color 0.3s;
            }

            a:hover {
                color: #fff;
            }

            #centro {
                display: none;
            }

            .gris {
                transition: all 1s;
                filter: drop-shadow(0 0px 28px rgba(0,0,0,0.5)) grayscale(100%) brightness(0.5)!important;
            }

            .overlay {
                filter: drop-shadow(0px 0px 2px white) drop-shadow(0px 0px 2px white) drop-shadow(0px 0px 2px white)!important;
            }

            /* Responsive layout */
            @media (max-width: 1280px) {
                #informacion, #contienelienzos {
                    max-width: 90%;
                }
            }

            @media (max-width: 768px) {
                #informacion table {
                    font-size: 10px;
                }
                #informacion th, #informacion td {
                    padding: 6px;
                }
            }
        </style>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1>Margaretta</h1>
        <table width="100%" height="100%" style="border-spacing:0; border-collapse:collapse;">
            <tr>
                <td style="vertical-align:top;" width=50%>
                    <div id="contienelienzos">
                        <canvas id="lienzo5" class="lienzo"  width=1024 height=1024></canvas><canvas id="lienzo5o" class="overlay"  width=1024 height=1024></canvas>
                        <canvas id="lienzo4" class="lienzo"  width=1024 height=1024></canvas><canvas id="lienzo4o" class="overlay"  width=1024 height=1024></canvas>
                        <canvas id="lienzo3" class="lienzo"  width=1024 height=1024></canvas><canvas id="lienzo3o" class="overlay"  width=1024 height=1024></canvas>
                        <canvas id="lienzo2" class="lienzo"  width=1024 height=1024></canvas><canvas id="lienzo2o" class="overlay"  width=1024 height=1024></canvas>
                        <canvas id="lienzo1" class="lienzo" width=1024 height=1024></canvas><canvas id="lienzo1o" class="overlay" width=1024 height=1024></canvas>
                        <canvas id="lienzotexto" width=1024 height=1024></canvas>
                        <canvas id="loading" width=100 height=100></canvas>
                        <div id="centro"></div>
                    </div>
                </td>
                <td style="vertical-align:top;" width=50%>
                    <div id="informacion">
                        <table>
                            <tr><th>Carpeta</th><th>Tamaño</th><th>Tipo</th><th>Numero de archivos</th><th>Porcentaje</th><th>Tamaño</th></tr>
                            <?php if(isset($_GET['carpeta'])){?>
                            <tr><td><a href="javascript:history.back()">Subir un nivel</a></td><td>Tamaño</td><td></td><td></td><td></td><td></td></tr>
                            <?php } ?>
                            <tr><td><div class="cuadrado" id="expandirtodo" style="background:hsl(255,75%,50%)">+</div> Expandir todo</td></tr>
                            <tr><td><div class="cuadrado" id="contraertodo" style="background:hsl(255,75%,50%)">-</div> Contraer todo</td></tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <script>
        
        		
        		$(document).ready(function(){
                    /*
                    $("canvas").mousemove(function(e){
                        console.log(e.pageX+"-"+e.pageY)
                        console.log(contexto1.getImageData(e.pageX,e.pageY,1,1).data[0]+"-"+contexto1.getImageData(e.pageX,e.pageY,1,1).data[1]+"-"+contexto1.getImageData(e.offsetX,e.offsetY,1,1).data[2])
                        contexto1.fillRect(e.offsetX,e.offsetY,5,5)
                    })
                    */
                   $("#informacion tr").mouseenter(function(){
                   	$(".lienzo").addClass("gris")
                   	$(this).mouseleave(function(){
                   		$(".lienzo").removeClass("gris")
                   		contexto1o.clearRect(0,0,1024,1024)
                   		contexto2o.clearRect(0,0,1024,1024)
                   		contexto3o.clearRect(0,0,1024,1024)
                   		contexto4o.clearRect(0,0,1024,1024)
                   		contexto5o.clearRect(0,0,1024,1024)
                   	})
                   	if($(this).hasClass("nivel1")){
                   		console.log("tiene el nivel 1")
                   		contexto1o.beginPath();
	                    contexto1o.fillStyle = "hsl("+$(this).attr("color")+",75%,50%)"
	                    contexto1o.moveTo(anchura/2,altura/2)
	                    contexto1o.arc(anchura/2,altura/2,$(this).attr("radio"),$(this).attr("anguloinicio"),$(this).attr("angulofinal"),false)
	                    contexto1o.lineTo(anchura/2,altura/2)
	                    contexto1o.fill();
	                    contexto1o.stroke();
	                    contexto1o.closePath();
	                    console.log("color"+$(this).attr("color")+"-"+$(this).attr("radio")+"-inicio"+$(this).attr("anguloinicio")+"-final"+$(this).attr("angulofinal"))
	                    
	                    contextotexto.beginPath();
		                contextotexto.fillStyle = "rgb(50,50,50)"
		
		                contextotexto.arc(anchura/2,altura/2,(anchura/incrementoradio*0.5)*1,0,Math.PI*2,false)
		
		                contextotexto.fill();
		                contextotexto.stroke();
		                contextotexto.closePath();
                   	}
                   	if($(this).hasClass("nivel2")){
                   		console.log("tiene el nivel 2")
                   		contexto2o.beginPath();
	                    contexto2o.fillStyle = "hsl("+$(this).attr("color")+",75%,50%)"
	                    contexto2o.moveTo(anchura/2,altura/2)
	                    contexto2o.arc(anchura/2,altura/2,$(this).attr("radio"),$(this).attr("anguloinicio"),$(this).attr("angulofinal"),false)
	                    contexto2o.lineTo(anchura/2,altura/2)
	                    contexto2o.fill();
	                    contexto2o.stroke();
	                    contexto2o.closePath();
	                    console.log("color"+$(this).attr("color")+"-"+$(this).attr("radio")+"-inicio"+$(this).attr("anguloinicio")+"-final"+$(this).attr("angulofinal"))
	                    
	                   
                   	}
                   	if($(this).hasClass("nivel3")){
                   		
                   		console.log("tiene el nivel 3")
                   		contexto3o.beginPath();
	                    contexto3o.fillStyle = "hsl("+$(this).attr("color")+",75%,50%)"
	                    contexto3o.moveTo(anchura/2,altura/2)
	                    contexto3o.arc(anchura/2,altura/2,$(this).attr("radio"),$(this).attr("anguloinicio"),$(this).attr("angulofinal"),false)
	                    contexto3o.lineTo(anchura/2,altura/2)
	                    contexto3o.fill();
	                    contexto3o.stroke();
	                    contexto3o.closePath();
	                    console.log("color"+$(this).attr("color")+"-"+$(this).attr("radio")+"-inicio"+$(this).attr("anguloinicio")+"-final"+$(this).attr("angulofinal"))
                   		
                   	}
                   	if($(this).hasClass("nivel4")){
                   		console.log("tiene el nivel 4")
                   		contexto4o.beginPath();
	                    contexto4o.fillStyle = "hsl("+$(this).attr("color")+",75%,50%)"
	                    contexto4o.moveTo(anchura/2,altura/2)
	                    contexto4o.arc(anchura/2,altura/2,$(this).attr("radio"),$(this).attr("anguloinicio"),$(this).attr("angulofinal"),false)
	                    contexto4o.lineTo(anchura/2,altura/2)
	                    contexto4o.fill();
	                    contexto4o.stroke();
	                    contexto4o.closePath();
	                    console.log("color"+$(this).attr("color")+"-"+$(this).attr("radio")+"-inicio"+$(this).attr("anguloinicio")+"-final"+$(this).attr("angulofinal"))
                   	}
                   	if($(this).hasClass("nivel5")){
                   		console.log("tiene el nivel 5")
                   		contexto5o.beginPath();
	                    contexto5o.fillStyle = "hsl("+$(this).attr("color")+",75%,50%)"
	                    contexto5o.moveTo(anchura/2,altura/2)
	                    contexto5o.arc(anchura/2,altura/2,$(this).attr("radio"),$(this).attr("anguloinicio"),$(this).attr("angulofinal"),false)
	                    contexto5o.lineTo(anchura/2,altura/2)
	                    contexto5o.fill();
	                    contexto5o.stroke();
	                    contexto5o.closePath();
	                    console.log("color"+$(this).attr("color")+"-"+$(this).attr("radio")+"-inicio"+$(this).attr("anguloinicio")+"-final"+$(this).attr("angulofinal"))
                   	}
                   })
        			$("#loading").fadeOut("slow");
        			setTimeout(function(){$("#lienzo1").fadeIn("slow");$("#lienzo1o").fadeIn("slow");},500)
        			setTimeout(function(){$("#lienzo2").fadeIn("slow");$("#lienzo2o").fadeIn("slow");},1000)
        			setTimeout(function(){$("#lienzo3").fadeIn("slow");$("#lienzo3o").fadeIn("slow");},1500)
        			setTimeout(function(){$("#lienzo4").fadeIn("slow");$("#lienzo4o").fadeIn("slow");},2000)
        			setTimeout(function(){$("#lienzo5").fadeIn("slow");$("#lienzo5o").fadeIn("slow");$("#lienzotexto").fadeIn("slow");},2500)
        			
        			$(".nivel2").hide();
        			$(".nivel3").hide();
        			$(".nivel4").hide();
        			$(".nivel5").hide();
        			$(".contraido").click(function(){
        				
        				if($(this).hasClass("nivel1")){
        					nombrecarpeta = $(this).attr("nombrecarpeta")
        					$(".nivel2").each(function(){
        						if($(this).attr("superior") == nombrecarpeta){
        							$(this).show("slow");
        							}
        					})
        				}
        				if($(this).hasClass("nivel2")){
        					nombrecarpeta = $(this).attr("nombrecarpeta")
        					$(".nivel3").each(function(){
        						if($(this).attr("superior") == nombrecarpeta){$(this).show("slow")}
        					})
        				}
        				if($(this).hasClass("nivel3")){
        					nombrecarpeta = $(this).attr("nombrecarpeta")
        					$(".nivel4").each(function(){
        						if($(this).attr("superior") == nombrecarpeta){$(this).show("slow")}
        					})
        				}
        				if($(this).hasClass("nivel4")){
        					nombrecarpeta = $(this).attr("nombrecarpeta")
        					$(".nivel5").each(function(){
        						if($(this).attr("superior") == nombrecarpeta){$(this).show("slow")}
        					})
        				}
        				
        			})
        		})
            var contexto1 = document.getElementById("lienzo1").getContext("2d")
            var contexto2 = document.getElementById("lienzo2").getContext("2d")
            var contexto3 = document.getElementById("lienzo3").getContext("2d")
            var contexto4 = document.getElementById("lienzo4").getContext("2d")
             var contexto5 = document.getElementById("lienzo5").getContext("2d")
             var contexto1o = document.getElementById("lienzo1o").getContext("2d")
            var contexto2o = document.getElementById("lienzo2o").getContext("2d")
            var contexto3o = document.getElementById("lienzo3o").getContext("2d")
            var contexto4o = document.getElementById("lienzo4o").getContext("2d")
             var contexto5o = document.getElementById("lienzo5o").getContext("2d")
             var contextotexto = document.getElementById("lienzotexto").getContext("2d")
            contexto1.strokeStyle = "rgb(255,255,255)"
            contexto2.strokeStyle = "rgb(255,255,255)"
            contexto3.strokeStyle = "rgb(255,255,255)"
            contexto4.strokeStyle = "rgb(255,255,255)"
            contexto5.strokeStyle = "rgb(255,255,255)"
            contexto1o.strokeStyle = "rgb(255,255,255)"
            contexto2o.strokeStyle = "rgb(255,255,255)"
            contexto3o.strokeStyle = "rgb(255,255,255)"
            contexto4o.strokeStyle = "rgb(255,255,255)"
            contexto5o.strokeStyle = "rgb(255,255,255)"
            contextotexto.strokeStyle = "rgb(255,255,255)"
            contexto1.font = "10px Verdana";
            contexto2.font = "10px Verdana";
            contexto3.font = "10px Verdana";
            contexto4.font = "10px Verdana";
            contexto5.font = "10px Verdana";
            contextotexto.font = "10px Verdana";
            contexto1.textAlign = "center";
            contexto2.textAlign = "center";
            contexto3.textAlign = "center";
            contexto4.textAlign = "center";
            contexto5.textAlign = "center";
            contextotexto.textAlign = "center"
            
            var anchura = 1024
            var altura = 1024
            
            var datos = {
            <?php
            
                function dirSize($directory) {
                    $size = 0;
                    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
                        $size+=$file->getSize();
                    }
                    return $size;
                } 
			if(!isset($_GET['carpeta'])){
            $directorio = "./";
			}else{
				$directorio = ".".$_GET['carpeta'];
			}

            $ficheros = scandir($directorio);
            $contador = 0;
			$numeroniveles = 0;
            foreach ($ficheros as $key => $value)
            {  
                if($contador > 1){
                	$numeroniveles = 1;
                    $ficheros2 = scandir($directorio."/".$value."/");
                    if(is_dir($directorio."/".$value)){
                        echo '"'.$value.'":{"tamanio":'.dirSize($directorio."/".$value).',"nombre":"'.$value.'","numero":'.(count($ficheros2)-2).',"tipo":"carpeta","nivel":1,
                        
                        "carpetas":{';
                            /////////////
                            
							//var_dump($ficheros2);
                        
                            $contador2 = 0;

                            foreach ($ficheros2 as $key2 => $value2)
                            {
                            //	echo $value."/".$value2."<br>";   
                                if($contador2 > 1){
                                	$numeroniveles = 2;
                                    if(is_dir($directorio."/".$value."/".$value2)){
                                        $ficheros3 = scandir($directorio."/".$value."/".$value2."/");
                                        echo '"'.$value2.'":{"tamanio":'.dirSize($directorio."/".$value."/".$value2).',"nombre":"'.$value2.'","numero":'.(count($ficheros3)-2).',"tipo":"carpeta","nivel":2,
                                        "carpetas":{';
			                                         /////////////
						                            
													//var_dump($ficheros2);
						                        
						                            $contador3 = 0;
						
						                            foreach ($ficheros3 as $key3 => $value3)
						                            {
						                            //	echo $value."/".$value2."<br>";  
						                                if($contador3 > 1){
						                                	$numeroniveles = 3;
						                                    if(is_dir($directorio."/".$value."/".$value2."/".$value3)){
                                                                $ficheros4 = scandir($directorio."/".$value."/".$value2."/".$value3."/");
						                                        echo '"'.$value3.'":{"tamanio":'.dirSize($directorio."/".$value."/".$value2."/".$value3).',"nombre":"'.$value3.'","numero":'.(count($ficheros4)-2).',"tipo":"carpeta","nivel":3,
						                                        "carpetas":{';
						                                        		/////////////
											                            
																		//var_dump($ficheros2);
											                        
											                            $contador4 = 0;
											
											                            foreach ($ficheros4 as $key4 => $value4)
											                            {
											                            //	echo $value."/".$value2."<br>";  
											                                if($contador4 > 1){
                                                                                
											                                	$numeroniveles = 4;
											                                    if(is_dir($directorio."/".$value."/".$value2."/".$value3."/".$value4)){
                                                                                    $ficheros5 = scandir($directorio."/".$value."/".$value2."/".$value3."/".$value4."/");
											                                        echo '"'.$value4.'":{"tamanio":'.dirSize($directorio."/".$value."/".$value2."/".$value3."/".$value4).',"nombre":"'.$value4.'","numero":'.(count($ficheros5)-2).',"tipo":"carpeta","nivel":4,
											                                        "carpetas":{';
											                                        	/////////////
																                            
																							//var_dump($ficheros5);
																                        
																                            $contador5 = 0;
																
																                            foreach ($ficheros5 as $key5 => $value5)
																                            {
																                            //echo $value."/".$value5."<br>";  
																                                if($contador5 > 1){
																                                	$numeroniveles = 5;
																                                    if(is_dir($directorio."/".$value."/".$value2."/".$value3."/".$value4."/".$value5)){
                                                                                                        $ficheros6 = scandir($directorio."/".$value."/".$value2."/".$value3."/".$value4."/".$value5."/");
																                                        echo '"'.$value5.'":{"tamanio":'.dirSize($directorio."/".$value."/".$value2."/".$value3."/".$value4."/".$value5).',"nombre":"'.$value5.'","numero":'.count($ficheros5).',"tipo":"carpeta","nivel":5,
																                                        "carpetas":{';
																                                        
																                                        echo'}
																                                        },';
																                                    }else{
																                                    		echo '"'.$value5.'":{"tamanio":'.fileSize($directorio."/".$value."/".$value2."/".$value3."/".$value4."/".$value5).',"nombre":"'.$value5.'","numero":'.(count($ficheros6)-2).',"tipo":"archivo","nivel":6,
																                                        "carpetas":{';
																                                        
																                                        echo'}
																                                        },';
																                                    }
																                               }
																								
																                                $contador5++;  
																                            }
																							echo '"":""';
															                         /////////////
											                                        echo'}
											                                        },';
											                                    }else{
											                                    		echo '"'.$value4.'":{"tamanio":'.fileSize($directorio."/".$value."/".$value2."/".$value3."/".$value4).',"nombre":"'.$value4.'","numero":"-","tipo":"archivo","nivel":4,
											                                        "carpetas":{';
											                                        
											                                        echo'}
											                                        },';
											                                    }
											                               }
																			
											                                $contador4++;  
											                            }
																		echo '"":""';
										                         /////////////
						                                        echo'}
						                                        },';
						                                    }else{
						                                    		echo '"'.$value3.'":{"tamanio":'.fileSize($directorio."/".$value."/".$value2."/".$value3).',"nombre":"'.$value3.'","numero":"-","tipo":"archivo","nivel":3,
						                                        "carpetas":{';
						                                        
						                                        echo'}
						                                        },';
						                                    }
						                               }
														
						                                $contador3++;  
						                            }
													echo '"":""';
						                         /////////////
                                        echo'}
                                        },';
                                    }else{
						                                    		echo '"'.$value2.'":{"tamanio":'.fileSize($directorio."/".$value."/".$value2).',"nombre":"'.$value2.'","numero":"-","tipo":"archivo","nivel":2,
						                                        "carpetas":{';
						                                        
						                                        echo'}
						                                        },';
						                                    }
                               }
								
                                $contador2++;  
                            }
							echo '"":""';
                         /////////////
                        echo '} 
                        },';
                    }
else{
	                                                               //if(substr($value, 1) != '.'){
						                                    		echo '"'.$value.'":{"tamanio":'.fileSize($directorio."/".$value).',"nombre":"'.$value.'","numero":"-","tipo":"archivo","nivel":1,
						                                        "carpetas":{';
						                                        
						                                        echo'}
						                                        },';
						                                    }
               }
                $contador++; 
				
            }
          
            echo '"":"" ';
			
			
			
            ?>
                
            }
           	<?php echo 'var incrementoradio = 6' ?>
            
                var sumanivel1 = 0;
                var sumanivel2 = 0;
                var sumanivel3 = 0;
                var sumanivel4 = 0;
                var sumanivel5 = 0;
                
                jQuery.each(datos, function(i, val) {
                	if(val.tamanio != null){sumanivel1 += val.tamanio;}
                    jQuery.each(val.carpetas, function(i2, val2) {
                        if(val2.tamanio != null){sumanivel2 += val2.tamanio;}
                            jQuery.each(val2.carpetas, function(i3, val3) {
                                if(val3.tamanio != null){sumanivel3 += val3.tamanio;}
                                    jQuery.each(val3.carpetas, function(i4, val4) {
	                                   if(val4.tamanio != null){sumanivel4 += val4.tamanio;}
		                                  jQuery.each(val4.carpetas, function(i5, val5) {
			                                 if(val5.tamanio != null){sumanivel5 += val5.tamanio;}
			                                
			                            });
	                            });
                            });
                        });
                    });


                console.log("es:"+sumanivel5)
                valoranterior = 0;
                valoranterior2 = 0;
                valoranterior3 = 0;
                valoranterior4 = 0;
                valoranterior5 = 0;
                jQuery.each(datos, function(i, val) {
                    contexto1.beginPath();
                    ractual = Math.round(Math.random()*255)
                    gactual =Math.round(Math.random()*255)
                    bactual = Math.round(Math.random()*255)
                    
                    contexto1.fillStyle = "rgb("+ractual+","+gactual+","+bactual+")"
                    contexto1.fillStyle = "hsl("+(valoranterior/sumanivel1)*360+",75%,50%)"
                    contexto1.moveTo(anchura/2,altura/2)
                    contexto1.arc(anchura/2,altura/2,((anchura/incrementoradio*0.5)*1+(anchura/incrementoradio*0.5)*1),(valoranterior/sumanivel1)*Math.PI*2,((valoranterior/sumanivel1)*Math.PI*2+(val.tamanio/sumanivel1)*Math.PI*2),false)
                    contexto1.lineTo(anchura/2,altura/2)
                    contexto1.fill();
                    contexto1.stroke();
                    contexto1.closePath();
                    $("svg").append('<circle r="25%" cx="50%" cy="50%" style="stroke-dasharray: '+((valoranterior/sumanivel1)*100+(val.tamanio/sumanivel1)*100)+' 100; stroke: hsl('+(valoranterior/sumanivel1)*360+',75%,50%); stroke-dashoffset: -100; animation-delay: 0.25s"></circle>')
                    
                    
                    anguloinicialnivel2 = valoranterior/sumanivel1
					amplitudnivel2 = val.tamanio/sumanivel1
					tamanionivel2 = val.tamanio;
					punteronivel2 = 0;
                     console.log(val)
                    if(val.nombre != null){
                    	cadena = '<tr class="nivel1 contraido" anguloinicio="'+(valoranterior/sumanivel1)*Math.PI*2+'" angulofinal="'+((valoranterior/sumanivel1)*Math.PI*2+(val.tamanio/sumanivel1)*Math.PI*2)+'" radio="'+((anchura/incrementoradio*0.5)*1+(anchura/incrementoradio*0.5)*1)+'" color="'+(valoranterior/sumanivel1)*360+'" nombrecarpeta="'+val.nombre+'"><td><div class="cuadrado" style="background:hsl('+(valoranterior/sumanivel1)*360+',75%,50%)">';
                    	if(val.tipo == "carpeta"){cadena +='+'}
                    	cadena += '</div>';
                    	if(val.tipo == "carpeta"){cadena +='<a href="margaretta.php?carpeta=<?php echo $_GET['carpeta'] ?>/'+val.nombre+'">'+val.nombre+'</a>'}else{cadena += val.nombre}
                    	cadena += '</td><td class="tamanio">'+Math.round((val.tamanio/(1024*1024))*100)/100+' MB</td><td>'+val.tipo+'</td><td class="numero">'+val.numero+'</td><td>'+(Math.round(((val.tamanio/sumanivel1)*100)*100)/100)+' %</td><td><div class="barra" style="width:'+(Math.round(((val.tamanio/sumanivel1)*100)*100)/100)+'px"></div></td></tr>'
                    $("#informacion table").append(cadena)
                    valoranterior += val.tamanio
                    }
                    
					
					
                    jQuery.each(val.carpetas, function(i2, val2) {
                    
                    	valorporcionprimernivel = val.tamanio/sumanivel1
                    
                    	valorporcionsegundonivel = (val2.tamanio/val.tamanio)
                   
                        contexto2.beginPath();
                        contexto2.fillStyle = "hsl("+(anguloinicialnivel2+punteronivel2)*360+",75%,50%)"
                        contexto2.moveTo(anchura/2,altura/2)
                        contexto2.arc(anchura/2,altura/2,((anchura/incrementoradio*0.5)*2+(anchura/incrementoradio*0.5)*1),anguloinicialnivel2*Math.PI*2+punteronivel2*Math.PI*2,(anguloinicialnivel2*Math.PI*2+punteronivel2*Math.PI*2+valorporcionsegundonivel*valorporcionprimernivel*Math.PI*2),false)
                        contexto2.lineTo(anchura/2,altura/2)
                        contexto2.fill();
                        contexto2.stroke();
                        contexto2.closePath();
                       
                       punteronivel3 = 0
                       anguloinicialnivel3 = anguloinicialnivel2+punteronivel2
                        if(val2.tamanio != null){
                        	
                        	cadena = '<tr class="nivel2 contraido" anguloinicio="'+(anguloinicialnivel2*Math.PI*2+punteronivel2*Math.PI*2)+'" angulofinal="'+(anguloinicialnivel2*Math.PI*2+punteronivel2*Math.PI*2+valorporcionsegundonivel*valorporcionprimernivel*Math.PI*2)+'" radio="'+((anchura/incrementoradio*0.5)*2+(anchura/incrementoradio*0.5)*1)+'" color="'+(anguloinicialnivel2+punteronivel2)*360+'"  nombrecarpeta="'+val2.nombre+'" superior="'+val.nombre+'"><td><div class="cuadrado" style="background:hsl('+(anguloinicialnivel2+punteronivel2)*360+',75%,50%)">'
                        	if(val2.tipo == "carpeta"){cadena += '+'}
                        	cadena += '</div>'+val2.nombre+'</td><td class="tamanio">'+Math.round((val2.tamanio/(1024*1024))*100)/100+' MB</td><td>'+val2.tipo+'</td><td class="numero">'+val2.numero+'</td><td>'+(Math.round(((val2.tamanio/sumanivel2)*100)*100)/100)+' %</td><td><div class="barra" style="width:'+(Math.round(((val2.tamanio/sumanivel2)*100)*100)/100)+'px"></div></td></tr>'
                        		$("#informacion table").append(cadena)
                        		punteronivel2 += valorporcionsegundonivel*valorporcionprimernivel
                        }
                        
                        
                        	
						
                        jQuery.each(val2.carpetas, function(i3, val3) {
                        		valorporcionprimernivel2 = val2.tamanio/sumanivel2	
                    			valorporcionsegundonivel2 = (val3.tamanio/val2.tamanio)
	                    		
                            contexto3.beginPath();
                           contexto3.fillStyle = "hsl("+(anguloinicialnivel3+punteronivel3)*360+",75%,50%)"
                            contexto3.moveTo(anchura/2,altura/2)
                            contexto3.arc(anchura/2,altura/2,((anchura/incrementoradio*0.5)*3+(anchura/incrementoradio*0.5)*1),anguloinicialnivel3*Math.PI*2+punteronivel3*Math.PI*2,(anguloinicialnivel3*Math.PI*2+punteronivel3*Math.PI*2+valorporcionsegundonivel2*valorporcionprimernivel2*Math.PI*2),false)
                            contexto3.lineTo(anchura/2,altura/2)
                            contexto3.fill();
                            contexto3.stroke();
                            contexto3.closePath();
                            
                             contextotexto.fillStyle = "black"
                             
                            punteronivel4 = 0
                       anguloinicialnivel4 = anguloinicialnivel3+punteronivel3
                           
                             if(val3.tamanio != null){
                             	
                             	cadena = '<tr class="nivel3 contraido"  anguloinicio="'+(anguloinicialnivel3*Math.PI*2+punteronivel3*Math.PI*2)+'" angulofinal="'+(anguloinicialnivel3*Math.PI*2+punteronivel3*Math.PI*2+valorporcionsegundonivel2*valorporcionprimernivel2*Math.PI*2)+'" radio="'+((anchura/incrementoradio*0.5)*3+(anchura/incrementoradio*0.5)*1)+'" color="'+(anguloinicialnivel3+punteronivel3)*360+'"  nombrecarpeta="'+val3.nombre+'" superior="'+val2.nombre+'"><td><div class="cuadrado" style="background:hsl('+(anguloinicialnivel3+punteronivel3)*360+',75%,50%)">'
                             	if(val3.tipo == "carpeta"){cadena += '+'}
                             	
                             	cadena += '</div>'+val3.nombre+'</td><td class="tamanio">'+Math.round((val3.tamanio/(1024*1024))*100)/100+' MB</td><td>'+val3.tipo+'</td><td class="numero">'+val3.numero+'</td><td>'+(Math.round(((val3.tamanio/sumanivel3)*100)*100)/100)+' %</td><td><div class="barra" style="width:'+(Math.round(((val3.tamanio/sumanivel3)*100)*100)/100)+'px"></div></td></tr>'
                             	$("#informacion table").append(cadena)
								punteronivel3 += valorporcionsegundonivel2*valorporcionprimernivel2
                            }
                            
                            
                           
                            jQuery.each(val3.carpetas, function(i4, val4) {
                           
                        		valorporcionprimernivel3 = val3.tamanio/(sumanivel3)
                    			valorporcionsegundonivel3 = (val4.tamanio/val3.tamanio)
	                    		
                            contexto4.beginPath();
                            
                            
                           contexto4.fillStyle = "hsl("+(anguloinicialnivel4+punteronivel4)*360+",75%,50%)"
                            contexto4.moveTo(anchura/2,altura/2)
                                
                            contexto4.arc(
                                anchura/2,
                                altura/2,
                                ((anchura/incrementoradio*0.5)*4+(anchura/incrementoradio*0.5)*1),
                                (anguloinicialnivel4*Math.PI*2+punteronivel4*Math.PI*2),(anguloinicialnivel4*Math.PI*2+punteronivel4*Math.PI*2+valorporcionsegundonivel3*valorporcionprimernivel3*Math.PI*2),
                                false)
                                
                            contexto4.lineTo(anchura/2,altura/2)
                            contexto4.fill();
                            contexto4.stroke();
                            contexto4.closePath();
                            
                            punteronivel5 = 0
                       anguloinicialnivel5 = anguloinicialnivel4+punteronivel4
                           
                             if(val4.tamanio != null){
                             	
                             	cadena = '<tr class="nivel4 contraido"  anguloinicio="'+(anguloinicialnivel4*Math.PI*2+punteronivel4*Math.PI*2)+'" angulofinal="'+(anguloinicialnivel4*Math.PI*2+punteronivel4*Math.PI*2+valorporcionsegundonivel3*valorporcionprimernivel3*Math.PI*2)+'" radio="'+((anchura/incrementoradio*0.5)*4+(anchura/incrementoradio*0.5)*1)+'" color="'+(anguloinicialnivel4+punteronivel4)*360+'"  nombrecarpeta="'+val4.nombre+'" superior="'+val3.nombre+'"><td><div class="cuadrado" style="background:hsl('+(anguloinicialnivel4+punteronivel4)*360+',75%,50%)">'
                             	if(val4.tipo == "carpeta"){cadena += '+'}
                             	cadena += '</div>'+val4.nombre+'</td><td class="tamanio">'+Math.round((val4.tamanio/(1024*1024))*100)/100+' MB</td><td>'+val4.tipo+'</td><td class="numero">'+val4.numero+'</td><td>'+(Math.round(((val4.tamanio/sumanivel4)*100)*100)/100)+' %</td><td><div class="barra" style="width:'+(Math.round(((val4.tamanio/sumanivel4)*100)*100)/100)+'px"></div></td></tr>'
                             	$("#informacion table").append(cadena)
                                 // Error sospechoso aqui ///////////////////////////////////////////////////
								punteronivel4 += valorporcionsegundonivel3*valorporcionprimernivel3
                                 // Error sospechoso aqui ///////////////////////////////////////////////////
                            }
                            
                              /////////////////////////////
                            
                            jQuery.each(val4.carpetas, function(i5, val5) {
                           
                        		valorporcionprimernivel4 = val4.tamanio/sumanivel4	
                    			valorporcionsegundonivel4 = (val5.tamanio/val4.tamanio)
	                    		
                            contexto5.beginPath();
                            
                           
                           contexto5.fillStyle = "hsl("+(anguloinicialnivel5+punteronivel5)*360+",75%,50%)"
                            contexto5.moveTo(anchura/2,altura/2)
                            contexto5.arc(anchura/2,altura/2,((anchura/incrementoradio*0.5)*5+(anchura/incrementoradio*0.5)*1),(anguloinicialnivel5*Math.PI*2+punteronivel5*Math.PI*2),(anguloinicialnivel5*Math.PI*2+punteronivel5*Math.PI*2+valorporcionsegundonivel4*valorporcionprimernivel4*Math.PI*2),false)
                            contexto5.lineTo(anchura/2,altura/2)
                            contexto5.fill();
                            contexto5.stroke();
                            contexto5.closePath();
                            
                             if(val5.tamanio != null){
                             	
                             	cadena = '<tr class="nivel5"  anguloinicio="'+(anguloinicialnivel5*Math.PI*2+punteronivel5*Math.PI*2)+'" angulofinal="'+(anguloinicialnivel5*Math.PI*2+punteronivel5*Math.PI*2+valorporcionsegundonivel4*valorporcionprimernivel4*Math.PI*2)+'" radio="'+(((anchura/incrementoradio*0.5)*5+(anchura/incrementoradio*0.5)*1))+'" color="'+(anguloinicialnivel5+punteronivel5)*360+'"  nombrecarpeta="'+val5.nombre+'" superior="'+val4.nombre+'"><td><div class="cuadrado" style="background:hsl('+(anguloinicialnivel5+punteronivel5)*360+',75%,50%)">'
                             	if(val5.tipo == "cadena"){cadena += '+'}
                             	cadena += '</div>'+val5.nombre+'</td><td class="tamanio">'+Math.round((val5.tamanio/(1024*1024))*100)/100+' MB</td><td>'+val5.tipo+'</td><td class="numero">'+val5.numero+'</td><td>'+(Math.round(((val5.tamanio/sumanivel5)*100)*100)/100)+' %</td><td><div class="barra" style="width:'+(Math.round(((val5.tamanio/sumanivel5)*100)*100)/100)+'px"></div></td></tr>'
                             	$("#informacion table").append(cadena)
								punteronivel5 += valorporcionsegundonivel4*valorporcionprimernivel4
                            }
                        });
                        /////////////////////////////
                            
                            
                        });
                            
                            
                        });
                        

                    });


                });
            
            
            
                contexto1.beginPath();
                contexto1.fillStyle = "rgb(50,50,50)"

                contexto1.arc(anchura/2,altura/2,(anchura/incrementoradio*0.5)*1,0,Math.PI*2,false)

                contexto1.fill();
                contexto1.stroke();
                contexto1.closePath();
                
          
            
            
        </script>
    </body>
</html>
<?php } ?>
