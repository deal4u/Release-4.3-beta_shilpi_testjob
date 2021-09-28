<div class="col-lg-12 animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <?php foreach ($images as $image){ ?>
                <div class="file-box rmveable-main text-center">
                    <div class="file gray_bg">
                        <span class="corner"></span>
                        <div class="image">

                           <?php
                           $file_name=  explode('.',$image['file']);
                           
                            $file_ext= strtolower(end($file_name));
                            if($file_ext == 'pdf'){
								$src = 'assets/claim_files/pdf.jpg';
							} elseif($file_ext == 'doc'){ 
								$src = "assets/claim_files/doc.jpg";
							} elseif($file_ext == 'docx'){ 
								$src = "assets/claim_files/docx.png";
							} elseif($file_ext == 'csv'){ 
								$src = "assets/claim_files/csv.png";							  
							} elseif($file_ext == 'txt'){ 
								$src = "assets/claim_files/txt.png";
							} elseif($file_ext == 'xls'){ 
								$src = "assets/claim_files/xls.png";
							} else{ 
								$src = "assets/claim_files/".$image['file']; 
							} ?>
							<a target="_blank" href="<?php echo base_url()?>admin/claims/view_file/<?php echo $image['id']; ?>" >
                                <img alt="image" class="img-fluid" src="<?php echo base_url($src); ?>"></a>

                        </div>
                        <div class="file-name text-left pb-4">
                           
                             <span>Name:</span><span class="related-name"><?php echo $image['name']; ?></span>
                            <br/>
                            <small><span>Added:</span> <?php echo date('F jS, Y' ,strtotime($image['created_at'])); ?></small>
                        </div>
						<?php if($image['claim_id']!=""){
							$class="remove-claim-related";
						}else{
							$class="remove-related";
						} ?>
                        <a href="javascript:void(0);" class="<?php echo $class; ?> btn btn-danger btn-sm" data-id="<?php echo $image['id']; ?>" data-claim-id="<?php echo $image['claim_id']; ?>"><i class="fa fa-trash"></i> Remove</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>