<?php
require("mysql.php");
require("tables.php");
require("helpfuncs.php");

$start = time();

function truncateTables(){
	$tables = array("mod_kplayproduct",
					"mod_kplayproduct_mode",
					"mod_kplayproduct_type",
					"mod_kplayproduct_slotsprice",
					"mod_kplayproduct_mode_to_product");
	echo "<p>";
					
	foreach ($tables as $table){
		$dbtrun = new sql();
		$dbtruncon = $dbtrun->connect("philipp_kplay2");
		$dbtrun->executeQuery("TRUNCATE TABLE `".$table."`", $dbtruncon);
		echo "truncateTables: Tabelle '".$table."' entfernt<br>";		
	}				
	echo "<br><p>";
}

function createProductTypes(){

	echo "<p>";
	$gamesType = new tbl_mod_kplayproduct_type();
	$gamesType->mod_kplayproduct_type_id = '1';
	$gamesType->mod_kplayproduct_type_name = "Gameserver";
	$gamesType->mod_kplayproduct_type_is_active = 1;
	$gamesType->mod_kplayproduct_type_has_publicprivate = 1;
	$gamesType->mod_kplayproduct_type_monthly_koins = 100;
	$gamesType->mod_kplayproduct_type_setup_koins = 1000;
	$gamesType->save();
	echo "createProductTypes: Erstelle Produkt-Typ ".$gamesType->mod_kplayproduct_type_name."..<br>";	

	$voiceType = new tbl_mod_kplayproduct_type();
	$voiceType->mod_kplayproduct_type_id = '2';
	$voiceType->mod_kplayproduct_type_name = "Voiceserver";
	$voiceType->mod_kplayproduct_type_is_active = 1;
	$voiceType->mod_kplayproduct_type_has_publicprivate = 1;
	$voiceType->mod_kplayproduct_type_monthly_koins = 10;
	$voiceType->mod_kplayproduct_type_setup_koins = 100;
	$voiceType->save();
	echo "createProductTypes: Erstelle Produkt-Typ ".$voiceType->mod_kplayproduct_type_name."...<br>";
	echo "<br></p>";
}

function createBasisMode(){
	$newmode = new tbl_mod_kplayproduct_mode();
	$newmode->mod_kplayproduct_mode_id = '1';
	$newmode->mod_kplayproduct_mode_name = 'basis';
	$newmode->save();
	echo "createBasisMode: Produkt-Mode ".$newmode->mod_kplayproduct_mode_name." erstellt<br><br>";
}


$dbnew = new sql();
$sql = "SELECT * FROM mga_games
		WHERE bestellbar = '1'
		ORDER BY game_name ASC";
$oldGameDatas = $dbnew->getRows( $sql, "philipp_kplay1" );

$kplayproduct_id = 1;


truncateTables();
createProductTypes();
createBasisMode();


foreach( $oldGameDatas as $key => $oldGameData )
{

	if( $oldGameData[ "game_name" ] != "" || $oldGameData[ "game_name" ] != " " )
	{
	$product = new tbl_mod_kplayproduct();
	$product->mod_kplayproduct_type_id = '1'; // alle Games werden mit dem Typ 1 = Gameserver eingetragen (2 = Voiceserver)
	$product->product_id = $oldGameData['produkt_id'];
	$product->mod_webinterface_product_id = '0';
	$product->mod_kplayproduct_is_active = '1';	
	$product->mod_kplayproduct_qstat_ident = $oldGameData['qstat'];
	$product->mod_kplayproduct_shortname = getShortName( $oldGameData['game_name'] );
	$product->mod_kplayproduct_name = $oldGameData['game_name'];
	$product->mod_kplayproduct_compat_switchgroup_id = $oldGameData['switchgroup_id'];
	$product->save();
	
	echo "<table>";
	echo "<tr><td>Produkt:</td>  <td>".$product->mod_kplayproduct_name."</td></tr>";
	echo "<tr><td>mod_kplayproduct_type_id</td>  <td>".$product->mod_kplayproduct_type_id." (Gameserver)</td></tr>";
	echo "<tr><td>product_id</td>  <td>".$product->product_id."</td></tr>";
	echo "<tr><td>mod_webinterface_product_id</td> <td>".$product->mod_webinterface_product_id."</td></tr>";
	echo "<tr><td>mod_kplayproduct_is_active</td>  <td>".$product->mod_kplayproduct_is_active."</td></tr>";
	echo "<tr><td>mod_kplayproduct_qstat_ident</td>  <td>".$product->mod_kplayproduct_qstat_ident."</td></tr>";
	echo "<tr><td>mod_kplayproduct_shortname</td>  <td>".$product->mod_kplayproduct_shortname."</td></tr>";
	echo "<tr><td>mod_kplayproduct_compat_switchgroup_id</td>  <td>".$product->mod_kplayproduct_compat_switchgroup_id."</td></tr>";

	$product_mtp = new tbl_mod_kplayproduct_mode_to_product();
	$product_mtp->mod_kplayproduct_mode_to_product_id = $oldGameData['game_id']; // var is used to track the m2p-id. db-field is set to auto_increment
	$product_mtp->mod_kplayproduct_id = $kplayproduct_id;
	$product_mtp->mod_kplayproduct_mode_id = '1'; //mode_id = 1 equals basis, which has been set manually by func createBasisMode
	$product_mtp->mod_kplayproduct_mode_to_product_is_active = '1';
	$product_mtp->mod_kplayproduct_mode_to_product_public_is_active = '1';
	$product_mtp->mod_kplayproduct_mode_to_product_private_is_active = '1';
	$product_mtp->mod_kplayproduct_mode_to_product_is_price_linear = '1';
	$product_mtp->mod_kplayproduct_mode_to_product_slot_price_public = $oldGameData['slotpreis_pub'];
	$product_mtp->mod_kplayproduct_mode_to_product_slot_price_private = $oldGameData['slotpreis_priv'];
	$product_mtp->mod_kplayproduct_mode_to_product_base_price_public = $oldGameData['grundpreis_pub'];
	$product_mtp->mod_kplayproduct_mode_to_product_base_price_private = $oldGameData['grundpreis_priv'];

	$minMaxSlots = getMinAndMaxSlots( explode(';', $oldGameData['slots']) );

	$product_mtp->mod_kplayproduct_mode_to_product_min_slots = $minMaxSlots['min'];
	$product_mtp->mod_kplayproduct_mode_to_product_max_slots = $minMaxSlots['max'];
	$product_mtp->save();		

	echo "<tr><td>mod_kplayproduct_mode_to_product_id</td>  <td>".$product_mtp->mod_kplayproduct_mode_to_product_id."</td></tr>";
	echo "<tr><td>mod_kplayproduct_id</td>  <td>".$product_mtp->mod_kplayproduct_id."</td></tr>";
	echo "<tr><td>mod_kplayproduct_mode_id</td>  <td>".$product_mtp->mod_kplayproduct_mode_id." (Mode 'basis')</td></tr>";
	echo "<tr><td>mod_kplayproduct_mode_to_product_slot_price_public</td>  <td>".$product_mtp->mod_kplayproduct_mode_to_product_slot_price_public."</td></tr>";
	echo "<tr><td>mod_kplayproduct_mode_to_product_slot_price_private</td>  <td>".$product_mtp->mod_kplayproduct_mode_to_product_slot_price_private."</td></tr>";
	echo "<tr><td>mod_kplayproduct_mode_to_product_base_price_public</td>  <td>".$product_mtp->mod_kplayproduct_mode_to_product_base_price_public."</td></tr>";
	echo "<tr><td>mod_kplayproduct_mode_to_product_base_price_private</td>  <td>".$product_mtp->mod_kplayproduct_mode_to_product_base_price_private."</td></tr>";
	echo "<tr><td>mod_kplayproduct_mode_to_product_min_slots</td>  <td>".$product_mtp->mod_kplayproduct_mode_to_product_min_slots."</td></tr>";
	echo "<tr><td>mod_kplayproduct_mode_to_product_max_slots</td>  <td>".$product_mtp->mod_kplayproduct_mode_to_product_max_slots."</td></tr>";
	
	echo "</table>";

/*
 * FOR-LOOP to generate individual Slotprices
 * don't forget is_public = 1 and is_public = 0
 * !TODO: Check Slotprice Calc!
 */	
 
	$slots = explode(';', $oldGameData['slots']);
	$minSlots = $minMaxSlots['min'];
	$maxSlots = $minMaxSlots['max'];	

	echo "<table>";	
	for($i = $minSlots; $i <= $maxSlots; $i++){
	
		$slotnum = $i;
		$slotprice = $oldGameData['grundpreis_pub'] + ($oldGameData['slotpreis_pub'] * $slotnum);	
	
		$newslots = new tbl_mod_kplayproduct_slotsprice();
		$newslots->mod_kplayproduct_mode_to_product_id = $oldGameData['game_id'];
		$newslots->mod_kplayproduct_slotsprice_number = $slotnum;
		$newslots->mod_kplayproduct_slotsprice = $slotprice;
		$newslots->mod_kplayproduct_slotsprice_is_active = '1';
		$newslots->mod_kplayproduct_slotsprice_is_public = '1';
		$newslots->save();
		
		echo "<tr><td colspan='2'>---</td></tr>";
		echo "<tr><td>mod_kplayproduct_mode_to_product_id</td>  <td>".$newslots->mod_kplayproduct_mode_to_product_id."</td></tr>";
		echo "<tr><td>mod_kplayproduct_slotsprice_number</td>  <td>".$newslots->mod_kplayproduct_slotsprice_number."</td></tr>";
		echo "<tr><td>mod_kplayproduct_slotsprice</td>  <td>".$newslots->mod_kplayproduct_slotsprice."</td></tr>";
		echo "<tr><td>mod_kplayproduct_slotsprice_is_public</td>  <td>".$newslots->mod_kplayproduct_slotsprice_is_public."</td></tr>";

	}

	//IF $product_mtp->mod_kplayproduct_mode_to_product_private_is_active DO private-slots
	//doesn't matter actually since we set "private_is_active" to "true" on any game

	
	for($i = $minSlots; $i <= $maxSlots; $i++){
	
		$slotnum = $i;
		$slotprice = $oldGameData['grundpreis_priv'] + ($oldGameData['slotpreis_priv'] * $slotnum);	
	
		$newslots = new tbl_mod_kplayproduct_slotsprice();
		$newslots->mod_kplayproduct_mode_to_product_id = $oldGameData['game_id'];
		$newslots->mod_kplayproduct_slotsprice_number = $slotnum;
		$newslots->mod_kplayproduct_slotsprice = $slotprice;
		$newslots->mod_kplayproduct_slotsprice_is_active = '1';
		$newslots->mod_kplayproduct_slotsprice_is_public = '0';
		$newslots->save();

		echo "<tr><td colspan='2'>---</td></tr>";
		echo "<tr><td>mod_kplayproduct_mode_to_product_id</td>  <td>".$newslots->mod_kplayproduct_mode_to_product_id."</td></tr>";
		echo "<tr><td>mod_kplayproduct_slotsprice_number</td>  <td>".$newslots->mod_kplayproduct_slotsprice_number."</td></tr>";
		echo "<tr><td>mod_kplayproduct_slotsprice</td>  <td>".$newslots->mod_kplayproduct_slotsprice."</td></tr>";
		echo "<tr><td>mod_kplayproduct_slotsprice_is_public</td>  <td>".$newslots->mod_kplayproduct_slotsprice_is_public."</td></tr>";

	}
	echo "</table>";	

	$kplayproduct_id++;

	echo "<hr size='1'>";
	
	}
	else
	{
		unset( $oldGameDatas[ $key ] );
	}
}

echo "<p><b>Daten in ".(time()-$start)."s übertragen</b></p>"; 
 
?>
