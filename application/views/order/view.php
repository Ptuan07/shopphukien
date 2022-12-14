<div class="container">
    <div class="card">
        <div class="card-header">
            List Order
        </div>
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
        <div class="card-body">
           <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">STT</th>
                <th scope="col">Order Code</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Image</th>
                <th scope="col">Product Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">SubTotal</th>
                <th scope="col">Manager</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($order_details as $key => $ord){
                ?>
                <tr>
                <th scope="row"><?php echo $key ?></th>
                <td><?php echo $ord->order_code ?></td>
                <td><?php echo $ord->title ?></td>
                <td><img src=" <?php echo base_url('uploads/product/'.$ord->image)  ?>" width="150" height="150"></td>
                <td><?php echo number_format($ord->price,0,',','.' );?></td>
                <td><?php echo $ord->qty  ?></td>
                
                <td>
                    <?php
                     echo number_format( $ord->qty * $ord->price,0,',','.' );
                    ?>
                </td>
                <td>

                </td>
                </tr>

                <?php
                    }
                ?>
               <tr>
                    <td>
                        <select class="xulydonhang form-control">
                            <?php 
                            if($ord->order_status==1){
                            ?>
                        <option selected id="<?php echo $ord->order_code ?>" value="0">---X??? l?? ????n h??ng---</option>
                        <option id="<?php echo $ord->order_code ?>" value="2">---????n h??ng ???? ???????c x??? l?? - ??ang giao h??ng---</option>
                        <option id="<?php echo $ord->order_code ?>" value="3">---????n h??ng ???? h???y---</option>
                     
                        <?php }elseif($ord->order_status==2){ ?>   
                            
                        <option  id="<?php echo $ord->order_code ?>" value="0">---X??? l?? ????n h??ng---</option>
                        <option selected id="<?php echo $ord->order_code ?>" value="2">---????n h??ng ???? ???????c x??? l?? - ??ang giao h??ng---</option>
                        <option id="<?php echo $ord->order_code ?>" value="3">---????n h??ng ???? h???y---</option>
                        
                        <?php }else{ ?>  
                            
                        <option  id="<?php echo $ord->order_code ?>" value="0">---X??? l?? ????n h??ng---</option>
                        <option id="<?php echo $ord->order_code ?>" value="2">---????n h??ng ???? ???????c x??? l?? - ??ang giao h??ng---</option>
                        <option selected id="<?php echo $ord->order_code ?>" value="3">---????n h??ng ???? h???y---</option>
                        <?php } ?>   
                    </select>
                    </td>
            </tr>
            </tbody>
            </table>

           
            </table>
        </div>
    </div>
</div>