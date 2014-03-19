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