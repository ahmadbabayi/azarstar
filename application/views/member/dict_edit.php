<div class="w3-container">
    <?php echo anchor('dict/luget/'.$row['title'].'/'. $row['id'], 'Back', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
    <header class="w3-container w3-border">
        <h1><?php echo $row['title']; ?></h1>
    </header>
    <script src="<?php echo base_url('cssjs/ckeditor/ckeditor.js'); ?>"></script>
    <div class="w3-margin-top">

        <?php
        echo validation_errors();
        echo form_open('', 'class="w3-container w3-card-4"');
        if (!empty($errormatn)) {
            echo $errormatn;
        }
        ?>
        <input type="submit" class="w3-button w3-section w3-teal w3-ripple" value="save">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <p><label>Dictionary name</label>
            <input class="w3-input w3-border" style="text-align:left; direction: <?php echo substr($row['direction'], 4); ?>" name="title" type="text" value="<?php echo $row['title']; ?>" required>
        </p>
        <p><label>Author</label>
            <input class="w3-input w3-border" style="text-align:left; direction: <?php echo substr($row['direction'], 4); ?>" name="author" type="text" value="<?php echo $row['author']; ?>">
        </p>

        <p><label>Thanks</label>
            <input class="w3-input w3-border" style="text-align:left; direction: <?php echo substr($row['direction'], 4); ?>" name="thanks" type="text" value="<?php echo $row2['thanks']; ?>">
        </p>

        <p><label>Direction</label>
            <select class="w3-select" name="direction">
                <option><?php echo $row['direction']; ?></option>
                <option>ltr2ltr</option>
                <option>ltr2rtl</option>
                <option>rtl2rtl</option>
                <option>rtl2ltr</option>
            </select>
        </p>

        <p><label>Description</label>
            <input class="w3-input w3-border" style="text-align:left; direction: <?php echo substr($row['direction'], 4); ?>" name="description" type="text" value="<?php echo $row['description']; ?>">
        </p>

        <p><label>Alphabet</label>
            <textarea class="w3-input w3-border" name="alphabet"><?php echo $row['alphabet']; ?></textarea>
        </p>

        <p><label>‌Book identity</label>
            <textarea id="identity" class="w3-input w3-border" name="identity"><?php echo $row2['identity']; ?></textarea>
            <script>
                CKEDITOR.replace('identity', {
                    language: 'az'
                });
                CKEDITOR.addCss("body {font-family: 'Tahoma'; font-size: 18px; direction: <?php echo substr($row['direction'], 4); ?>;}");
                CKEDITOR.config.autoParagraph = false;
                CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
                CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_BR;
            </script>
        </p>
        
        <p><label>‌Book identity 2</label>
            <textarea id="identity2" class="w3-input w3-border" name="identity2"><?php echo $row2['identity2']; ?></textarea>
            <script>
                CKEDITOR.replace('identity2', {
                    language: 'az'
                });
                CKEDITOR.addCss("body {font-family: 'Tahoma'; font-size: 18px; direction: <?php echo substr($row['direction'], 4); ?>;}");
                CKEDITOR.config.autoParagraph = false;
                CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
                CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_BR;
            </script>
        </p>

        <p><label>Premble</label>
            <textarea class="w3-input w3-border" name="preamble"><?php echo $row2['preamble']; ?></textarea>
            <script>
                CKEDITOR.replace('preamble', {
                    language: 'az'
                });
                CKEDITOR.addCss("font-family: 'Tahoma'; font-size: 18px; direction: <?php echo substr($row['direction'], 4); ?>;}");
                CKEDITOR.config.autoParagraph = false;
                CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
                CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_BR;
            </script>
        </p>

        <input type="submit" class="w3-button w3-section w3-teal w3-ripple" value="save">

        </form>
    </div>
</div>