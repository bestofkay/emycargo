<div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                       EDIT TERMINAL CHARGES
                    </h2>
                </div>
                <form action="<?= site_url('settings/edit_charges'); ?>" method="post">
               
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
                            <?php $x=0;foreach($data as $e){ $x++; if($x < 7){?>
                            <div  class="mt-3">
                                <label><?= $e->name ?></label>
                                <input type="hidden" name="id[]" value="<?= $e->id; ?>">
                                <input type="number" name="charges[]" value="<?= $e->charges ?>" class="input w-full border mt-2" step="any" placeholder="" required>
                            </div>
                            <?php }} ?>
                        </div>
                        <!-- END: Form Layout -->
                    
                </div>
                  
                  <div class="intro-y col-span-12 lg:col-span-6">
                  <!-- BEGIN: Form Layout -->
                  <div class="intro-y box p-5">
                    
                  <?php $x=0;foreach($data as $e){ $x++; if($x > 6){?>
                            <div  class="mt-3">
                                <label><?= $e->name ?></label>
                                <input type="hidden" name="id[]" value="<?= $e->id; ?>">
                                <input type="text" name="charges[]" value="<?= $e->charges ?>" class="input w-full border mt-2" placeholder="" required>
                            </div>
                            <?php }} ?>

                            <div class="text-right mt-5">
                          <button type="submit" class="button w-30 bg-theme-1 text-white">EDIT TARIFF</button>
                      </div>
                     
                  </div>
                  <!-- END: Form Layout -->
              
          </div>
                </div>
</form>