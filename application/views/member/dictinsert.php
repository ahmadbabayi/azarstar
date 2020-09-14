<div class="w3-container">
    <?php echo anchor('', 'Back', 'class="w3-button w3-section w3-teal w3-ripple"') ?>

<header class="w3-container w3-border">
  <h1>New dictionary</h1>
</header>
<div class="w3-cell w3-margin-top">
    
    <?php
    echo validation_errors();
    echo form_open('','class="w3-container w3-card-4"');
    if (!empty($errormatn))
    {
        echo $errormatn;
    }
    ?>
<p><label>Dictionary name</label>
    <input class="w3-input w3-border" name="title" type="text" required>
</p>
<p><label>Author</label>
    <input class="w3-input w3-border" name="author" type="text">
</p>

<p><label>Direction</label>
    <select class="w3-select" name="direction">
        <option>ltr2ltr</option>
        <option>ltr2rtl</option>
        <option>rtl2rtl</option>
        <option>rtl2ltr</option>
    </select>
</p>

<p><label>Description</label>
    <input class="w3-input w3-border" name="description" type="text">
</p>

<p><label>Alphabet</label>
    <textarea class="w3-input w3-border" name="alphabet"></textarea>
</p>


<p>
    <button class="w3-button w3-section w3-teal w3-ripple" type="submit"> insert </button></p>

</form>
</div>
</div>