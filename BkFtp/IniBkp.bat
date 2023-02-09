@echo off

rar x -hp%1 RotBkp.rar

call BaixaBkp.bat %2 %3

echo Acabou