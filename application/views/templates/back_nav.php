
<div class="mobile-menu md:hidden">
            <div class="mobile-menu-bar">
                <a href="" class="flex mr-auto">
                    <img alt="EMY Cargo" class="w-6" src="<?= base_url(); ?>public/dist/images/logo.svg">
                </a>
                <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            </div>
            <ul class="border-t border-theme-24 py-5 hidden">
            <li>
                        <a href="<?=  site_url() ?>" class="side-menu <?php if(strtolower($controller)=='home'){ echo 'menu--active';}?>">
                            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                            <div class="side-menu__title"> Dashboard </div>
                        </a>
                    </li>

                    <li>
                    <a href="javascript:;" class="side-menu <?php if(strtolower($controller)=='clients'){ echo 'side-menu--active';}?>">
                        <div class="side-menu__icon"> <i data-feather="user"></i> </div>
                        <div class="side-menu__title"> Clients <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="<?php if(strtolower($controller)=='clients'){ echo 'side-menu__sub-open';}?>">
                    <li>
                            <a href="<?=  site_url('clients/new_client') ?>" class="side-menu <?php if(strtolower($method)=='new_client'){ echo 'side-menu--active';}?>">
                                <div class="side-menu__"> <i data-feather="user-plus"></i> </div>
                                <div class="side-menu__title"> New Client </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=  site_url('clients/search_client') ?>" class="side-menu <?php if(strtolower($method)=='search_client'){ echo 'side-menu--active';}?>">
                                <div class="side-menu__icon"> <i data-feather="search"></i> </div>
                                <div class="side-menu__title"> Search </div>
                            </a>
                        </li>
                        
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" class="side-menu <?php if(strtolower($controller)=='cargo'){ echo 'side-menu--active';}?>">
                        <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                        <div class="side-menu__title"> Cargos <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="<?php if(strtolower($controller)=='cargo'){ echo 'side-menu__sub-open';}?>">
                        <li>
                            <a href="<?=  site_url('cargo/cargo_search') ?>" class="side-menu <?php if(strtolower($method)=='cargo_search'){ echo 'side-menu--active';}?>">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Search </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=  site_url('cargo/cleared_cargos') ?>" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Cleared Cargos </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=site_url('cargo/uncleared_cargos') ?>" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Uncleared Cargos </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu  <?php if(strtolower($controller)=='invoice'){ echo 'side-menu--active';}?>">
                        <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                        <div class="side-menu__title"> Invoice <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class=" <?php if(strtolower($controller)=='invoice'){ echo 'side-menu__sub-open';}?>">
                       
                        <li>
                            <a href="<?=  site_url('invoice') ?>" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Generated Invoices </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                        <div class="side-menu__title"> Settings <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Set tariffs </div>
                            </a>
                        </li>
                        <li>
                            <a href="" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Other settings </div>
                            </a>
                        </li>
                    </ul>
                </li>
              
            </ul>
</div>
             <!-- END: Mobile Menu -->
        <div class="flex">
            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
                <a href="" class="intro-x flex items-center pl-5 pt-4">
                    <img alt="EMY Cargo" class="w-6" src="<?= base_url(); ?>public/dist/images/logo.svg">
                    <span class="hidden xl:block text-white text-lg ml-3"> EMY<span class="font-medium">Cargo</span> </span>
                </a>
                <div class="side-nav__devider my-6"></div>
                <ul>
                    <li>
                        <a href="<?=  site_url() ?>" class="side-menu <?php if(strtolower($controller)=='home'){ echo 'side-menu--active';}?>">
                            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                            <div class="side-menu__title"> Dashboard </div>
                        </a>
                    </li>
                    <li>
                    <a href="javascript:;" class="side-menu <?php if(strtolower($controller)=='clients'){ echo 'side-menu--active';}?>">
                        <div class="side-menu__icon"> <i data-feather="user"></i> </div>
                        <div class="side-menu__title"> Clients <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="<?php if(strtolower($controller)=='clients'){ echo 'side-menu__sub-open';}?>">
                    <li>
                            <a href="<?=  site_url('clients/new_client') ?>" class="side-menu <?php if(strtolower($method)=='new_client'){ echo 'side-menu--active';}?>">
                                <div class="side-menu__"> <i data-feather="user-plus"></i> </div>
                                <div class="side-menu__title"> New Client </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=  site_url('clients/search_client') ?>" class="side-menu <?php if(strtolower($method)=='search_client'){ echo 'side-menu--active';}?>">
                                <div class="side-menu__icon"> <i data-feather="search"></i> </div>
                                <div class="side-menu__title"> Search </div>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu <?php if(strtolower($controller)=='cargo'){ echo 'side-menu--active';}?>">
                        <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                        <div class="side-menu__title"> Cargos <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="<?php if(strtolower($controller)=='cargo'){ echo 'side-menu__sub-open';}?>">
                        <li>
                            <a href="<?=  site_url('cargo/cargo_search') ?>" class="side-menu <?php if(strtolower($method)=='cargo_search'){ echo 'side-menu--active';}?>">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Search </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=  site_url('cargo/cleared_cargos') ?>" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Cleared Cargos </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=site_url('cargo/uncleared_cargos') ?>" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Uncleared Cargos </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu  <?php if(strtolower($controller)=='invoice'){ echo 'side-menu--active';}?>">
                        <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                        <div class="side-menu__title"> Invoice <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class=" <?php if(strtolower($controller)=='invoice'){ echo 'side-menu__sub-open';}?>">
                       
                        <li>
                            <a href="<?=  site_url('invoice') ?>" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Generated Invoices </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="side-menu <?php if(strtolower($controller)=='settings'){ echo 'side-menu--active';}?>">
                        <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                        <div class="side-menu__title"> Settings <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="<?php if(strtolower($controller)=='settings'){ echo 'side-menu__sub-open';}?>">
                        <li>
                            <a href="<?=  site_url('settings/terminal_charges') ?>" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="dollar-sign"></i> </div>
                                <div class="side-menu__title"> Set Terminal Charges </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=  site_url('settings/company') ?>" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                                <div class="side-menu__title"> Company settings </div>
                            </a>
                        </li>
                    </ul>
                </li>
                </ul>
            </nav>
            <!-- END: Side Menu -->
 <!-- BEGIN: Content -->
 <div class="content">
           <!-- BEGIN: Top Bar -->
           <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active"><?= ucwords($method) ?></a> </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Account Menu -->
                    <div class="intro-x dropdown w-8 h-8 relative">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                            <img alt="Midone Tailwind HTML Admin Template" src="<?= base_url() ?>public/dist/images/profile-12.jpg">
                        </div>
                        <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                            <div class="dropdown-box__content box bg-theme-38 text-white">
                                
                                <div class="p-2">
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                                  
                                </div>
                                <div class="p-2 border-t border-theme-40">
                                    <a href="<?= site_url('home/logout') ?>" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Account Menu -->
                </div>

                <!-- END: Top Bar -->