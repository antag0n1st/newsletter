<?php
Load::model('group');
/* @var $group Group */
if (!isset($group)) {
    $group = new Group();
}
?>

<?php if ($group): ?>
    <div class="details1">
        <form onsubmit="before_submit();" id="add-group" name="form" method="post" >

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
                <?php HTML::textfield('group_name', 'input-text', '', array(), false, $group->group_name); ?>
                <?php HTML::textfield('contact_name', 'input-text', '', array(), false, $group->contact_name); ?>
                <?php HTML::textfield('manager', 'input-text', '', array(), false, $group->manager); ?>
                <?php HTML::select($categories, 'category_id', $group->category_id, 'input-text', 'cursor: pointer;'); ?>            
            </div>        
            <div class="collum1 text">
                address:
                <br/>
                city:
                <br/>
                country:  <br />
                phone:
                <br/>
            </div>
            <div class="collum2">
                <?php HTML::textfield('address', 'input-text', '', array(), false, $group->address); ?>
                <?php HTML::textfield('city', 'input-text', '', array(), false, $group->city); ?>
                <?php HTML::select($countries, 'country_id', $group->country_id, 'input-text', 'cursor: pointer;'); ?>
                <div>
                    <div id="other_phones"></div>
                    <div> <input class="addemail" id="add_phone" type="button" title="Add New" /> </div>
                </div>
                <?php HTML::textfield('phone', 'input-text', '', array(), false, $group->phone_number); ?> 
                <input  class="input-text" id="other_phones_hidden_field" type="hidden" value="" name="other_phones" />
                <!-- RENDER OTHER EMAIL -->
            </div>
            <div class="collum1 text">

                website:
                <br/>
                email:
            </div>
            <div class="collum2">

                <?php HTML::textfield('website', 'input-text', '', array(), false, $group->website); ?>
                <div>
                    <div id="other_emails"></div>
                    <div> <input class="addemail" id="add_email" type="button" title="Add New" /> </div>
                </div>
                <?php HTML::textfield('email', 'input-text', '', array(), false, $group->email); ?> 

                <input  class="input-text" id="other_emails_hidden_field" type="hidden" value="" name="other_emails" />
                <!-- RENDER OTHER EMAIL -->

            </div>

            <div class="details2">
                <div class="collum1 text">
                    comment: 
                </div>
                <div class="collum2">
                    <?php HTML::textarea('comment', '', 'width: 560px; height: 100px;', array(), false, $group->comment); ?>
                </div>
            </div>

            <?php HTML::input_hidden('group_id', array(), false, $group->id); ?>

            <input class="save" type="submit" value="Save"/>

        </form>

    </div>


    <script type="text/javascript">
        $(function () {
            $("#add_email").click(function () {
                add_new_email();
            });
            
            $("#add_phone").click(function () {
                add_new_phone();
            });
        });

        var other_emails_json_string = '<?php echo isset($_POST['other_emails']) ? $_POST['other_emails'] : $group->other_emails; ?>';
        var other_emails = other_emails_json_string ? JSON.parse(other_emails_json_string) : {};

        var other_phones_json_string = '<?php echo isset($_POST['other_phones']) ? $_POST['other_phones'] : $group->other_phone_numbers; ?>';
        var other_phones = other_phones_json_string ? JSON.parse(other_phones_json_string) : {};

        function before_submit() {
            $("#other_emails_hidden_field").val(JSON.stringify(other_emails));
            $("#other_phones_hidden_field").val(JSON.stringify(other_phones));
        }

        function other_email_type(index, object) {
            other_emails[index] = object.value;
        }
        
        function other_phone_type(index, object) {
            other_phones[index] = object.value;
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
        
        function add_new_phone(value, key) {
            var index = random_string();
            var child = "";

            if (key) {
                delete other_phones[key];
                other_phones[index] = value ? value : "";
            }

            child += '<div id="other_phone_' + index + '">';
            child += '<input class="input-text" onkeyup="other_phone_type(\'' + index + '\',this);" value="' + (value ? value : '') + '" />';
            child += '<input class="x" type="button" value="x" onclick="remove_phone_by_index(\'' + index + '\');" />';
            child += "";
            child += "</div>";

            $("#other_phones").append(child);
        }

        function remove_by_index(index) {
            $("#other_email_" + index).remove();
            delete other_emails[index];
        }

        function remove_phone_by_index(index) {
            $("#other_phone_" + index).remove();
            delete other_phones[index];
        }

        for (var email_key in other_emails) {
            var email_address = other_emails[email_key];
            add_new_email(email_address, email_key);
        }
        
        for (var phone_key in other_phones) {
            var phone_number = other_phones[phone_key];
            add_new_phone(phone_number, phone_key);
        }

    </script>


<?php else: ?>
    <div class="details1">
        <h2>You must click on a group to view its details</h2>
        <p>If you want to add a group , please 
            <a href="<?php echo URL::abs('groups/add'); ?>">
                click here
            </a>
        </p>

    </div>

<?php endif; ?>
