<?php $busid = $bus_id['id']; ?>
<?php $userid = $user_id['id']; ?>
<h2>Client Control Panel</h2> 
   <h3>"America's Most Vertical City" and "Largest Ghost Town in America"</h3> 

   <?php foreach ($cbusiness->result() as $row): ?>
   <p>You are logged in as <strong><?=$username?></strong> for <strong><?=$row->busname?></strong>.</p>
      <?php endforeach; ?>
      <p>What would you like to do?</p>
<p class="fileupload"><a href="/client/gallery/<?=$userid ?>">Upload Photos</a></p>

<p class="profile"><a href="/client/profile/<?=$userid ?>">Update Profile</a></p>

<p class="specials"><a href="/client/specials/<?=$userid ?>">Update Specials</a></p>

<p class="video"><a href="/client/video/<?=$userid ?>">Update Video</a></p>
		<h2>Your Specials</h2>
    <div id="gallery">
		<?php if (isset($specials) && count($specials)): 
			foreach($specials->result() as $specials): ?>
                <label>Name</label> <?=$specials->specname?><br />
                <label>Description</label> <?=$specials->specdesc?><br />

                
			<?php endforeach; else: ?>

        <?php endif; ?>
        </div>
        
       <h2>Update Your Specials?</h2>
       <p class="notice">To add a special to your site simply fill in the Name of the special and the Description of the special in the fields below.</p>
       
       <?=form_open('client/specupdate'); ?>
       <?=form_hidden('userid', $userid); ?>
       <input type="hidden" name="busid" value="<?=$busid; ?>" /> 
	   <?=form_fieldset('Update your Specials'); ?>
       
       <p><?=form_label('Name', 'name')?>
	   <?=form_input('name', 'Enter The Name'); ?></p>
       
       <p><?=form_label('Description', 'description')?>
	   <?=form_input('description', 'Enter The Description'); ?></p>
	   
	   <?=form_submit('submit','Update Special'); ?>
	   <?=form_fieldset_close(); ?>
	   <?=form_close(); ?>
	   
       <?php echo validation_errors('<p class="error">'); ?>