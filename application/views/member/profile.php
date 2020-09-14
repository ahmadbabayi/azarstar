<div class="w3-container">
    <?php echo anchor('', 'Back', 'class="w3-button w3-section w3-teal w3-ripple"') ?>
    <?php
    echo validation_errors();
    echo form_open('member/profile');
    ?>
    <h1>Profile</h1>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <table>
        <tr>
            <td>Email: </td>
            <td><input type="text" name="email" required="" placeholder="Enter your email" value="<?php echo $row['email']; ?>"></td>
        </tr>
        <tr>
            <td>Password: </td>
            <td><input type="password" name="password" required="" placeholder="Enter your password"></td>
        </tr>
        <tr>
            <td>Confirm password: </td>
            <td><input type="password" name="password_confirm" required="" placeholder="Confirm your password"></td>
        </tr>
    </table>
    <div><input type="submit" value="Submit" /></div>
</form>
</div>