  <!DOCTYPE html>
           
        <div class="vote">
          <?php $like = $PVPR["nbPV"]; $dislike = $PVPR["nbPR"]; ?>
          <div class="vote_bar">
            <div class="vote_progress" style="width:<?php if($like==0 && $dislike==0){echo 0;} else{ echo 100*($like/($like+$dislike));} ?>%" >
              
            </div>
          </div>
          
          <div class="vote_btns">
            <form action="Main.php?mot=<?php echo $_GET['mot']?>&pays=<?php echo $_GET['pays']?>&trad=<?php echo $PVPR["idT"];?>&vote=value" method="POST">
              <button type="submit" class="vote_btn vote_like" name="value" value='+1' >
              <i class="fa fa-thumbs-up"></i> <?php echo $like; ?></button>
            </form>
            <form action="Main.php?mot=<?php echo $_GET['mot']?>&pays=<?php echo $_GET['pays']?>&trad=<?php echo $PVPR["idT"];?>&vote=value" method="POST">
              <button type="submit" class="vote_btn vote_dislike" name="value" value='-1'>
              <i class="fa fa-thumbs-down"></i> <?php echo $dislike; ?></button>
            </form>
          </div>
        </div>