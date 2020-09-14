<div class="w3-container">
    <?php echo anchor('dict/word/' . $row['id'], 'Back', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
    <?php echo anchor('member/entryremove/' . $dict_id . '/' . $row['id'], 'Delete entry', 'class="w3-button w3-section w3-teal w3-ripple" onclick="return confirm(\'Are you sure you want to delete this entry?\');"') ?>
    <?php echo anchor('member/entry/' . $dict_id, 'Add new entry', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
    <header class="w3-container w3-border w3-dark-grey w3-text-white">
        <h1>Edit entry</h1>
    </header>
    <div>
            <?php if ($pre['id']>0) {echo anchor('member/entry_edit/'.$dict_id.'/'.$pre['id'], $pre['word'],'class="w3-button  w3-gray"');} ?> < &nbsp;&nbsp;>
            <?php if ($next['id']>0) {echo anchor('member/entry_edit/'.$dict_id.'/'.$next['id'], $next['word'],'class="w3-button  w3-gray"');} ?>
        </div>
    <script src="<?php echo base_url('cssjs/ckeditor/ckeditor.js'); ?>"></script>
    <div class="w3-container w3-margin-top w3-xlarge">

        <?php
        echo validation_errors();
        echo form_open('', 'class="w3-container w3-card-4"');
        if (!empty($errormatn)) {
            echo $errormatn;
        }
        ?>
        <input type="hidden" name="dict_id" value="<?php echo $dict_id; ?>">
        <p><label>word</label>
            <input class="w3-input w3-border" name="word" value="<?php echo $row['word']; ?>" type="text" required>
        </p>
        <p><label>Pronuncition</label>
            <input class="w3-input w3-border" name="pronun" value="<?php echo $row['pronun']; ?>" type="text">
        </p>

        <p><label>Etymology</label>
            <textarea id="etymology" class="w3-input w3-border" name="etymology"><?php echo $row['body']; ?></textarea>

            <script>
                CKEDITOR.replace('etymology', {
                    language: 'az'
                });
                CKEDITOR.addCss("body {font-size: 16px; direction: <?php echo substr($dict['direction'], 4); ?>;}");
                CKEDITOR.config.autoParagraph = false;
                CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
                CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_BR;
            </script>
        </p>

        <p>
            <input type="submit" class="w3-button w3-section w3-teal w3-ripple" value="edit"></p>

        </form>
    </div>
</div>