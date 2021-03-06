<script type="text/javascript">
  function item_total (input, price, response) {
    var input_items = document.getElementById(input).value;
    var total_price = input_items * price;
    document.getElementById(response).innerHTML = total_price.toFixed(2);
  }
</script>
<div id="modal-addtocart" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add to Cart</h4>
      </div>
      <div class="modal-body">
      <?php
        $cart_query = $conn->query("select * from carts_tbl where item_id  = '".$item_row['item_id']."' and acc_id = '".$cos_row['acc_id']."' and cart_status = 'Pending'");
            $cart_row = $cart_query->fetch();
        if ($cart_row['item_id'] != $item_row['item_id']) {
      ?> 
        <span id="savecart-response<?=$item_row['item_id'];?>">
        <form id="savecart-form<?=$item_row['item_id'];?>" method="POST">
          <input type="hidden" name="acc_id" value="<?=$cos_row['acc_id'];?>">
          <input type="hidden" name="item_id" value="<?=$item_row['item_id'];?>">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
               <div class="col-lg-2 col-lg-2">
                  <div class="border" style="height: 130px; overflow: hidden;">
                    <img src="<?=$item_row['item_photo'];?>" style="height: 100%; width: auto;">
                  </div>
               </div>
               <div class="col-lg-4 col-lg-4">
                  <h4 class="margin-top-sm margin-bottom-sm"><?=$item_row['name'];?></h4>
                    <p class="text-small text-muted margin-bottom">by: <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
                    <p class="text-left"><strong>Price:</strong> P<?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
                    <p class="text-left"><strong>Items Left:</strong> <?=$quantity_row['quantity'];?> Items</p>
               </div>
               <div class="col-lg-2 col-lg-2">
                  <label class="margin-top">No. of items:</label>
                  <input type="number" min="1" max="<?=$item_row['quantity'];?>" onkeyup="item_total ('input_item<?=$item_row['item_id'];?>', '<?=$item_row['price'];?>', 'total_response<?=$item_row['item_id'];?>')" value="1" id="input_item<?=$item_row['item_id'];?>" class="form-control input-lg" name="quantity">
               </div>
               <div class="col-lg-2 col-lg-2">
                  <label class="margin-top">Total Price:</label>
                  <p class="margin-top-sm lead">P<span id="total_response<?=$item_row['item_id'];?>"><?=$item_row['price'];?></span></p>
               </div>
               <div class="col-lg-2 col-lg-2">
                  <button type="submit" style="margin-top: 35px;" class="btn btn-danger btn-lg btn-block" onclick="form_process ('savecart-form<?=$item_row['item_id'];?>', '../functions/save-cart-2.php', 'savecart-response<?=$item_row['item_id'];?>')">Add</button>
               </div> 
            </div>
            </div>
          </div>
        </form>
        </span>
      <?php
        }
        else {
        ?>
        <span id="cancelcart-response<?=$item_row['item_id'];?>">
          <input type="hidden" name="acc_id" value="<?=$cos_row['acc_id'];?>">
          <input type="hidden" name="item_id" value="<?=$item_row['item_id'];?>">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row">
               <div class="col-lg-2 col-lg-2">
                  <div class="border" style="height: 130px; overflow: hidden;">
                    <img src="<?=$item_row['item_photo'];?>" style="height: 100%; width: auto;">
                  </div>
               </div>
               <div class="col-lg-4 col-lg-4">
                  <h4 class="margin-top-sm margin-bottom-sm"><?=$item_row['name'];?></h4>
                    <p class="text-small text-muted margin-bottom">by: <?=$seller_row['firstname'];?> <?=$seller_row['lastname'];?></p>
                    <p class="text-left"><strong>Price:</strong> P<?=$item_row['price'];?>/<?=$item_row['unit'];?></p>
                    <p class="text-left"><strong>Items Left:</strong> <?=$quantity_row['quantity'];?> Items</p>
               </div>
               <div class="col-lg-2 col-lg-2">
                  <label class="margin-top">No. of items:</label>
                  <p class="margin-top-sm lead"><?=$cart_row['quantity'];?></p>
               </div>
               <div class="col-lg-2 col-lg-2">
                  <label class="margin-top">Total Price:</label>
                  <p class="margin-top-sm lead">P<?=$cart_row['total_price'];?></p>
               </div>
               <div class="col-lg-2 col-lg-2">
                  <button type="submit" style="margin-top: 35px;" class="btn btn-danger btn-lg btn-block" onclick="load_process ('cancelcart-response<?=$item_row['item_id'];?>', '../functions/delete-module.php?cart_id=<?=$cart_row['cart_id'];?>')">Cancel</button>
               </div> 
            </div>
            </div>
          </div>
        </span>
        <?php    
        }
      ?>  
      </div>
      <div class="modal-footer">
        <a class="btn btn-info btn-lg" href="cos-checkout.php">Proceed to Checkout <i class="fa fa-chevron-right fa-fw"></i></a>
      </div>
    </div>
  </div>
</div>      