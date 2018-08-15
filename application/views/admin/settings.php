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
    });
</script>
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
                            <div class="panel-heading vd_bg-grey">
                                <h3 class="panel-title" style="color:#F9C30B"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span>Change API key</h3>
                            </div>
                            <div  class="panel-body table-responsive left">
                                <form class="form-horizontal"  action="<?= $this->config->base_url() ?>admin/settings" method="post" role="form" id="register-form">
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">API key<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="text" placeholder="API key" value="<?php echo $res->api_key ?>" class="width-120 required"  name="api_key" id="api_key" required >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label  col-md-2">Map API key<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="text" placeholder="map API key" value="<?php echo $res->google_api_key ?>" class="width-120 required"  name="google_api_key" id="google_api_key" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">Paypal Id<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="text" placeholder="paypal ID" value="<?php echo $res->paypal_id ?>" class="width-120 required"  name="paypal_id" id="paypal_id" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">Paypal Password<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="text" placeholder="Paypal Password" value="<?php echo $res->paypal_password ?>" class="width-120 required"  name="paypal_password" id="paypal_password" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">Paypal Signature<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="text" placeholder="Paypal Signature" value="<?php echo $res->signature ?>" class="width-120 required"  name="signature" id="signature" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">Paypal Account<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <select name="paypal_account" id="paypal_account">
                                                <option <?php echo $res->paypal_account == 'sandbox' ? 'selected' : '' ?> value="sandbox">Sandbox</option>
                                                <option <?php echo $res->paypal_account == 'live' ? 'selected' : '' ?> value="live">Live</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">Driver Rate in %<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="text" placeholder="Driver rate" value="<?php echo $res->driver_rate ?>" class="width-120 required"  name="driver_rate" id="driver_rate" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">Ride fare(Per kilometer)<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="text" placeholder="Ride fare(Per kilometer)" value="<?php echo $set[0]->value ?>" class="width-120 required"  name="FARE" id="fare" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">UNIT<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="text" placeholder="UNIT" value="<?php echo $set[1]->value ?>" class="width-120 required"  name="UNIT" id="unit" required >
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-left:160px">
                                        <button class="btn vd_bg-green vd_white" type="submit" id="submit-register">Submit</button>
                                    </div>
                                </form>
                            </div>

                            <div class="panel-heading vd_bg-grey">
                                <h3 class="panel-title" style="color:#F9C30B"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span>Mail SMTP settings</h3>
                            </div>
                            <div  class="panel-body table-responsive left">
                                <form class="form-horizontal"  action="<?= $this->config->base_url() ?>admin/mail_setting" method="post" role="form" id="register-form">
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">Host<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="text" placeholder="SMTP host name" value="<?php echo $set[2]->value ?>" class="width-120 required"  name="SMTP_HOST" id="host" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">Port<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="text" placeholder="SMTP port number" value="<?php echo $set[3]->value ?>" class="width-120 required"  name="SMTP_PORT" id="smtp_port" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">smtp username<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="text" placeholder="SMTP user" value="<?php echo $set[4]->value ?>" class="width-120 required"  name="SMTP_USER" id="smtp_user" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">smtp password<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="text" placeholder="SMTP pass" value="<?php echo $set[5]->value ?>" class="width-120 required"  name="SMTP_PASS" id="smtp_pass" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">From<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="text" placeholder="Format: admin@icanstudioz.com" value="<?php echo $set[6]->value ?>" class="width-120 required"  name="FROM" id="smtp_from" required >
                                            <br/>
                                            <label class="control-label  col-md-5">example:- demo@icanstudioz.com</label>
                                        </div>

                                    </div>
                                    <div class="form-group" style="margin-left:160px">
                                        <button class="btn vd_bg-green vd_white" type="submit" id="submit-register">Submit</button>
                                    </div>
                                </form>
                            </div>

                            <div class="panel-heading vd_bg-grey">
                                <h3 class="panel-title" style="color:#F9C30B"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span>Change Password</h3>
                            </div>
                            <div  class="panel-body table-responsive left">
                                <form class="form-horizontal"  action="<?= $this->config->base_url() ?>admin/settings" method="post" role="form" id="register-form">
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">Old Password<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="password" placeholder="Old Password" value="" class="width-120 required"  name="old_password" id="password" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">New Password<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="password" placeholder="New Password" value="" class="width-120 required"  name="new_password" id="new_password" required >
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-left:160px">
                                        <button class="btn vd_bg-green vd_white" type="submit" id="submit-register">Submit</button>
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
