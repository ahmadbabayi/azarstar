<div class="w3-container">
    <h1>Azerbaijan Latin alphabet to Arab alphabet convertor</h1>
<?php echo validation_errors(); 
echo form_open('','id="form1"');
?>
    <textarea style="font-size: 16px; width: 90%; height: 300px;" placeholder="text in latin max 5000 characters" name="latin" maxlength="5000"><?php echo $memo1; ?></textarea><br><br>
</form>
<button onclick="submitform()">convert</button> &nbsp;&nbsp;&nbsp;
<?php
if ($login) {
    echo '<button onclick="openmenu()">Add word</button>';
}
 else {
    echo '<button onclick="alert(\'you must login!\')">Add word</button>';
}
?>
<span><?php echo ' - '.$wordcount.' words';  ?></span>
<br><br>
<textarea style="font-size: 16px; width: 90%; height: 300px; direction: rtl;" id="arabtext" name="arab"><?php echo $memo2; ?></textarea><br><br>
<button onclick="selecttext('arabtext')">copy text</button>
</div>