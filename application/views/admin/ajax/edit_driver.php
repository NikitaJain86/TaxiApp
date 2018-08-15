<script>
    function imageIsLoadededit(e) {
        $('#myImgedit').show();
        $('#myno_img').hide();
        $('#myImgedit').attr('src', e.target.result);
        $('#image-div').hide();
    };
    $(function(){
        $('#myImgedit').hide();
        $("#edituploadBtn").change(function () {
            $(".edit-file").val($("#edituploadBtn").val());
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoadededit;
                reader.readAsDataURL(this.files[0]);
            }
        });
       
    });
</script>
<div class="panel widget light-widget col-md-12">
    <div class="panel-body">
        <h3 class="mgbt-xs-20">Edit Driver</h3>
        <hr/>
        <form enctype="multipart/form-data" class="form-horizontal"  action="<?php echo $this->config->base_url() ?>admin/drivers/update" method="post" role="form" id="register-form">
            <input type="hidden" value="<?php echo!empty($post['user_id']) ? $post['user_id'] : ''; ?>" name="user_id"/>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label  col-md-4">Name<span class="vd_red">*</span></label>
                    <div id="first-name-input-wrapper"  class="controls col-md-8">
                        <input type="text" placeholder="John" value="<?php echo!empty($post['name']) ? $post['name'] : ''; ?>" class="width-120 required" name="name" id="name" required >
                    </div>
                </div>
            </div>
<!--            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4">Address</label>
                    <div id="website-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <textarea class="width-120 required" name="address"><?php //echo $post['address'] ?></textarea>
                    </div>
                </div>
            </div>-->
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4">Mobile no.</label>
                    <div id="website-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <input type="text" placeholder="+66 1234 56789" class="width-120" value="<?php echo!empty($post['mobile']) ? $post['mobile'] : ''; ?>"  name="mobile" id="mobile">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4" >Email <span class="vd_red">*</span></label>
                    <div id="email-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <input type="email" placeholder="Email" class="width-120 required" required value="<?php echo!empty($post['email']) ? $post['email'] : ''; ?>" name="email" id="email">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4" >Vehicle Number <span class="vd_red">*</span></label>
                    <div id="email-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <input type="text" placeholder="Vehicle Number" class="width-120 required" required value="<?php echo!empty($post['vehicle_no']) ? $post['vehicle_no'] : ''; ?>" name="vehicle_no" id="vehicle_no">
                    </div>
                </div>
            </div>
<!--            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4" >ID Proof <span class="vd_red">*</span></label>
                    <div id="email-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <input type="text" placeholder="Id Proof" class="width-120 required" required value="<?php echo!empty($post['id_proof_name']) ? $post['id_proof_name'] : ''; ?>" name="id_proof_name" id="id_proof_name">
                    </div>
                </div>
            </div>-->
<!--            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4" >ID Proof Number<span class="vd_red">*</span></label>
                    <div id="email-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <input type="text" placeholder="Id Proof Number" class="width-120 required" required value="<?php echo!empty($post['id_proof_number']) ? $post['id_proof_number'] : ''; ?>" name="id_proof_number" id="id_proof_number">
                    </div>
                </div>
            </div>-->
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4">Status</label>
                    <div id="email-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <div class="vd_radio radio-success">
                            <input type="radio" <?php echo!empty($post['status']) ? $post['status'] == 1 ? 'checked' : ''  : '' ?> class="radiochk" value="1" id="optionsRadios8" name="status">
                            <label for="optionsRadios8"> Active</label>
                            <input type="radio" <?php echo empty($post['status']) ? 'checked' : '' ?> value="0" class="radiochk" id="optionsRadios9" name="status">
                            <label for="optionsRadios9"> Deactive</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4">Password <span class="vd_red">*</span></label>
                    <div id="password-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <input type="password" placeholder="Password" class="width-120"  name="password" id="password">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label col-md-4">Avatar</label>
                    <div id="email-input-wrapper"  class="controls col-sm-6 col-md-8">
                        <input class="edit-file" placeholder="Choose File" disabled="disabled" />
                        <div class="fileUpload btn btn-primary">
                            <span>Upload Photo</span>
                            <input  id="edituploadBtn" type="file"  name="avatar" class="upload" />
                        </div>
                        <br/>
                        <img id="myImgedit" style="width: 100px;height: 100px" src="../avatar/no-image.jpg" alt="your image" />
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
            <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
            <div class="form-group">
                <div class="col-md-9"></div>
                <div class="col-md-3 mgbt-xs-10 mgtp-20">
                    <div class="vd_checkbox  checkbox-success"></div>
                    <div class="vd_checkbox checkbox-success"></div>
                    <div class="mgtp-10">
                        <button class="btn vd_bg-green vd_white" type="submit" id="submit-register" name="submit-register">Submit</button>
                    </div>
                </div>
                <div class="col-md-12 mgbt-xs-5"> </div>
            </div>
        </form>
    </div>
</div>