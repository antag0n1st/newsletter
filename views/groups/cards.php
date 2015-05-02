
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
        <input class="input-text" id="address" type="text" name="address" />
        <input class="input-text" id="city" type="text" name="city" />
        <input class="input-text" id="country" type="text" name="country" />
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
            <textarea name="comment" id="comment" style="width: 320px;height: 150px;"></textarea>
        </div>
        <div class="history text" style="">
            history:
        </div>
        <div id="history_of_events">

        </div>
    </div>

</div>

<div id="search-panel" style="
     position: fixed;
     width: 100%;
     height: 100%;
     left: 0;
     top: 0;
     background-color: rgba(1,1,1,0.5);
     display: none;
     ">
    <div  style="position: fixed;
          width: 600px;
          height: 400px;
          background-color: white;
          border: 1px solid black;
          top: 20%;
          left: 20%;
          padding: 10px;
          ">

        <table style="width: 600px;">
            <colgroup>
                <col class="colid" />
            </colgroup>
            <thead>
                <tr id="title-line">
                    <th> ID </th>
                    <th> Group Name </th>
                    <th> Contact </th>
                    <th> Country </th>
                </tr>
            </thead>
            <tbody id="search-results">

            </tbody>
        </table>

    </div>
</div>

<style>
    .choose-hover:hover{
        background-color: #ccccff;
        cursor: pointer;
    }
</style>

<script type="text/javascript">
    
    var last_search = [];
    
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
        
        $("#search-panel").click(function(){
            $("#search-panel").hide();
        });

    });
    
    function set_data_by_index(index){
        $("#search-panel").hide();
        set_data(last_search[index]);
    }

    var get_data_by_key = function (key) {
        var value = $("#" + key).val();


        $.ajax({
            url: base_url + 'groups/search',
            type: 'post',
            dataType: 'json',
            success: function (json) {
                last_search = json;
                if (json.length === 1) {
                    set_data(json[0]);
                } else if (json.length > 1) {
                    $("#search-panel").show();
                    preview_data(json);
                } else {
                    set_data();
                }
            },
            error: function (jqxhr, textStatus, error) {
                var err = textStatus + ", " + error;
                console.log("Request Failed: " + err);
            },
            data: {value: value, key: key}
        });

    };

    var preview_data = function (data) {

        var html = "";



        $.each(data, function (key, festival) {

            html += '<tr onclick="set_data_by_index('+key+');" class="choose-hover">';

            html += "<td>";
            html += festival.id;
            html += "</td>";

            html += "<td>";
            html += festival.group_name;
            html += "</td>";

            html += "<td>";
            html += festival.contact_name;
            html += "</td>";

            html += "<td>";
            html += festival.country_name;
            html += "</td>";

            html += "</tr>";
        });



        $("#search-results").html(html);
    };

    var set_data = function (group) {

        if (group) {

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
            $.each(JSON.parse(group.other_emails), function (key, email) {
                $("#other_emails").append('<input class="input-text" type="text" name="email" value="' + email + '" />');
            });

            $("#manager").val(group.manager);
            $("#comment").val(group.comment);

            $("#history_of_events").html('');

            var festival_html = "<table style='width:530px;'>";

            festival_html += '<thead><tr id="title-line">';
            festival_html += '<th> Festival </th>';
            festival_html += '<th> Date </th>';
            festival_html += '<th> Participants </th>';
            festival_html += '<th> Country </th>';
            festival_html += '</tr></thead>';

            festival_html += '<tbody>';



            if (group.festivals) {
                $.each(group.festivals, function (key, festival) {

                    festival_html += '<tr>';

                    festival_html += '<td>';
                    festival_html += '<a target="_blank" ';
                    festival_html += 'href="' + base_url + 'applications/details/' + festival.application_id + '">';
                    festival_html += festival.festival_name;
                    festival_html += '</a>';
                    festival_html += '</td>';

                    festival_html += '<td>';
                    festival_html += festival.event_started_at;
                    festival_html += '</td>';

                    festival_html += '<td>';
                    festival_html += festival.participants;
                    festival_html += '</td>';

                    festival_html += '<td>';
                    festival_html += festival.country;
                    festival_html += '</td>';

                    festival_html += '</tr>';

                });
            }

            festival_html += "</tbody></table>";
            $("#history_of_events").append(festival_html);
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

