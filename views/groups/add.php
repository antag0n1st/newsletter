
<div class="details1">
    <form onsubmit="before_submit();" id="add-group" name="form" method="post" action="<?php echo URL::abs('groups/add'); ?>">

        <div class="collum1 text"> 
            name:
            <br/>
            contact name:
            <br/>
            manager:
            <br/>
            categories:
        </div>

        <div class="collum2">
            <input class="input-text" name="group_name" type="text" <?php HTML::post_value('group_name'); ?> /> 
            <input class="input-text" name="contact_name" type="text" <?php HTML::post_value('contact_name'); ?> /> 
            <input class="input-text" name="manager" type="text" <?php HTML::post_value('manager'); ?> /> 
            <select class="input-text" name="category_id" style="cursor: pointer;">

                <?php foreach ($categories as $key => $category): /* @var $category Category */ ?>

                    <option <?php HTML::post_selected($key, 'category_id', $category->id); ?> >
                        <?php echo $category->category_name; ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </div>        
        <div class="collum1 text">
            address:
            <br/>
            city:
            <br/>
            country:  
        </div>
        <div class="collum2">
            <input class="input-text" name="address" type="text" <?php HTML::post_value('address'); ?> /> 
            <input class="input-text" name="city" type="text" <?php HTML::post_value('city'); ?> /> <br/>
            <select class="input-text" name="country_id"style="cursor: pointer;">

                <?php foreach ($countries as $key => $country): /* @var $country Country */ ?>

                    <option <?php HTML::post_selected($key, 'country_id', $country->id); ?> >
                        <?php echo $country->country_name; ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </div>
        <div class="collum1 text">
            phone:
            <br/>
            website:
            <br/>
            email:
        </div>
        <div class="collum2">
            <input class="input-text" name="phone" type="text" <?php HTML::post_value('phone'); ?> /> 
            <input class="input-text" name="website" type="text" <?php HTML::post_value('website'); ?> /> 
            <div>
                <div id="other_emails"></div>
                <div> <input class="addemail" id="add_email" type="button" title="Add New" /> </div>
            </div>
            <input class="input-text" name="email" type="text" <?php HTML::post_value('email'); ?> /> 

            <input  class="input-text" id="other_emails_hidden_field" type="hidden" value="" name="other_emails" />
            <!-- RENDER OTHER EMAIL -->

        </div>

        <div class="details2">
            <div class="collum1 text">
                comment: 
            </div>
            <div class="collum2">
                <textarea name="comment" style="width: 360px; height: 200px;"> <?php echo isset($_POST['comment']) ? $_POST['comment'] : ""; ?> </textarea>
            </div>
        </div>


        <input class="save" type="submit" value="Save"/>

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

    function add_new_email(value, key) {
        var index = random_string();
        var child = "";

        if (key) {
            delete other_emails[key];
            other_emails[index] = value ? value : "";
        }

        child += '<div id="other_email_' + index + '">';
        child += '<input class="input-text" onkeyup="other_email_type(\'' + index + '\',this);" value="' + (value ? value : '') + '" />';
        child += '<input class="x" type="button" value="x" onclick="remove_by_index(\'' + index + '\');" />';
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

    for (var email_key in other_emails) {
        var email_address = other_emails[email_key];
        add_new_email(email_address, email_key);
    }

</script>

