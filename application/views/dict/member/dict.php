<div class="w3-container">
    <?php echo anchor('', 'Back', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
    <?php echo anchor('member/dict_edit/'.$row['id'], 'Dictionary details', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
    <?php echo anchor('member/latex/'.$row['id'], 'Download latex', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
    <?php echo anchor('member/entry/'.$row['id'], 'Add new entry', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
</div>
