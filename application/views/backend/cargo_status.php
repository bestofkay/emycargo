<style>
.table td {
    font-size: 14px;
}
</style>
<div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        
                        <?php if($status==0){ echo "Uncleared";}else{echo "Cleared";} ?> List of Containers
                    </h2>
                </div>
  <!-- BEGIN: Datatable -->
  <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full">
                        <thead>
                            <tr>
                            <th class="border-b-2 whitespace-no-wrap">CLIENT</th>
                                <th class="border-b-2 whitespace-no-wrap">CONTAINER NO.</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">VESSEL</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">LADEN PORT</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">ARRIVAL DATE</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">CREATED BY</th>
                                <th class="border-b-2 text-center whitespace-no-wrap"><?php if($status==0){ echo "ACTIONS";}else{echo "CLEAR DATE";}?></th>
                               
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($cargos as $d){ ?>
                            <tr>
                            <td class="text-center border-b"><?= $d->client_name ?></td>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap"><?= $d->containerNumber ?></div>
                                    <div class="text-gray-600 text-xs whitespace-no-wrap"><?= $d->billNumber ?></div>
                                </td>
                                <td class="text-center border-b"><?= $d->vessel ?></td>
                                <td class="text-center border-b"><?= $d->portOfLaden ?></td>
                                <td class="text-center border-b"><?php if(!empty($d->arrivalDate)){ echo date('j, F, Y', strtotime($d->arrivalDate));} ?></td>
                                <td class="text-center border-b"><?= $d->staff_name ?></td>
                                <?php if($status==0){ ?>
                                    <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                        <a class="flex items-center text-theme-9 tooltip" href="<?= site_url('invoice/edit/'.$d->uniqueID.'_'.$d->id) ?>" data-theme="light" title="Edit Container"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a> &nbsp;
                                        <a class="flex items-center text-theme-6 tooltip" href="<?= site_url('invoice/cargo/'.$d->uniqueID.'_'.$d->id) ?>" data-theme="light" title="View generated Invoice(s)"> <i data-feather="codesandbox" class="w-4 h-4 mr-1"></i> Invoice </a>
                                    </div>
                                </td>
                                 <?php}else{?>
                                    <th class="border-b-2 text-center whitespace-no-wrap"><?php if(!empty($d->clearDate)){ echo date('j, F, Y', strtotime($d->clearDate));} ?></th>
                               <?php } ?>
                                
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- END: Datatable -->