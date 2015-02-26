
<div style="padding-left: 20px;">

    <br />
    name: <input id="group_name" type="text" name="name" />
    contact name: <input id="contact_name" type="text" name="contact_name" />
    category: <input id="category" type="text" name="category" />

    <br /> <br />

    country: <input id="country" type="text" name="country" />
    city: <input id="city" type="text" name="city" />
    address: <input id="address" type="text" name="address" />

    <br /> <br />

    website: <input id="website" type="text" name="website" />
    email: <input id="email" type="text" name="email" />
    other emails:

    <br /> <br /> <br />
    <div style="overflow: hidden; width: 100%;">
        <div style="float: left;">
            manager: <input id="manager" type="text" name="manager" /> <br /><br />
            comment: <textarea name="comment" id="comment" style="width: 400px;height: 200px;"></textarea>
        </div>
        <div style="float: left; padding-left: 20px;">
            history of visited festivals
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
        console.log(data);
        if (data.length) {
            var group = data[0];
            
            $("#group_name").val(group.group_name);
            $("#contact_name").val(group.contact_name);
            $("#category").val(group.category_name);
            
            $("#country").val(group.country_name);
            $("#city").val(group.city);
            $("#address").val(group.address);
            
            $("#website").val(group.website);
            $("#email").val(group.email);
            
            $("#manager").val(group.manager);
            $("#comment").val(group.comment);
            
        } else {
            $("#group_name").val('');
            $("#contact_name").val('');
            $("#category").val('');
            
            $("#country").val('');
            $("#city").val('');
            $("#address").val('');
            
            $("#website").val('');
            $("#email").val('');
            
            $("#manager").val('');
            $("#comment").val('');
        }

    };

</script>

