<div class="container">
    <div class="card">
        <div class="card-header">
            Create Product
        </div>
        <div class="card-body">
        <a href="<?php echo base_url('product/list') ?>" class="btn btn-success">List</a>
        <?php
            if($this->session->flashdata('success')){
                ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success') ?></div>
                <?php
                }
                elseif($this->session->flashdata('error'))
                {?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error') ?></div>
                <?php 
                }
           ?>
        <form action="<?php echo base_url('product/store') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1" >
                <?php echo '<span class="text text-danger">'.form_error('title').'</span>' ?>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Price</label>
                <input type="text" name="price" class="form-control" id="exampleInputEmail1" >
                <?php echo '<span class="text text-danger">'.form_error('price').'</span>' ?>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <input type="text" class="form-control" name="description" id="exampleInputPassword1">
                <?php echo '<span class="text text-danger">'.form_error('description').'</span>' ?>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Image</label>
                <input type="file" class="form-control-file" name="image" >
                <small><?php if(isset($error)){ echo $error;} ?></small>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Quantity</label>
                <input type="text" class="form-control" name="quantity" id="exampleInputPassword1">
                <?php echo '<span class="text text-danger">'.form_error('quantity').'</span>' ?>
            </div>

            <div class="form-group">
                <div class="form-group">
                 <label for="exampleFormControlSelect1">Category</label>
                    <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                       <?php 
                        foreach($category as $key => $cat){
                        ?>
                        <option value="<?php echo $cat->id ?>"><?php echo $cat->title ?></option>

                        <?php
                        }
                       ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="form-group">
                 <label for="exampleFormControlSelect1">Brand</label>
                    <select class="form-control" name="brand_id" id="exampleFormControlSelect1">
                    <?php 
                        foreach($brand as $key => $bra){
                        ?>
                        <option value="<?php echo $bra->id ?>"><?php echo $bra->title ?></option>

                        <?php
                        }
                       ?>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <div class="form-group">
                 <label for="exampleFormControlSelect1">Status</label>
                    <select class="form-control" name="status" id="exampleFormControlSelect1">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <button type="submit"  class="btn btn-primary">Add</button>
         </form>
        </div>
    </div>
</div>