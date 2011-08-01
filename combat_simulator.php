<? require("ships.php") ?>
<?
$att_fleet = new Fleet(true);
$def_fleet = new Fleet(false);
?>
<html>
	<head>
		<title>TI3 Combat Simulator</title>
		<LINK href="combat_simulator.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<h1>TI3 Combat Simulator</h1>
		<?
		if ($_POST['submit'])
		{
		?>
		<h2>Results</h2>
		<table>
			<tr>
				<th colspan="3" class="attacker">Attacker</th>
				<th colspan="3" class="defender">Defender</th>
			</tr>
			<tr>
				<th colspan="6">Starting Units</th>
			</tr>
			<tr>
				<th>Unit</th>
				<th class="small">Cost</th>
				<th class="small">Avg Hits</th>
				<th>Unit</th>
				<th class="small">Cost</th>
				<th class="small">Avg Hits</th>
			</tr>
			<? for ($i = 0; $i < max($att_fleet->fleet_size(), $def_fleet->fleet_size()); $i++) { ?>
				<tr>
					<? if ($i < $att_fleet->fleet_size()) { ?>
						<?= $att_fleet->ship_at($i)->to_table_cells(); ?>
					<? } else { ?>
						<td colspan="3">
					<? } ?>
					<? if ($i < $def_fleet->fleet_size()) { ?>
						<?= $def_fleet->ship_at($i)->to_table_cells(); ?>
					<? } else { ?>
						<td colspan="3">
					<? } ?>
				</tr>
			<? } ?>
			<tr>
				<th colspan="6">Victory Percentage</th>
			</tr>
			<tr>
				<td colspan="3">Space: <span class="victory_percentage">0%</span></td>
				<td colspan="3">Space: <span class="victory_percentage">0%</span></td>
			</tr>
			<tr>
				<td colspan="3">Ground: <span class="victory_percentage">0%</span></td>
				<td colspan="3">Ground: <span class="victory_percentage">0%</span></td>
			</tr>
		</table>
		<?
			// results
		}
		?>
		<form action="combat_simulator.php" method="post">
			<h2>Parameters</h2>
			<h3>Units</h3>
			<table>
				<tr>
					<th colspan="2" class="attacker">Attacker</th>
					<th colspan="2" class="defender">Defender</th>
				</tr>
				<tr>
					<td colspan="2" />
					<td colspan="2">
						<input type="checkbox" id="Space_Mines_def" name="Space_Mines_def"
						<? if ($_POST["Space_Mines_def"]) { echo("checked "); } ?>/>
						<label for="Space_Mines_def">Space Mines</label>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="text" id="SD_att" name="SD_att" size="4"
						<? if ($_POST["SD_att"]) { echo("value=\"" . $_POST["SD_att"] . "\" "); } ?>/>
						<label for="SD_att">Space Docks</label>
					</td>
					<td colspan="2">
						<input type="text" id="SD_def" name="SD_def" size="4"
						<? if ($_POST['SD_def']) { echo("value=\"" . $_POST['SD_def'] . "\" "); } ?>/>
						<label for="SD_def">Space Docks</label>
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" id="PDS_att" name="PDS_att" size="4"
						<? if ($_POST["PDS_att"]) { echo("value=\"" . $_POST["PDS_att"] . "\" "); } ?>/>
						<label for="PDS_att">PDS</label>
					</td>
					<td>
						<input type="text" id="Scientist_PDS_att" name="Scientist_PDS_att" size="4"
						<? if ($_POST["Scientist_PDS_att"]) { echo("value=\"" . $_POST["Scientist_PDS_att"] . "\" "); } ?>/>
						<label for="Scientist_PDS_att">of them with Scientist</label>
					</td>
					<td>
						<input type="text" id="PDS_def" name="PDS_def" size="4"
						<? if ($_POST['PDS_def']) { echo("value=\"" . $_POST['PDS_def'] . "\" "); } ?>/>
						<label for="PDS_def">PDS</label>
					</td>
					<td>
						<input type="text" id="Scientist_PDS_def" name="Scientist_PDS_def" size="4"
						<? if ($_POST["Scientist_PDS_def"]) { echo("value=\"" . $_POST["Scientist_PDS_def"] . "\" "); } ?>/>
						<label for="Scientist_PDS_def">of them with Scientist</label><br />
						<input type="text" id="Planet_PDS_def" name="Planet_PDS_def" size="4"
						<? if ($_POST["Planet_PDS_def"]) { echo("value=\"" . $_POST["Planet_PDS_def"] . "\" "); } ?>/>
						<label for="Planet_PDS_def">of them on the planet</label><br />
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" id="WS_att" name="WS_att" size="4"
						<? if ($_POST["WS_att"]) { echo("value=\"" . $_POST["WS_att"] . "\" "); } ?>/>
						<label for="WS_att">War Suns</label>
					</td>
					<td>
						<input type="checkbox" id="Admiral_WS_att" name="Admiral_WS_att"
						<? if ($_POST["Admiral_WS_att"]) { echo("checked "); } ?>/>
						<label for="Admiral_WS_att">Admiral</label><br />
						<input type="checkbox" id="WS_no_sustain_att" name="WS_no_sustain_att"
						<? if ($_POST["WS_no_sustain_att"]) { echo("checked "); } ?>/>
						<label for="WS_no_sustain_att">don't sustain damage</label>
					</td>
					<td>
						<input type="text" id="WS_def" name="WS_def" size="4"
						<? if ($_POST["WS_def"]) { echo("value=\"" . $_POST["WS_def"] . "\" "); } ?>/>
						<label for="WS_def">War Suns</label></td>
					<td>
						<input type="checkbox" id="Admiral_WS_def" name="Admiral_WS_def"
						<? if ($_POST["Admiral_WS_def"]) { echo("checked "); } ?>/>
						<label for="Admiral_WS_def">Admiral</label><br />
						<input type="checkbox" id="WS_no_sustain_def" name="WS_no_sustain_def"
						<? if ($_POST["WS_no_sustain_def"]) { echo("checked "); } ?>/>
						<label for="WS_no_sustain_def">don't sustain damage</label>
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" id="DN_att" name="DN_att" size="4"
						<? if ($_POST["DN_att"]) { echo("value=\"" . $_POST["DN_att"] . "\" "); } ?>/>
						<label for="DN_att">Dreadnoughts</label></td>
					<td>
						<input type="checkbox" id="Admiral_DN_att" name="Admiral_DN_att"
						<? if ($_POST["Admiral_DN_att"]) { echo("checked "); } ?>/>
						<label for="Admiral_DN_att">Admiral</label><br />
						<input type="checkbox" id="DN_no_sustain_att" name="DN_no_sustain_att"
						<? if ($_POST["DN_no_sustain_att"]) { echo("checked "); } ?>/>
						<label for="DN_no_sustain_att">don't sustain damage</label>
					</td>
					<td>
						<input type="text" id="DN_def" name="DN_def" size="4"
						<? if ($_POST["DN_def"]) { echo("value=\"" . $_POST["DN_def"] . "\" "); } ?>/>
						<label for="DN_def">Dreadnoughts</label>
					</td>
					<td>
						<input type="checkbox" id="Admiral_DN_def" name="Admiral_DN_def"
						<? if ($_POST["Admiral_DN_def"]) { echo("checked "); } ?>/>
						<label for="Admiral_DN_def">Admiral</label><br />
						<input type="checkbox" id="DN_no_sustain_def" name="DN_no_sustain_def"
						<? if ($_POST["DN_no_sustain_def"]) { echo("checked "); } ?>/>
						<label for="DN_no_sustain_def">don't sustain damage</label>
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" id="CS_att" name="CS_att" size="4"
						<? if ($_POST["CS_att"]) { echo("value=\"" . $_POST["CS_att"] . "\" "); } ?>/>
						<label for="CS_att">Cruisers</label>
					</td>
					<td>
						<input type="checkbox" id="Admiral_CS_att" name="Admiral_CS_att"
						<? if ($_POST["Admiral_CS_att"]) { echo("checked "); } ?>/>
						<label for="Admiral_CS_att">Admiral</label><br />
						<input type="checkbox" id="CS_sustain_att" name="CS_sustain_att"
						<? if ($_POST["CS_sustain_att"]) { echo("checked "); } ?>/>
						<label for="CS_sustain_att">sustain damage</label>
					</td>
					<td>
						<input type="text" id="CS_def" name="CS_def" size="4"
						<? if ($_POST["CS_def"]) { echo("value=\"" . $_POST["CS_def"] . "\" "); } ?>/>
						<label for="CS_def">Cruisers</label>
					</td>
					<td>
						<input type="checkbox" id="Admiral_CS_def" name="Admiral_CS_def"
						<? if ($_POST["Admiral_CS_def"]) { echo("checked "); } ?>/>
						<label for="Admiral_CS_def">Admiral</label><br />
						<input type="checkbox" id="CS_sustain_def" name="CS_sustain_def"
						<? if ($_POST["CS_sustain_def"]) { echo("checked "); } ?>/>
						<label for="CS_sustain_def">sustain damage</label>
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" id="DD_att" name="DD_att" size="4"
						<? if ($_POST["DD_att"]) { echo("value=\"" . $_POST["DD_att"] . "\" "); } ?>/>
						<label for="DD_att">Destroyers</label>
					</td>
					<td>
						<input type="checkbox" id="Admiral_DD_att" name="Admiral_DD_att"
						<? if ($_POST["Admiral_DD_att"]) { echo("checked "); } ?>/>
						<label for="Admiral_DD_att">Admiral</label>
					</td>
					<td>
						<input type="text" id="DD_def" name="DD_def" size="4"
						<? if ($_POST["DD_def"]) { echo("value=\"" . $_POST["DD_def"] . "\" "); } ?>/>
						<label for="DD_def">Destroyers</label>
					</td>
					<td>
						<input type="checkbox" id="Admiral_DD_def" name="Admiral_DD_def"
						<? if ($_POST["Admiral_DD_def"]) { echo("checked "); } ?>/>
						<label for="Admiral_DD_def">Admiral</label>
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" id="CR_att" name="CR_att" size="4"
						<? if ($_POST["CR_att"]) { echo("value=\"" . $_POST["CR_att"] . "\" "); } ?>/>
						<label for="CR_att">Carriers</label>
					</td>
					<td>
						<input type="checkbox" id="Admiral_CR_att" name="Admiral_CR_att"
						<? if ($_POST["Admiral_CR_att"]) { echo("checked "); } ?>/>
						<label for="Admiral_CR_att">Admiral</label>
					</td>
					<td>
						<input type="text" id="CR_def" name="CR_def" size="4"
						<? if ($_POST["CR_def"]) { echo("value=\"" . $_POST["CR_def"] . "\" "); } ?>/>
						<label for="CR_def">Carriers</label>
					</td>
					<td>
						<input type="checkbox" id="Admiral_CR_def" name="Admiral_CR_def"
						<? if ($_POST["Admiral_CR_def"]) { echo("checked "); } ?>/>
						<label for="Admiral_CR_def">Admiral</label>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="text" id="FF_att" name="FF_att" size="4"
						<? if ($_POST["FF_att"]) { echo("value=\"" . $_POST["FF_att"] . "\" "); } ?>/>
						<label for="FF_att">Fighters</label>
					</td>
					<td colspan="2">
						<input type="text" id="FF_def" name="FF_def" size="4"
						<? if ($_POST["FF_def"]) { echo("value=\"" . $_POST["FF_def"] . "\" "); } ?>/>
						<label for="FF_def">Fighters</label>
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" id="MU_att" name="MU_att" size="4"
						<? if ($_POST["MU_att"]) { echo("value=\"" . $_POST["MU_att"] . "\" "); } ?>/>
						<label for="MU_att">Mechanized Units</label><br />
						<input type="text" id="ST_att" name="ST_att" size="4"
						<? if ($_POST["ST_att"]) { echo("value=\"" . $_POST["ST_att"] . "\" "); } ?>/>
						<label for="ST_att">Shock Troops</label><br />
						<input type="text" id="GF_att" name="GF_att" size="4"
						<? if ($_POST["GF_att"]) { echo("value=\"" . $_POST["GF_att"] . "\" "); } ?>/>
						<label for="GF_att">Ground Forces</label>
					</td>
					<td>
						<input type="checkbox" id="General_att" name="General_att"
						<? if ($_POST["General_att"]) { echo("checked "); } ?>/>
						<label for="General_att">General</label>
					</td>
					<td>
						<input type="text" id="MU_def" name="MU_def" size="4"
						<? if ($_POST["MU_def"]) { echo("value=\"" . $_POST["MU_def"] . "\" "); } ?>/>
						<label for="MU_def">Mechanized Units</label><br />
						<input type="text" id="ST_def" name="ST_def" size="4"
						<? if ($_POST["ST_def"]) { echo("value=\"" . $_POST["ST_def"] . "\" "); } ?>/>
						<label for="ST_def">Shock Troops</label><br />
						<input type="text" id="GF_def" name="GF_def" size="4"
						<? if ($_POST["GF_def"]) { echo("value=\"" . $_POST["GF_def"] . "\" "); } ?>/>
						<label for="GF_def">Ground Forces</label>
					</td>
					<td>
						<input type="checkbox" id="General_def" name="General_def"
						<? if ($_POST["General_def"]) { echo("checked "); } ?>/>
						<label for="General_def">General</label>
					</td>
				</tr>
			</table>
			<input type="submit" id="submit" name="submit" value="Simulate" />
			<!--
			<h3>Techs</h3>
			<table>
				<tr>
					<th colspan="2" class="attacker">Attacker</th>
					<th colspan="2" class="defender">Defender</th>
				</tr>
				<tr>
					<th colspan="4">PDS Techs</th>
				</tr>
				<tr>
					<td>
						<input type="checkbox" id="Graviton_att" name="Graviton_att"
						<? if ($_POST["Graviton_att"]) { echo("checked "); } ?>/>
						<label for="Graviton_att" class="yellow_tech">Graviton Laser System</label>
					</td>
					<td>
						<input type="checkbox" id="Magen_att" name="Magen_att"
						<? if ($_POST["Magen_att"]) { echo("checked "); } ?>/>
						<label for="Magen_att" class="red_tech">Magen Defense Grid</label>
					</td>
					<td>
						<input type="checkbox" id="Maneuvering_def" name="Maneuvering_def"
						<? if ($_POST["Maneuvering_def"]) { echo("checked "); } ?>/>
						<label for="Maneuvering_def" class="blue_tech">Maneuvering Jets</label>
					</td>
					<td />
				</tr>
				<tr>
					<th colspan="4">Pre-Combat Techs</th>
				</tr>
				<tr>
					<td><input type="checkbox" id="Assault_att" name="Assault_att" /> <label for="Assault_att" class="red_tech">Assault Cannon</label></td>
					<td><input type="checkbox" id="ADT_att" name="ADT_att" /> <label for="ADT_att" class="red_tech">Automated Defense Turrets</label></td>
					<td><input type="checkbox" id="Assault_def" name="Assault_def" /> <label for="Assault_def" class="red_tech">Assault Cannon</label></td>
					<td />
				</tr>
				<tr>
					<th colspan="4">Space Techs</th>
				</tr>
				<tr>
					<td><input type="checkbox" id="Hylar_V_att" name="Hylar_V_att" /> <label for="Hylar_V_att" class="red_tech">Hylar V Assault Laser</label></td>
					<td><input type="checkbox" id="Cybernetics_att" name="Cybernetics_att" /> <label for="Cybernetics_att" class="green_tech">Cybernetics</label></td>
					<td><input type="checkbox" id="Hylar_V_def" name="Hylar_V_def" /> <label for="Hylar_V_def" class="red_tech">Hylar V Assault Laser</label></td>
					<td><input type="checkbox" id="Cybernetics_def" name="Cybernetics_def" /> <label for="Cybernetics_def" class="green_tech">Cybernetics</label></td>
				</tr>
				<tr>
					<td><input type="checkbox" id="Duranium_att" name="Duranium_att" /> <label for="Duranium_att" class="red_tech">Duranium Armor</label></td>
					<td><input type="checkbox" id="AF_att" name="AF_att" /> <label for="AF_att" class="blue_tech">Advanced Fighters</label></td>
					<td><input type="checkbox" id="Duranium_def" name="Duranium_def" /> <label for="Duranium_def" class="red_tech">Duranium Armor</label></td>
					<td><input type="checkbox" id="AF_def" name="AF_def" /> <label for="AF_def" class="blue_tech">Advanced Fighters</label></td>
				</tr>
				<tr>
					<th colspan="4">Ground Force Techs</th>
				</tr>
				<tr>
					<td><input type="checkbox" id="Gen_Synth_att" name="Gen_Synth_att" /> <label for="Gen_Synth_att" class="green_tech">Gen Synthesis</label></td>
					<td><input type="checkbox" id="Graviton_att" name="Graviton_att" /> <label for="Graviton_att" class="red_tech">Graviton Negator</label></td>
					<td><input type="checkbox" id="Gen_Synth_def" name="Gen_Synth_def" /> 	<label for="Gen_Synth_def" class="green_tech">Gen Synthesis</label></td>
					<td />
				</tr>
			</table>
			<input type="submit" id="submit" name="submit" value="Simulate" />
			-->
			<!--
			<h3>Races</h3>
			<table>
				<tr>
					<th class="attacker">Attacker</th>
					<th class="defender">Defender</th>
				</tr>
				<tr>
					<td>
						<input type="radio" id="att_Xxcha" name="Race_att" value="Xxcha" />
						<label for="att_Xxcha">Xxcha</label><br />
						<input type="radio" id="att_Norr" name="Race_att" value="Norr" />
						<label for="att_Norr">N'orr</label><br />
						<input type="radio" id="att_JolNar" name="Race_att" value="JolNar" />
						<label for="att_JolNar">Jol-Nar</label>
					</td>
					<td>
						<input type="radio" id="def_Xxcha" name="Race_def" value="Xxcha" />
						<label for="def_Xxcha">Xxcha</label><br />
						<input type="radio" id="def_Norr" name="Race_def" value="Norr" />
						<label for="def_Norr">N'orr</label><br />
						<input type="radio" id="def_JolNar" name="Race_def" value="JolNar" />
						<label for="def_JolNar">Jol-Nar</label>
					</td>
				</tr>
			</table>
			-->
			<!--
			<h3>Special Circumstances</h3>
			<ul>
				<li><input type="checkbox" id="Home_Planet" name="Home_Planet" /> <label for="Home_Planet">Defender's Home System</label></li>
				<li><input type="checkbox" id="Ion_Storm" name="Ion_Storm" /> <label for="Ion_Storm">Ion Storm</label></li>
				<li><input type="checkbox" id="Nebula" name="Nebula" /> <label for="Nebula">Nebula</label></li>
				<li><input type="checkbox" id="Shock_Troops" name="Shock_Troops" /> <label for="Shock_Troops">Shock Troops</label></li>
			</ul>
			<input type="submit" id="submit" name="submit" value="Simulate" />
			-->
		</form>
		<? // require("text_contents.php"); ?>
	</body>
</html>