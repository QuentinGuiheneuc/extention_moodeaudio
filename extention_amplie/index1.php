<!--/**
 * moOde audio player (C) 2014 Tim Curtis
 * http://moodeaudio.org
 *
 * tsunamp player ui (C) 2013 Andrea Coiutti & Simone De Gregori
 * http://www.tsunamp.com
 *
 * This Program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3, or (at your option)
 * any later version.
 *
 * This Program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * 2019-04-12 TC moOde 5.0
 * modifier par quentin guiheneuc
 *
 */-->
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
	
<!--<script src="js/index.js"></script>-->

	
</head>

<?php 

$pdo;
require_once dirname(__FILE__) . '/inc/playerlib.php';

playerSession('open', '', ''); 
session_write_close();
try{
    $pdo = new PDO('sqlite:/var/local/www/db/cfg-BTN-sqlite3.db',"","");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
} catch(Exception $e) {
    echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
    die();
};

$section = basename(__FILE__, '.php');

storeBackLink($section, $tpl);
//include('/var/local/www/header.php');
eval("echoTemplate(\"".getTemplate("/var/www/indx/$tpl")."\");");
?>
<body>
<br>


<div class="tab-content -webkit-full-screen" style=" height: 730px;">
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
        	<li class="active" style="padding-right: 10px;" ><a href="/index1.php">Home</a></li>
        	<li style="padding-right: 10px;"><a href="/parametre_control.php">Parametre</a></li>
      	</ul><br>
    </div>
	<div class="row content">
	</div>
</div>

<div class="col-sm-">
	<br><br>
  	<div class="container-fluid sidenav">
		<div class="row">
        <?php
                        $stmt = $pdo->prepare("SELECT rowid,name_btn, name_script, argu, usb, vitesse FROM config_BTN ;");
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach($result as $value1){
                            echo ("<a type='button' class='btn btn-success' style='margin:5px;' id ='".$value1['rowid']."' name='".$value1['name_btn']."' href='/index1.php?pol=".$value1['name_btn']."'> ".$value1['name_btn']."</a>");
                            };
                            //$value1['name_btn']SELECT * FROM config_BTN WHERE argu = 6
                ?>
            
                <?php
                
                 if ($_SERVER["REQUEST_METHOD"] == "GET"){
                     $value = $_GET["pol"];
                    if ($value != null){
                        $stmt2 = $pdo->prepare("SELECT * FROM config_BTN WHERE name_btn = '$value';");
                        $stmt2->execute();
                        $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                        foreach($result as $value1){
                            if (hexdec($value1['usb']) > 127){
                                $res = $value1['usb'];
                            }else {
                                $res = hexdec($value1['usb']);
                            };
                            //echo $res;
                            sysCmd("sudo python /var/www/script/".$value1['name_script']." ".$value1['argu']." ".$res." ".$value1['vitesse']."");
                            };
                            
                    };
                        
                };
                ?>
				
		</div>
	</div>
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