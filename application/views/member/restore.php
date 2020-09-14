<?php 
echo $error;
?>
<div class="w3-container">
<div class="w3-container">
    <?php echo anchor('', 'Back', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
</div>
<header class="w3-container w3-border w3-dark-grey w3-text-white">
  <h1>Restore database</h1>
</header>
    <div class="w3-container">
        <?php
        echo form_open_multipart('member/restore');
        ?>
        <input class="w3-input" id="fileupload" type="file" name="uploadfile">
        <input class="w3-button w3-border" type="submit" value="Restore">
        </form>
    </div>
    </div>