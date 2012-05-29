<?php
/*-------------------------------------------------------+
| WebClearFusion Content Management System
| Copyright (C) 2010 - 2012 lovepsone
+--------------------------------------------------------+
| Filename: show_char_skill.php
| Author: lovepsone
+--------------------------------------------------------+
| Removal of this copyright header is strictly prohibited 
| without written permission from the original author(s).
+--------------------------------------------------------*/

	function get_character_skills($guid_id)
		{
			SelectDataBase("characters");
			$char_skills = db_array(db_query("SELECT * FROM `character_skills` WHERE `guid`='".$guid_id."'"));
			return $char_skills;
		}

	function show_player_skills($guid)
		{
			global $txt;
			selectdb("wcf");
			$result = db_query("SELECT `id` AS ARRAY_KEY, `name`, `order` FROM ".DB_SKILL_CAT."");
			$skill_category = array(); $skill_name = array();
			while ($data = db_array($result))
					{
						$skill_category[$data['ARRAY_KEY']] = $data['order'];
						$skill_name[$data['ARRAY_KEY']] = $data['name'];
					}

			$skill_rev = array();
			// �������� ������ � ������ � ����� ��� ���������� �� �� ������
			$playerSkill = array();
			$skillcount = get_character_skills($guid);

			if ($skillcount)
				{
					SelectDataBase("characters");
					$result = db_query("SELECT * FROM `character_skills` WHERE `guid`='$guid'");

					while ($data = db_array($result))
 						{
   							$skillId = $data['skill'];
   							if ($skillId == 0) { continue; }
   							$skill = $data['value'];
   							$maxskill = $data['max'];
   							$skillPerm = 0; // ��� � �������� (����������� � � skill, � � maxSkill(������� ����)
   							$skillTemp = 0; // ��������� ���, ������ ������ �� skill(������� ����)

   							if ($skillLine = get_skill_line($skillId))
   								{
									$skill = $skill + $skillPerm;
								    	$maxskill = $maxskill + $skillPerm;
								    	$category = $skillLine['Category'];

								    	// ��������� 12 ������
								    	if ($category == 12) { continue; }

									//$order = $skill_category[$category]['order'];
									$order = $skill_category[$category];
									$skill_rev[$order] = $category;

								    	$playerSkill[$order][] = array(
												'id'=>$skillId,
								          			'Name'=>$skillLine['Name'],
								          			'Category'=>$category,
								          			'Description'=>$skillLine['Description'],
								          			'icon'=>$skillLine['iconId'],
								          			'Skill'=>$skill,
								          			'maxSkill'=>$maxskill,
								          			'bonus'=>$skillTemp);
   								}
  						}
				}

  			if ($playerSkill)
  				{
    					ksort($playerSkill);
					echo"<tr><td><table class='report'>";
					echo"<tr><td class='head' colspan='3'>".$txt['modul_acp_char_skill']."</td></tr>";

    					foreach($playerSkill as $id => $skill_data)
    						{
      							$id = $skill_rev[$id];
      							echo"<tr><td class='skill_category' colspan='3'>".$skill_name[$id]."</td></tr>";
      							foreach($skill_data as $skill)
      								{
        								if ($skill['Description'] != "")
										{
		  									$tip = "<table class=skilltip><tr class=top><td>".$skill['Name']."</td></tr><tr><td>".$skill['Description']."</td></tr></table>";
          										echo"<tr ".add_tooltip($tip,'BORDER, false, STICKY, false').">";
        									}
									else { echo"<tr>"; }

        								$pct = intval($skill['Skill']/$skill['maxSkill']*100);
        								$text = $skill['Skill'];
             								if ($skill['bonus'] > 0)
										{
											$text .= "<font class='posstat'>+".$skill['bonus']."</font>";
										}
        								elseif ($skill['bonus'] < 0)
										{
											$text .= "<font class='negstat'>".$skill['bonus']."</font>";
										}
        								$text .= " / ".$skill['maxSkill'];

									//$ico = "";
									//if ($skill['icon'] > 1) { $ico = '<img src='.get_spell_icon($skill['icon']).'>'; }
									//echo"<td class='skill_ico'>".$ico."</td>";

								        echo"<td class='skill_name'><a href='?skill=".$skill['id']."&guid=".$guid."'>".$skill['Name']."</td>";
								        echo"<td class='skill_bar'><div class='skill_bar'><b class='s1' style='width: ".$pct."%;'></b><span>".$text."</span></div></td>";
								        echo"</tr>";
      								}
    						}
    					echo"</table></td><tr>";
  				}
		}
?>