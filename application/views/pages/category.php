<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                     <div class="brands-name">
                            <ul class="panel-title">
                            <?php
                                        foreach($category as $key =>$cate){
                                        ?>
                            <li><a href="<?php echo base_url('danh-muc/'.$cate->id) ?>"><?php echo $cate->title ?></a>
                            </li>
                            <?php 
										}
									?>
                        </ul>
                    </div>
                    <!--/category-products-->

                    <div class="brands_products">
                        <!--brands_products-->
                        <h2>Brands</h2>
                        <div class="brands-name">
                            <ul class="panel-title">
                                <?php
                                        foreach($brand as $key =>$bra){
                                        ?>
                                <li><a
                                        href="<?php echo base_url('thuong-hieu/'.$bra->id) ?>"><?php echo $bra->title ?></a>
                                </li>
                                <?php 
										}
									?>
                            </ul>
                        </div>
                    </div>
                    <!--/brands_products-->



                    <div class="shipping text-center">
                        <!--shipping-->
                        <img src="images/home/shipping.jpg" alt="" />
                    </div>
                    <!--/shipping-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center"><?php echo $title ?></h2>
                    <?php 
						 foreach($category_product as $key=>$pro){
						 ?>
                    <form action="<?php echo base_url('add-to-cart') ?> " method="POST">
                    <div class="col-sm-4">
                   
                   
                        <div class="product-image-wrapper">
                            <div class="productinfo text-center">
                            <input type="hidden" value="<?php echo $pro->id ?>" name="product_id" >
                            <input type="hidden" value="1" name="quantity" >
                                <img width="150px" height="150px"
                                    src="<?php echo base_url('uploads/product/'.$pro->image) ?>" alt="" />
                                <h2><?php echo number_format($pro->price,0,',','.') ?>VND</h2>
                                <p><?php echo $pro->title ?></p>
                                <a href="<?php echo base_url('san-pham/'.$pro->id) ?>" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>Details</a>
                                <button type="submit" class="btn btn-default add-to-cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
                            </div>

                        </div>
                        <!--features_items-->

                        
                    </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
</section>