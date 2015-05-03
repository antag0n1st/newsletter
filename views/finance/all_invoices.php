<div class="table">  
    <table>
        <colgroup>
            <col class="colid" />
        </colgroup>
        <thead>
            <tr id="title-line">
                <th> App. ID </th>
                <th> Subject Name </th>
                <th> Group Name </th>
                <th> Leader </th>
                <th> Invoiced Sum </th>
                <th> Created at</th>
                <th> Paid at</th>
                <th> Is Paid </th>
                <th>Invoice</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $key => $invoice): /* @var $invoice Invoice */ ?>
                <tr>
                    <td> 
                        <?php HTML::anchor($invoice->application_id, 'applications/details/'.$invoice->application_id); ?>                    
                    </td>
                    <td><?php echo $invoice->subject_name; ?></td>
                    <td><?php echo $invoice->group_name; ?></td>
                    <td><?php echo $invoice->contact_name; ?></td>
                    <td><?php echo $invoice->price; ?></td>
                    <td><?php echo TimeHelper::to_date($invoice->created_at,'d M Y'); ?></td>
                    <td><?php echo strtotime($invoice->paid_at) ? TimeHelper::to_date($invoice->paid_at,'d M Y') : '-'; ?></td>
                    <td><?php echo $invoice->is_paid ? 'Yes' : 'No'; ?></td>
                    <td>
                        <?php HTML::anchor('create', 'finance/invoice-details/'.$invoice->id,'','',true); ?>
                    </td>
                </tr>   
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <?php if($paginator){
        /* @var $paginator Paginator */
        echo $paginator->build_pagination_html();
    } ?>
</div>