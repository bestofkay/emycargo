<div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Add New Cargo to <?= $client_details->fullname; ?>
                    </h2>
                </div>
                <form action="<?= site_url('cargo/create_action'); ?>" method="post">
                <input type="hidden" name="client_id" value="<?= $client_details->id; ?>">
                <input type="hidden" name="client_name" value="<?= $client_details->uniqueID.'_'.$client_details->id; ?>">
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
                                <label>Container Number</label>
                                <input type="text" name="container_no" class="input w-full border mt-2" placeholder="Container No" required>
                            </div>
                            <div class="mt-3">
                                <label>Port of Laden</label>
                                <input type="text" name="laden" class="input w-full border mt-2" placeholder="Port of laden" required>
                            </div>
                            <div class="mt-3">
                                <label>Port of Discharge</label>
                                <input type="text" name="discharge" class="input w-full border mt-2" placeholder="Port of arrival" required>
                            </div>

                            <div class="mt-3">
                                <label>Bill Number</label>
                                <input type="text" name="bill_no" class="input w-full border mt-2" placeholder="Bill No" required>
                            </div>

                            <div class="mt-3"> <label>Early Delivery?</label>
                                <div class="flex items-center text-gray-700 mt-2"> <input type="radio" class="input border mr-2" id="vertical-radio-chris-evans"  name="early" value="1" required> <label class="cursor-pointer select-none" for="vertical-radio-chris-evans">Yes</label> </div>
                                <div class="flex items-center text-gray-700 mt-2"> <input type="radio" name="early" class="input border mr-2" id="vertical-radio-liam-neeson" name="vertical_radio_button" value="0"> <label class="cursor-pointer select-none" for="vertical-radio-liam-neeson">No</label> </div>
                              
                            </div>

                            <div class="mt-3"s> <label>Late Delivery?</label>
                                <div class="flex items-center text-gray-700 mt-2"> <input type="radio" class="input border mr-2" id="vertical-radio-chris-evans"  name="late" value="1" required> <label class="cursor-pointer select-none" for="vertical-radio-chris-evans">Yes</label> </div>
                                <div class="flex items-center text-gray-700 mt-2"> <input type="radio" name="late" class="input border mr-2" id="vertical-radio-liam-neeson"  value="0"> <label class="cursor-pointer select-none" for="vertical-radio-liam-neeson">No</label> </div>
                              
                            </div>

                            <div class="mt-3">
                                <label>Call No</label>
                                <input type="text" name="callNo" class="input w-full border mt-2" placeholder="Call No" required>
                            </div>

                            <div class="mt-3">
                                <label>Voyage Number</label>
                                <input type="text" name="voyageNo" class="input w-full border mt-2" placeholder="Voyage No" required>
                            </div>

                            <div class="mt-3">
                                <label>Line Operator</label>
                                <input type="text" name="line" class="input w-full border mt-2" placeholder="Line Operator">
                            </div>

                            <div class="text-right mt-5">
                          <button type="submit" class="button w-30 bg-theme-1 text-white">ADD CARGO</button>
                      </div>
                        </div>
                        <!-- END: Form Layout -->
                    
                </div>
                  
                  <div class="intro-y col-span-12 lg:col-span-6">
                  <!-- BEGIN: Form Layout -->
                  <div class="intro-y box p-5">
                    
                      <div class="mt-3">
                          <label>Start date</label>
                          <input class="datepicker input w-full border mt-2" name="start" required>
                      </div>

                      <div class="mt-3">
                          <label>Arrival date</label>
                          <input class="datepicker input w-full border mt-2" name="end" required> 
                      </div>

                      <div class="mt-3">
                          <label>Due date</label>
                          <input class="datepicker input w-full border mt-2" name="due" required>
                      </div>

                      <div class="mt-3">
                                <label>Vessel</label>
                                <input type="text" name="vessel" class="input w-full border mt-2" placeholder="Vessel name" required>
                            </div>

                            <div class="mt-3">
                                <label>Manifest</label>
                                <input type="text" name="manifest" class="input w-full border mt-2" placeholder="Manifest">
                            </div>

                            <div class="mt-3">
                                <label>Weight</label>
                                <input type="text" name="weight" class="input w-full border mt-2" placeholder="Weight" required>
                            </div>

                            <div class="mt-3">
                                <label>Volume</label>
                                <input type="text" name="volume" class="input w-full border mt-2" placeholder="Volume" required>
                            </div>

                            <div class="mt-3">
                                <label>Mode</label>
                                <input type="text" name="mode" class="input w-full border mt-2" placeholder="Mode" required>
                            </div>

                            <div class="mt-3">
                                <label>Package</label>
                                <input type="text" name="package" class="input w-full border mt-2" placeholder="Package">
                            </div>
                            <div class="mt-3">
                                <label>Comment</label>
                                <textarea name="comment" class="input w-full border mt-2" placeholder="Enter Comment"></textarea>
                            </div>
                     
                  </div>
                  <!-- END: Form Layout -->
              
          </div>
                </div>
</form>