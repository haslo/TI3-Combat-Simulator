<h2>Simulator Internals</h2>
<p>These are the default simulator settings, please <a href="mailto:haslo@haslo.ch">contact me</a> if you disagree with any of them and I'll see what I can do.</p>
<h3>Unit Distributions</h3>
<ul>
	<li>MUs, STs and GFs are put together, in this order, on one War Sun (preferrably) or Carrier (if not enough War Suns are present). This will ensure more "buffer" hit assignable to as many empty carriers as possible while keeping an invasion force after Fighters are down.</li>
	<li>Generals are placed with the strongest ground invasion force. Like this, they'll die last, too.</li>
</ul>
<h3>Casualty Order</h3>
<ul>
	<li>
		Casualties in space combat are removed in the following order:<br />
		<strong>Sustain Damage with CS > Sustain Damage with DN > Sustain Damage with WS > Empty Carriers > Fighters > Destroyers > Cruisers > Dreadnoughts > Full Carriers > War Suns</strong>
	</li>
	<li>
		Casualties during bombardments are removed in the following order:<br />
		<strong>Ground Forces until there's only 1 > Shock Troops > last Ground Force</strong>
	</li>
	<li>
		Casualties in invasion combat are removed in the following order:<br />
		<strong>Sustain Damage with MU > Fighters from Graviton Negator > Shock Troops > Ground Forces > Mechanized Units</strong>
	</li>
</ul>
<h3>Pre-Combat Sequence Order</h3>
<ul>
	<li>
		As per FAQ 2.3, the pre-combat sequence order is as follows (and all the other pre-combat effects are ignored):<br />
		<strong>AFB > Assault Cannon</strong>
	</li>
</ul>
<h3>Algorithm</h3>
<ul>
	<li>The simulator runs 10000 times for each given scenario, until one side has no units left. First, it does a space battle, then a bombardment (assuming there's only one planet to invade) and then ground combat (again assuming just one planet).</li>
</ul>
<h3>ToDo</h3>
<ul>
	<li>Add Techs</li>
	<li>Add Race Modifiers</li>
	<li>Add Special Circumstances (Ion Storms, Nebulas, Home Systems)</li>
	<li>Add Race-Specific Tech</li>
	<li>Add Mercenaries (with Evasion)</li>
	<li>Add all Flagships</li>
</ul>
<h3>Copyright</h3>
<p>&copy; 2011 Guido Gloor Modjib</p>
