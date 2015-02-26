
<div style="padding-left: 30px;">
    <form onsubmit="before_submit();" id="add-group" name="form" method="post" action="<?php echo URL::abs('groups/add'); ?>">
        <br />
        name:  <input name="group_name" type="text" <?php HTML::post_value('group_name'); ?> /> <br /> <br />
        contact name: <input name="contact_name" type="text" <?php HTML::post_value('contact_name'); ?> /> <br /> <br />

        email: <input name="email" type="text" <?php HTML::post_value('email'); ?> /> <br /> <br />

        <div>
            <div id="other_emails"></div>
            <div> <input id="add_email" type="button" value="add email" /> </div>
        </div>
        <br />
        <!-- RENDER OTHER EMAIL -->

        phone <input name="phone" type="text" <?php HTML::post_value('phone'); ?> /> <br /> <br />

        country: <select name="country_id">

            <?php foreach ($countries as $key => $country): /* @var $country Country */ ?>

                <option <?php HTML::post_selected($key, 'country_id', $country->id); ?> >
                    <?php echo $country->country_name; ?>
                </option>

            <?php endforeach; ?>

        </select>
        <br /> <br />
        city: <input name="city" type="text" <?php HTML::post_value('city'); ?> /> <br /> <br />
        address: <input name="address" type="text" <?php HTML::post_value('address'); ?> /> <br /> <br />
        website: <input name="website" type="text" <?php HTML::post_value('website'); ?> /> <br /> <br />
        

        categories: <select name="category_id">

            <?php foreach ($categories as $key => $category): /* @var $category Category */ ?>

                <option <?php HTML::post_selected($key, 'category_id', $category->id); ?> >
                    <?php echo $category->category_name; ?>
                </option>

            <?php endforeach; ?>

        </select><br /> <br />
        comment: <textarea name="comment"><?php echo isset($_POST['comment']) ? $_POST['comment'] : ""; ?></textarea>
        <br /> <br />
        manager: <input name="manager" type="text" <?php HTML::post_value('manager'); ?> /> <br /> <br />
        <input id="other_emails_hidden_field" type="hidden" value="" name="other_emails" />
        <input type="submit" value="Save" />
    </form>

</div>

<script type="text/javascript">
    $(function () {
        $("#add_email").click(function () {
            add_new_email();
        });
    });
    
    var other_emails_json_string = '<?php echo isset($_POST['other_emails']) ? $_POST['other_emails'] : ""; ?>';

    var other_emails = other_emails_json_string ? JSON.parse(other_emails_json_string) : {};

    function before_submit() {
        $("#other_emails_hidden_field").val(JSON.stringify(other_emails));
    }

    function other_email_type(index, object) {
        other_emails[index] = object.value;
    }

    function add_new_email(value,key) {
        var index = random_string();
        var child = "";

        if(key){
            delete other_emails[key];
            other_emails[index] = value ? value : "";
        }        

        child += '<div id="other_email_' + index + '">';
        child += '<input onkeyup="other_email_type(\'' + index + '\',this);" value="' + (value ? value : '') + '" />';
        child += '<input type="button" value="remove" onclick="remove_by_index(\'' + index + '\');" />';
        child += "";
        child += "</div>";

        $("#other_emails").append(child);
    }

    function remove_by_index(index) {
        $("#other_email_" + index).remove();
        delete other_emails[index];
    }


    function random_string(n) {
        if (!n) {
            n = 5;
        }
        var text = '';
        var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        for (var i = 0; i < n; i++) {
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        }

        return text;
    }
    
    for(var email_key in other_emails){
        var email_address = other_emails[email_key];
        add_new_email(email_address,email_key);
    }

</script>

