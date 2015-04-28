
<div class="details1">


    <div class="collum1 text"> 
        name:
        <br/>
        contact name:
        <br/>
        manager:
        <br/>
        category:
    </div>
    <div class="collum2">
        <input class="input-text" id="group_name" type="text" name="name" />
        <input class="input-text" id="contact_name" type="text" name="contact_name" />
        <input class="input-text" id="manager" type="text" name="manager" />
        <input class="input-text" id="category" type="text" name="category" />

    </div>

    <div class="collum1 text"> 
        address:
        <br/>
        city:
        <br/>
        country:        
    </div>

    <div class="collum2">
        <input class="input-text" id="country" type="text" name="country" />
        <input class="input-text" id="city" type="text" name="city" />
        <input class="input-text" id="address" type="text" name="address" />
    </div>

    <div class="collum1 text"> 
        phone: 
        <br/>
        website:
        <br/>
        email:
        <br/>
        other emails:        
    </div>

    <div class="collum2">
        <input class="input-text" id="phone" type="text" name="phone" />
        <input class="input-text" id="website" type="text" name="website" />
        <input class="input-text" id="email" type="text" name="email" />
        <div id="other_emails">
            
        </div>
    </div>

    <div class="details2">
        <div class="collum1 text">

            comment:
        </div>
        <div class="collum2">
            <textarea name="comment" id="comment" style="width: 360px;height: 200px;"></textarea>
        </div>
        <div class="history text">
            history of visited festivals
        </div>
        <div id="history_of_events">

        </div>
    </div>

</div>

<script type="text/javascript">
    $(function () {
        $("#group_name").keyup(function (e) {
            if (e.keyCode === 13) {
                get_data_by_key('group_name');
            }
        });

        $("#contact_name").keyup(function (e) {
            if (e.keyCode === 13) {
                get_data_by_key('contact_name');
            }
        });

    });

    var get_data_by_key = function (key) {
        var value = $("#" + key).val();


        $.ajax({
            url: base_url + 'groups/search',
            type: 'post',
            dataType: 'json',
            success: function (json) {
                set_data(json);
            },
            error: function (jqxhr, textStatus, error) {
                var err = textStatus + ", " + error;
                console.log("Request Failed: " + err);
            },
            data: {value: value, key: key}
        });

    };

    var set_data = function (data) {

        if (data.length) {
            var group = data[0];

            $("#group_name").val(group.group_name);
            $("#contact_name").val(group.contact_name);
            $("#category").val(group.category_name);

            $("#country").val(group.country_name);
            $("#city").val(group.city);
            $("#address").val(group.address);

            $("#phone").val(group.phone_number);
            $("#website").val(group.website);
            $("#email").val(group.email);
            
            $("#other_emails").html('');
            $.each(JSON.parse(group.other_emails),function(key,email){
                $("#other_emails").append('<input class="input-text" type="text" name="email" value="'+email+'" />');
            });

            $("#manager").val(group.manager);
            $("#comment").val(group.comment);

            $("#history_of_events").html('');

            if (group.festivals) {
                $.each(group.festivals, function (key, festival) {

                    var festival_html = "<div>";
                    festival_html += '<a target="_blank" ';
                    festival_html += 'href="'+base_url+'applications/details/'+festival.application_id+'">';
                    festival_html += festival.festival_name;
                    festival_html += '</a>';
                    festival_html += '';
                    festival_html += '';
                    festival_html += '';
                    festival_html += '';
                    festival_html += '';
                    festival_html += "</div>";
                    $("#history_of_events").append(festival_html);
                    //       event_ended_at: "2015-03-25 00:00:00"
//       event_id: "18"
//       event_started_at: "2015-03-18 00:00:00"
//       festival_id: "2"
//       festival_name: "Festival na site ludosti"
//       hotel_id: "3"
//       hotel_name: "akjshd glashdg aksjdh gaksjdhg lasdhlg laskhdg lasdhg "
                });
            }

        } else {
            $("#group_name").val('');
            $("#contact_name").val('');
            $("#category").val('');

            $("#country").val('');
            $("#city").val('');
            $("#address").val('');

            $("#phone").val('');
            $("#website").val('');
            $("#email").val('');
            $("#other_emails").html('');

            $("#manager").val('');
            $("#comment").val('');
            $("#history_of_events").html('');
        }

    };

</script>

