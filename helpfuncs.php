<?php

function getShortName($game){
	$games =  array('Unreal Tournament 2003' => 'ut2003',
					'Half-Life' => 'hl',
					'Unreal Tournament' => 'ut',
					'Beben ]|[ Arena' => 'q3',
					'Beben ]|[ Arena: Challenge Promode Arena' => 'q3cpa',
					'Medal of Honor: Allied Assault' => 'mohaa',
					'Half-Life: Counter-Strike' => 'cs',
					'Medal of Honor: Spearhead' => 'mohs',
					'Battlefield 1942 inkl. allen Mods' => 'bf1942',
					'Voice Server: Teamspeak' => 'ts',
					'Return To Castle Wolfenstein: OSP' => 'rtcwosp',
					'Medal of Honor' => 'moh',
					'Voice Server' => 'voice',
					'Battlefield 1942' => 'bf1942',
					'Half-Life: Day of Defeat' => 'dod',
					'Half-Life: Natural Selection' => 'hlns',
					'Beben ]I[ Arena: Orange Smoothie Productions' => 'q3osp',
					'Jedi Knight 2' => 'jk2',
					'Jedi Knight 2: Jedi Outcast' => 'jk2jo',
					'Return to Castle Wolfenstein' => 'rtcw',
					'Unreal Tournament' => 'ut',
					'Unreal Tournament: Tactical Ops' => 'utto',
					'Voice Server: Ventrilo' => 'vent',
					'Devastation' => 'dev',
					'RtCW: Enemy Territory' => 'rtcwet',
					'Elite Force 2' => 'ef2',
					'Freelancer' => 'fl',
					'Medal of Honor: Breakthrough' => 'mohb',
					'Call of Duty' => 'cod',
					'Call of Duty und United Offensive' => 'coduo',
					'Halo' => 'halo',
					'Half-Life inkl. allen Steam-Mods' => 'hl+',
					'Sacred: Underworld' => 'sacuw',
					'GTR' => 'gtr',
					'Half-Life 2 Deathmatch' => 'hl2dm',
					'GTR inkl. Mods' => 'gtr+',
					'Jedi Academy' => 'ja',
					'Steam' => 'steam',
					'Counter-Strike: Source' => 'css',
					'Americas Army' => 'aa',
					'Battlefield Vietnam' => 'bfv',
					'Unreal Tournament 2004' => 'ut2004',
					'Battlefield Vietnam inkl. allen Mods' => 'bfv+',
					'Sacred' => 'sac',
					'Far Cry' => 'fc',
					'Live for Speed' => 'lfs',
					'Soldier of Fortune II' => 'sof2',
					'Soldier of Fortune II : inkl. Mods' => 'sof2+',
					'Söldner: Secret Wars' => 'ssw',
					'Painkiller' => 'pk',
					'Webwars Arena' => 'wa',
					'Joint Operations' => 'jo',
					'Doom3' => 'd3',
					'BFV_test' => 'bfv',
					'bfv_test' => 'bfv',
					'Tribes Vengeance' => 'tv',
					'Tribes Vengeance : Open Betaserver' => 'tvob',
					'Battlefield 2' => 'bf2',
					'War§ow' => 'ws',
					'GTL' => 'gtl',
					'GTL inkl. Mods' => 'gtl+',
					'F.E.A.R' => 'fear',
					'Q4' => 'q4',
					'Q4 - Deutsche Version' => 'q4de',
					'Call of Duty 2' => 'cod2',
					'Star Wars Battlefront II' => 'swb2',
					'rFactor' => 'rf',
					'Day of Defeat: Source' => 'dods',
					'Prey' => 'prey',
					'MMORPG Imagine' => 'mmorpgi',
					'Battlefield 2142' => 'bf2142',
					'Challenge 2' => 'c2',);
					
return $games[$game];						
}

function replaceSonderzeichen($phrase){
	$corSonderzeichen = array('Ã¶','Â§');
	$propSonderzeichen = array('ö','§');
	return str_replace($corSonderzeichen, $propSonderzeichen, $phrase);
}

function getMinAndMaxSlots($slots){		//getMinAndMaxSlots(splitSlotsToArray('2;4;6;8;10;12'));
	return array('min' => current($slots), 'max' => end($slots));
}



?>
