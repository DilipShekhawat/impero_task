@extends('frontend/layouts/app')
@section('content')
<?php
// defining array of names according to id
$paymentYype=[1=>'cash', 2=>'cheque', 3=>'online', 4=>'none', 5=>'paymentDue', 6=>'webPayment'];
$pinTypeId=[1=>'sale', 2=>'not_home', 3=>'no', 4=>'already_bought', 5=>'delivery_pending'];

 ?>
        <div class="card-deck">
           <div class="col-xl-12">
              <div class="dash-table-cover">
                <div class="manage-bk-text">
                  <h4>MANAGE Products</h4>
                  <div class="go-bk">
                      <div class="d-flex">
                        <a class="btn un-btn" href="{{route('add_excel')}}"> + Upload Excel </a>
                      </div>
                  </div>
                </div>
                <div class="row my-5">
                  <div class="search-here pb-3 col-6" >
                    <form class="form-inline flex-form-group " method="post">
                      @csrf
                      <select class="form-control inputfromfield select2 col-8" placeholder="select multiple products" name="productNames[]" multiple >
                        <option label="Select products" value="">Select products</option>
                        <?php if($products){
                          foreach ($products as $key => $value) {
                         ?>
                        <option <?= in_array($value,$selectedProduct) ? 'selected' : '' ?> value="<?= $value ?>"> <?= $value ?></option>
                        <?php }} ?>
                      </select>
                      <button type="submit" class="nav-link btn btn-blue  btn-sm col-3 ml-3">Submit</button>

                    </form>
                  </div>
                  
                  <!-- date picker form -->
                  <div class="search-here pb-3 col-6">
                    <form class="form-inline flex-form-group datesearch" >
                      @csrf
                      <input class="form-control" type="text" name="daterange" value="<?= isset($_GET['daterange']) ? $_GET['daterange'] : ''  ?>" />
                    <a class="btn" aria-current="page" href="{{route('welcome')}}">Reset</a>
                    </form>
                  </div>
                  <!-- date picker form -->
                </div>
                <div class="table-responsive">
                  <table class="table tb-bg" id="datatable">
                      <thead>
                        <tr class="head-booking">
                          <th>Order Id</th>
                          <th>Payment Type</th>
                          <th>Pintype Id</th>
                          <th>Customer Name</th>
                          <th>Full Address</th>
                          <th>Order Date</th>
                          <th style="min-width: 150px;">Price </th>
                          <th>Quantity</th>
                          <th>Product Name</th>
                        </tr>
                      </thead>
                      <tbody class="AjaxData">
                        <?php 
                        if($data){
                        foreach ($data as $ckey => $cvalue) { 
                          ?>
                          <tr class="books-details">
                            
                            <td><?= $cvalue['order_id'] ?></td>
                            <td><?= $paymentYype[$cvalue['payment_type']] ?></td>
                            <td><?= $pinTypeId[$cvalue['pin_type_id']] ?></td>
                            <td><?= $cvalue['customer_name'] ?></td>
                            <td><?= $cvalue['full_address'] ?></td>
                            <td><?= $cvalue['order_date'] ?></td>
                            <td class="balance"><?= $cvalue['price'] ?></td>
                            <td><?= $cvalue['quantity'] ?></td>
                            <td><?= $cvalue['product_name'] ?></td>
                          </tr>
                        <?php } }?>
                        
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="6" style="text-align:right">Total:</th>
                          <th id="stockqty"></th>
                          <th ></th>
                          <th ></th>
                        </tr>

                      </tfoot>
                  </table>

                </div>
              </div>
           </div>
        </div>
  <script type="text/javascript">
      $(document).ready(function() {
        $('#datatable').DataTable({
               
          "footerCallback": function(row, data, start, end, display) {
              var api = this.api(),data;
              var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
                //for total of all row
              total = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
              pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                // generate net percentage per page of total  
                var percentage= (pageTotal/total)*100;
                percentage= parseFloat(percentage).toFixed(2);
                // check if perentage has number or not
                percentage = isNaN(percentage) ? 0 : percentage;
                
            $( api.column( 6 ).footer() ).html('$'+pageTotal+'('+percentage +' %)' );
          }
        });
        /*select 2 functionality*/
        $('.select2').select2({
          placeholder: "Select Products",
          
        });
    });
    </script>
@endsection

