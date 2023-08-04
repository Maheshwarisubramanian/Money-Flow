<?php
ini_set('session.gc_maxlifetime', 36000);
session_set_cookie_params(36000);
ob_start();
session_start();
error_reporting(E_ERROR | E_PARSE);

include_once("../config/dbconfig.php");
include_once("../config/class.php");
date_default_timezone_set("Asia/Calcutta");

if(!isset($_SESSION['username']) || $_SESSION['MONEYFLOW']=='N')
header("location:../index.php");

if(isset($_REQUEST['btnSubmit']))
{
    $date= date('Y-m-d',strtotime($_REQUEST['txtDate']));
    $c_date = date("Y-m-d h:m:s");
    $details =  array('mf_date' =>$date );

    $count = sizeof($_REQUEST['catrecno']);

    //echo $count;
    
    for($i=$count-1;0<=$i;$i--)
    {
        
    //  $category = array('moneyflow[]');
        $category = $_REQUEST['catrecno'][$i];
        $moneyflow = $_REQUEST['Moneyflow'][$i];
        $narration =$_REQUEST['Narration'][$i];
        // echo $i;
        // echo "fsdfasd";
        //  echo $category;
        //  echo "<br>";
         
         // echo $moneyflow;
         // echo "<br>";


        $insquery = "INSERT INTO `moneyflowdetails`(`mf_date`, `mf_category`, `mf_moneyflow`, `mf_narration`, `mf_createddate`, `mf_modifieddate`) VALUES 
            ('$date','$category','$moneyflow','$narration','$c_date','$c_date')";
        $exequery = mysqli_query($con,$insquery);

        if($exequery)
        {
            $msg = "Wow... You Added Successfully Mahi";
            header("refresh: 3;");
        }

        else 
        {
            $msg = "OOPs ... Something went wrong";
            //header("refresh: 3;");
        }
        


    }
  //  exit;
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>



  	


    <meta charset="UTF-8">
    <title>  Registration Form </title>
    <link rel="stylesheet" href="../css/styleforcategory.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
     rel = "stylesheet">
           <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
           <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> -->
    <!-- jQuery library -->
  <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

  <script src="https://www.npmjs.com/package/typescript-plugin-css-modules"></script>

<!-- for autocomplete -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https:ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

     <!-- jQuery UI library, for autocomplete-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
















    <!-- for Change function -->

   

      <script>
        function onlyNumberKey(evt) {
             
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
    </script>


 



   <!--  <script type="text/javascript">
         $( function() {
          alert("fsdfsadf");
            $("#txtCategory").autocomplete({
            source: 'fetchcategorydataformoneyflow.php'  
            });
        });
    </script> -->

    <!-- <script type="text/javascript">
      

    </script> -->

    <script>
        $(function() {
            $( "#txtCategory" ).autocomplete({
                source: 'fetchcategorydataformoneyflow.php',
                
            });
            // alert("fsdfsadf");
        });
     </script>

     <style type="text/css">
        
        table, td, th {  
          border: 1px solid #ddd;
          text-align: left;
        }

        table {
          border-collapse: collapse;
          width: 100%;
        }
        th, td {
          padding-right: 90px;
        }


     </style>

     <script>
    $(document).ready(function(){
      $("#txtCategory").change(function(){
        var category=$(this).val();
      //  alert(category);

         if(category=='')
          {
              $("#hdnCategory").val('');
          }
          else
          {
              $.ajax({
                    type:"post",
                    url:"getcategoryformoneyflow.php",
                    data:{category:category},
                    success:function(result)
                    {
                     //alert(result);

                       var data= JSON.parse(result);
                     //  alert(data);
                       // print_r(data);

                        if(!data)
                        {
                            $("#hdnCategory").val('');  
                        }
                        else
                        {
                            $("#hdnCategory").val(data.cd_recno);
                           
                        }
                    }
                })

          }
      });
    });
    </script>
     

     <script type="text/javascript">
        $(document).ready(function(){
          
            $("#addItem").click(function(){
 
                var category = $("#txtCategory").val();
                var categoryrecno = $("#hdnCategory").val();
                var moneyflow = $("#txtMoneyflow").val();
                var narration = $("#txtNarration").val();

                if(category=='' || moneyflow == '')
                {
                    alert("Enter values");
                    exit;
                }

                $(".forappend").after('<tr  style="width:100%;"><td style="width: 25%;"><input  style="width: 150%;" type="text" name="cat[]" id="cat" value="" ><input  style="width: 150%;" type="text" name="catrecno[]" id="catrecno" value="" ></td><td style="width: 15%;"><input style="width: 100%;" type="text" name="Moneyflow[]" id="Moneyflow" value="" ></td><td style="width: 45%;"><input  style="width: 120%;" type="text" name="Narration[]" id="Narration" value="" ></td><td style="width: 15%;"><button style="margin-right: 30px;" type="button" title="delete" id="catrecno" onclick="rowremove(this)">*</button><button type="button" title="edit" id="edit" onclick="rowedit(this)">-</button></td></tr>');

                $("#cat").val(category);
                $("#catrecno").val(categoryrecno);
                $("#Moneyflow").val(moneyflow);
                $("#Narration").val(narration);

                $("#txtCategory").val('');
                $("#hdnCategory").val('');
                $("#txtMoneyflow").val('');
                $("#txtNarration").val('');

                var item = 0;
                var amount = 0;
                $("input[name='Moneyflow[]']").each(function(){
                    amount += parseFloat(this.value);
                    item = item +1;
                });

                amount = amount.toFixed(2);
                $("#txtTotalitems").val(item);
                $("#txtAmount").val(amount);

                
            })
        })
     </script>

     <script type="text/javascript">
        
        function rowremove(e)
        {
            e.parentNode.parentNode.remove();
        }
     </script>

     <script type="text/javascript">
        function rowedit(e)
        {
            var delcategory = e.parentNode.parentNode.childNodes[0].childNodes[0].value;
            var delcategoryrecno = e.parentNode.parentNode.childNodes[0].childNodes[1].value;
            var delmoneyflow = e.parentNode.parentNode.childNodes[1].childNodes[0].value;
            var delnarration = e.parentNode.parentNode.childNodes[2].childNodes[0].value;

            e.parentNode.parentNode.remove();

            $("#txtCategory").val(delcategory);
            $("#hdnCategory").val(delcategoryrecno);
            $("#txtMoneyflow").val(delmoneyflow);
            $("#txtNarration").val(delnarration);
        }
     </script>

     
   </head>
<body>

    <div>
        <?php

        if(isset($msg))
        {
            echo '<script>alert("'.$msg.'")</script>';
        }

        ?>
    </div>
    
  <div class="container">
    <?php 
    include_once("menu.php");
    ?>


    <div class="title">Money Flow</div>
    <div class="content">
      <form action="#" method="post">

        <div class="user-details">
          <div class="input-box">

            <span class="details">Date</span>
            <?php $date= date('d-m-Y'); ?>
            <input type="text" name="txtDate" id="txtDate" value="<?php echo $date; ?>">
           
          </div>
          <!-- <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder="Enter your username" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="text" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="text" placeholder="Confirm your password" required>
          </div> -->
        </div>
         <div class="user-details">
            

            <span class="details">Money Flow</span>
            <table>
                <tr>
                    <th>
                        Category
                    </th>
                    <th>
                        Money Flow
                    </th>
                    <th>
                        Narration
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                <tr>
                    <td style="width: 25%;">
                        <input  style="width: 150%;" type="text" name="hdnCategory" id="hdnCategory" value="" >
                        <input  style="width: 150%;" type="text" name="txtCategory" id="txtCategory" value="" >
                    </td>
                    <td style="width: 15%;">
                        <input style="width: 100%;" type="text" name="txtMoneyflow" id="txtMoneyflow" value=""  />
                    </td>
                    <td style="width: 45%;">
                        <input style="width: 120%;" type="text" name="txtNarration" id="txtNarration" value="" >
                    </td>
                    <td style="width: 15%;">
                        <button type="button" name="addItem" id="addItem">Click Me!</button>
                    </td>
                    
                </tr>
            </table>

            

            <table  class="forappend">
                
                
            </table>
           
           
        
         </div>

         <div class="user-details">

             <table>
                <tr>
                    <td>
                        Total Items :
                    </td>
                    <td>
                        <input style="width: 100%;" type="text" name="txtTotalitems" id="txtTotalitems" value="" readonly="">
                    </td>
                

                
                    <td>
                        Total Amount :
                    </td>
                    <td>
                        <input style="width: 100%;" type="text" name="txtAmount" id="txtAmount" value="" readonly="">
                    </td>
                </tr>
            </table>

          </div>
        <!-- <div class="gender-details">
          <input type="radio" name="gender" id="dot-1">
          <input type="radio" name="gender" id="dot-2">
          <input type="radio" name="gender" id="dot-3">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div> -->
        <div class="button">
            <table>
                <tr>
                    <td>
                        <input type="submit" name="btnSubmit" id="btnSubmit" value="Register">
                    </td>
                    <td>
                         <input type="reset" value="Reset" >
                    </td>

                    <td >
                        <a href="moneyflow-data.php">
                            <input type="button" value="Datas">
                             
                                
                            </input>
                         </a>
                    </td>
                </tr>
            </table>
          
           
        </div>
      </form>
    </div>
  </div>

</body>
</html>