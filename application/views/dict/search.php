<div class="w3-container">
    <h1><?php echo $dict_title; ?></h1>

    <div class="w3-container">
            <?php
            foreach ($items as $row):
                ?>
            <?php echo anchor('dict/soz/'.$row['id'].'/'. filter_url($row['word']), $row['word'], 'class="w3-bar w3-xlarge"');?>
            <?php endforeach; ?>
    </div>
</div>