<div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                       EDIT COMPANY DETAILS
                    </h2>
                </div>
                <form action="<?= site_url('settings/edit_company'); ?>" method="post">
                <input type="hidden" name="id" value="<?= $data->id; ?>">
               
                <?php  if($this->session->flashdata('error')){?>
                            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> <?= $this->session->flashdata('error'); ?> </div>
                        <?php } ?>
                        <?php  if($this->session->flashdata('message')){?>
                            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> <?= $this->session->flashdata('message'); ?> </div>
                        <?php } ?>
                <div class="grid grid-cols-12 gap-6 mt-5">
                  
                        <div class="intro-y col-span-12 lg:col-span-6">
                        <!-- BEGIN: Form Layout -->
                        <div class="intro-y box p-5">
                            <div  class="mt-3">
                                <label>Company Name</label>
                                <input type="text" name="company_name" value="<?= $data->company_name ?>" class="input w-full border mt-2" placeholder="" required>
                            </div>
                            <div class="mt-3">
                                <label>Company Address</label>
                                <input type="text" name="address" value="<?= $data->company_address ?>" class="input w-full border mt-2" placeholder="" required>
                            </div>
                            <div class="mt-3">
                                <label>RC/CAC NO</label>
                                <input type="text" name="rc_no" value="<?= $data->cac_no ?>" class="input w-full border mt-2" placeholder="" required>
                            </div>
                            <div class="mt-3">
                                <label>Company Email</label>
                                <input type="text" name="email" value="<?= $data->company_email ?>" class="input w-full border mt-2" placeholder="" required>
                            </div>

                            <div class="mt-3">
                                <label>Company Phone(s)</label>
                                <input type="text" name="phones" value="<?= $data->company_phones ?>" class="input w-full border mt-2" placeholder="" required>
                            </div>

                        </div>
                        <!-- END: Form Layout -->
                    
                </div>
                  
                  <div class="intro-y col-span-12 lg:col-span-6">
                  <!-- BEGIN: Form Layout -->
                  <div class="intro-y box p-5">
                    
                      <div class="mt-3">
                                <label>Bank Name</label>
                                <input type="text" name="bank" value="<?= $data->bank_name ?>" class="input w-full border mt-2" placeholder="" required>
                            </div>

                            <div class="mt-3">
                                <label>Account Name</label>
                                <input type="text" name="account_name" value="<?= $data->account_name ?>" class="input w-full border mt-2" placeholder="">
                            </div>

                            <div class="mt-3">
                                <label>Account Number</label>
                                <input type="text" name="account_no" value="<?= $data->account_number ?>" class="input w-full border mt-2" placeholder="" required>
                            </div>

                            <div class="text-right mt-5">
                          <button type="submit" class="button w-30 bg-theme-1 text-white">EDIT COMPANY</button>
                      </div>
                     
                  </div>
                  <!-- END: Form Layout -->
              
          </div>
                </div>
</form>