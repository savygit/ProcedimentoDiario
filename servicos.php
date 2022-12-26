<?php
echo "<div style='font-size:12pt; padding:15px'>";
echo "<h1>Parar, Iniciar e Reiniciar Serviços (MySQL e Apache)</h1>";
echo "Acessar Terminal direto no servidor ou pelo PuTTY<br>";
echo "<br>&emsp;PuTTY" . "<br>&emsp;Host Name: srvsavy" . "<br>&emsp;Porta: 22". "<br>&emsp;Usuário: trixs". "<br>&emsp;Senha: soft4241";
echo "<h3>MySQL</h3>";
echo "<ul>";
echo "<li><B>PARAR (Serviço):</B>&emsp;sudo service mysql stop</li>";
echo "<li><B>PARAR (\"Matar\" os usuários):</B>&emsp;sudo killall -u mysql</li>";
echo "<li><B>INICIAR:</B>&emsp;sudo service mysql start</li>";
echo "</ul>";

echo "<h3>Apache</h3>";
echo "<ul>";
echo "<li><B>PARAR:</B>&emsp;sudo service apache2 stop</li>";
echo "<li><B>INICIAR:</B>&emsp;sudo service apache2 start</li>";
echo "<li><B>REINICIAR:</B>&emsp;sudo service apache2 restart</li>";
echo "</ul>";
echo "</div>"
?>