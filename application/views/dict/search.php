<div class="w3-container">
    <ul class="w3-ul">
        <h3>
                <?php echo $dict_title; ?>
            </h3>
        <?php
        foreach ($items as $row):
            ?><li>
            <?php echo anchor('dict/word/' . $row['id'], $row['word']); ?></li>
        <?php endforeach; ?>
    </ul>
</div>

