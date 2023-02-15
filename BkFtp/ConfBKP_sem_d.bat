call DelBkp.bat %4 %5
set ano=%date:~6,4%
set mes=%date:~3,2%
set pathDrive="H:\Meu Drive\SavyCompartilhado\BACKUP\Empresas"
set pathCompleto=%pathDrive%\%ano%\%ano%%mes%
if not exist %pathDrive%\%ano% mkdir %pathDrive%\%ano%
if not exist %pathCompleto% mkdir %pathCompleto%
mkdir %pathCompleto%\BK_%1

mkdir BACKUP\BK_%1

mkdir BACKUP\BK_%1\Fazenda
mkdir BACKUP\BK_%1\AlexTog
mkdir BACKUP\BK_%1\FFDistr
mkdir BACKUP\BK_%1\SPModal
mkdir BACKUP\BK_%1\SP_CTeMDFe
mkdir BACKUP\BK_%1\Toride
mkdir BACKUP\BK_%1\Sigbol
mkdir BACKUP\BK_%1\FS_SCS
mkdir BACKUP\BK_%1\FS_Moema
mkdir BACKUP\BK_%1\FS_Santos
mkdir BACKUP\BK_%1\FS_Controle
mkdir BACKUP\BK_%1\SiteSigbol
mkdir BACKUP\BK_%1\Savy
mkdir BACKUP\BK_%1\TrixDes
mkdir BACKUP\BK_%1\TrixDes2
mkdir BACKUP\BK_%1\EspacoMais
mkdir BACKUP\BK_%1\ClinicaAudio
mkdir BACKUP\BK_%1\AIPA
mkdir BACKUP\BK_%1\Proserv
mkdir BACKUP\BK_%1\LAFF
mkdir BACKUP\BK_%1\BrasconLogAPP
mkdir BACKUP\BK_%1\AppColetasBrascon
mkdir BACKUP\BK_%1\BrasconPombos
mkdir BACKUP\BK_%1\BrasconJaparatuba
mkdir BACKUP\BK_%1\BrasconItapicuru
mkdir BACKUP\BK_%1\BrasconSaoGoncalo
mkdir BACKUP\BK_%1\Sterlix
mkdir BACKUP\BK_%1\Ecoservice
mkdir BACKUP\BK_%1\NtSterlixParnaiba
mkdir BACKUP\BK_%1\NtSterlix
mkdir BACKUP\BK_%1\NtRaiz
mkdir BACKUP\BK_%1\PHPInfo
mkdir BACKUP\BK_%1\LogsQ_Reflectsys

move phpInfo_trix.txt BACKUP\BK_%1\PHPInfo\phpInfo_trix.txt
move phpInfo_mobtrix.txt BACKUP\BK_%1\PHPInfo\phpInfo_mobtrix.txt
move phpInfo_reflectsys.txt BACKUP\BK_%1\PHPInfo\phpInfo_reflectsys.txt
move phpInfo_reflectsys1.txt BACKUP\BK_%1\PHPInfo\phpInfo_reflectsys1.txt
move phpInfo_reflectsys2.txt BACKUP\BK_%1\PHPInfo\phpInfo_reflectsys2.txt
move phpInfo_sistematrix.txt BACKUP\BK_%1\PHPInfo\phpInfo_sistematrix.txt
move bdfazspm.sql.tar.gz BACKUP\BK_%1\Fazenda\bdfazspm.sql.tar.gz
move bdffdtrix.sql.tar.gz BACKUP\BK_%1\FFDistr\bdffdtrix.sql.tar.gz
move bdspmtrix.sql.tar.gz BACKUP\BK_%1\SPModal\bdspmtrix.sql.tar.gz 
move bdalexsp.sql.tar.gz BACKUP\BK_%1\AlexTog\bdalexsp.sql.tar.gz  
move bdespmais.sql.tar.gz BACKUP\BK_%1\EspacoMais\bdespmais.sql.tar.gz
move bdaudiom.sql.tar.gz BACKUP\BK_%1\ClinicaAudio\bdaudiom.sql.tar.gz
move bdsavy.sql.tar.gz BACKUP\BK_%1\Savy\bdsavy.sql.tar.gz
move bdaipagm.sql.tar.gz BACKUP\BK_%1\AIPA\bdaipagm.sql.tar.gz
move bdproser.sql.tar.gz BACKUP\BK_%1\Proserv\bdproser.sql.tar.gz 
move bdescmus.sql.tar.gz BACKUP\BK_%1\LAFF\bdescmus.sql.tar.gz
move AppColetas.zip BACKUP\BK_%1\AppColetasBrascon\AppColetas.zip
move AppColetasJap.zip BACKUP\BK_%1\AppColetasBrascon\AppColetasJap.zip
move bdbralog.sql.tar.gz BACKUP\BK_%1\BrasconLogAPP\bdbralog.sql.tar.gz
move bdbrascon.sql.tar.gz BACKUP\BK_%1\BrasconPombos\bdbrascon.sql.tar.gz
move bdbrajap.sql.tar.gz BACKUP\BK_%1\BrasconJaparatuba\bdbrajap.sql.tar.gz
move bdbraita.sql.tar.gz BACKUP\BK_%1\BrasconItapicuru\bdbraita.sql.tar.gz
move bdbrasga.sql.tar.gz BACKUP\BK_%1\BrasconSaoGoncalo\bdbrasga.sql.tar.gz
move bdecoser.sql.tar.gz BACKUP\BK_%1\Ecoservice\bdecoser.sql.tar.gz
move bdsterlix.sql.tar.gz BACKUP\BK_%1\Sterlix\bdsterlix.sql.tar.gz
move bdntparnaiba.sql.tar.gz BACKUP\BK_%1\NtSterlixParnaiba\bdntparnaiba.sql.tar.gz
move bdntsterlix.sql.tar.gz BACKUP\BK_%1\NtSterlix\bdntsterlix.sql.tar.gz
move bdntraiz.sql.tar.gz BACKUP\BK_%1\NtRaiz\bdntraiz.sql.tar.gz
move bdsigbol.sql.tar.gz BACKUP\BK_%1\Sigbol\bdsigbol.sql.tar.gz
move bdsigmoe.sql.tar.gz BACKUP\BK_%1\FS_Moema\bdsigmoe.sql.tar.gz
move bdsigsan.sql.tar.gz BACKUP\BK_%1\FS_Santos\bdsigsan.sql.tar.gz
move bdsigscs.sql.tar.gz BACKUP\BK_%1\FS_SCS\bdsigscs.sql.tar.gz
move bdsigcfr.sql.tar.gz BACKUP\BK_%1\FS_Controle\bdsigcfr.sql.tar.gz
move sigbol1.sql.tar.gz BACKUP\BK_%1\SiteSigbol\sigbol1.sql.tar.gz 
move bdtrixdes.sql.tar.gz BACKUP\BK_%1\TrixDes\bdtrixdes.sql.tar.gz
move bdtrixdes2.sql.tar.gz BACKUP\BK_%1\TrixDes2\bdtrixdes2.sql.tar.gz
move TorideBK.rar BACKUP\BK_%1\Toride\TorideBK.rar
move BKPLogsQ.zip BACKUP\BK_%1\LogsQ_Reflectsys\BKPLogsQ.zip
move BKP_DocsFiscais_SPModal.tar.gz BACKUP\BK_%1\SP_CTeMDFe\BKP_DocsFiscais_SPModal.tar.gz

cd BACKUP

xcopy /S /I BK_%1 %pathCompleto%\BK_%1

rar -m5 -hp%2 a BK_%1.rar BK_%1

copy BK_%1.rar %3

rd BK_%1/s

echo ACABOU