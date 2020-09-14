<div class="w3-container">
    <h1><?php echo $row['title']; ?></h1>
    <div class="w3-bar w3-light-grey">
        <?php
        $alphabet = explode(' ', $row['alphabet']);
        foreach ($alphabet as $value) {
            echo '<a href="' . base_url('/dict/show/' . $row['id'] . '/0/' . $value) . '" class="w3-bar-item w3-button">' . $value . '</a>';
        }
        ?>
    </div>
    <?php
    foreach ($items as $row):
        ?>
        <div class="w3-row">
            <div class="w3-container">
                <h1 class="w3-button  w3-block w3-light-grey w3-border"><?php echo anchor('member/dictionary/' . $row['id'], $row['word_id']) ?></h1>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="w3-center">
        <div class="w3-bar w3-border">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>

