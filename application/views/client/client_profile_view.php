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
		<h2>Your Business Profile</h2>
    <div id="gallery">
		<?php if (isset($business) && count($business)): 
			foreach($business->result() as $business): ?>
                <label>Business Name</label> <?=$business->busname?><br />
                <label>Business Owner</label> <?=$business->busowner?><br />
                <label>Street Address</label> <?=$business->busaddress?><br />
                <label>City</label> <?=$business->buscity?><br />
                <label>Zip</label> <?=$business->buszip?><br />
                <label>Phone</label> <?=$business->busphone?><br />
                <label>Web Address</label> <?=$business->webaddress?><br />
                <label>Category</label> <?=$business->category?><br />
                <label>Featured</label> <?=$business->featured?><br />
                <label>Description</label> <?=$business->description?><br />
                
			<?php endforeach; else: ?>

        <?php endif; ?>
        </div>
        
       <h2>Update Your Profile?</h2>
       
       <?=form_open('client/update'); ?>
       <?=form_hidden('userid', $user_id); ?>
       <input type="hidden" name="busid" value="<?=$busid; ?>" /> 
	   <?=form_fieldset('Update your business profile'); ?>
       
       <p><label>Business Name</label><input name="businessname" id="businessname" type="text" value="<?=$business->busname?>" /></p>
       
       <p><label>Business Owner</label><input name="owner" id="owner" type="text" value="<?=$business->busowner?>" /></p>
       
       <p><label>Business Address</label><input name="address" id="address" type="text" value="<?=$business->busaddress?>" /></p>
       
       <p><label>Business City</label><input name="city" id="city" type="text" value="<?=$business->buscity?>" /></p>
       
       <p><label>Business Zip</label><input name="zip" id="zip" type="text" value="<?=$business->buszip?>" /></p>
       
       <p><label>Business Phone</label><input name="phone" id="phone" type="text" value="<?=$business->busphone?>" /></p>
       
       <p><label>Business Web</label><input name="web" id="web" type="text" value="<?=$business->webaddress?>" /></p>

       <p><textarea name="description" cols="90" rows="12"><?=$business->description?></textarea></p>
       

       
       <p><?=form_label('Category', 'category')?><select name="category">
       
            <?php foreach ($categories->result() as $row): ?>
            <option value="<?=$row->cid?>" > <?=$row->cid?> - <?=$row->catname?></option>
            <?php endforeach; ?>
			</select></p>
	   
	   <?=form_submit('submit','Update Profile'); ?>
	   <?=form_fieldset_close(); ?>
	   <?=form_close(); ?>