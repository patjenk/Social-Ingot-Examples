<?php
/**
 * Patrick Jenkins <patrick@socialgrowthtechnologies.com>
 * 8/11/2010
 *
 * View for testing Social Ingot mobile transactions from click to postback
 */
?>
<html>
    <head>
        <title>Mobile Simulation</title>
        <link rel="stylesheet" type="text/css" href="assets/style.css" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript">
            function update_mobile_widgets() {
              $.ajax({
                      url: 'mobile.php',
                      dataType: 'html',
                      type: 'POST',
                      data: { api_key: $('input[name=api_key]').val(), secret: $('input[name=secret]').val(), uid: $('input[name=uid]').val(), },
                      success: function(response) {
                        $('#mobile').html(response);
                      }
                    });
            }
            function update_postbacks() {
              $.ajax({
                      url: 'postbacks.php',
                      dataType: 'html',
                      type: 'POST',
                      data: { api_key: $('input[name=api_key]').val(), secret: $('input[name=secret]').val() },
                      success: function(response) {
                        $('#postbacks').html(response);
                      }
                    });
            }
            function simulate_transaction(mobile_id) {
              $.ajax({
                      url: 'simulate_mobile.php',
                      dataType: 'json',
                      type: 'POST',
                      data: { api_key: $('input[name=api_key]').val(), secret: $('input[name=secret]').val(),  uid: $('input[name=uid]').val(), mobile_id: mobile_id, params: $('input[name=params]').val()},
                      success: function(response) {
                      }
                    });
              return false;
            }
        </script>
    </head>
    <body>
        <div class="header">
            <img src="http://sgts3.s3.amazonaws.com/social_ingot_top_bgm.png" alt="Social Ingot" />
        </div>
        <div class="content">
            <h2>Passing your secret key over an insecure connection is not advisable. Please use a development keyset for testing..</h2>
            <table>
                <tr>
                    <td>API Key:</td>
                    <td><input type="text" name="api_key" value="9f2ac35d2b495336fccaaeba351aa7487f072a4a" style="width: 320px;" /></td>
                </tr>
                <tr>
                    <td>Secret:</td>
                    <td><input type="text" name="secret" value="6d0db6688d3fb1a29bcdba2c8b6c85a5d4809e6d"  style="width: 320px;" /></td>
                <tr>
                </tr>
                    <td>User Id:</td>
                    <td><input type="text" name="uid" value="4321"  style="width: 320px;" /></td>
                <tr>
                </tr>
                    <td>Extra Params:</td>
                    <td><input type="text" name="params" value="bacon=delicious&location=rightside"  style="width: 320px;" /></td>
                </tr>
            </table>
            <input type="submit" value="Refresh Mobile Widgets" onclick="update_mobile_widgets();" />
            <input type="submit" value="Refresh Postbacks" onclick="update_postbacks();" />

            <table class="output">
                <tr>
                    <th>Mobile Payments</th>
                    <th>Postbacks</th>
                </tr>
                <tr style="vertical-align: top;">
                    <td id="mobile" class="mobile">&nbsp;</td>
                    <td id="postbacks" class="postbacks">&nbsp;</td>
                </tr>
            <table>
        </div>
    </body>
</html>
