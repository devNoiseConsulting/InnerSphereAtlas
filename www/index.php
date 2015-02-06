<?php
include("./isatlas-config.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>Inner Sphere Atlas</title> 
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="verify-v1" content="GlY3yEdIofi6DHBMfA+J7Ay00/3LoUiSEpGbQ9QSRt0=" />

	<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" /> 
	<meta name="DC.title" lang="en" content="Inner Sphere Atlas" /> 
	<meta name="DC.publisher" content="Team SPAM!" /> 
	<meta name="DC.creator" content="Michael J. Flynn" /> 
	<meta name="DC.contributor" content="Chris Wheeler" /> 
	<meta name="DC.description" lang="en" content="A listing of all the known planets/systems in the BattleTech/MechWarrior Universe (aka The Inner Sphere)." /> 
	<meta name="DC.subject" lang="en" content="BattleTech; btech; BattleMech; Mech; Mecha; Succession Wars; Inner Sphere; CityTech; AeroTech; MechWarrior; Kurita; Steiner; Davion; Marik; Liao; Clans; Clan Wolf; Clan Smoke Jaguar; Clan Jade Falcon; Clan Ghost Bear; Periphery" /> 
	<meta name="DC.subject" scheme="LCSH" lang="en" content="BattleTech (Game)" /> 
	<meta name="DC.type" scheme="DCMIType" content="Text" /> 
	<meta name="DC.format" scheme="IMT" content="text/html" /> 
	<meta name="DC.identifier" content="http://isatlas.teamspam.net/" /> 
	<meta name="DC.language" scheme="RFC1766" content="en" /> 
	<meta name="ICBM" content="40.0508, -75.4047" /> 

	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.1/build/reset-fonts-grids/reset-fonts-grids.css">
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.4.1/build/base/base-min.css">
	<link rel="stylesheet" type="text/css" href="./style/isatlas.css" media="screen" />
	
	<script src="./javascript/prototype.js" type="text/javascript"></script>
	<script src="./javascript/scriptaculous.js" type="text/javascript"></script>
</head>
<body>
<div id="doc2" class="yui-t4">
	<div id="hd"><h1><a href="./">IS Atlas</a> /</h1></div>
	<div id="bd">
		<div id="yui-main">
			<div class="yui-b">
				<div class="yui-g">
					<div class="yui-u first">
							<h2>Systems:</h2>
								<ul>
									<li>
										<form method="post" action="./planet.php">
											Search: <input type="hidden" name="func" value="search" />
													<input type="hidden" name="start" value="0" />
													<input type="hidden" name="whichfield" value="name" />
													<input type="text" name="searchvalue" id="searchvalue" size="24" value=""/>
													<div class="autocomplete" id="planet_complete"></div>
													<script type="text/javascript">new Ajax.Autocompleter('searchvalue',
																										  'planet_complete',
																										  './planet_ajax.php',
																										  {minChars: 3})
													</script>
													<input type="submit" value="Go!" /> 
										</form><br/><br/>
									</li>
									<li>
										Highlights: 
										<ul>
											<li>
												<a href="/planet-detail.php?planet=2075223">A Place</a>, 
												<a href="/planet-detail.php?planet=2334257">Addicks</a>, 
												<a href="/planet-detail.php?planet=2737000">Ares</a>, 
												<a href="/planet-detail.php?planet=2873870">Atreus</a>, 
												<a href="/planet-detail.php?planet=3363837">Demeter</a>, 
												<a href="/planet-detail.php?planet=4252832">Galatea</a>, 
												<a href="/planet-detail.php?planet=4377378">Hesperus II</a>, 
												<a href="/planet-detail.php?planet=4627270">Inarcs</a>, 
												<a href="/planet-detail.php?planet=5667826">Konstance</a>, 
												<a href="/planet-detail.php?planet=5884436">Luthien</a>, 
												<a href="/planet-detail.php?planet=6390282">New Avalon</a>, 
												<a href="/planet-detail.php?planet=7426000">Sian</a>, 
												<a href="/planet-detail.php?planet=7652747">Solaris VII</a>, 
												<a href="/planet-detail.php?planet=7800483">St. Ives</a>, 
												<a href="/planet-detail.php?planet=8377200">Terra</a>, 
												<a href="/planet-detail.php?planet=8427523">Tharkad</a>, 
												<a href="/planet-detail.php?planet=8456668">Tikonov</a>, 
												<a href="/planet-detail.php?planet=8992767">Twycross</a><br/><br/>
											</li>
										</ul>
									</li>
									<li>
										Browse: 
										<ul>
											<li>
												  <a href="./planet.php?func=browsebyletter&amp;searchvalue=A">A</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=B">B</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=C">C</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=D">D</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=E">E</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=F">F</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=G">G</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=H">H</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=I">I</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=J">J</a>
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=K">K</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=L">L</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=M">M</a>
												<br/>
												  <a href="./planet.php?func=browsebyletter&amp;searchvalue=N">N</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=O">O</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=P">P</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=Q">Q</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=R">R</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=S">S</a>
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=T">T</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=U">U</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=V">V</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=W">W</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=X">X</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=Y">Y</a> 
												| <a href="./planet.php?func=browsebyletter&amp;searchvalue=Z">Z</a> 
												<br/><br/>
											</li>
										</ul>
									</li>
								</ul>
							<h2><a href="./novel.php">Novels</a></h2>
								<ul>
									<li>
										<a href="./novel-timeline.php">Timeline</a> <br/><br/>
									</li>
								</ul>
							<h2>Credits:</h2>
								<ul>
									<li>
										Chris Wheeler, The Czar of Planet Information and Fluff, has been searching through all his sourcebooks and novels to create the planet descriptions. 
									</li>
									<li>
										Most of the original Factory and Product/Component information came from <a href="http://www.abo.fi/~jivars/gb.htm">Gauss Bear's BattleTech site</a> 
									</li>
								</ul>
					</div>
					<div class="yui-u">
							<h2><a href="./factory.php">Factories:</a></h2>
								<ul>
									<li>
										<form method="post" action="./factory.php">
											Search: <input type="hidden" name="func" value="search" /> <input type="hidden" name="start" value="0" /> <input name="searchvalue" /> <input type="hidden" name="whichfield" value="F.name" /> <input type="submit" value="Go!" /> 
										</form><br/><br/>
									</li>
									<li>
										Highlights: 
										<ul>
											<li>
												<a href="/factory-detail.php?factory=2243762">Achernar BattleMechs</a>, 
												<a href="/factory-detail.php?factory=2534704">Aldis Industries</a>, 
												<a href="/factory-detail.php?factory=2554263">Alliance Mining and Geology</a>, 
												<a href="/factory-detail.php?factory=2373706">Ceres Metals Industries</a>, 
												<a href="/factory-detail.php?factory=3334263">Defiance Industries</a>, 
												<a href="/factory-detail.php?factory=3278498">Earthwerks Incorporated</a>, 
												<a href="/factory-detail.php?factory=4363725">General Motors</a>, 
												<a href="/factory-detail.php?factory=5737759">Kressly Warworks</a>, 
												<a href="/factory-detail.php?factory=7827270">StarCorps Industries</a>, 
												<a href="/factory-detail.php?factory=8364603">Tengo Aerospace</a><br/><br/>
											</li>
										</ul>
									</li>
								</ul>
							<h2><a href="./product-type.php">Product/Component Types: </a></h2>
								<ul>
									<li>
										<form method="post" action="./product-type.php">
											Search: <input type="hidden" name="func" value="search" /> <input type="hidden" name="start" value="0" /> <input name="searchvalue" /> <input type="hidden" name="whichfield" value="PT.product_type" /> <input type="submit" value="Go!" /> 
										</form><br/><br/>
									</li>
									<li>
										Highlights: 
										<ul>
											<li>
												<a href="/product-type-detail.php?searchvalue=13000">Aerospace (Jumpship)</a>, 
												<a href="/product-type-detail.php?searchvalue=20000">BattleMech (Light BattleMech)</a>, 
												<a href="/product-type-detail.php?searchvalue=21000">BattleMech (Medium BattleMech)</a>, 
												<a href="/product-type-detail.php?searchvalue=22000">BattleMech (Heavy BattleMech)</a>, 
												<a href="/product-type-detail.php?searchvalue=23000">BattleMech (Assault BattleMech)</a>, 
												<a href="/product-type-detail.php?searchvalue=51000">Component - Armament (Gauss Rifle)</a>, 
												<a href="/product-type-detail.php?searchvalue=62000">Power Plant - Jump Engine (Kearny-Fuchida Drive System)</a>, 
												<a href="/product-type-detail.php?searchvalue=32000">Vehicle (Tracked Vehicle)</a><br/><br/>
											</li>
										</ul>
									</li>
								</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="yui-b">
			<?php include("$ISA_DOCROOTDIR/adsense.php"); ?>
		</div>
	</div>
	<div id="ft"><? include("$ISA_DOCROOTDIR/cya.php"); ?></div>
</div>
</body>
</html>
