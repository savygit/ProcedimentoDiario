<html>
   <head>
      <title>Monitoramento do espaço em disco</title>
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <style>
         *{padding:0;margin:0;box-sizing:border-box;}
         body{font-family:"Arial"}
         .dashboard{display:flex;flex-wrap:wrap;align-content:stretch;justify-content:space-between;}
         .servidor{flex-basis:50%;padding:0 10px 10px;flex-grow:1;}
         .servidor iframe{width:100%;height:200px;border:1px solid;}
         .servidor .resu{width:100%;height:180px}
         @media (max-width: 768px)
         {
            .servidor{flex-basis:100%;}
         }
      </style>
   </head>
   <body style="font-size: 14pt; padding: 7.5px">
      <div class="dashboard">
         <div class="servidor">
            <h3>ReflectSys: </h3>
            <iframe width="600px" height="160px" src="https://reflectsys.com.br/Crontab/monitor_espaco.php"></iframe>
         </div>
         <div class="servidor">
            <h3>SistemaTrix: </h3>
            <iframe width="600px" height="160px" src="https://sistematrix.com.br/Crontab/monitor_espaco.php"></iframe>
         </div>
         <div class="servidor">
            <h3>ReflectSys1: </h3>
            <iframe width="600px" height="160px" src="https://reflectsys1.com.br/Crontab/monitor_espaco.php"></iframe>
         </div>
         <div class="servidor">
            <h3>ReflectSys2: </h3>
            <iframe width="600px" height="160px" src="https://reflectsys2.com.br/Crontab/monitor_espaco.php"></iframe>
         </div>
         <div class="servidor">
            <h3>Dados Resumidos: </h3>
            <iframe class='resu' width="600px" src="http://localhost/Trix/OutrosProgramas/ProcedimentoDiario/espaco_em_disco/BuscaDados.php"></iframe>
         </div>
      </div>
   </body>
</html>