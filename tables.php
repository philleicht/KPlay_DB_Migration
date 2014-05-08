<?php
//require("mysql.php");

/* #############################################################################################
*
*		K-Play Product
*
* #############################################################################################
*/

class tbl_mod_kplayproduct{
/*	Database fields */

	public $mod_kplayproduct_type_id;
	public $product_id;
	public $mod_webinterface_product_id;
	public $mod_kplayproduct_compat_switchgroup_id;
	public $mod_kplayproduct_is_active;	
	public $mod_kplayproduct_qstat_ident;
	public $mod_kplayproduct_shortname;
	public $mod_kplayproduct_name;


	public function save(){
		$dbsave = new sql();
		$dbsavecon = $dbsave->connect("philipp_kplay2");
		$dbsave->executeQuery(
		  "INSERT INTO `mod_kplayproduct` (mod_kplayproduct_type_id,
											  	product_id,
											  	mod_webinterface_product_id,
												mod_kplayproduct_compat_switchgroup_id,
												mod_kplayproduct_is_active,
												mod_kplayproduct_qstat_ident,
												mod_kplayproduct_shortname,
												mod_kplayproduct_name)
										VALUES ('$this->mod_kplayproduct_type_id',
											  	'$this->product_id',
											  	'$this->mod_webinterface_product_id',
												'$this->mod_kplayproduct_compat_switchgroup_id',
												'$this->mod_kplayproduct_is_active',
												'$this->mod_kplayproduct_qstat_ident',
												'$this->mod_kplayproduct_shortname',
												'$this->mod_kplayproduct_name')", $dbsavecon);			
	}
}

/*#############################################################################################
*
*		K-Play Product Mode to Product
*
*#############################################################################################
*/

class tbl_mod_kplayproduct_mode_to_product{

	public $mod_kplayproduct_mode_to_product_id;
	public $mod_kplayproduct_id;
	public $mod_kplayproduct_mode_id;
	public $mod_kplayproduct_mode_to_product_is_active;
	public $mod_kplayproduct_mode_to_product_public_is_active;
	public $mod_kplayproduct_mode_to_product_private_is_active;
	public $mod_kplayproduct_mode_to_product_is_price_linear;
	public $mod_kplayproduct_mode_to_product_slot_price_public;
	public $mod_kplayproduct_mode_to_product_slot_price_private;
	public $mod_kplayproduct_mode_to_product_base_price_public;
	public $mod_kplayproduct_mode_to_product_base_price_private;
	public $mod_kplayproduct_mode_to_product_min_slots;
	public $mod_kplayproduct_mode_to_product_max_slots;	
	
	public function save(){
		$dbsave = new sql();
		$dbsavecon = $dbsave->connect("philipp_kplay2");
		$dbsave->executeQuery(
		"INSERT INTO `mod_kplayproduct_mode_to_product` (mod_kplayproduct_mode_to_product_id,
														mod_kplayproduct_id,
														mod_kplayproduct_mode_id,
														mod_kplayproduct_mode_to_product_is_active,
														mod_kplayproduct_mode_to_product_public_is_active,
														mod_kplayproduct_mode_to_product_private_is_active,
														mod_kplayproduct_mode_to_product_is_price_linear,
														mod_kplayproduct_mode_to_product_slot_price_public,
														mod_kplayproduct_mode_to_product_slot_price_private,
														mod_kplayproduct_mode_to_product_base_price_public,
														mod_kplayproduct_mode_to_product_base_price_private,
														mod_kplayproduct_mode_to_product_min_slots,
														mod_kplayproduct_mode_to_product_max_slots)
												VALUES ('$this->mod_kplayproduct_mode_to_product_id',
														'$this->mod_kplayproduct_id',
												 		'$this->mod_kplayproduct_mode_id',
														'$this->mod_kplayproduct_mode_to_product_is_active',
														'$this->mod_kplayproduct_mode_to_product_public_is_active',
														'$this->mod_kplayproduct_mode_to_product_private_is_active',
														'$this->mod_kplayproduct_mode_to_product_is_price_linear',
														'$this->mod_kplayproduct_mode_to_product_slot_price_public',
														'$this->mod_kplayproduct_mode_to_product_slot_price_private',
														'$this->mod_kplayproduct_mode_to_product_base_price_public',
														'$this->mod_kplayproduct_mode_to_product_base_price_private',
														'$this->mod_kplayproduct_mode_to_product_min_slots',
														'$this->mod_kplayproduct_mode_to_product_max_slots')", $dbsavecon);
	}
}

/* #############################################################################################
*		
*		K-Play Product Type
*
* #############################################################################################
*/

class tbl_mod_kplayproduct_type{
	
	public $mod_kplayproduct_type_id;
	public $mod_kplayproduct_type_name;	
	public $mod_kplayproduct_type_name_phrase;
	public $mod_kplayproduct_type_is_active;
	public $mod_kplayproduct_type_has_publicprivate;
	public $mod_kplayproduct_type_monthly_koins;
	public $mod_kplayproduct_type_setup_koins;

	public function save(){
		$dbsave = new sql();
		$dbsavecon = $dbsave->connect("philipp_kplay2");
		$query = $dbsave->executeQuery(
		  "INSERT INTO `mod_kplayproduct_type` (mod_kplayproduct_type_id,
		  										mod_kplayproduct_type_name,
											  	mod_kplayproduct_type_name_phrase,
											  	mod_kplayproduct_type_is_active,
												mod_kplayproduct_type_has_publicprivate,
												mod_kplayproduct_type_monthly_koins,
												mod_kplayproduct_type_setup_koins)
										VALUES ('$this->mod_kplayproduct_type_id',
												'$this->mod_kplayproduct_type_name',
											  	'$this->mod_kplayproduct_type_name_phrase',
											  	'$this->mod_kplayproduct_type_is_active',
												'$this->mod_kplayproduct_type_has_publicprivate',
												'$this->mod_kplayproduct_type_monthly_koins',
												'$this->mod_kplayproduct_type_setup_koins')", $dbsavecon);		
	}
}

/* #############################################################################################
*
* 		K-Play Product Mode
*
* #############################################################################################
*/

class tbl_mod_kplayproduct_mode{
	
	public $mod_kplayproduct_mode_id;
	public $mod_kplayproduct_mode_name;
	
	public function save(){
		
		$dbsave = new sql();
		$dbsavecon = $dbsave->connect("philipp_kplay2");
		$dbsave->executeQuery(
		  "INSERT INTO `mod_kplayproduct_mode` (mod_kplayproduct_mode_id, mod_kplayproduct_mode_name) VALUES ('$this->mod_kplayproduct_mode_id', '$this->mod_kplayproduct_mode_name')", $dbsavecon);		
	}
	
}

/* #############################################################################################
*
* 		K-Play Product Slotsprice
*
* #############################################################################################
*/

class tbl_mod_kplayproduct_slotsprice{
	
	public $mod_kplayproduct_mode_to_product_id;
	public $mod_kplayproduct_slotsprice_number;	
	public $mod_kplayproduct_slotsprice;
	public $mod_kplayproduct_slotsprice_is_active;
	public $mod_kplayproduct_slotsprice_is_public;

	public function save(){
		$dbsave = new sql();
		$dbsavecon = $dbsave->connect("philipp_kplay2");
		$query = $dbsave->executeQuery(
		  "INSERT INTO `mod_kplayproduct_slotsprice` (mod_kplayproduct_mode_to_product_id,
		  											  mod_kplayproduct_slotsprice_number,
											  		  mod_kplayproduct_slotsprice,
											  		  mod_kplayproduct_slotsprice_is_active,
													  mod_kplayproduct_slotsprice_is_public)
											  VALUES ('$this->mod_kplayproduct_mode_to_product_id',
													  '$this->mod_kplayproduct_slotsprice_number',
											  		  '$this->mod_kplayproduct_slotsprice',
											  		  '$this->mod_kplayproduct_slotsprice_is_active',
													  '$this->mod_kplayproduct_slotsprice_is_public')", $dbsavecon);		
	}
}



?>
