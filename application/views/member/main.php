<div class="w3-container">
    <div>
        <?php echo anchor('member/dictionaryadd', 'Creat new dictionary', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
        <?php echo anchor('member/restore', 'Restore database', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
        <?php echo anchor('member/backup', 'Backup database', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
        <?php echo anchor('member/profile', 'Profile', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
    </div>
    <?php
    foreach ($items as $row):
        ?>

            <div class="w3-container w3-border w3-margin-top w3-bar w3-button">
                <h1><?php echo anchor('member/dictionary/'.$row['id'],$row['title']) ?></h1>
            </div>

    <?php endforeach; ?>
</div>