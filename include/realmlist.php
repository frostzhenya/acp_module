<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2011 lovepsone
+--------------------------------------------------------+
| Filename: realmlist.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	$config['revision'] = 'wcf_revision_nr = [349]';
	$config['rev_acp'] = ' 0.02.00';

	//==================================================================
	// ���� ����� (realmd)
	//==================================================================
	$config_db_connect['rhostname'] = '127.0.0.1';
	$config_db_connect['rusername'] = 'mangos';
	$config_db_connect['rpassword'] = 'mangos';
	$config_db_connect['rdbname'] = 'realmd';

	$realms = array();
	//==================================================================
	// ���� ���� (mangos[1])
	//==================================================================
	$realms[1]['hostname'] = '127.0.0.1';
	$realms[1]['username'] = 'mangos';
	$realms[1]['password'] = 'mangos';
	$realms[1]['dbname'] = 'mangos';
	
	//==================================================================
	// ���� ���������� (characters[1])
	//==================================================================
	$realms[1]['chostname'] = '127.0.0.1';
	$realms[1]['cusername'] = 'mangos';
	$realms[1]['cpassword'] = 'mangos';
	$realms[1]['cdbname'] = 'characters';
	
	//==================================================================
	// ���� ���� (mangos[2])
	//==================================================================
	$realms[2]['hostname'] = '127.0.0.1';
	$realms[2]['username'] = 'mangos';
	$realms[2]['password'] = 'mangos';
	$realms[2]['dbname'] = 'mangos2';
	
	//==================================================================
	// ���� ���������� (characters[2])
	//==================================================================
	$realms[2]['chostname'] = '127.0.0.1';
	$realms[2]['cusername'] = 'mangos';
	$realms[2]['cpassword'] = 'mangos';
	$realms[2]['cdbname'] = 'characters2';

	//==================================================================
	// ����� ���������� �� ��������� �������(���������������)
	//==================================================================
	if (isset($_SESSION['realmd_id']))
		{
			$r_id = $_SESSION['realmd_id'];
		}
	elseif (isset($_GET['realm_id']) && isnum($_GET['realm_id']))
		{
			$r_id = addslashes($_GET["realm_id"]);
		}
	else
		{
			$r_id = 1;
		}

		//==================================================================
		// ���� ���� (mangos)
		//==================================================================
		$config_db_connect['hostname'] = $realms[$r_id]['hostname'];
		$config_db_connect['username'] = $realms[$r_id]['username'];
		$config_db_connect['password'] = $realms[$r_id]['password'];
		$config_db_connect['dbname'] = $realms[$r_id]['dbname'];

		//==================================================================
		// ���� ���������� (characters)
		//==================================================================
		$config_db_connect['chostname'] = $realms[$r_id]['chostname'];
		$config_db_connect['cusername'] = $realms[$r_id]['cusername'];
		$config_db_connect['cpassword'] = $realms[$r_id]['cpassword'];
		$config_db_connect['cdbname'] = $realms[$r_id]['cdbname'];
?>