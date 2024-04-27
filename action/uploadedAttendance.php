 <?php
if ($_SESSION['userType']=='Trainer') {
  ?>
 <div class="card mb-4 wow fadeIn">
        <div class="card-body d-sm-flex justify-content-between">
          <h4 class="mb-2 mb-sm-0 pt-1">
            <span>Uploaded Events</span>
          </h4>
        </div>
           <table id="dataTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Module</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                          <th>Module</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php  
                                      if ($attMade=$con->query("SELECT distinct * from uploadedattendance,modules where modules.moduleId=uploadedattendance.module AND uploadedattendance.trainer='".$_SESSION['userId']."'")) {
                                        if (mysqli_num_rows($attMade)==0) {
                                         echo "<tr ><td colspan='5' align='center'>No Event uploaded Yet</td></tr>";
                                        }
                                        while ($allAtt=mysqli_fetch_array($attMade)) {
                                          ?>
                                          <tr>
                                            
                                          <td><?php echo  $allAtt['moduleName']; ?></td>
                                          <td><?php echo  $allAtt['date']; ?></td>
                                          <td><?php echo  $allAtt['approved']; ?>
                                          </td>
                                          </tr>
                                          <?php 
                                        }
                                      }
                                      ?>
                                    </tbody>
                                </table>

      </div> 

      <?php  
}elseif ($_SESSION['userType']=='User') {
  ?>
   <div class="card mb-4 wow fadeIn">
        <div class="card-body d-sm-flex justify-content-between">
          <h4 class="mb-2 mb-sm-0 pt-1">
            <span>Valid Events</span>
          </h4>
        </div>
            <table id="dataTable" class="table table-bordered">
                                    
                                    <tbody>
                                      <?php
                                      if ($mod=$con->query("SELECT * FROM events")) {
                                        if (mysqli_num_rows($mod)>0) {
                                          ?>
                                             <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Event</th>
                                            <th>Time</th>
                                            <th>Location</th>
                                            <th>Tickets Available</th>
                                            
                                        </tr>
                                    </thead>
                                          <?php
                                        }
                                        while ($getMod=mysqli_fetch_array($mod)) {

                                          echo "<tr>
                                              
                                              <td>".$getMod['id']."</td>
                                              <td>".$getMod['event_name']."</td>
                                              <td>".$getMod['event_time']."</td>
                                              <td>".$getMod['location']."</td>
                                              <td>".$getMod['tickets']."</td>
                                             
                                          </tr>";

                                        }
                                      }
                                      ?>
                                    </tbody>
                                </table>







      </div> 


      <div class="card mb-4 wow fadeIn">
        <div class="card-body d-sm-flex justify-content-between">
          <h4 class="mb-2 mb-sm-0 pt-1">
            <span>Book Your Ticket On Events</span>
          </h4>
        </div>


             <form class="container row w-75" action="" method="post" enctype="multipart/form-data">

            <div class="col-lg-12">


            <?php
                  
                  if (isset($_POST['book'])) {
                    $idiz=$_POST['idis'];


                    $book=$con->query("INSERT INTO booked (id, event_name, location)
        SELECT id, event_name, location
        FROM events
        WHERE id = $idiz");


                    if ($book==true) {
                      ?>
                       <script>alert('Event Booked')</script>
                      <?php
                    }


                  }



                  if (isset($_POST['cancel'])) {
                    $idiz=$_POST['idis'];
                    

                    $cancel=$con->query("delete from `booked` ");


                       if ($book==true) {
                      ?>
                       <script>alert('Event Booked')</script>
                      <?php
                    }
                  }


            ?>

              <div class=" d-flex justify-content-center">

                <input type="text" class="form-control file" name="idis" placeholder="Please Enter Event Id Your To Book Now">
                <button class="btn btn-dark btn-sm my-0 p w-25" type="submit" name="book">Book Event</button>
                <button class="btn btn-dark btn-sm my-0 p w-25" type="submit" name="cancel">Cancel Event</button>
                
              </div>
            </div>

              <br>
          </form>
          <br>
          <br>
        </div>
        <br>

        <div class="card mb-4 wow fadeIn">
        <div class="card-body d-sm-flex justify-content-between">
          <h4 class="mb-2 mb-sm-0 pt-1">
            <span>Uploaded Events</span>
          </h4>
        </div>
           <table id="dataTable" class="table table-bordered">
                                    
                                    <tbody>
                                      <?php
                                      if ($modi=$con->query("SELECT * FROM booked")) {
                                        if (mysqli_num_rows($modi)>0) {
                                          ?>
                                             <thead>
                                        <tr>
                                            <th>Event_ame</th>
                                            <th>Location</th>
                                            
                                        </tr>
                                    </thead>
                                          <?php
                                        }
                                        while ($getModi=mysqli_fetch_array($modi)) {

                                          echo "<tr>
                                              
                                              
                                              <td>".$getModi['event_name']."</td>
                                              <td>".$getModi['location']."</td>
                                             
                                          </tr>";

                                        }
                                      }
                                      ?>
                                    </tbody>
                                </table>

      </div> 


            



  <?php
}else{
  ?>
   <div class="card mb-4 wow fadeIn">
        <div class="card-body d-sm-flex justify-content-between">
          <h4 class="mb-2 mb-sm-0 pt-1">
            <span>Uploaded Events</span>
          </h4>
        </div>
           <table id="dataTable" class="table table-bordered">
                                    
                                    <tbody>
                                      <?php
                                      if ($mod=$con->query("SELECT * FROM events")) {
                                        if (mysqli_num_rows($mod)>0) {
                                          ?>
                                             <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Event</th>
                                            <th>Time</th>
                                            <th>Location</th>
                                            <th>Tickets Available</th>
                                            
                                        </tr>
                                    </thead>
                                          <?php
                                        }
                                        while ($getMod=mysqli_fetch_array($mod)) {

                                          echo "<tr>
                                              
                                              <td>".$getMod['id']."</td>
                                              <td>".$getMod['event_name']."</td>
                                              <td>".$getMod['event_time']."</td>
                                              <td>".$getMod['location']."</td>
                                              <td>".$getMod['tickets']."</td>
                                             
                                          </tr>";

                                        }
                                      }
                                      ?>
                                    </tbody>
                                </table>

      </div> 





      <div class="card mb-4 wow fadeIn">
        <div class="card-body d-sm-flex justify-content-between">
          <h4 class="mb-2 mb-sm-0 pt-1">
            <span>Manage & Modify Events Here</span>
          </h4>
        </div>



           

          <?php

          //----------------------------SELECT-------------------------//
            
            $fet=$a1=$b1=$c1=$d1=$e1="";

            
            if (isset($_POST['select'])) {
              $a=$_POST['idi'];
              $b=$_POST['namei'];
              $c=$_POST['timei'];
              $d=$_POST['locationi'];
              $e=$_POST['ticketsi'];


              $delta=mysqli_query($con,"select*from `events` where id='$a'");

              if (mysqli_num_rows($delta)>0) {
                 while ($fet=mysqli_fetch_array($delta)) {
                  
                   $a1=$fet['id'];
                   $b1=$fet['event_name'];
                   $c1=$fet['event_time'];
                   $d1=$fet['location'];
                   $e1=$fet['tickets'];
                 }
              }
            }



            //------------------------UPDATE---------------------//


            if (isset($_POST['update'])) {
              
              $a=$_POST['idi'];
              $b=$_POST['namei'];
              $c=$_POST['timei'];
              $d=$_POST['locationi'];
              $e=$_POST['ticketsi'];


              $updatecom=mysqli_query($con,"UPDATE events SET event_name='$b', event_time='$c', location='$d', tickets='$e' WHERE id='$a'");

              if ($updatecom==true) {
                ?>

                <script>alert('Event Updated Successfully')</script>
                <?php
              }

            }

             //---------------------DELETE-----------------------------//



            if (isset($_POST['delete'])) {
              
              $a=$_POST['idi'];

              $del=mysqli_query($con,"delete from `events` where id='$a'");

              if ($del==true) {
                ?>
                <script>alert('Event Deleted Successfully')</script>
                <?php
              }
            }

          ?>



           
           <form class="container row w-750" action="" method="post" enctype="multipart/form-data">

            <div class="col-lg-12">

              <div class=" d-flex justify-content-center">
                <input type="text" class="form-control file" name="idi" value="<?php echo $a1;?>" placeholder="Please Enter Event Id">
                <input type="text" class="form-control file" name="namei" value="<?php echo $b1;?>" placeholder="Please Enter Event Name">
              </div>

              <br>
          
            <div class=" d-flex justify-content-center">
              <input type="datetime-local" class="form-control file" name="timei" value="<?php echo $c1;?>" placeholder="Please Event Time">
              <input type="text" class="form-control file" name="locationi" value="<?php echo $d1;?>" placeholder="Please Event Location">
            </div>
            <br>
            <input style="width:20rem;" type="text" class="form-control file" name="ticketsi" value="<?php echo $e1;?>" placeholder="No Of Available Tickets">
            <br>
            <button class="btn btn-dark btn-sm my-0 p" type="submit" name="select">View</button>
            <button class="btn btn-dark btn-sm my-0 p" type="submit" name="update">Update</button>
            <button class="btn btn-dark btn-sm my-0 p" type="submit" name="delete">Delete</button>

          </form>

          

          </div><br><br>

       

  <?php 
}
    ?>