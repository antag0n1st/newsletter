<?php
Load::model('application');
/* @var $application Application */
if (!isset($application)) {
    $application = new Application();
}
?>

<form onsubmit="before_submit();" id="add-applications" name="form" method="post">
    <div class="details1">
        <div class="collum1 text">
            group name:<br/>
            event name:<br/>
            hotel name:<br/>
            participant:<br/>
            date of arrival:<br/>
            date of departure:<br/>
            needs airport pickup:<br/>
        </div>
        <div class="collum2">

            <?php HTML::textfield('group_name', '', '', array(), false, $application->group_name); ?> 
            <?php HTML::input_hidden('group_id', array(), false, $application->group_id); ?>
            <?php HTML::textfield('event_name', '', '', array(), false, $application->festival_name); ?> 
            <?php HTML::input_hidden('event_id', array(), false, $application->event_id); ?>    
            <?php HTML::textfield('hotel_name', '', '', array(), false, $application->hotel_name); ?> 
            <?php HTML::input_hidden('hotel_id', array(), false, $application->hotel_id); ?>

            <?php HTML::textfield('participants', '', '', array(), false, $application->participants); ?> 
            <?php HTML::textfield('date_of_arrival', '', '', array(), false, $application->date_of_arrival); ?>  
            <?php HTML::textfield('date_of_departure', '', '', array(), false, $application->date_of_departure); ?> <br/>
            <?php HTML::checkbox('needs_airport_pickup', '', 'yes', '', array(), false, $application->needs_airport_pickup); ?> 
        </div>

        <div class="collum1 text">
            1 bed room: <br/>
            2 bed room:<br/> 
            3 bed room:<br/>
            4 bed room:<br/>
            5 bed room:<br/>
            number of rooms:<br/>
        </div>
        <div class="collum2">
            <?php HTML::textfield('bed_1', '', '', array(), false, $application->room_1); ?>
            <?php HTML::textfield('bed_2', '', '', array(), false, $application->room_2); ?> 
            <?php HTML::textfield('bed_3', '', '', array(), false, $application->room_3); ?> 
            <?php HTML::textfield('bed_4', '', '', array(), false, $application->room_4); ?> 
            <?php HTML::textfield('bed_5', '', '', array(), false, $application->room_5); ?>

            <?php HTML::textfield('number_of_rooms', '', '', array(), false, $application->number_of_rooms); ?> 
            <label id="rooms_check"></label> 
        </div>
        <div class="collum1 text">
            application is sent: <br/>
            application has answer:<br/>
            invitation is sent:<br/>
            invitation price:<br/>
            Total price:<br/>
            group manager: <br/>
        </div>
        <div class="collum2">   
            <?php HTML::checkbox('application_is_sent', '', 'yes', '', array(), false, $application->application_is_sent); ?> <br/>
            <?php HTML::checkbox('applications_has_answer', '', 'yes', '', array(), false, $application->application_has_answer); ?><br/>
            <?php HTML::checkbox('invitation_is_sent', '', 'yes', '', array(), false, $application->invitation_is_sent); ?> <br/>
            <?php HTML::textfield('invitation_price', '', '', array(), false, $application->invitation_price); ?>
            <?php HTML::textfield('invoice_price', '', '', array(), false, $application->invoice_price); ?> <br/>
            <?php HTML::textfield('group_manager', '', '', array(), false, $application->group_manager); ?>
        </div>
    </div>
    <div class="details2">
        <div class="collum1 text">
            remarks:
        </div>
        <div class="collum2">

            <?php HTML::textarea('remarks', '', 'width:600px;height:120px;', array(), false, $application->remarks); ?>


        </div>

        <div class="collum1 text" style="margin-left: 310px;">
            Invoices:
        </div>
        <div class="collum2" style="width: 350px;">
            <div id="invoice_panel" style="overflow: hidden;">

            </div>
            <input type="button" id="add_invoice" value="Add" />
        </div>
    </div>

    <?php HTML::input_hidden('invoices'); ?>

    <input class="save" type="submit" value="Save"/> 

</form>

<script type="text/javascript">

    var Invoice = function () {
        this.id = 0;
        this.application_id = '<?php echo $application->id; ?>';
        this.created_at = '';
        this.price = 0;
        this.subject_id = 0;
        this.subject_name = '';
        this.is_paid = false;
    };

    var invoices_json_string = '<?php echo isset($_POST['invoices']) ? $_POST['invoices'] : $application->invoices; ?>';

    var invoices = invoices_json_string ? JSON.parse(invoices_json_string) : {};

    $(function () {
        $("#add_invoice").click(function () {
            add_invoice();
        });

        for (var key in invoices) {
            var invoice = invoices[key];
            add_invoice(invoice, key);
        }
    });

    function add_invoice(invoice, key) {
        var index = random_string();
        var child = "";

        if (key) {
            delete invoices[key];
            invoices[index] = invoice ? invoice : new Invoice();
        } else {
            invoices[index] = new Invoice();
        }
        
        child += '<div style="background-color:#eeeeee;padding:5px;margin:5px;overflow:hidden;" id="invoice_' + index + '">';
        child += '<input id="remove_' + index + '" style="float:right;" class="x" type="button" value="x" />';
        child += 'price: <input onkeyup="price_type(\'' + index + '\',this);" type="text" value="' + (invoice ? invoice.price : '') + '" /> <br />';
        child += 'subject: <input id="subject_'+index+'" onkeyup="subject_type(\'' + index + '\',this);" type="text" value="' + (invoice ? invoice.subject_name : '') + '" /> <br />';
        child += '<input id="subject_id_'+index+'" type="hidden" />';
        child += '<label for="checkbox_'+index+'">is paid:</label> <input id="checkbox_'+index+'" onchange="checkbox_change(\'' + index + '\',this);" type="checkbox" ' + (invoice && invoice.is_paid ? 'checked="checked"' : '') + ' />';
        child += '';

        child += '</div>';

        $("#invoice_panel").append(child);
        
        add_autocompete(index);

        $("#remove_" + index).click(index, function (event) {
            if (confirm('are you sure?')) {
                remove_by_index(event.data);
            }
        });
    }

    function price_type(index, object) {
        invoices[index].price = object.value;
    }

    function subject_type(index, object) {
        invoices[index].subject_name = object.value;
    }

    function checkbox_change(index, object) {
        invoices[index].is_paid = object.checked;
    }

    function remove_by_index(index) {
        $("#invoice_" + index).remove();
        delete invoices[index];
    }

    function before_submit() {
        $("#invoices").val(JSON.stringify(invoices));
    }

    function add_autocompete(index) {
        $(function () {
            $("#subject_"+index).autocomplete({
                minLength: 0,
                source: base_url + 'finance/get-subjects',
                focus: function (event, ui) {
                    $("#subject_id_"+index).val(ui.item.id);
                    $("#subject_"+index).val(ui.item.subject_name);
                    invoices[index].subject_name = ui.item.subject_name;
                    invoices[index].subject_id = ui.item.id;
                    return false;
                },
                select: function (event, ui) {
                    $("#subject_id_"+index).val(ui.item.id);
                    $("#subject_"+index).val(ui.item.subject_name);
                    invoices[index].subject_name = ui.item.subject_name;
                    invoices[index].subject_id = ui.item.id;
                    return false;
                }
            })
                    .autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                        .append("<a>" + item.subject_name + "<br>" + item.bank_name + "</a>")
                        .appendTo(ul);
            };
        });
    }


    ////////////////////////////////////////////////////////////////////////////

    create_picker_by_id("date_of_arrival");
    create_picker_by_id("date_of_departure");

    set_picker_date('date_of_arrival', '<?php echo $application->date_of_arrival; ?>');
    set_picker_date('date_of_departure', '<?php echo $application->date_of_departure; ?>');

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

<?php if (isset($_POST['date_of_arrival'])): ?>

            $("#date_of_arrival").datepicker('setDate', '<?php echo isset($_POST['date_of_arrival']) ? $_POST['date_of_arrival'] : ''; ?>');
            $("#date_of_departure").datepicker('setDate', '<?php echo isset($_POST['date_of_departure']) ? $_POST['date_of_departure'] : ''; ?>');

<?php endif; ?>


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

                var last_date_format = $("#date_of_arrival").datepicker('option', 'dateFormat');
                $("#date_of_arrival").datepicker('option', 'dateFormat', 'dd M yy');
                $("#date_of_arrival").datepicker('setDate', ui.item.event_started_at);
                $("#date_of_arrival").datepicker('option', 'dateFormat', last_date_format);


                var last_date_format2 = $("#date_of_departure").datepicker('option', 'dateFormat');
                $("#date_of_departure").datepicker('option', 'dateFormat', 'dd M yy');
                $("#date_of_departure").datepicker('setDate', ui.item.event_ended_at);
                $("#date_of_departure").datepicker('option', 'dateFormat', last_date_format2);

                return false;
            },
            select: function (event, ui) {
                $("#event_name").val(ui.item.festival_name);
                $("#event_id").val(ui.item.id);

                var last_date_format = $("#date_of_arrival").datepicker('option', 'dateFormat');
                $("#date_of_arrival").datepicker('option', 'dateFormat', 'dd M yy');
                $("#date_of_arrival").datepicker('setDate', ui.item.event_started_at);
                $("#date_of_arrival").datepicker('option', 'dateFormat', last_date_format);


                var last_date_format2 = $("#date_of_departure").datepicker('option', 'dateFormat');
                $("#date_of_departure").datepicker('option', 'dateFormat', 'dd M yy');
                $("#date_of_departure").datepicker('setDate', ui.item.event_ended_at);
                $("#date_of_departure").datepicker('option', 'dateFormat', last_date_format2);

                return false;
            }
        })
                .autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                    .append("<a>starting at: " + item.event_started_at + " - " + item.festival_name + "<br>" + item.country_name + "</a>")
                    .appendTo(ul);
        };
    });
</script>