
    <?php
    
    

    //import database
    include("../connection.php");



    if($_POST){
        //print_r($_POST);
        $result= $database->query("select * from webuser");
        $name=$_POST['name'];
        $cid=$_POST['cid'];


        $age=$_POST["age"];
        $gravida=$_POST["gravida"];
        $lmp=$_POST["lmp"];
        $edc=$_POST["edc"];
        $weight=$_POST["weight"];
        $height=$_POST["height"];
        $bmi=$_POST["bmi"];
        $ancno=$_POST["ancno"];
        $ancplace=$_POST["ancplace"];
        $salary=$_POST["salary"];
        $osm=$_POST["osm"];


        $oldemail=$_POST["oldemail"];
        $dob=$_POST["dob"];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $address=$_POST["address"];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $id=$_POST['id00'];
/*
        $name=$row["pname"];
        $email=$row["pemail"];
        $cid=$row["pcid"];
        $dob=$row["pdob"];
        $tele=$row["ptel"];
        $address=$row["paddress"];
*/      
        if ($password==$cpassword){
            $error='3';
            $result= $database->query("select patient.pid from patient inner join webuser on patient.pemail=webuser.email where webuser.email='$email';");
            //$resultqq= $database->query("select * from doctor where docid='$id';");
            if($result->num_rows==1){
                $id2=$result->fetch_assoc()["pid"];
            }else{
                $id2=$id;
            }
            
            echo $id2."jdfjdfdh";
            if($id2!=$id){
                $error='1';
                //$resultqq1= $database->query("select * from doctor where docemail='$email';");
                //$did= $resultqq1->fetch_assoc()["docid"];
                //if($resultqq1->num_rows==1){
                    
            }else{

                //$sql1="insert into doctor(docemail,docname,docpassword,docnic,doctel,specialties) values('$email','$name','$password','$nic','$tele',$spec);";
                $sql1="update patient set pemail='$email',pname='$name',ppassword='$password',pcid='$cid'
                ,age='$age',gravida='$gravida',lmp='$lmp',edc='$edc',weight='$weight',height='$height',bmi='$bmi',ancno='$ancno',ancplace='$ancplace',salary='$salary',osm='$osm'
                ,ptel='$tele',pdob='$dob',paddress='$address' where pid=$id ;";
                $database->query($sql1);

                $sql1="update webuser set email='$email' where email='$oldemail' ;";
                $database->query($sql1);
                //echo $sql1;
                //echo $sql2;
                $error= '4';
                
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
        //header('location: signup.php');
        $error='3';
    }
    

    header("location: patient.php?action=edit&error=".$error."&id=".$id);
    ?>
    
   

</body>
</html>