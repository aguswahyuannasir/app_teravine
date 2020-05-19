<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-file font-green-meadow"></i>
            <span class="font-green-meadow"><?php echo $setting['pagetitle']; ?></span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form method="post" action="<?php echo site_url($setting['url'].'add') ?>" class="form-horizontal form-add">
            <input type="hidden" name="ex_csrf_token" value="<?= csrf_get_token(); ?>"><div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>There are some errors on the form. Please check below!</span>
            </div>
            <div class="alert alert-warning display-hide">
                <button class="close" data-close="alert"></button>
				<span>
                    <ul></ul>
				</span>
            </div>

            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-2"> Nama
                                <span class="required" aria-required="true">*</span>
                            </label>
                            <div class="col-md-7">
                                <input name="nama" type="text" class="form-control required" placeholder="Nama" maxlength="50">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-2">No HP
                                <span class="required" aria-required="true">*</span>
                            </label>
                            <div class="col-md-7">
                                <input name="no_hp" type="number" class="form-control required" placeholder="No HP">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-2">Email
                                <span class="required" aria-required="true">*</span>
                            </label>
                            <div class="col-md-7">
                                <input name="email" type="email" class="form-control required" placeholder="email">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-2">Alamat
                                <span class="required" aria-required="true">*</span>
                            </label>
                            <div class="col-md-7">
                                <input name="alamat" type="text" class="form-control required" placeholder="Alamat">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-icon-only green" id="add_alamat">
                                <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="add_arr_alamat"></div>


            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Create</button>
                                <a class="ajaxify" href="<?php echo site_url($setting['url']) ?>">
                                    <button type="button" class="btn default">Back</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>
            <a href="<?=site_url($setting['url'].$setting['method'])?>" class="ajaxify" id="reload" style="display: none;"></a>
        </form>
        <!-- END FORM-->
    </div>
</div>

<script>
    jQuery(document).ready(function() {
        // Fungsi Form Validasi
        var form = '.form-add';
        FormValidation.initDefault(form);

        
    });


    var no = -1;
    $('#add_alamat').off().on('click', function(e) {
        no += 1;
        var nomor = no + 1;
        var html_project = 
            '<div class="row">'+
                '<div class="col-md-12">'+
                    '<div class="form-group">'+
                        '<label class="control-label col-md-2">'+
                            '<span class="required" aria-required="true">*</span>'+
                        '</label>'+

                        '<div class="col-md-7">'+
                            '<input name="almt[]" id="almt_'+no+'" no="'+no+'" type="text" class="form-control required" placeholder="Alamat">'+
                        '</div>'+

                        '<div class="col-md-1">'+                                
                            '<button type="button" id="btn_remove_'+no+'" no="'+no+'" class="btn btn-icon-only red">'+
                            '<i class="fa fa-times"></i>'+
                            '</button>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>';
        $('#add_arr_alamat').append(html_project);

         //remove item
         $('#btn_remove_'+no).off().on('click', function (ev) {
            $(this).parent().parent().remove();
        });
    }); 

</script>