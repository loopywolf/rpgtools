<?php
	/* class Chr {
		var $skill = 0;
		var $maxDamage = 0;
		var $tff = 0;
		//var $protection = 0;
		var $injury = 0;
	}*/
	/* combat - 1 on 1 */
	function attack($attacker,&$defender) {
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

	//a combat calculator
	//chr setup
	$p1 = array(
		"name" => "Triox", 
		"skill" => 10, 
		"skillName" => "WP-Helmet",
		"maxDamage" => 100,
		"shield" => 50,
		"shieldUp" => true,
		"TFF" => 100,
		"injury" => 0
	);
	$p2 = array(
		"name" => "Gas",
		"skill" => 10, 
		"skillName" => "WP-Ranged",
		"maxDamage" => 50,
		"TFF" => 80,
		"injury" => 0
	);
	$p3 = array(
		"name" => "Solid",
		"skill" => 5, 
		"skillName" => "WP-Sword",
		"maxDamage" => 150,
		"TFF" => 150,
		"protection" => 10,
		"injury" => 0
	);
	$p1 = array(
		"name" => "Snow",
		"skill" => 10, 
		"skillName" => "WP-Spear",
		"maxDamage" => 150,
		"TFF" => 150,
		"injury" => 0
	);
	$p2 = array(
		"name" => "Rust",
		"skill" => 10, 
		"skillName" => "STR",
		"maxDamage" => 50,
		"TFF" => 140,
		"protection" => 10,
		"injury" => 0
	);
	$p2 = array(
		"name" => "Neon",
		"skill" => 5, 
		"skillName" => "WP-Baton",
		"maxDamage" => 100,
		"TFF" => 80,
		"Dodging" => 10,
		"injury" => 0
	);
	$p2 = array(
		"name" => "Silver",
		"skill" => 5, 
		"skillName" => "WP-Sword",
		"maxDamage" => 87, //some of the time they get special attack so 75 + 25/2
		"TFF" => 125,
		"injury" => 0
	);
	$p1 = array(
		"name" => "Zora",
		"skill" => 10, 
		"skillName" => "WP-Spear",
		"maxDamage" => 135, //some of the time they get special attack so 75 + 25/2
		"TFF" => 80,
		"injury" => 0
	);
	$p2 = array(
		"name" => "Chalk",
		"skill" => 11, 
		"skillName" => "STR",
		"maxDamage" => 55, //some of the time they get special attack so 75 + 25/2
		"TFF" => 100,
		"injury" => 0
	);
	$p2 = array(
		"name" => "Silica",
		"skill" => 10, 
		"skillName" => "STR",
		"maxDamage" => 50, //some of the time they get special attack so 75 + 25/2
		"TFF" => 80,
		"injury" => 0
	);

	print_r($p1);
	print_r($p2);

	for($trials = 0;$trials<200;$trials++) {
		echo "TRIAL $trials".PHP_EOL;

		//plays out simulated combat between these two chrs
		$turn = 1;
		resetForBattle($p1);
		resetForBattle($p2);

		do {
			attack($p1,$p2);
			echo " <<< ";
			attack($p2,$p1);
			$turn++;
		} while( $p1[injury]<100 && $p2[injury]<100 );

		if($p1[injury]>=100) $p2[wins][] = $turn;
			else
		if($p2[injury]>=100) $p1[wins][] = $turn;
	
	}//for

	computeWins($p1);
	computeWins($p2);

?>