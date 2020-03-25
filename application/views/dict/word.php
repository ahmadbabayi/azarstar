<div class="w3-container">
    <div class="w3-left w3-margin-top w3-margin-left">
        <h1 class="w3-border w3-padding"><?php echo $row['title']; ?></h1>
        <div>
            <?php if ($pre>0) {echo anchor('dict/soz/'.$pre, 'Previus word','class="w3-button  w3-gray"');} ?>
            <?php if ($next>0) {echo anchor('dict/soz/'.$next, 'Next word','class="w3-button  w3-gray"');} ?>
        </div>
        <h2><?php echo $row['word']; ?></h2><?php echo $row['pronun']; ?>
        <div class="w3-bar" style="direction: <?php echo substr($row['direction'], 4); ?>;">
            <?php echo $row['body']; ?>
        </div>
    </div>
</div>