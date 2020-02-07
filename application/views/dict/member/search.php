<div class="w3-container">
<div class="w3-container">
    <?php echo anchor('member', 'Back', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
    <?php echo anchor('member/dict_edit/'.$row['id'], 'Dictionary details', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
    <?php echo anchor('member/latex/'.$row['id'], 'Download latex', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
    <?php echo anchor('member/entry/'.$row['id'], 'Add new entry', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
</div>
<header class="w3-container w3-border w3-dark-grey w3-text-white">
  <h1><?php echo $row['title']; ?></h1>
</header>
    <div class="w3-container">
        <?php
        echo form_open('member/search/'.$row['id']);
        ?>
        <input type="hidden" name="dict_id" value="<?php echo $row['id']; ?>">
        <input class="w3-input w3-border w3-round w3-sand" style="width: 160px; display: inline-block;" type="text" name="q" placeholder="Search..">
        <input class="w3-button w3-border" type="submit" value="Search">
        </form>
    </div>
    <div class="w3-container">
            <?php
            foreach ($items as $row):
                ?>
            <?php echo anchor('member/entry_edit/'.$row['dict_id'].'/'. $row['id'], $row['word'], 'class="w3-bar w3-xlarge"');?>
            <?php endforeach; ?>
    </div>
    </div>