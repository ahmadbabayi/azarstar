<div class="w3-container">
    <header class="w3-container w3-border w3-dark-grey w3-text-white">
  <h1><?php echo $row['title']; ?></h1>
</header>
    <div class="w3-container w3-display-topright">
        <?php
        echo form_open('dict/search/'.$row['id']);
        ?>
        <input type="hidden" name="dict_id" value="<?php echo $row['id']; ?>">
        <input class="w3-input w3-border w3-round w3-sand" style="width: 160px; display: inline-block;" type="text" name="q" placeholder="Search..">
        <input class="w3-button w3-border" type="submit" value="Search">
        </form>
    </div>
    <div class="w3-mobile w3-light-grey">
        <?php
        $alphabet = explode(' ', $row['alphabet']);
        foreach ($alphabet as $value) {
            echo '<a href="' . base_url('/dict/char/' . $row['id'] . '/' . $value) . '" class="w3-bar-item w3-button">' . $value . '</a>';
        }
        ?>
    </div>
    <div class="w3-left w3-margin-top">
        <div class="w3-bar w3-border">
            <?php echo $pagination; ?>
        </div>
    </div>
    <div class="w3-container">
            <?php
            foreach ($items as $row):
                ?>
            <?php echo anchor('dict/soz/'.$row['id'].'/'. $row['word'], $row['word'], 'class="w3-bar w3-xlarge"');?>
            <?php endforeach; ?>
    </div>
    <div class="w3-center">
        <div class="w3-bar w3-border">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>

