<div class="table">

    <form id="add-applications" name="form" method="post">

        <label>Hotel Name</label> <?php HTML::textfield('hotel_name', '', '', array(), false, ''); ?> <br /><br />
        <?php HTML::input_hidden('hotel_id', array(), false, ''); ?>
        <label>Subject Name</label> <?php HTML::textfield('subject_name', '', '', array(), false, ''); ?> <br /><br />

        <label>Account</label> <?php HTML::textfield('account', '', '', array(), false, ''); ?> <br /><br />
        <label>Bank Name</label> <?php HTML::textfield('bank_name', '', '', array(), false, ''); ?> <br /><br />
        
        <?php HTML::select($countries, 'country_id',0, '', 'cursor: pointer;'); ?> <br /><br />
        
        <input type="submit" value="Save" />
    </form>

</div>
<script type="text/javascript">
    $(function () {
        $("#hotel_name").autocomplete({
            minLength: 0,
            source: base_url + 'hotels/get-hotels',
            focus: function (event, ui) {
                $("#hotel_name").val(ui.item.hotel_name);
                $("#subject_name").val(ui.item.hotel_name);
                $("#hotel_id").val(ui.item.id);
                return false;
            },
            select: function (event, ui) {
                $("#hotel_name").val(ui.item.hotel_name);
                $("#subject_name").val(ui.item.hotel_name);
                $("#hotel_id").val(ui.item.id);
                return false;
            }
        })
                .autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                    .append("<a>" + item.hotel_name + "<br>" + item.country_name + "</a>")
                    .appendTo(ul);
        };
    });
</script>