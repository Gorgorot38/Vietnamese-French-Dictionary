  <!DOCTYPE html>
           
         
        <!-- Le JS... -->
       	<div class="vote">
       		<?php $like = 0; $dislike = 0; ?>
       		<div class="vote_bar">
       			<div class="vote_progress" style="width:<?php if($like==0 && $dislike==0){echo 0;} else{ echo 100*($like/($like+$dislike));} ?>%" >
       				
       			</div>
       		</div>
       		
       		<div class="vote_btns">
       			<form action="like.php?ref=ref&idU=idU&vote=1" method="POST">
       				<button type="submit" class="vote_btn vote_like" >
       				<i class="fa fa-thumbs-up"></i> <?php echo $like; ?></button>
       			</form>
       			<form action="like.php?ref=ref&idU=idU&vote=1" method="POST">
       				<button type="submit" class="vote_btn vote_dislike">
       				<i class="fa fa-thumbs-down"></i> <?php echo $dislike; ?></button>
       			</form>
       		</div>
       	</div>