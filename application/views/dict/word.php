<div class="w3-container">
    <div class="w3-left w3-margin-top w3-margin-left">
        <h1 class="w3-border w3-padding"><?php echo $row['title']; ?></h1>
        <div>
            <?php if ($pre['id']>0) {echo anchor('dict/soz/'.$pre['id'].'/'.filter_url($pre['word']), $pre['word'],'class="w3-button  w3-gray"');} ?> < &nbsp;&nbsp;>
            <?php if ($next['id']>0) {echo anchor('dict/soz/'.$next['id'].'/'.filter_url($next['word']), $next['word'],'class="w3-button  w3-gray"');} ?>
        </div>
        <h2><?php echo $row['word']; ?></h2><?php echo $row['pronun']; ?>
        <div class="w3-bar" style="direction: <?php echo substr($row['direction'], 4); ?>;">
            <?php echo $row['body']; ?>
        </div>
        <?php if(substr($row['direction'], 4) != 'rtl') { ?>
        <br>
        <div class="w3-bar" style="direction: rtl">
            <?php echo $memo2; ?>
        </div>
        <?php } ?>
    </div>
</div>