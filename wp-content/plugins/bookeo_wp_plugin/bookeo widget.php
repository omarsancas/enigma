<?php
$hwe_txtwidgetcode = isset($_REQUEST['txtwidgetcode']) ? $_REQUEST['txtwidgetcode'] : '';
if (isset($_REQUEST['sub'])) {
    update_option('hwe_txtwidgetcode', $hwe_txtwidgetcode);
}
$option = get_option("hwe_txtwidgetcode");
?>

<form name="myform" method="post">
    <h2>Bookeo Widget</h2>
    <table class="form-table">
        <tr>
            <th scope="row">
                <label for="txtwidgetcode">Widget Code</label>
            </th>
            <td>
                <input type="text" name="txtwidgetcode" id="txtwidgetcode" class="regular-text" size="40" value="<?php echo $option; ?>">
                <p class="description">By clicking the 'Save Changes' button below, you agree that the plugin will
                    display a 'powered by Bookeo' link in your page.</p>
            </td>
        </tr>
    </table>

    <p>
        <input type="submit" name="sub" value="Save Changes" class="button button-primary">
    </p>
</form>
