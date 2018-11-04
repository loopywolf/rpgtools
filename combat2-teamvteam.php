<?php
include "combat-chrs-definition.php";
//define teams here
/*$players[] = $chrDef["Neon"];
$players[] = $chrDef["Silver"];
$players[] = $chrDef["Quicksilver"];
$players[] = $chrDef["Protium"];
$players[] = $chrDef["Water"];
$players[] = $chrDef["Krypton"];
$players[] = $chrDef["Triox"];
$players[] = $chrDef["Sugar"]; */

/* $mobs[] = $chrDef["Bromine"];
addToTeam($mobs,"Vanadium");
addToTeam($mobs,"Vanadium");
addToTeam($mobs,"Vanadium"); */

function addToTeam(&$team,$name) {
	global $chrDef;

	$n = count($team);
	$c = $chrDef[$name];
	$c["name"] = $c["name"].$n;

	$team[] = $c;	
}
function attack($attacker,&$defender,$index,$targetIndex) {
	if( $attacker[injury]>=100 ) {
		echo $attacker[name]." lost\n";
		return;
	}	//can't attack when dead
	//process attack		
	$dice = rand(0,100);
	$roll = intval($attacker[skill] * $dice/100); //result from 0 to 9 (or more)
	$rollEffect = $roll * 10;
	$damageDealt = intval($attacker[maxDamage] * $roll / 10.0);
	echo "$attacker[name] rolled $dice% of $attacker[skill] and got $roll$ dealing $rollEffect% of $attacker[maxDamage] = $damageDealt dmg";
	//armor
	if($defender[protection]) {
		$damageDealt = $damageDealt - $defender[protection];
		echo " (Protection -$defender[protection])";
		if($damageDealt<0) $damageDealt=0;
	}//if
	//shields1
	if($defender[shieldUp]) {
		if($defender[shield]>$damageDealt) { 
			echo " (Shield -$defender[shield])";
			$damageDealt=0;
		} else {
			$defender[shieldUp] = false;
			echo " ($defender[name] shield fail)".PHP_EOL;
		}
	}//if
	if($defender[damageShield]) {
		$damageBack = intval($defender[damageShield] * $roll / 10.0);
		echo " (damageShield sent back $damageBack - not working yet)";
		//do shields and protection count? Why not
		//do damage-shields count? this is complicated - no
		//feel like we need code to compute and deal damage, but the damage-shield has to be kept out of it
	}//if
	if($defender[TFF]==0) die( "defender ".$defender[name]." TFF is zero. targetIndex=$targetIndex ERROR!\n");
	$injuryResult = intval(100 * $damageDealt/$defender[TFF]);
	$defender[injury] += $injuryResult;
	echo " to $defender[name] = $injuryResult% injury (total $defender[injury] %)".PHP_EOL;
}//F
function computeWins($player) {
	if(!isset($player[wins]) || count($player[wins])==0) return;
	
	$total = 0;		
	foreach($player[wins] as $w)
		$total += $w;
	$total = intval(10 * $total / count($player[wins])) / 10;

	echo $player[name]." average win in $total turns".PHP_EOL;
}//F
function resetForBattle(&$player){
	$player[injury]=0;
	if(isset($player[shield]))
		$player[shieldUp]=true;
}//F
function teamAlive($team) {
	foreach($team as $t)
		if($t[injury]<100) return true;
	return false;
}//F
function pickTarget($team,$startIndex) {
	//starting with the opposite-number, try to find a valid target
	$startIndex = $startIndex % count($team);

	$i = $startIndex;
	do {
		if( $team[$i][injury]<100 ) return $i;	//note: if the first one we try is valid, we return it
		$i = ($i + 1) % count($team);	//increment, and loop
		echo "x";
	} while($i != $startIndex);

	return -1;	//couldn't find any!
}//F
function whoLived($team) {
	if( !teamAlive($team)) return;

	for($i=0;$i<count($team);$i++) {
		if( $team[$i][injury]<100 ) echo $team[$i][name]." lived (".$team[$i][injury]."%)".PHP_EOL;
	}//for
}//F
function figureTurnsAverage($data) {
	$total = 0;
	foreach($data as $d)
		$total += $d;

	$took = $total / count($data);
	echo "Took $took turns (average)".PHP_EOL;
}//F

//a combat calculator
/*--------------------------------------------------------------------------------------------------------------------------------------------

														 ██████╗ ██████╗ ██████╗ ███████╗
														██╔════╝██╔═══██╗██╔══██╗██╔════╝
														██║     ██║   ██║██║  ██║█████╗  
														██║     ██║   ██║██║  ██║██╔══╝  
														╚██████╗╚██████╔╝██████╔╝███████╗
														 ╚═════╝ ╚═════╝ ╚═════╝ ╚══════╝
                                 
--------------------------------------------------------------------------------------------------------------------------------------------*/

echo "Players:\n";
print_r($players);
echo "Mobs:\n";
print_r($mobs);

$wins = 0;
$SAMPLE_SIZE = $argv[1];
if($SAMPLE_SIZE=="" || $SAMPLE_SIZE==0) $SAMPLE_SIZE = 1;
echo "SAMPLE SIZE = $SAMPLE_SIZE\n";

for($trials = 0;$trials < $SAMPLE_SIZE;$trials++) {
	echo "TRIAL $trials".PHP_EOL;

	//plays out simulated combat between these two chrs
	$turn = 1;
	for($i=0;$i<count($players);$i++) resetForBattle($players[$i]);
	for($i=0;$i<count($mobs);$i++) resetForBattle($mobs[$i]);

	do {
		//players attack
		for($i=0;$i<count($players);$i++) {
			if($players[$i][injury]>=100) continue;
			$t = pickTarget($mobs,$i);
			if($t<0) break;	//no more targets
			attack($players[$i],$mobs[$t],$i,$t);
		}//for
		echo " <<< ";
		//mobs attack
		for($i=0;$i<count($mobs);$i++) {
			if($mobs[$i][injury]>=100) continue;
			$t = pickTarget($players,$i);
			if($t<0) break;	//no more targets
			attack($mobs[$i],$players[$t],$i,$t);
		}//for
		$turn++;
	} while( teamAlive($players) && teamAlive($mobs) );

	$tookHowManyTurns[] = $turn;

	if( teamAlive($players) ) $wins++;

}//for

$chances = 100 * ($wins / $SAMPLE_SIZE);

whoLived($players);
whoLived($mobs);

echo "Chances = $wins / $SAMPLE_SIZE = $chances%".PHP_EOL;

figureTurnsAverage($tookHowManyTurns);
?>