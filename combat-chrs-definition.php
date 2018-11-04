<?php
//chr definition
$chrDef["Bromine"] = array(
	"name" => "Bromine",
	"skill" => 10, 
	"skillName" => "WP-Lash",
	"maxDamage" => 100,
	"TFF" => 80,
	"injury" => 0
);
$chrDef["Gas"] = array(
	"name" => "Gas",
	"skill" => 10, 
	"skillName" => "WP-Ranged",
	"maxDamage" => 50,
	"TFF" => 80,
	"injury" => 0
);
$chrDef["Krypton"] = array(
	"name" => "Krypton", 
	"skill" => 10, 
	"skillName" => "WP-Baton",
	"maxDamage" => 75,
	"TFF" => 50,
	"Dodging" => 10,
	"injury" => 0
);
$chrDef["Neon"] = array(
	"name" => "Neon",
	"skill" => 5, 
	"skillName" => "WP-Baton",
	"maxDamage" => 100,
	"TFF" => 80,
	"Dodging" => 10,
	"injury" => 0
);
$chrDef["Protium"] = array(
	"name" => "Protium",
	"skill" => 15, 
	"skillName" => "WP-Rifle",
	"maxDamage" => 100,
	"TFF" => 80,
	"Dodging" => 10,
	"injury" => 0
);
$chrDef["Quicksilver"] = array(
	"name" => "Quicksilver",
	"skill" => 10, 
	"skillName" => "WP-Whip",
	"maxDamage" => 30,
	"TFF" => 100,
	"injury" => 0
);
$chrDef["Rust"] = array(
	"name" => "Rust",
	"skill" => 10, 
	"skillName" => "STR",
	"maxDamage" => 50,
	"TFF" => 140,
	"protection" => 10,
	"injury" => 0
);
$chrDef["Solid"] = array(
	"name" => "Solid",
	"skill" => 5, 
	"skillName" => "WP-Sword",
	"maxDamage" => 150,
	"TFF" => 150,
	"protection" => 10,
	"injury" => 0
);
$chrDef["Snow"] = array(
	"name" => "Snow",
	"skill" => 10, 
	"skillName" => "WP-Spear",
	"maxDamage" => 150,
	"TFF" => 150,
	"injury" => 0
);
$chrDef["Silver"] = array(
	"name" => "Silver",
	"skill" => 5, 
	"skillName" => "WP-Sword",
	"maxDamage" => 87, //some of the time they get special attack so 75 + 25/2
	"TFF" => 125,
	"injury" => 0
);
$chrDef["Silica"] = array(
	"name" => "Silica",
	"skill" => 10, 
	"skillName" => "STR",
	"maxDamage" => 70, 
	"TFF" => 100,
	"injury" => 0
);
$chrDef["Sugar"] = array(
	"name" => "Sugar",
	"skill" => 20, 
	"skill2" => 5,
	"skillName" => "STR",
	"maxDamage" => 125, 
	"TFF" => 1000,
	"injury" => 0
);
$chrDef["Triox"] = array(
	"name" => "Triox", 
	"skill" => 10, 
	"skillName" => "WP-Helmet",
	"maxDamage" => 100,
	"shield" => 50,
	"shieldUp" => true,
	"TFF" => 100,
	"injury" => 0
);
$chrDef["Vanadium"] = array(
	"name" => "Vanadium", 
	"skill" => 5, 
	"skillName" => "WP-HighSpeed",
	"maxDamage" => 175,
	"protection" => 10,
	"TFF" => 200,
	"injury" => 0
);
$chrDef["Water"] = array(
	"name" => "Water", 
	"skill" => 10, 
	"skillName" => "WP-Whip",
	"maxDamage" => 150,
	"TFF" => 80,
	"injury" => 0
);
$chrDef["Zora"] = array(
	"name" => "Zora", 
	"skill" => 10, 
	"skillName" => "WP-Spear",
	"maxDamage" => 135,
	"TFF" => 80,
	"injury" => 0
);
//--- Development -------------
$chrDef["Diflourine"] = array(
	"name" => "Diflourine", 
	"skill" => 10, 
	"skillName" => "Punch",
	"maxDamage" => 200,
	"TFF" => 100,
	"injury" => 0
);
$chrDef["Peroxide"] = array(
	"name" => "Peroxide", 
	"skill" => 10, 
	"skillName" => "Bite",
	"maxDamage" => 50,
	"TFF" => 75,
	"Dodging" => 5,
	"injury" => 0
);
$chrDef["BlackTarHeroine"] = array(
	"name" => "BlackTarHeroine", 
	"skill" => 10, 
	"skillName" => "Grasp",
	"maxDamage" => 100,
	"TFF" => 500,
	"injury" => 0
);
$chrDef["Carbon"] = array(
	"name" => "Carbon", 
	"skill" => 10, 
	"skillName" => "Punch",
	"maxDamage" => 150,
	"TFF" => 200,
	"injury" => 0,
	"protection" => 10,
	"damageShield" => 10,
);

/* this is a setup where the entire player group fight this new force, and lose unless they get Sugar's help
Against the force, all toegther - 30%, with Sugar 100% */

//$players[] = $chrDef["Neon"];
$players[] = $chrDef["Silver"];
//$players[] = $chrDef["Quicksilver"];
//$players[] = $chrDef["Protium"];
//$players[] = $chrDef["Water"];
//$players[] = $chrDef["Krypton"];
//$players[] = $chrDef["Triox"];
//$players[] = $chrDef["Zora"];
//$players[] = $chrDef["Sugar"];

//$mobs[] = $chrDef["BlackTarHeroine"];
//$mobs[] = $chrDef["Vanadium"];
//$mobs[] = $chrDef["Vanadium"];
//$mobs[] = $chrDef["Vanadium"];
//$mobs[] = $chrDef["Peroxide"];
//$mobs[] = $chrDef["Peroxide"];
//$mobs[] = $chrDef["Peroxide"];
//$mobs[] = $chrDef["Diflourine"];
$mobs[] = $chrDef["Carbon"];

