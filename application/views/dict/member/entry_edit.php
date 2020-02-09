<div class="w3-container">
    <?php echo anchor('dict/show/'.$row['id'], 'Back', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
    <?php echo anchor('member/entry_edit/'.$row['id'].'/'.$row['id'], 'Edit', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
</div>
