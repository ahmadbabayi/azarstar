<div id="hiddenform" class="w3-display-middle w3-border w3-gray w3-padding" style="display: none;">
    <h2>Add new word!</h2>
    <?php
    echo form_open('');
    ?>
    <table>
        <tr>
            <td>Latin</td>
            <td><input id="hin1" type="text" name="latin" onkeypress="interfocus(event, 'hin2')"></td>
        </tr>
        <tr>
            <td>عرب الیفباسی</td>
            <td><input id="hin2" type="text" name="arab" onkeypress="interfocus(event, 'hin3')"></td>
        </tr>
    </table>
</form>
<div class="itemadd">
    <button id="hin4" onclick="closeform()">cancel</button>
    <button id="hin3" onclick="ajaxwordadd('<?php echo base_url();  ?>')">insert</button>
</div>
</div>
