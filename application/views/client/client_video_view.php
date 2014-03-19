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
		<h2>Your Video</h2>
    <div id="gallery">
		<?php if (isset($videos) && count($videos)): 
			foreach($videos->result() as $videos): ?>
                <label>Video ID</label> <?=$videos->link?><br />

                
			<?php endforeach; else: ?>

        <?php endif; ?>
        </div>
        
       <h2>Update Your Video?</h2>
       <p class="notice">To add a video to your page it must already be on Youtube. Copy everything to the right of 'v=' in the URL and paste it below. For example: http://www.youtube.com/watch?v=DcpAEGA5aSM. You would copy DcpAEGA5aSM and paste it below.</p>
       
       <?=form_open('client/vidupdate'); ?>
       <?=form_hidden('userid', $user_id); ?>
       <input type="hidden" name="busid" value="<?=$busid; ?>" /> 
	   <?=form_fieldset('Update your Video ID'); ?>
       
       <p><?=form_label('Video ID', 'videoid')?>
	   <?=form_input('videoid', 'Enter Your Video ID'); ?></p>
	   
	   <?=form_submit('submit','Update Video'); ?>
	   <?=form_fieldset_close(); ?>
	   <?=form_close(); ?>
	   
       <?php echo validation_errors('<p class="error">'); ?>