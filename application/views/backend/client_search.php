<div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Search Client
                    </h2>
                </div>
                <form action="<?= site_url('clients/search_client_action'); ?>" method="post">
                <?php  if($this->session->flashdata('error')){?>
                            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> <?= $this->session->flashdata('error'); ?> </div>
                        <?php } ?>
                <div class="grid grid-cols-12 gap-6 mt-5">
                  
                        <div class="intro-y col-span-12 lg:col-span-6">
                        <!-- BEGIN: Form Layout -->
                        <div class="intro-y box p-5">
                            <div>
                                <label>Client/Business Name, Phone or Email</label>
                                <input type="text" name="client_name" class="input w-full border mt-2" placeholder="Client/Busines name">
                            </div>
                            <div class="text-right mt-5">
                          <button type="submit" class="button w-30 bg-theme-1 text-white">SEARCH CLIENT</button>
                      </div>
                        </div>
                      
                        <!-- END: Form Layout -->
                    
                </div>
                </div>
</form>

<!-- END: Top Bar -->
<?php if(isset($clients) && !empty($clients)){ ?>
<h2 class="intro-y text-lg font-medium mt-10">
                    Client Details
                </h2>
                <div class="grid grid-cols-12 gap-6 mt-5">
                   
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-no-wrap">NAME</th>
                                    <th class="whitespace-no-wrap">EMAIL</th>
                                    <th class="text-center whitespace-no-wrap">PHONE</th>
                                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="intro-x">
                                   
                                    <td>
                                        <a href="" class="font-medium whitespace-no-wrap"><?=$clients->fullname?></a> 
                                    </td>
                                    <td class=""><?=$clients->email?></td>
                                    <td class=""><?=$clients->phone?></td>
                                   
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center items-center">
                                        <a class="flex items-center text-theme-1 mr-3 tooltip text-white" href="javascript:;" data-tit data-toggle="modal" data-theme="light" title="View Clent Details" data-target="#delete-confirmation-modal"> <i data-feather="eye" class="w-4 h-4 mr-1"></i> View </a>
                                            <a class="flex items-center text-theme-9 mr-3" href="javascript:;"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                            <!--a-- class="flex items-center text-theme-6 tooltip text-white" href="javascript:;" data-tit data-toggle="modal" data-theme="light" title="This is awesome tooltip example!" data-target="#delete-confirmation-modal"> <i data-feather="codesandbox" class="w-4 h-4 mr-1"></i> Cargo </!--a-->
                                        </div>
                                    </td>
                                </tr>
                             
                            </tbody>
                        </table>
                    </div>
                   
                </div>
                <!-- BEGIN: Delete Confirmation Modal -->
                <div class="modal" id="delete-confirmation-modal">
                    <div class="modal__content">
                    <div class="p-5 text-center">
                    <table class="table table-report table-report--bordered">
                           
                           <tbody>
                               <tr>
                                   <th class="border-b"><div class="text-gray-600 mt-2">NAME</div></th>
                                   <td class="border-b"> <div class="text-gray-600 mt-2"><?=$clients->fullname?></div></td>
                               </tr>
                               <tr>
                                   <th class="border-b"><div class="text-gray-600 mt-2">EMAIL</div></th>
                                   <td class="border-b"> <div class="text-gray-600 mt-2"><?=$clients->email?></div></td>
                               </tr>
                               <tr>
                                   <th class="border-b"><div class="text-gray-600 mt-2">PHOME</div></th>
                                   <td class="border-b"> <div class="text-gray-600 mt-2"><?=$clients->phone?></div></td>
                               </tr>
                               <tr>
                                   <th class="border-b"><div class="text-gray-600 mt-2">OTHER PHOME</div></th>
                                   <td class="border-b"> <div class="text-gray-600 mt-2"><?=$clients->other_phones?></div></td>
                               </tr>
                               <tr>
                                   <th class="border-b"><div class="text-gray-600 mt-2">ADDRESS</div></th>
                                   <td class="border-b"> <div class="text-gray-600 mt-2"><?=$clients->address?></div></td>
                               </tr>
                            
                           </tbody>
                       </table> 
                            
                        </div>
                   
                    </div>
                </div>
                <!-- END: Delete Confirmation Modal -->
            </div>
            <!-- END: Content -->
<?php } ?>