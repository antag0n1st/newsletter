<form id="add-applications" name="form" method="post" action="<?php echo URL::abs('applications/add'); ?>">
    <br />

    group name: <?php HTML::textfield('group_name'); ?> <br /><br />
    <?php HTML::input_hidden('group_id'); ?>

    event name: <?php HTML::textfield('event_name'); ?> <br /><br />
    <?php HTML::input_hidden('event_id'); ?>

    hotel name: <?php HTML::textfield('hotel_name'); ?> <br /><br />
    <?php HTML::input_hidden('hotel_id'); ?>

    participant: <?php HTML::textfield('participant'); ?> <br /><br />
    date of arrival: <?php HTML::textfield('date_of_arrival'); ?>  <br /><br />
    date of departure: <?php HTML::textfield('date_of_departure'); ?><br /><br />

    needs airport pickup: <?php HTML::checkbox('needs_airport_pickup'); ?> <br /><br />

    1 bed room: <?php HTML::textfield('bed_1'); ?> <br /><br />
    2 bed room: <?php HTML::textfield('bed_2'); ?> <br /><br />
    3 bed room: <?php HTML::textfield('bed_3'); ?> <br /><br />
    4 bed room: <?php HTML::textfield('bed_4'); ?> <br /><br />
    5 bed room: <?php HTML::textfield('bed_5'); ?> <br /><br />

    number of rooms: <?php HTML::textfield('number_of_rooms'); ?> <label id="rooms_check"></label> <br /><br />

    remarks:<?php HTML::textarea('remarks'); ?><br /><br />

    application is sent: <?php HTML::checkbox('application_is_sent'); ?> <br /><br />
    application has answer: <?php HTML::checkbox('applications_has_answer'); ?> <br /><br />

    invitation is sent: <?php HTML::checkbox('invitation_is_sent'); ?> <br /><br />
    invitation price: <?php HTML::textfield('invitation_price'); ?> <br /><br />

    invoice price: <?php HTML::textfield('invoice_price'); ?> <br /><br />
    invoice is paid: <?php HTML::checkbox('invoice_is_paid'); ?> <br /><br />

    group manager: <?php HTML::textfield('group_manager'); ?> <br /><br />


    <input type="submit" />

</form>

<script type="text/javascript">
    create_picker_by_id("date_of_arrival");
    create_picker_by_id("date_of_departure");

    function is_data_correct() {

        var n1 = parseInt($("#bed_1").val());
        var n2 = parseInt($("#bed_2").val());
        var n3 = parseInt($("#bed_3").val());
        var n4 = parseInt($("#bed_4").val());
        var n5 = parseInt($("#bed_5").val());

        var total = parseInt($("#number_of_rooms").val());
        var participant = parseInt($("#participant").val());

        n1 = isNaN(n1) ? 0 : n1;
        n2 = isNaN(n2) ? 0 : n2;
        n3 = isNaN(n3) ? 0 : n3;
        n4 = isNaN(n4) ? 0 : n4;
        n5 = isNaN(n5) ? 0 : n5;

        total = isNaN(total) ? 0 : total;
        participant = isNaN(participant) ? 0 : participant;

        if (total === n1 + n2 + n3 + n4 + n5) {
            $("#rooms_check").html("Good");
        } else {
            $("#rooms_check").html("Bad");
            return;
        }

        if (participant === n1 * 1 + n2 * 2 + n3 * 3 + n4 * 4 + n5 * 5) {
            $("#rooms_check").html("Good");
        } else {
            $("#rooms_check").html("Bad");
            return;
        }
    }

    $(function () {
        $("#date_of_arrival").datepicker('setDate', '<?php echo isset($_POST['date_of_arrival']) ? $_POST['date_of_arrival'] : ''; ?>');
        $("#date_of_departure").datepicker('setDate', '<?php echo isset($_POST['date_of_departure']) ? $_POST['date_of_departure'] : ''; ?>');

        $("#bed_1").keyup(function () {
            is_data_correct();
        });

        $("#bed_2").keyup(function () {
            is_data_correct();
        });

        $("#bed_3").keyup(function () {
            is_data_correct();
        });

        $("#bed_4").keyup(function () {
            is_data_correct();
        });

        $("#bed_5").keyup(function () {
            is_data_correct();
        });

        $("#number_of_rooms").keyup(function () {
            is_data_correct();
        });

        $("#participant").keyup(function () {
            is_data_correct();
        });
    });

    $(function () {
        $("#hotel_name").autocomplete({
            minLength: 0,
            source: base_url + 'hotels/get-hotels',
            focus: function (event, ui) {
                $("#hotel_name").val(ui.item.hotel_name);
                $("#hotel_id").val(ui.item.id);
                return false;
            },
            select: function (event, ui) {
                $("#hotel_name").val(ui.item.hotel_name);
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

    $(function () {
        $("#group_name").autocomplete({
            minLength: 0,
            source: base_url + 'groups/get-groups',
            focus: function (event, ui) {
                $("#group_name").val(ui.item.group_name);
                $("#group_id").val(ui.item.id);
                return false;
            },
            select: function (event, ui) {
                $("#group_name").val(ui.item.group_name);
                $("#group_id").val(ui.item.id);
                return false;
            }
        })
                .autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                    .append("<a>" + item.group_name + "<br>" + item.country_name + "</a>")
                    .appendTo(ul);
        };
    });

    $(function () {
        $("#event_name").autocomplete({
            minLength: 0,
            source: base_url + 'events/get-events',
            focus: function (event, ui) {
                $("#event_name").val(ui.item.festival_name);
                $("#event_id").val(ui.item.id);
                return false;
            },
            select: function (event, ui) {
                $("#event_name").val(ui.item.festival_name);
                $("#event_id").val(ui.item.id);
                return false;
            }
        })
                .autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                    .append("<a>starting at: "+item.event_started_at+" - " + item.festival_name + "<br>" + item.country_name + "</a>")
                    .appendTo(ul);
        };
    });
</script>