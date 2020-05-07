<!DOCTYPE html>
<html> 
<head>
    <!--l'en-tête-->
    <title>Controle</title>
    <!--<link href="style/style.css" rel="stylesheet" > fichier pour le style
   	<meta charset="utf-8">
	<meta name="viewport" content="height=757, width=683, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
-->
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 
	<link href="css/bootstrap.min.css?v=r642" rel="stylesheet">
	<link href="css/bootstrap-select.css?v=r642" rel="stylesheet">
	<link href="css/flat-ui.css?v=r642" rel="stylesheet">
	<link href="css/jquery.pnotify.default.css?v=r642" rel="stylesheet">
	<link href="css/fontawesome-moode.css?v=r642" rel="stylesheet">
	<link href="css/panels.css?v=r642" rel="stylesheet">
	<link href="css/moode.css?v=r642" rel="stylesheet">
	<script src="js/bootstrap.min.js?v=r642" defer=""></script>
	<script src="js/bootstrap-select.min.js?v=r642" defer=""></script>
	<script src="js/jquery.pnotify.min.js?v=r642" defer=""></script>
	<script src="js/playerlib.js?v=r642" defer=""></script>
	<script src="js/links.js?v=r642" defer=""></script>
	<link href="css/jquery.countdown.css?v=r642" rel="stylesheet">
	<script src="js/jquery.countdown.js?v=r642" defer=""></script>
	<script src="js/jquery.scrollTo.min.js?v=r642" defer=""></script>
	<script src="js/jquery.touchSwipe.min.js?v=r642" defer=""></script>
	<script src="js/jquery.lazyload.js?v=r642" defer=""></script>
	<script src="js/jquery.md5.js?v=r642" defer=""></script>
	<script src="js/jquery.adaptive-backgrounds.js?v=r642" defer=""></script>
	<script src="js/notify.js?v=r642" defer=""></script>
	<script src="js/jquery.knob.js?v=r642" defer=""></script>
	<script src="js/bootstrap-contextmenu.js?v=r642" defer=""></script>
	<script src="js/scripts-library.js?v=r642" defer=""></script>
	<script src="js/scripts-panels.js?v=r642" defer=""></script>
	
	<!-- MOBILE APP ICONS -->
	<!-- Apple -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="apple-touch-icon" sizes="180x180" href="/v5-apple-touch-icon.png">
	<link rel="mask-icon" href="/v5-safari-pinned-tab.svg" color="#5bbad5">
	<!-- Android/Chrome -->
	<link rel="icon" type="/image/png" sizes="32x32" href="/v5-favicon-32x32.png">
	<link rel="icon" type="/image/png" sizes="16x16" href="/v5-favicon-16x16.png">
	<!--link rel="manifest" href="/site.webmanifest"-->
	<meta name="theme-color" content="#ffffff">
	<!-- Microsoft -->
	<meta name="msapplication-TileColor" content="#da532c">
	
    <script src="js/index.js"></script>
   

	
</head>
<?php 


$pdo;



require_once dirname(__FILE__) . '/inc/playerlib.php';

playerSession('open', '', ''); 
//$dbh = cfgdb_connect();
//sqlite:/var/local/www/db/cfg-BTN-sqlite3.db
try{
    $pdo = new PDO('sqlite:/var/local/www/db/cfg-BTN-sqlite3.db',"","");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
} catch(Exception $e) {
    echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
    die();
}

$section = basename(__FILE__, '.php');
//$tpl = "parametre_control.html";
storeBackLink($section, $tpl);
//include('/var/local/www/header.php');400px
eval("echoTemplate(\"".getTemplate("/var/www/indx/$tpl")."\");");
?>

<body >
    <br>
    <div class="tab-content sidenav" style=" height: auto;" > <!--Menu-->
    <div id="menu-top" class="ui-header ui-bar-f ui-header-fixed slidedown" data-position="fixed" data-role="header" role="banner">
    <div class="dropdown">
			<a aria-label="Menu" class="dropdown-toggle btn" id="menu-settings" role="button" data-toggle="dropdown" data-target="#" href="#notarget">m</a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="menu-settings">
					<li class="context-menu menu-separator"><a href="javascript:location.reload(true); void 0"><i class="fas fa-redo sx"></i> Refresh</a></li>
					<li><a href="#restart-modal" data-toggle="modal"><i class="fas fa-power-off sx"></i> Restart</a></li>
					
			</ul>
		</div>
    </div>
        <div class="container-fluid">
            <div class="col-sm-4 sidenav container-fluid">
                <ul class="nav nav-pills nav-stacked">
                    <li style="padding-right: 10px;" ><a href="/index.php">Moode</a></li>
                    <li style="padding-right: 10px;" ><a href="/index1.php">Home</a></li>
                    <li class="active" style="padding-right: 10px;"><a href="/parametre_control.php">Parametre</a></li>
                </ul><br>
            </div>
         
        </div>
        
        
    <div class="col-sm-12 table-responsive " style="width: 100%;  height: 400px;" ><!--Tableau-->
            <table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Nom du Boutton</th>
                    <th>Nom du script</th>
                    <th>Argument(action)</th>
                    <th>USB</th>
                    <th>Vitesse</th>
                </tr>
                </thead>
                <tbody id="tableaux" >
                <?php
            
                    $stmt = $pdo->prepare("SELECT rowid,name_btn, name_script, argu, usb, vitesse FROM config_BTN ;");
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $i=0;
                    foreach($result as $value1){
                        if ($i == 1){
                            echo '<tr style="background: #949494;" >
                            <td>'.  $value1['rowid']."</td>
                            <td>". $value1['name_btn']."</td>
                            <td>". $value1['name_script']."</td>
                            <td>". $value1['argu']."</td>
                            <td>".$value1['usb']."</td>
                            <td>".$value1['vitesse']."</td>\n";
                            $i=0;
                            continue;
                        } if ($i==0){
                            echo '<tr>
                            <td>'.  $value1['rowid']."</td>
                            <td>". $value1['name_btn']."</td>
                            <td>". $value1['name_script']."</td>
                            <td>". $value1['argu']."</td>
                            <td>".$value1['usb']."</td>
                            <td>".$value1['vitesse']."</td>\n";
                            $i = 1;
                        };
                    };
                ?>
                </tbody>
            </table>
        </div>
        <button aria-label="Previous" class="btn btn-success" style="margin-top: 10px; margin-left: 15px;" onclick="ajouter()">Ajouter</button>
        <button aria-label="Previous" class="btn btn-danger" style="margin-top: 10px;" onclick="supp()">Supprimer</button>
        <button aria-label="Previous" class="btn btn-warning text-dark" style="margin-top: 10px;" onclick="modif()">Modifier</button>
        <button aria-label="Previous" class="btn btn-success" style="margin-top: 10px;" onclick="fermer()">Fermer</button>

    <form method="post" action style=" height: 80%;">
        <?php
            
                     $ndb = null;
                     $nds = null;
                     $aa = null;
                     $usb = null;
                     $usb1=".";
                     $vi =0;
                     

                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $ndb = $_POST["ndb"];
                        $nds = $_POST["nds"];
                        $aa = $_POST["aa"];
                        $usb1 = $_POST["usb"];
                        $usb2 =$_POST["usbb"];
                        $idb = $_POST["idb"];
                        $vi2 = $_POST["vi"];
                        $vi = $_POST["sel1"];
                        
                        

                        if ($usb1 != null){
                            $usb = $usb1;
                        }else{
                            $usb = $usb2;
                        };

                        if ($_POST["mid"] != null){ //MODIFIER
                            try { 
                                if ($_POST["sel2"]=="id"){
                                    $id = "rowid";
                                }else if ($_POST["sel2"]=="Nom du Boutton"){
                                    $id = "name_btn";
                                }else if ($_POST["sel2"]=="Nom du script"){
                                    $id = "name_script";
                                }else if ($_POST["sel2"]=="Argument(action)"){
                                    $id = "argu";
                                }else if ($_POST["sel2"]=="USB"){
                                    $id = "usb";
                                }else if ($_POST["sel2"]=="Vitesse"){
                                    $id = "vitesse";
                                };
                                $mid = $_POST["mid"];
                                $inmid = $_POST["inmid"];

                                $hh ="UPDATE config_BTN SET  $id = '$inmid' WHERE rowid = '$mid';";
                                $stmt2 = $pdo->prepare($hh);
                                $stmt2->execute();
                                $_SESSION['notify']['title'] = 'Modifier';
                                $_SESSION['notify']['msg'] = "Modifier avec Succés !!!";
                                $_SESSION['notify']['duration'] = 5;

                            } catch(Exception $e) { 
                                $_SESSION['notify']['title'] = 'Modifier';
                                $_SESSION['notify']['msg'] = "na pas pu étre Modifier avec Succés !!!";
                                $_SESSION['notify']['duration'] = 5;
                            };
                        };
                        if ($idb != null) {//SUPPRIMER
                            try {
                                $idb = $_POST["idb"];
                                $hh ="DELETE FROM config_BTN WHERE rowid = $idb ;";
                                $stmt2 = $pdo->prepare($hh);
                                $stmt2->execute();
                                    
                                $_SESSION['notify']['title'] = 'Supprime';
                                $_SESSION['notify']['msg'] = "A été supprime avec Succés !!!";
                                $_SESSION['notify']['duration'] = 5;
                                

                            } catch(Exception $e) { 
                                $_SESSION['notify']['title'] = 'Supprime';
                                $_SESSION['notify']['msg'] = "na pas été supprime avec Succés !!!";
                                $_SESSION['notify']['duration'] = 5;
                            };
                        };
                        if ($ndb != null) {//AJOUTER
                            if ($vi == "0"){
                                $vi3=$vi2;
                            }else{
                                $vi3=$vi;
                            };
                                try {
                                    $quey = "INSERT INTO config_BTN (name_btn, name_script, argu, usb, vitesse) VALUES ('".$ndb."','" .$nds."','".$aa."','".$usb."','".$vi3."');";
                                    $stmt1 = $pdo->prepare( $quey );
                                    $stmt1->execute();
                                    //echo $quey;
                                    $_SESSION['notify']['title'] = 'Ajouté';
                                    $_SESSION['notify']['msg'] = "A été ajouté avec Succés !!!";
                                    $_SESSION['notify']['duration'] = 5;
                                } catch(Exception $e) { 
                                    $_SESSION['notify']['title'] = 'Ajouté';
                                    $_SESSION['notify']['msg'] = "na pas été ajouté avec Succés !!!";
                                    $_SESSION['notify']['duration'] = 5;
                                }; 
                                        
                        };
                            
                    };
                
 
            ?>

            
    
        <div class="col-sm">
            <br><br>
            <div id="Modi" class="container-fluid hide" style="margin-top:-10px;">
                <div class="row">
                <div class="col-1" >
                        <select class="form-control" id="sel2" name="sel2" >
                            <option>id</option>
                            <option>Nom du Boutton</option>
                            <option>Nom du script</option>
                            <option>Argument(action)</option>
                            <option>USB</option>
                            <option>Vitesse</option>
                            </select>
                        </div>
                    <div class="col-3">
                        <input type="text" class="form-control"  placeholder="ID ??" style="width: 100px; height: 20px;" name="mid" id="mid">
                        <span>===></span>
                        <input type="text" class="form-control"  placeholder="??" style="width: 100px; height: 20px;" name="inmid" id="inmid">
                        <input class="btn btn-success" type="submit">
                    </div>
                </div>
            </div>

            <div id="Supp" class="container-fluid hide" style="margin-top:-10px;">
                <div class="row">
                        <div class="col-1">
                            <input type="text" class="form-control"  placeholder="id ??" style="width: 150px; height: 20px;" name="idb" id="idb">
                        </div>
                        <div class="col-1"> 
                            <input class="btn btn-success" type="submit">
                        </div>
                </div>
            </div>
            <div id="Ajout" class="container-fluid hide">
                <div class="row">
                    <div class="col">
                        <span>Nom du Boutton</span>
                        <input type="text" class="form-control"  placeholder="uti" style="width: 150px; height: 20px;" name="ndb" id="ndb">
                    </div>
                        <div class="col">
                        <span>Nom du script</span>
                        <!--<input type="text" class="form-control"  placeholder="serial1.py" style="width: 150px; height: 20px;" name="nds" id="nds">-->
                        <select class="form-control" id="nds" name="nds" style="width: 120px; height: 35px;">
                        <?php
                        $reponse = sysCmd("ls /var/www/script");
                        foreach($reponse as $value1){
                            echo "<option oninput='setnc($value1)'>$value1</option>";
                        };

                        ?>
                        </select>
                    </div>
                    <div class="col">
                        <span>Argument(action)</span>
                        <input type="text" class="form-control"  placeholder="a" style="width: 150px; height: 20px;" name="aa" id="aa">
                    </div>
                    <div class="col">
                        <span>USB</span>
                        <input type="text" class="form-control" placeholder="i2c 0x12" style="width: 80px; height: 20px;"name="usbb" id="usbb">
                        <select class="form-control" id="usb" name="usb" style="width: 150px; height: 35px;">
                        <option></option>
                        <?php
                        $reponse = sysCmd("ls /dev/ | grep ttyU ; ls /dev/ | grep ttyA");
                        foreach($reponse as $value1){
                            $dev = "/dev/";
                            echo "<option>$dev$value1</option>";
                        };
                        ?></select>
                    </div>
                   
                    <div class="col" >
                    <span>Vitesse </span>
                        <select class="form-control" id="sel1" name="sel1" style="width: 120px; height: 35px;">
                            <option> </option>
                            <option>300</option>
                            <option>1200</option>
                            <option>2400</option>
                            <option>4800</option>
                            <option>9600</option>
                            <option>19200</option>
                            <option>38400</option>
                            <option>57600</option>
                            <option>74880</option>
                            <option>115200</option>
                            <option>230400</option>
                            <option>250000</option>
                            <option>500000</option>
                            <option>1000000</option>
                            <option>2000000</option>
                            </select>
                        <input type="text" class="form-control"  placeholder="argu3" style="width: 120px; height: 20px;" name="vi" id="vi">
                        </div>
                       
                        <div class="col" > 
                        <canvas style="width: 100px;height: 20px;"></canvas>
                        <input class="btn btn-success" type="submit">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </form>
   </div>
    <div id="screen-saver" class="hide" href="#notarget">
            <div id="ss-backdrop"></div>
            <div id="ss-style"></div>
            <div id="ss-hud" class="hudui">
                <div class="btn-group">
                    <button aria-label="Previous" class="btn btn-cmd prev"><i class="fas fa-backward"></i></button>
                    <button aria-label="Play / Pause" class="btn btn-cmd play"><i class="fas fa-play"></i></button>
                    <button aria-label="Next" class="btn btn-cmd next"><i class="fas fa-forward"></i></button>
                </div>
                <div id="ss-volume">
                    <button aria-label="Volume Down" id="ssvoldn" class="btn btn-cmd"><i class="far fa-minus"></i></button>
                    <span aria-label="Volume" id="ssvolume"></span>
                    <button aria-label="Volume Up" id="ssvolup" class="btn btn-cmd"><i class="far fa-plus"></i></button>
                </div>
                <div id="ss-toolbar">
                    <button aria-label="Playlist" id="ss-toggle-pl" class="btn btn-cmd"><i class="fal fa-chevron-down"></i></button>
                    <button aria-label="Song" class="btn btn-cmd toggle-song"><i class="fal fa-exchange-alt"></i></button>
                </div>
                <div id="ss-container-playlist">
                    <div id="ss-playlist">
                        <ul class="ss-playlist"></ul>
                    </div>
                </div>
            </div>

            <div id="ss-coverart" class="ss-coverart">
                <div id="ss-split">
                    <div id="ss-coverart-url"></div>
                    <div id="ss-extratags"></div>
                </div>
                <div id="ss-info" class="ss-fsize ss-info">
                    <div id="ss-currentsong"></div>
                    <!--div id="ss-currentartist"></div-->
                    <div id="ss-currentalbum"></div>
                </div>
            </div>
        </div>

    </div>
    <div id="volume-popup" class="modal modal-xs hide fade" tabindex="-1" role="dialog" aria-labelledby="volume-popup-label" aria-hidden="true" style="display: none; width: 250.2px; height: 250.2px; ">
        <div class="modal-body">
            <div id="volknob-2" style="padding-top: 0px ">
                <div id="volcontrol-2" class="volume-step-limiter">
                    <div style="display: inline-block; width: 150.2px; height: 150.2px;">
                    <canvas width="136" height="10.2"></canvas>
                    <input aria-label="Volume" readonly="" class="volumeknob" id="volume-2" data-min="0" data-max="100" data-width="100%" data-thickness="0.16" data-bgcolor="rgba(96,96,96,0.2)" data-fgcolor="#27ae60" data-readonly="false" data-cursor="false" data-anglearc="240" data-angleoffset="-120" style="width: 72px; height: 45px; position: absolute; vertical-align: middle; margin-top: 45px; margin-left: -104px; border: 0px; background: none; font: bold 27px Arial; text-align: center; color: rgb(39, 174, 96); padding: 0px; -webkit-appearance: none;"></div>
                </div>
                <div aria-label="Volume Display" class="volume-display" href="#notarget" style="margin-top: -20px;">82</div>
            </div>
            <div id="volbtns-2" style="width: 240.2px; height: 60.2px; ">
                <button aria-label="Volume Down" id="volumedn-2" class="btn btn-cmd btn-volume btn-primary"><i class="far fa-minus fa-xs"></i></button>
                <button aria-label="Volume Up" id="volumeup-2" class="btn btn-cmd btn-volume btn-primary"><i class="far fa-plus fa-xs"></i></button>
            </div>
        </div>
        </div>
        <div id="context-menus">
        <div id="context-menu-folder" class="context-menu">
            <ul class="dropdown-menu" role="menu">
                <li><a href="#notarget" data-cmd="add"><i class="fal fa-plus sx"></i> Add</a></li>
                <li><a href="#notarget" data-cmd="play"><i class="fal fa-play sx"></i> Play</a></li>
                <li><a href="#notarget" data-cmd="clradd"><i class="fal fa-share-square sx"></i> Clear/Add</a></li>
                <li><a href="#notarget" data-cmd="clrplay"><i class="fal fa-share-square sx"></i> Clear/Play</a></li>
                <li><a href="#notarget" data-cmd="updmpddb"><i class="fal fa-sync sx"></i> Update this folder</a></li>
                <li><a href="#notarget" data-cmd="closemenu"><i class="fal fa-times-circle sx"></i> Close</a></li>
            </ul>
        </div>

        <div id="context-menu-folder-item" class="context-menu">
            <ul class="dropdown-menu" role="menu">
                <li><a href="#notarget" data-cmd="add"><i class="fal fa-plus sx"></i> Add</a></li>
                <li><a href="#notarget" data-cmd="play"><i class="fal fa-play sx"></i> Play</a></li>
                <li><a href="#notarget" data-cmd="clrplay"><i class="fal fa-share-square sx"></i> Clear/Play</a></li>
                <li><a href="#notarget" data-cmd="closemenu"><i class="fal fa-times-circle sx"></i> Close</a></li>
            </ul>
        </div>

        <div id="context-menu-savedpl-root" class="context-menu">
            <ul class="dropdown-menu" role="menu">
                <li><a href="#notarget" data-cmd="add"><i class="fal fa-plus sx"></i> Add</a></li>
                <li><a href="#notarget" data-cmd="play"><i class="fal fa-play sx"></i> Play</a></li>
                <li><a href="#notarget" data-cmd="clradd"><i class="fal fa-share-square sx"></i> Clear/Add</a></li>
                <li class="menu-separator"><a href="#notarget" data-cmd="clrplay"><i class="fal fa-share-square sx"></i> Clear/Play</a></li>
                <li><a href="#notarget" data-cmd="delsavedpl"><i class="fal fa-trash sx"></i> Delete playlist</a></li>
                <li><a href="#notarget" data-cmd="closemenu"><i class="fal fa-times-circle sx"></i> Close</a></li>
            </ul>
        </div>

        <div id="context-menu-savedpl-item" class="context-menu">
            <ul class="dropdown-menu" role="menu">
                <li><a href="#notarget" data-cmd="add"><i class="fal fa-plus sx"></i> Add</a></li>
                <li><a href="#notarget" data-cmd="play"><i class="fal fa-play sx"></i> Play</a></li>
                <li><a href="#notarget" data-cmd="clrplay"><i class="fal fa-share-square sx"></i> Clear/Play</a></li>
                <li><a href="#notarget" data-cmd="closemenu"><i class="fal fa-times-circle sx"></i> Close</a></li>
            </ul>
        </div>

        <div id="context-menu-db-search-results" class="context-menu-lib">
            <ul class="dropdown-menu" role="menu">
                <li><a href="#notarget" data-cmd="addall"><i class="fal fa-plus sx"></i> Add</a></li>
                <li><a href="#notarget" data-cmd="playall"><i class="fal fa-play sx"></i> Play</a></li>
                <li><a href="#notarget" data-cmd="clrplayall"><i class="fal fa-share-square sx"></i> Clear/Play</a></li>
                <li><a href="#notarget" data-cmd="closemenu"><i class="fal fa-times-circle sx"></i> Close</a></li>
            </ul>
        </div>

        <div id="context-menu-lib-item" class="context-menu-lib">
            <ul class="dropdown-menu" role="menu">
                <li><a href="#notarget" data-cmd="add"><i class="fal fa-plus sx"></i> Add</a></li>
                <li><a href="#notarget" data-cmd="play"><i class="fal fa-play sx"></i> Play</a></li>
                <li><a href="#notarget" data-cmd="clrplay"><i class="fal fa-share-square sx"></i> Clear/Play</a></li>
                <li><a href="#notarget" data-cmd="closemenu"><i class="fal fa-times-circle sx"></i> Close</a></li>
            </ul>
        </div>

        <div id="context-menu-lib-all" class="context-menu-lib">
            <ul class="dropdown-menu" role="menu">
                <li><a href="#notarget" data-cmd="addall"><i class="fal fa-plus sx"></i> Add</a></li>
                <li><a href="#notarget" data-cmd="playall"><i class="fal fa-play sx"></i> Play</a></li>
                <li><a href="#notarget" data-cmd="clrplayall"><i class="fal fa-share-square sx"></i> Clear/Play</a></li>
                <li><a id="tracklist-toggle" href="#notarget" data-cmd="tracklist"><i class="fal fa-list sx"></i> Show tracks</a></li>
                <li><a href="#notarget" data-cmd="closemenu"><i class="fal fa-times-circle sx"></i> Close</a></li>
            </ul>
        </div>

        <div id="context-menu-lib-disc" class="context-menu-lib"> <!-- r44f -->
            <ul class="dropdown-menu" role="menu">
                <li><a href="#notarget" data-cmd="addall"><i class="fal fa-plus sx"></i> Add</a></li>
                <li><a href="#notarget" data-cmd="playall"><i class="fal fa-play sx"></i> Play</a></li>
                <li><a href="#notarget" data-cmd="clrplayall"><i class="fal fa-share-square sx"></i> Clear/Play</a></li>
                <li><a href="#notarget" data-cmd="closemenu"><i class="fal fa-times-circle sx"></i> Close</a></li>
            </ul>
        </div>

        <div id="context-menu-radio-folder" class="context-menu">
            <ul class="dropdown-menu" role="menu">
                <li><a href="#notarget" data-cmd="add"><i class="fal fa-plus sx"></i> Add</a></li>
                <li><a href="#notarget" data-cmd="play"><i class="fal fa-play sx"></i> Play</a></li>
                <li><a href="#notarget" data-cmd="clradd"><i class="fal fa-share-square sx"></i> Clear/Add</a></li>
                <li><a href="#notarget" data-cmd="clrplay"><i class="fal fa-share-square sx"></i> Clear/Play</a></li>
                <li><a href="#notarget" data-cmd="closemenu"><i class="fal fa-times-circle sx"></i> Close</a></li>
            </ul>
        </div>

        <div id="context-menu-radio-item" class="context-menu">
            <ul class="dropdown-menu" role="menu">
                <li><a href="#notarget" data-cmd="add"><i class="fal fa-plus sx"></i> Add</a></li>
                <li><a href="#notarget" data-cmd="play"><i class="fal fa-play sx"></i> Play</a></li>
                <li class="menu-separator"><a href="#notarget" data-cmd="clrplay"><i class="fal fa-share-square sx"></i> Clear/Play</a></li>
                <li><a href="#notarget" data-cmd="editradiostn"><i class="fal fa-edit sx"></i> Edit station</a></li>
                <li><a href="#notarget" data-cmd="delstation"><i class="fal fa-trash sx"></i> Delete station</a></li>
                <li><a href="#notarget" data-cmd="closemenu"><i class="fal fa-times-circle sx"></i> Close</a></li>
            </ul>
        </div>

        <div id="context-menu-playlist-item" class="context-menu">
            <ul class="dropdown-menu" role="menu">
                <li><a href="#notarget" data-cmd="deleteplitem"><i class="fal fa-trash sx"></i> Remove item(s)</a></li>
                <li><a href="#notarget" data-cmd="moveplitem"><i class="fal fa-arrow-up sx"></i> Move item(s)</a></li>
                <li><a href="#notarget" data-cmd="setforclockradio"><i class="fal fa-alarm-clock sx"></i> Set for clock radio</a></li>
                <li><a href="#notarget" data-cmd="closemenu"><i class="fal fa-times-circle sx"></i> Close</a></li>
            </ul>
        </div>

        <div id="context-menu-playback" class="context-menu">
            <ul class="dropdown-menu" role="menu">
                <li><a href="#notarget" data-cmd="save-playlist"><i class="fal fa-save sx"></i> Save playlist</a></li>
                <li><a href="#notarget" data-cmd="set-favorites"><i class="fal fa-heart-circle sx"></i> Set favorites</a></li>
                <li id="context-menu-consume"><a href="#notarget" data-cmd="consume"><i class="fal fa-arrow-down sx"></i> Consume<span id="menu-check-consume"><i class="fal fa-check"></i></span></a></li>
                <li id="context-menu-repeat"><a href="#notarget" data-cmd="repeat"><i class="fal fa-repeat sx"></i> Repeat<span id="menu-check-repeat"><i class="fal fa-check"></i></span></a></li>
                <li id="context-menu-single"><a href="#notarget" data-cmd="single"><i class="fal fa-redo sx"></i> Single<span id="menu-check-single"><i class="fal fa-check"></i></span></a></li>
                <li><a href="#notarget" data-cmd="toggle-song"><i class="fal fa-exchange-alt sx"></i> Last track</a></li>
                <li><a href="#notarget" data-cmd="closemenu"><i class="fal fa-times-circle sx"></i> Close</a></li>
            </ul>
        </div>
    </div>
    <div id="menu-bottom" class="btn-group btn-list ui-footer ui-bar-f ui-footer-fixed slidedown" data-position="fixed" data-role="footer" role="banner" style="display: block;">
        <div id="playbar" >
                <div aria-label="Cover" id="playbar-cover"><img id= "playbar-img" src=""></div>
                <div id="playbar-title" style="padding-bottom: 1.5em;">
                    <div id="playbar-currentsong">Showtek x Tom Budin - Natural Blues (Adrien Toma 2K18 Booty)</div>
                    <div id="playbar-currentalbum">Adrien Toma - TEN by Adrien Toma Vol.1</div>
                    <div id="playbar-mtime" style="display: none;">
                        <div id="playbar-mcount" class="hasCountdown">01:45</div>
                        <div id="playbar-mtotal">&nbsp;/&nbsp;02:40</div>
                    </div>
                </div>
                <!--<div aria-label="Switch to Playback" id="playbar-switch"><div></div></div>-->
                <div id="playbar-controls">
                    <button aria-label="Previous" class="btn btn-cmd prev"><i class="fas fa-backward"></i></button>
                    <button aria-label="Play / Pause" class="btn btn-cmd play"><i class="fas fa-pause"></i></button>
                    <button aria-label="Next" class="btn btn-cmd next"><i class="fas fa-forward"></i></button>
                </div>
                <div id="playbar-toggles">
                    <button aria-label="Context Menu" class="btn playback-context-menu" data-toggle="context" data-target="#context-menu-playback"><i class="far fa-ellipsis-h"></i></button>
                    <button aria-label="Random" class="btn btn-cmd btn-toggle random" data-cmd="random"><i class="fal fa-random"></i></button>
                    <button aria-label="Hide" class="btn btn-cmd ralbum hide"><i class="fal fa-dot-circle"></i></button>
                    <button aria-label="Cover View" class="btn btn-cmd coverview"><i class="fal fa-tv"></i></button>
                    <button aria-label="Volume" class="btn volume-popup" data-toggle="modal"><i class="fal fa-volume-up"></i></button>
                    <button aria-label="Consume" class="btn btn-cmd btn-toggle consume hide" id="playbar-consume" data-cmd="consume"><i class="fal fa-arrow-down"></i></button>
                    <button aria-label="Add To Favourites" class="btn btn-cmd addfav"><i class="fal fa-heart"></i></button>
                </div>
                <div id="playbar-timeline" style="display: block;">
                    <div class="timeline-bg"></div>
                    <div class="timeline-progress" style="width: 24.7%;"><div class="inner-progress"></div></div>
                    <div class="timeline-thm">
                        <input aria-label="Timeline" id="playbar-timetrack" type="range" min="0" max="1000" value="0" step="1">
                    </div>
                    <div id="playbar-time">
                        <div id="playbar-countdown" class="hasCountdown">01:45</div>
                        <span id="playbar-div">&nbsp;/&nbsp;</span>
                        <div id="playbar-total">02:40</div>
                    </div>
                </div>
                <div id="playbar-radio"></div>
        </div>		
    </div>
        
</body>
</html> 

<?php
include('footer.php');
?>



