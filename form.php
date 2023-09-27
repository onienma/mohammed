<?php
include 'conn.php';
$firstName =   $_POST['firstName'];
$lastName =    $_POST['lastName'];
$email =       $_POST['email'];

$errors = [
    'firsNameError' => ' ',
    'lastNameError' => ' ',
    'emailErorr'    => ' ',
];

if(isset($_POST['submit'])){

    $firstName =   mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName =    mysqli_real_escape_string($conn,$_POST['lastName']);
    $email =       mysqli_real_escape_string($conn,$_POST['email']);

    
    $sql = "INSERT INTO users(firstName, lastName, email)
       VALUES ('$firstName', '$lastName', '$email')";

           
if(empty($firstName)){
    $errors['firstNameError'] = 'يرجى ادخال الاسم الاول';

}elseif(empty($lastName)){
    $errors['lastNameError']=  'يرجى إدخال الاسم الاخير';

}elseif(empty($email)){
    $errors['emailError'] =  'يرجى إدخال البريد الالكتروني';
}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['emailError'] = 'يرجى إدخال البريد الالكتروني الصحيح';
}
else{


     if(mysqli_query($conn, $sql)){
         header('Location: ' . $_SERVER['PHP_SELF']);
        }else{
           echo 'Error: ' . mysqli_error($conn);
        }
   }
}