<div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Register New Client
                    </h2>
                </div>
                <form action="<?= site_url('clients/create_action'); ?>" method="post">
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
                            <div>
                                <label>Client/Business Name</label>
                                <input type="text" name="client_name" class="input w-full border mt-2" placeholder="Client/Busines name">
                            </div>
                            <div class="mt-3">
                                <label>Email</label>
                                <div class="relative mt-2">
                                    <input type="text" name="email" class="input pr-12 w-full border col-span-4" placeholder="Email Address">
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"></div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label>Primary Phone</label>
                                <div class="relative mt-2">
                                    <input type="text" name="phone_no" class="input pr-12 w-full border col-span-4" placeholder="Primary Phone">
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"></div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label>Other Phones</label>
                                <div class="relative mt-2">
                                    <input type="text" name="o_phone_no" class="input pr-12 w-full border col-span-4" placeholder="Other Phone">
                                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"></div>
                                </div>
                            </div>


                        </div>
                        <!-- END: Form Layout -->
                    
                </div>
                  
                  <div class="intro-y col-span-12 lg:col-span-6">
                  <!-- BEGIN: Form Layout -->
                  <div class="intro-y box p-5">
                    
                      <div class="mt-3">
                          <label>Address</label>
                          <div class="mt-2">
                              <textarea data-feature="basic" class="summernote" name="address"></textarea>
                          </div>
                      </div>
                      <div class="text-right mt-5">
                          <button type="submit" class="button w-30 bg-theme-1 text-white">ADD CLIENT</button>
                      </div>
                  </div>
                  <!-- END: Form Layout -->
              
          </div>
                </div>
</form>