<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="w3-container w3-center">
    <h1 class="">Azarstar</h1>
    <h2>Azerbaijani dictionaries and language tools</h2>
    <div>
        <?php
        echo form_open('dict/search');
        ?>
        <input class="w3-input w3-border w3-round w3-sand" style="width: 600px; display: inline-block;" type="text" name="q" placeholder="Search..">
        <input class="w3-button w3-border" type="submit" value="Search">
        </form>
    </div>
    <?php
    foreach ($items as $row):
        ?>
        <div class="w3-row">
            <div class="w3-container">
                <h2 class="w3-text-teal"><?php echo anchor('dict/show/' . $row['id'], $row['title'], 'class="w3-btn"') ?></h2>
                <p><?php echo $row['description'] ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>