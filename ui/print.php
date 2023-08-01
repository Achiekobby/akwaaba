<?php 

include_once 'connectdb.php';
session_start();



include_once "header.php";


?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Waybill</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
           
         
          <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Waybill</h5>
              </div>
              <div class="card-body">
                


 <!-- Main content -->
 <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> Waybill.
                    <small class="float-right">Date: 2/10/2014</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  CONSIGNOR
                  <address>
                    <strong>AKWAABA LINK INVESTMENT LTD.</strong><br>
                    P .O BOX CO 13311, TEMA<br>
                    Phone: 0553997745 / 0553997746<br>
                    Email: akwaabalinkgh@gmail.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                <strong>CUSTOMER:</strong> GB Oil Limited:                 
                <br><strong>CUSTOMER NO:</strong> GB1607601
                <br><strong>DESTINATION:</strong> VALCO-TEMA 
                <br><strong>DRIVER:</strong> THOMAS ASANTE
                <br><strong>NPA REFRENCE :</strong>..........................   
                 
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Waybill Serial #007612</b><br>
                  <b>Order TYPE:</b> Domestic<br>
                  <b>Loading Time:</b> 1:30 PM<br>
                  <b>Truck Header No:</b> AS 860414<br>
                  <b>Truct Trailer No:</b> AS 860414
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                <hr style="height:2px; border-width:0; color:black; background-color:black;"> <br>
                <div class="card-header">
                <h5 class="m-0">COMPARTMENT DETAILS</h5>
                <hr style="height:2px; border-width:0; color:black; background-color:black;"><br>
              </div><BR><b>Seals: </b><br>
                  <b>Seals:</b> <br>
                  <b>Ullages:</b> <br>
                  <b>Front:</b> <br>

                <hr style="height:2px; border-width:0; color:black; background-color:black;">
                      <th>Product</th>
                      <th>Unit</th>
                      <th>Meter No.</th>
                      <th>BRV Volume</th>
                      <th>Opening Readings</th>
                      <th>Closing Readings</th>
                      <th>Variance</th>
                   
                    </tr>
                   
                    </thead>
                   
                    <tbody>
                   
                    <tr>
                      <td>RFO</td>
                      <td>##</td>
                      <td>Meter1</td>
                      <td>54000</td>
                      <td>104178518</td>
                      <td>104232518</td>
                      <td>54000</td>
                    </tr>
                    
                    </tbody>
                  </table>
                </div>

                <!-- /.col -->
              </div>
              <!-- /.row -->
<hr style="height:2px; border-width:0; color:black; background-color:black;">
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Grand Total:</p>
                  
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">54000</p>

                  <div class="table-responsive">
                    <table class="table">
                      
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Start of Remarks: -->
              <div class="card-header">
                <h5 class="m-0">Remarks:</h5>
                <hr style="height:2px; border-width:0; color:black; background-color:black;"><br>
              </div>

               <!-- End of Remarks: -->
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Save Waybill
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->





              </div>
            </div>       


            
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php 

// include_once "footer.php";


?>