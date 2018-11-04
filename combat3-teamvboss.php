<?php
/* player team vs 1 big mob (sugar) */
function attack($attacker,&$defender,$overrideSkill = 0) {
	if( $attacker[injury]>=100 ) {
		echo $attacker[name]." lost\n";
		return;
	}	//can't attack when dead
	//process attack		
	$dice = rand(0,100);
	$roll = intval($attacker[skill] * $dice/100); //result from 0 to 9 (or more)
	if($overrideSkill>0) $roll = intval($attacker[overrideSkill] * $dice/100); //result from 0 to 9 (or more)
	$rollEffect = $roll * 10;
	$damageDealt = intval($attacker[maxDamage] * $roll / 10.0);
	echo "$attacker[name] rolled $dice% of $attacker[skill] and got $roll$ dealing $rollEffect% of $attacker[maxDamage] = $damageDealt dmg";
	//armor
	if($defender[protection]) {

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
	if($defender[TFF]==0) die("defender TFF was 0\n");
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
include "combat-chrs-definition.php";

$players[] = $p2;
$players[] = $p1;
/* $players[] = $p3;
$players[] = $p4;
$players[] = $p5; */

$wins = 0;
$SAMPLE_SIZE = $argv[1];
if($SAMPLE_SIZE=="") $SAMPLE_SIZE = 1;

for($trials = 0;$trials < $SAMPLE_SIZE;$trials++) {
	echo "TRIAL $trials".PHP_EOL;

	//plays out simulated combat between these two chrs
	$turn = 1;
	for($i=0;$i<count($players);$i++) resetForBattle($players[$i]);
	resetForBattle($mob1);

	//print_r($players);
	//print_r($mobs);

	do {
		//players attack
		for($i=0;$i<count($players);$i++) {
			if($players[$i][injury]>=100) continue;
			attack($players[$i],$mob1);
		}//for
		echo " <<< ";
		$t = pickTarget($players,0);
		//echo "t=$t ";
		if($t<0) break;	//no more targets
		attack($mob1,$players[$t]);
		$t = pickTarget($players,0);
		if($t<0) break;	//no more targets
		attack($mob1,$players[$t],$mob1[skill2]);
		$turn++;
	} while( teamAlive($players) && $mob1[injury]<100 );

	$tookHowManyTurns[] = $turn;

	if( teamAlive($players) ) $wins++;

}//for

$chances = 100 * ($wins / $SAMPLE_SIZE);

whoLived($players);

echo "Chances = $wins / $SAMPLE_SIZE = $chances%".PHP_EOL;

figureTurnsAverage($tookHowManyTurns);
?>