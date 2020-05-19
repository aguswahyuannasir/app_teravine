<div class="row">
    <div class="col-md-12">
        <div class="portlet light datatable">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-table font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">List <?php echo $setting['pagetitle']?></span>
                </div>
                <div class="actions">
                    <a href="<?=site_url($setting['url'])?>show_add" class="ajaxify btn green-meadow tooltips" data-original-title="Tambah Data" data-placement="top" data-container="body"><i class="fa fa-plus"></i> Add</a>
                   
                    <?php if($cek_count > 0 ){ ?>
                    <a href="javascript:" class="btn btn-sm yellow-crusta btn_show_filter tooltips" data-original-title="Cari" data-placement="top" data-container="body"><i class="fa fa-search"></i> Search</a>
                    <?php } ?>

                </div>
            </div>
            <div class="portlet-body">

                <?php if($cek_count > 0 ) { ?>

                <div class="table-container">
                    
                    <table class="table table-striped table-bordered table-hover" id="datatable_ajax">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="40px">No</th>
                                <th>Nama</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th width="130px">Action</th>
                            </tr>
                            <tr role="row" class="filter display-hide">
                                <td></td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="nama" placeholder="Nama">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="no_hp" placeholder="No HP">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="email" placeholder="Email">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="alamat" placeholder="Alamat">
                                </td>
                                <td class="text-center">
                                    <button data-original-title="Search" class="tooltips btn btn-sm yellow-crusta filter-submit margin-bottom"><i class="fa fa-search"></i></button>
                                    <button data-original-title="Reset" class="tooltips btn btn-sm red-sunglo filter-cancel"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
               
                <?php }else{ ?>  
                    <Center>
                    <span style="text-decoration: underline">
                    There's currently No Data Exists <br>
                    Please Create by Clicking the ADD button below
                    </span>
                    </Center>
                <?php } ?>

            </div>
        </div>

       
    </div>
</div>

 <script type="text/javascript">
$(document).ready(function() {

    //table customer
    var url = "<?=site_url($setting['url'].'get_table')?>";
    var header = [
        { "sClass": "text-center" },
        null,
        null,
        null,
        null,
        { "sClass": "text-center" }
    ];
    var order = [];
    var sort = [-1];

    TableAjax.initDefault(url, header, order, sort);
    

});
</script>