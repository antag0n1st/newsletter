<form class="details1" id="add-event" name="form" method="post" action="<?php echo URL::abs('events/add-event'); ?>">
    
    <div class="collum1 text">
     festival:
    <br />
    Start Date:
    <br/> 
    End Date:
    </div>
    
    <div class="collum2">    
   <input class="input-text" id="festival_name" type="text" name="festival_name" <?php HTML::post_value('festival_name'); ?> />
    <input class="input-text" name="start_date" type="text" id="start-date-datepicker" <?php HTML::post_value('start_date'); ?> /> 
     <input class="input-text" name="end_date" type="text" id="end-date-datepicker" <?php HTML::post_value('end_date'); ?> /> 
    <input id="festival_id" type="hidden" name="festival_id" <?php HTML::post_value('festival_id'); ?> />
    <input class="save" type="submit" value="save" />

</form>

<script type="text/javascript">


    $(function () {
        $("#festival_name").autocomplete({
            minLength: 0,
            source: base_url + 'events/get-festivals',
            focus: function (event, ui) {
                $("#festival_name").val(ui.item.festival_name);
                $("#festival_id").val(ui.item.id);
                return false;
            },
            select: function (event, ui) {
                $("#festival_name").val(ui.item.festival_name);
                $("#festival_id").val(ui.item.id);
                return false;
            }
        })
                .autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                    .append("<a>" + item.festival_name + "<br>" + item.country_name + "</a>")
                    .appendTo(ul);
        };
    });

    

    create_picker_by_id('start-date-datepicker');
    create_picker_by_id('end-date-datepicker');

</script>