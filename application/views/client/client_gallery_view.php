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

		<h2>Photo Gallery</h2>
    <div id="gallery">
		<?php if (isset($photos) && count($photos)): 
			foreach($photos->result() as $photo): ?>
                <div class="thumb">
                    <a href="<?=$photo->fullsize ?>">
                    <img src="<?=$photo->thumb ?>" />
                    </a>
                </div>
			<?php endforeach; else: ?>
			<div id="blank_gallery">No Images have been uploaded!</div>
        <?php endif; ?>
    </div>
	
	<div id="upload">
		<?php
		$redirect = current_url();
		echo form_open_multipart('/client/gallery_up/');
		echo form_hidden('redirect', $redirect);
		echo form_upload('userfile');
		echo form_submit('upload', 'Upload');
		echo form_close();
		?>		
	</div>
    
    <?php echo validation_errors('<p class="error">'); ?>