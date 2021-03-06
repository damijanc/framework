<?php require('../includes/header.inc.php'); ?>
<?php $this->RenderBegin(); ?>

<div id="instructions">
	<h1>Using the QCheckBoxColumn</h1>

	<p>In this example we will take our Paginated <strong>QDataGrid</strong>, and add a column which has a
	"Select" checkbox.  Sound familiar? Yep, <a href="select.php">the last example </a> achieved 
	the same goal by creating checkbox controls on the fly. Well, this time, we're going to do it 
	using a simpler method. This time around we're using the <strong>QCheckBoxColumn</strong>, and letting 
	it do the heavy lifting for us.	:)</p>

	<p>So instead of having to create the checkboxes ourselves, and loop through child controls,
	we just create the QCheckBoxColumn, and we can use the column's <strong>GetSelectedItems()</strong> function 
	to get the list of selected people to fill the label with. Note that the column itself doesn't know
	what object type the items in it are, so you need to pass the class name to the
	<strong>GetSelectedItems</strong> function.<p>

	<p>In the previous example, we triggered a server hit everytime a checkbox was clicked. Our first 
	datagrid replicates this by specifying a callback for when the checkbox is rendered
	and then adding an action to each checkbox, but usually you will want to wait until a seperate save 
	button to be hit in order to reduce server activity. It is also a good idea to avoid click acitons
	on a QCheckBoxColumn because it is impossible to add an action to the Select All checkbox.</p>

	<hr>

	<p>The second example is a much more practical example. In this case, we're displaying a 
	many-to-many relationship and allowing the user to select a Project that should be associated with 
	the current one (in this case, ACME Website Redesign). This is exactly what the MetaControls do for
	association tables.</p>

	<p>First, we once again create the <strong>QCheckBoxColumn</strong>, and again we call
	<strong>SetCheckboxCallback</strong>, but this time it's in order to allow us to set the initial state of 
	the checkbox based on if an association already exists. The most efficient way to get this 
	information is by setting a <strong>virtual attribute</strong> as part of the bind function, as shown.</p>

	<p>Finally, we'll want to act on the changed checkboxes once the user clicks Go. To do so,
	instead of calling <strong>GetSelectedItems</strong> like we did before, we want to call 
	<strong>GetChangedIds</strong>. The reason for this is that there may be associated items on later pages
	that never had checkboxes created for them. And those items won't show up on a simple list of
	selected checkboxes, but we don't want to accidently unassociate their related items. It's also
	nice that the QCheckBoxColumn takes care of figuring out which items have been <strong>deselected</strong>
	for us as well.</p>

	<p>Once we have those changed item's Ids, we can do what we'd like with them. In this example
	we just output them to the user via javascript alerts. When the <strong>MetaControls</strong> do this
	for association tables, they actually perform the described associations.

	<p>Finally, you should note that using a QCheckBoxColumn requires that the databound object's
	primary key be a single column named Id.</p>
</div>

<div id="demoZone">
	<p><?php $this->lblResponse->Render(); ?></p>
	<?php $this->dtgPersons->Render(); ?>

	<hr />

	<h2>Child Projects of ACME Website Redesign</h2>
	<?php $this->dtgProjects->Render(); ?>
	<?php $this->btnGo->Render(); ?>
</div>

<?php $this->RenderEnd(); ?>
<?php require('../includes/footer.inc.php'); ?>