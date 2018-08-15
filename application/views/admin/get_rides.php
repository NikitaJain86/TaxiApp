<style>
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
</style>
<script>
    $(document).ready(function () {
        var msg = '<?php echo $this->session->userdata("msg"); ?>';
        var type = '<?php echo $this->session->userdata("type"); ?>';

        if (msg != "" && type != "") {
            if (type == "success") {
                var icon = "fa fa-check-circle vd_green";
            } else {
                var icon = "fa fa-exclamation-circle vd_red";
            }
            notification("topright", type, icon, type, msg);
<?php echo $this->session->unset_userdata("msg"); ?>
<?php echo $this->session->unset_userdata("type"); ?>
        }


        $(document).on('click', '.btnaction', function () {
            var action = $(this).attr('data-original-title');
            var id = $(this).attr('id');
            if (action == 'edit' || action == "view") {
                $.ajax({
                    type: 'post',
                    url: '<?php echo $this->config->base_url() ?>admin/getUser',
                    data: "user_id=" + id,
                    success: function (data) {
                        $("#confirm").modal("show");
                        $("#response").html(data);
                    }
                });
            }
            if (action == 'delete') {
                $('#confirmdel')
                        .modal('show', {backdrop: 'static', keyboard: false})
                        .one('click', '#delete', function (e) {
                            $.ajax({
                                type: 'post',
                                url: '<?php echo $this->config->base_url() ?>admin/users/delete',
                                data: "user_id=" + id,
                                success: function () {
                                    $('.hiderow' + id).closest('tr').hide();
                                }
                            });
                        });
            }
        });

    });
</script>
<div aria-hidden="true" role="dialog" tabindex="-1" class="modal fade" id="confirmdel" style="display: none;z-index: 2147483648">
    <div class="modal-dialog">
        <div class="modal-body">
            Are you sure want to delete!
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
            <button type="button" data-dismiss="modal" class="btn">Cancel</button>
        </div>
    </div>
</div>
<div aria-hidden="true" role="dialog" tabindex="-1" class="modal fade" id="confirm" style="display: none;z-index: 2147483648">
    <div class="modal-dialog" id="response">

    </div>
</div>
<div class="vd_content-wrapper">
    <div class="vd_container">
        <div class="vd_content clearfix">
            <div class="vd_head-section clearfix">
                <div class="vd_panel-header">
                    <div class="vd_panel-menu hidden-sm hidden-xs" data-intro="<strong>Expand Control</strong><br/>To expand content page horizontally, vertically, or Both. If you just need one button just simply remove the other button code." data-step=5  data-position="left">
                        <div data-action="remove-navbar" data-original-title="Remove Navigation Bar Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-navbar-button menu"> <i class="fa fa-arrows-h"></i> </div>
                        <div data-action="remove-header" data-original-title="Remove Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="remove-header-button menu"> <i class="fa fa-arrows-v"></i> </div>
                        <div data-action="fullscreen" data-original-title="Remove Navigation Bar and Top Menu Toggle" data-toggle="tooltip" data-placement="bottom" class="fullscreen-button menu"> <i class="glyphicon glyphicon-fullscreen"></i> </div>
                    </div>
                </div>
            </div>
            <div class="vd_content-section clearfix">
                <div class="panel widget light-widget">
                    <div class="panel-body">
                        <div class="panel widget">
                            <div  class="panel-body table-responsive">
                                <div class="col-md-12">
                                    <form action="<?= $this->config->base_url() . 'admin/rides_search' ?>" method="post">

                                        <div class="col-md-4">
                                            <label>Search from driver OR user OR address</label>
                                            <input class="form-control" type="text" value="<?php echo!empty($data['email']) ? $data['email'] : ''; ?>" name="email"/>
                                        </div>

                                        <div class="col-md-2">
                                            <label>Status</label>
                                            <select class="form-control" name="is_active">
                                                <option value="">Select</option>
                                                <option <?php echo!empty($data['is_active']) ? $data['is_active'] == 'ACCEPTED' ? 'selected' : '' : ''; ?>  value="ACCEPTED">Accepted</option>
                                                <option <?php echo!empty($data['is_active']) ? $data['is_active'] == 'COMPLETED' ? 'selected' : '' : ''; ?>  value="COMPLETED">Completed</option>
                                                <option <?php echo isset($data['is_active']) ? $data['is_active'] == 'PENDING' ? 'selected' : '' : ''; ?>  value="PENDING">Pending</option>
                                                <option <?php echo isset($data['is_active']) ? $data['is_active'] == 'CANCELLED' ? 'selected' : '' : ''; ?>  value="CANCELLED">Cancelled</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1" style="margin-top:28px">
                                            <input type="submit" value="search" class="btn btn-success"/>
                                        </div>
                                        <?php if (!empty($chk)) { ?>
                                            <div class="col-md-1" style="margin-top:29px;width:105px;margin-left:14px">
                                                <a href="<?= $this->config->base_url() . 'admin/getrides' ?>" style="color: red">Clear search</a>
                                            </div>
                                        <?php } ?>

                                    </form>
                                </div>

                            </div>
                            <div class="panel-heading vd_bg-grey">
                                <h3 class="panel-title" style="color:#F9C30B"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Rides </h3>
                            </div>
                            <div  class="panel-body table-responsive">
                                <table id="example" class="table table-hover display">
                                    <thead>
                                        <tr>

                                            <th>Driver name</th>
                                            <th>User name</th>
                                            <th>Pickup address</th>
                                            <th>Drop address</th>
                                            <th>Amount</th>
                                            <th>Payment status</th>
											<th>Payment mode</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($result)) {
                                            foreach ($result as $val) {
                                                ?>
                                                <tr>
                                                    <td><?= $val->driver ?></td>
                                                    <td><?= $val->customer ?></td>
                                                    <td><?= $val->pickup_adress ?></td>
                                                    <td><?= $val->drop_address ?></td>
                                                    <td><?= $val->amount ?></td>
                                                    <td><?= $val->payment_status ?></td>
													<td><?= $val->payment_mode ?></td>
                                                    <td><?php if ($val->status == 'COMPLETED') { ?>
                                                            <span id="span" class="label label-success" style="background-color:green;color:white;">COMPLETED</span>
                                                        <?php } else if ($val->status == 'CANCELLED') { ?>
                                                            <span id = "span" class = "label label-success" style = "background-color:red;color:white;">CANCELLED</span >
                                                            <?php
                                                        } else if ($val->status == 'ACCEPTED') {
                                                            ?>
                                                            <span id = "span" class = "label label-success" style = "background-color:darkblue;color:white;">ACCEPTED</span >
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span id = "span" class = "label label-success" style = "background-color:orange;color:white;">PENDING</span >
                                                        <?php }
                                                        ?></td>
                                                    <td><a type="button" <?= $val->status != 'ACCEPTED' ? 'disabled' : '' ?> class="btn btn-sm btn-primary" href="<?= $this->config->base_url() ?>admin/index/<?= $val->ride_id ?>">View</a></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?= !empty($links) ? $links : ''; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
