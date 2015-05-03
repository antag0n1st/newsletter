<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php /* @var $invoice Invoice */ ?>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

        <title>Invoice</title>

        <link rel='stylesheet' type='text/css' href='<?php echo URL::abs('public/css/invoice-style.css'); ?>' />
        <link rel='stylesheet' type='text/css' href='<?php echo URL::abs('public/css/print.css'); ?>' media="print" />
        <script type='text/javascript' src='<?php echo URL::abs('public/js/jquery-2.1.3.min.js'); ?>'></script>
        <script type='text/javascript' src='<?php echo URL::abs('public/js/print.js'); ?>'></script>

    </head>

    <body>

        <div id="page-wrap">

            <div id="identity">
                <div id="address-content">
                    <p contentEditable="true" id="address"><b>MAKFOLK Skopje</b> <br />
                        Association for cultivation and establishing of <br />
                        Macedonian folklore and tradition <br />
                        <b>Tel. +389 70 359747; Fax. +389 2 2743052</b> <br />
                        <b>E-mail: dejanbrzanov@makfolk.com.mk</b> <br />
                        <b>www.makfolk.com.mk</b>
                    </p>
                </div>


                <div id="logo">

                    <div id="logoctr">
                        <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                        <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                        |
                        <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                        <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
                    </div>

                    <div id="logohelp">
                        <input id="imageloc" type="text" size="50" value="" /><br />
                        (max width: 540px, max height: 100px)
                    </div>
                    <img id="image" src="<?php echo URL::image('makfolk-logo.png'); ?>" alt="logo" />
                </div>

                <div id="underline"></div>

            </div>

            <div style="clear:both"></div>
            <br />

            <div id="customer">

                <div style="float: left;">
                    <p contentEditable="true" style="
                       width: 400px;
                       min-height: 70px;
                       border: 1px solid black;
                       padding: 10px;
                       ">
                        
                        <b>To:</b> <br />
                        <?php echo $invoice->group_name; ?> <br />
                        <?php echo $invoice->contact_name; ?> <br />
                        <b>Address:</b> <br />
                        <?php echo $invoice->country_name; ?> <br />
                        <?php echo $invoice->city; ?> <br />
                        <?php echo $invoice->address; ?> <br />
                    </p>
                </div>


                <table id="meta">
                    <tr>
                        <td class="meta-head">Invoice #</td>
                        <td><textarea><?php echo $invoice->invoice_number; ?></textarea></td>
                    </tr>
                    <tr>

                        <td class="meta-head">Date</td>
                        <td><textarea id="date"><?php echo TimeHelper::to_date($invoice->created_at,'d M Y'); ?></textarea></td>
                    </tr>
                    <tr>
                        <td class="meta-head">Amount Due</td>
                        <td><textarea class="due"><?php echo $invoice->price; ?> EUR</textarea></td>
                    </tr>

                </table>

            </div>

            <table id="items">

                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Unit Cost</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>

                <tr class="item-row">
                    <td class="item-name"><div class="delete-wpr"><textarea>Participation Fee</textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
                    <td class="description"><textarea>Participation Fee</textarea></td>
                    <td><textarea class="cost"><?php echo $invoice->price; ?> EUR</textarea></td>
                    <td><textarea class="qty">1</textarea></td>
                    <td><textarea class="price"><?php echo $invoice->price; ?> EUR</textarea></td>
                </tr>

                <tr id="hiderow">
                    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
                </tr>

                <tr>

                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line">Total</td>
                    <td class="total-value"><textarea id="total"><?php echo $invoice->price; ?> EUR</textarea></td>
                </tr>               

            </table>
            <br />
            <b>Payment Details:</b>
            <p contentEditable="true" style="
                 border: 1px solid black;
                 padding: 10px;
                 ">
                Name of the company: MAKFOLK <br />
                Address: Jane Sandanski 84/3-14, 100 Skopje Macedonia <br />
                IBAN Code: MK 07 210701000669596 <br />
            </p>
            <br />
             <p contentEditable="true" style="
                 border: 1px solid black;
                 padding: 10px;
                 ">
                Bank Name: NLB TUTUNSKA BANKA A.D. SKOPJE <br />
                Bank Adress: 12 Makedonska brigade br.20 <br />
                Country: Makedonija <br />
                SWIFT: TUTNMK22
            </p>
            All bank Transfer cost to be paid by the Group/Ensemble (player)
            <br />
            <br />
            <div>
                <textarea style="height: 60px;">Invoiced By:

MAKFOLK Association</textarea>
            </div>

        </div>

    </body>

</html>