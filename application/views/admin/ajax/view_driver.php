<div class="panel widget light-widget col-md-12">
    <div class="panel-body">
        <h3 class="mgbt-xs-20">View Driver Information</h3>
        <hr/>
        <form enctype="multipart/form-data" class="form-horizontal"  action="<?php echo $this->config->base_url() ?>admin/drivers/update" method="post" role="form" id="register-form">
            <input type="hidden" value="<?php echo!empty($post['user_id']) ? $post['user_id'] : ''; ?>" name="user_id"/>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label  col-md-4"><b>Name</b></label>
                    <div id="first-name-input-wrapper"  class="controls col-md-8">
                        <label class="control-label" ><?php echo!empty($post['name']) ? $post['name'] : ''; ?></label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4"><b>Mobile no</b></label>
                    <div id="website-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <label class="control-label" ><?php echo!empty($post['mobile']) ? $post['mobile'] : ''; ?></label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4" ><b>Email</b></label>
                    <div id="email-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <label class="control-label" ><?php echo!empty($post['email']) ? $post['email'] : ''; ?></label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4" ><b>Vehicle Number</b></label>
                    <div id="email-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <label class="control-label" ><?php echo!empty($post['vehicle_no']) ? $post['vehicle_no'] : ''; ?></label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4"><b>Status</b></label>
                    <div id="email-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <label class="control-label" ><?php echo!empty($post['status']) ? $post['status'] == 1 ? 'Active' : 'Deactive' : '' ?></label>

                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4"><b>Avatar</b></label>
                    <div id="email-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <?php if (!empty($post['avatar'])) { ?>
                            <div id="image-div">
                                <img id="img" src="<?php echo $post['avatar'] ?>" style="height: 100px;width: 100px"/>
                            </div>
                        <?php } else {
                            ?>
                            <img id="myno_img" style="width: 100px;height: 100px" src="../avatar/no-image.jpg" alt="your image" />
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4"><b>License</b></label>
                    <div id="email-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <?php if (!empty($post['license'])) { ?>
                            <div id="image-div">
                                <img id="img" src="<?php echo base_url() . $post['license'] ?>" style="height: 200px;width: 300px"/>
                            </div>
                        <?php } else {
                            ?>
                            <img id="myno_img" style="width: 100px;height: 100px" src="../avatar/no-image.jpg" alt="your image" />
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4"><b>Insurance</b></label>
                    <div id="email-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <?php if (!empty($post['insurance'])) { ?>
                            <div id="image-div">
                                <img id="img" src="<?php echo base_url() . $post['insurance'] ?>" style="height: 300px;width: 200px"/>
                            </div>
                        <?php } else {
                            ?>
                            <img id="myno_img" style="width: 100px;height: 100px" src="<?php echo base_url() ?>avatar/no-image.jpg" alt="your image" />
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4"><b>Permit</b></label>
                    <div id="email-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <?php if (!empty($post['permit'])) { ?>
                            <div id="image-div">
                                <img id="img" src="<?php echo base_url() . $post['permit'] ?>" style="height: 200px;width: 200px"/>
                            </div>
                        <?php } else {
                            ?>
                            <img id="myno_img" style="width: 100px;height: 100px" src="<?php echo base_url() ?>avatar/no-image.jpg" alt="your image" />
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4"><b>Registration</b></label>
                    <div id="email-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <?php if (!empty($post['registration'])) { ?>
                            <div id="image-div">
                                <img id="img" src="<?php echo base_url() . $post['registration'] ?>" style="height: 200px;width: 200px"/>
                            </div>
                        <?php } else {
                            ?>
                            <img id="myno_img" style="width: 100px;height: 100px" src="<?php echo base_url() ?>avatar/no-image.jpg" alt="your image" />
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>