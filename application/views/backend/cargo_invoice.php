<style>
.table td {
    font-size: 14px;
}
</style>
<div class="intro-y flex items-center mt-8">
<?php  if($this->session->flashdata('error')){?>
                            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> <?= $this->session->flashdata('error'); ?> </div>
                        <?php } ?>
                        <?php  if($this->session->flashdata('message')){?>
                            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> <?= $this->session->flashdata('message'); ?> </div>
                        <?php } ?>
                    <h2 class="text-lg font-medium mr-auto">
                        
                        <?= $cargo->containerNumber ?> List of Generated Invoices
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <a href="<?= site_url('invoice/generate_invoice/'.$cargo->uniqueID.'_'.$cargo->id) ?>" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Generate New Invoice </a>
                    </div>
                </div>
  <!-- BEGIN: Datatable -->
  <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full">
                        <thead>
                            <tr>
                            <th class="border-b-2 whitespace-no-wrap">S/NO.</th>
                            <th class="border-b-2 whitespace-no-wrap">CLIENT</th>
                                <th class="border-b-2 whitespace-no-wrap">INVOICE NO.</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">DATE CREATED</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">CREATED BY</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x=0; foreach($invoice_details as $d){ $x++; ?>
                            <tr>
                            
                                <td class="text-center border-b"><?= $x ?></td>
                                <td class="text-center border-b"><?= $d->fullname ?></td>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap"><?= $d->invoiceNo ?></div>
                                </td>
                                <td class="text-center border-b"><?php if(!empty($d->dateCreated)){ echo date('j, F, Y', strtotime($d->dateCreated));} ?></td>
                                <td class="text-center border-b"><?= $d->staff_name ?></td>
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                         <a class="flex items-center text-theme-6 tooltip text-white" href="javascript:;"  data-theme="light" title="Delete Invoice" data-tit data-toggle="modal" data-target="#delete-confirmation-modal<?= $d->id ?>"> <i data-feather="trash" class="w-4 h-4 mr-1"></i> Delete </a>&nbsp;&nbsp;
                                        <a class="flex items-center text-theme-9 tooltip" target="_blank" href="<?= site_url('invoice/print_invoice/'.$d->id) ?>" data-theme="light" title="Print Invoice(s)"> <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print </a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- END: Datatable -->
                <?php foreach($invoice_details as $d){ ?>
                                    <div class="modal" id="delete-confirmation-modal<?= $d->id ?>">
                                        <div class="modal__content">
                                            <div class="p-5 text-center">
                                                <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                                                <div class="text-3xl mt-5">Are you sure?</div>
                                                <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
                                            </div>
                                            <div class="px-5 pb-8 text-center">
                                               
                                                <form method="post" action="<?= site_url('invoice/delete'); ?>">
                                                    <input type="hidden" name="id" value="<?= $d->id ?>">
                                                    <input type="hidden" name="data" value="<?= $cargo->uniqueID.'_'.$cargo->id ?>">
                                                    <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                                                <button type="submit" class="button w-24 bg-theme-6 text-white">Delete</button>
                                                </form>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>     