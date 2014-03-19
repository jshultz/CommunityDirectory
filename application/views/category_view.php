<h2>Welcome To Sedona Arizona, Arizona</h2> 
   
<p>Choose the Category of Business you are interested in:<br/> <?php foreach ($catList->result() as $row): ?>
            <a href="/site/categories/<?=$row->cid?>"><?=$row->catname?></a>, &nbsp;
            <?php endforeach; ?></p>

<?php foreach ($catpagename->result() as $row) : ?>
        <h3>You are currently viewing <?=$row->catname?></h3>
        <p><?=$row->catdesc?></p>
        <?php endforeach; ?>
        
<table id="businessTable" class="tablesorter span-17" style="clear:both;">
	<thead><tr><th>Business Name</th><th>Business Owner</th><th>Web</th><th>Photos</th><th>Videos</th><th>Specials</th></tr></thead>
		<?php if(count($businessList) > 0) : foreach ($businessList->result() as $crow): ?>

            <tr>
                <td><a href="/site/business/<?=$crow->id?>"><?=$crow->busname?></a></td>
                <td><?=$crow->busowner?></td>
                <td><a href="<?=$crow->webaddress?>">Visit Site</a></td>
                <td>
					<?php if(isset($crow->thumb)):?>
                    yes
                    <?php else:?>
                    no
                    <?php endif?>
                    
                </td>
                
                <td>
					<?php if(isset($crow->title)):?>
                    yes
                    <?php else:?>
                    no
                    <?php endif?>
                    
                
                </td>
                <td>
					<?php if(isset($crow->specname)):?>
                    yes
                    <?php else:?>
                    no
                    <?php endif?>
                    
                
                </td>
            </tr>
        <?php endforeach; ?>
        
        <?php else : ?>
        <td colspan="4"><p>No Category Selected</p></td>
        
        <?php endif; ?>

</table>