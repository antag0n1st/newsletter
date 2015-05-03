<div class="table">  
    <table>
        <colgroup>
            <col class="colid" />
        </colgroup>
        <thead>
            <tr id="title-line">
                <th> Subject Name </th>
                <th> Subject bank </th>
                <th> Invoiced Sum </th>
                <th> Paid </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $key => $invoice): /* @var $invoice Invoice */ ?>
                <tr>
                    <td>
                        <a href="<?php echo URL::abs('finance/by-subject/'.$invoice->subject_id); ?>">
                            <?php echo $invoice->subject_name; ?>
                        </a>
                    </td>
                    <td><?php echo $invoice->bank_name; ?></td>
                    <td><?php echo $invoice->sum_invoices; ?></td>
                    <td><?php echo $invoice->sum_paid; ?></td>
                </tr>   
            <?php endforeach; ?>
        </tbody>
    </table>
</div>