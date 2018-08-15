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
    })
    $(document).on("click", "#submit-register", function () {
        if ($("#password").val() == $("#confirm_password").val()) {
            if ($("#password").val() == '' || $("#confirm_password").val() == '') {
                alert("password and confirm password should not be empty")
                return false;
            } else {
                $("#register-form").submit();
            }
        } else {
            alert("password and confirm password must be same")
            return false;
        }
    });
</script>

<div class="vd_content-wrapper">
    <div class="vd_container">
        <div class="vd_content clearfix">

            <div class="vd_content-section clearfix">
                <div class="panel widget light-widget">
                    <div class="panel-body">
                        <div class="panel widget">
                            <div class="panel-heading vd_bg-grey">
                                <h3 class="panel-title" style="color:#F9C30B"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span>Reset Password</h3>
                            </div>
                            <div  class="panel-body table-responsive left">
                                <form class="form-horizontal"  action="<?= $this->config->base_url() ?>user/reset_password" method="post" role="form" id="register-form">
                                    <input type="hidden" value="<?= $res->user_id ?>" name="user_id"/>
                                    <div class="form-group">
                                        <label class="control-label  col-md-2">New Password<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="password" placeholder="New Password" value="" class="width-120 required"  name="password" id="password" required >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label  col-md-2">Confirm Password<span class="vd_red">*</span></label>
                                        <div id="first-name-input-wrapper"  class="controls col-md-8">
                                            <input type="password" placeholder="Confirm password" value="" class="width-120 required"  name="confirm_password" id="confirm_password" required >
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-left:160px">
                                        <button class="btn vd_bg-green vd_white" id="submit-register">Submit</button>
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
<footer class="footer-1"  id="footer">      
    <div class="vd_bottom ">
        <div class="container">
            <div class="row">
                <div class=" col-xs-12">
                    <div class="copyright">
                        Copyright &copy;2017 http://www.icanstudioz.com
                    </div>
                </div>
            </div><!-- row -->
        </div><!-- container -->
    </div>
</footer>