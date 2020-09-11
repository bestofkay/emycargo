<app-header>
</app-header>
<main class="main-wrapper clearfix">
    <!-- Page Title Area -->
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Admin</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a routerLink="<?= site_url('home'); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Admin</li>
            </ol>
        </div>
        <!-- /.page-title-right -->
    </div>
    <!-- /.page-title -->
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <h5 class="box-title mr-b-0">New Role</h5>
                        <p>&nbsp;</p>
                        <div *ngIf="isError" class="alert alert-icon alert-danger border-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button> <i class="material-icons list-icon">not_interested</i> {{ errResponse }}</div>

                        <div *ngIf="isSuccess" class="alert alert-icon alert-success border-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button> <i class="material-icons list-icon">check_circle</i> {{ sucResponse }}</div>

                        <form class="form-material" #roleForm="ngForm" (ngSubmit)="onSubmit(roleForm)">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" id="l30" ngModel name="name" placeholder="Enter Admin role" type="text" id="name">
                                        <input value="{{ mytoken }}"  ngModel name="token" type="hidden" id="token">
                                        <label for="l30">Role name</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                <div class="form-group">
                                
                                    <select id="approve" class="m-b-10 form-control" ngModel name="approve" data-placeholder="Choose" data-toggle="select2">
                                            <option value=" ">HAS APPROVAL POWER?</option>
                                            <option value="0">NO</option>
                                            <option value="1">YES</option>
                                    </select>
                                   
                                </div>
                                </div>

                            </div>

                            <div class="form-actions btn-list">
                                <button class="btn btn-primary" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.widget-list -->
    <div class="col-md-12 widget-holder">
        <div class="widget-bg">
            <div class="widget-heading clearfix">
                <h5>Edit Role / Add Privileges </h5>
            </div>
            <!-- /.widget-heading -->
            <div class="widget-body clearfix">
                <table class="table-responsive">
                    <thead>
                        <tr>
                            <th data-editable="">Role</th>
                            <th data-editable="">Approve</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                       
                    </tbody>
                </table>
            </div>
            <!-- /.widget-body -->
        </div>
    </div>

</main>