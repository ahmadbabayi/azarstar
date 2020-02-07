<div class="w3-container">
    <?php echo anchor('dict/show/' . $dict_id, 'Back', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
    <header class="w3-container w3-border w3-dark-grey w3-text-white">
        <h1>New entry</h1>
    </header>
    <script src="<?php echo base_url('cssjs/ckeditor/ckeditor.js'); ?>"></script>
    <div class="w3-container w3-margin-top">

        <?php
        echo validation_errors();
        echo form_open('', 'class="w3-container w3-card-4"');
        if (!empty($errormatn)) {
            echo $errormatn;
        }
        ?>
        <input type="hidden" name="dict_id" value="<?php echo $dict_id; ?>">
        <p><label>word</label>
            <input class="w3-input w3-border" name="word" type="text" required>
        </p>
        <p><label>Pronuncition</label>
            <input class="w3-input w3-border" name="pronun" type="text">
        </p>

        <p><label>Etymology</label>
            <textarea class="w3-input w3-border" name="etymology"></textarea>
        </p>

        <p>
            <input type="submit" class="w3-button w3-section w3-teal w3-ripple" value="insert"></p>
        <script>
                CKEDITOR.replace('etymology', {
                    language: 'az'
                });
                CKEDITOR.addCss("body {font-size: 16px; direction: <?php echo substr($dict['direction'], 4); ?>;}");
                CKEDITOR.config.autoParagraph = false;
                CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
                CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_BR;
            </script>

        </form>
    </div>
    <br>
    <div class="w3-container w3-margin-top w3-border">
        <h1>Last word:</h1>
        <?php echo anchor('member/entry_edit/' . $dict_id . '/' . $row['id'], 'Edit', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
        <h2><?php echo $row['word']; ?>: </h2>

        <p>
            <?php echo htmlspecialchars_decode($row['body']); ?>
        </p>
    </div>
</div>