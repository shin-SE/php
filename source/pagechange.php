<div class="pag_div">
<div class="pagination">
      <a href="?pageno=1" class="previous" style="display:inline">&nbsp;&laquo;&nbsp;最初&nbsp;</a>
      <div class="<?php if($pageno <= 1){ echo 'disabled'; } ?> " style="display:inline">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="previous round">&nbsp;&nbsp;&#8249;&nbsp;&nbsp;</a>
      </div>
      <div style="display:inline"><?php echo $pageno ?>ページ目/<?php echo $total_pages ?>ページ中 </div>
      <div class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>" style="display:inline">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>" class="next round">&nbsp;&nbsp;&#8250;&nbsp;&nbsp;</a>
      </div>
      <a href="?pageno=<?php echo $total_pages; ?>" class="next" style="display:inline">&nbsp;最後&nbsp;&raquo;&nbsp;</a>
</div>
</div>
