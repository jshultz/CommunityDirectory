<?php echo $map['javascript']; ?>
<div id="map_canvas" class="span-8" style="float:right; height:400px;"><?php echo $map['mapdiv']; ?></div> 

 <h2>Your Business in Jerome</h2> 

<?php if(isset($business) && count($business)) : foreach ($business->result() as $row): ?>
            
                <h2><?=$row->busname?></h2>
                <p><?=$row->busaddress?><br />
               <?=$row->buscity?><br />
                <?=$row->buszip?><br />
                <?=$row->busphone?></p>
                <p><?=$row->description?></p>
            
        <?php endforeach; ?>
        
        <?php else: ?>
            
            <p class="notice">You have not chosen a business. Please go back and try again.</p>
            
        <?php endif;?>
        
        <div id="specials" class="span-15">
    <h2>Specials</h2>
		<?php $results = $specials->result(); 
		if (count($results)) :
		foreach($results as $row): ?>
                
                    <h3><?=$row->specname?></h3>
                    <p><?=$row->specdesc?></p>
                
			<?php endforeach; else: ?>
			<div id="blank_gallery">No Specials have been added!</div>
        <?php endif; ?>
    </div>
        
		
    <div id="gallery" class="span-17">
    <h2>Photo Gallery</h2>
		<?php $results = $photos->result(); 
		 if (count($results)): 
			foreach($results as $row): ?>
                <div class="thumb">
                    <a href="<?=$row->fullsize ?>" rel="example1">
                    <img src="<?=$row->thumb ?>" />
                    </a>
                </div>
			<?php endforeach; else: ?>
			<div id="blank_gallery">No Videos have been uploaded!</div>
        <?php endif; ?>
    </div>
        
        
<div id="video" class="span-17">
    <h2>Video</h2>

<?php $results = $video->result();
	if (count($results)):
	foreach($results as $row): ?>

    <object width="480" height="385"><param name="movie" value="http://www.youtube.com/v/<?php echo ($row->link); ?>&hl=en_US&fs=1&"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/<?php echo ($row->link); ?>&hl=en_US&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></embed></object>

    <?php endforeach; else: ?>
			<div id="blank_gallery">No Images have been uploaded!</div>
        <?php endif; ?>
    
</div>

<div id="comments" class="span-17">
<div id="disqus_thread"></div>
<script type="text/javascript">
  /**
    * var disqus_identifier; [Optional but recommended: Define a unique identifier (e.g. post id or slug) for this thread] 
    */
  (function() {
   var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
   dsq.src = 'http://welcometosedonaarizona.disqus.com/embed.js';
   (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
  })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript=welcometosedonaarizona">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>

</div>

<script type="text/javascript">
			$(document).ready(function(){
				$("a[rel='example1']").colorbox({transition:"fade",slideshow:false});
				});
		</script>