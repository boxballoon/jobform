<?php

// echo htmlspecialchars( $_POST['first_name'] );


// Validation

if ( isset( $_POST['submit'] ) ) {

  echo "What?";

  echo ( $_POST['first_name'] );
  echo ( $_POST['last_name'] );
  echo ( $_POST['email'] );
  echo ( $_POST['phone'] );



  // FIRST NAME
  if( empty( $_POST['first_name'] ) ){

    $msg_first_name = "You must your first name";
    $letters_pattern = '/^[a-zA-Z ]*$/';

  }else {
    echo htmlspecialchars( $_POST['first_name'] );
  }

  // LAST NAME
  if( empty( $_POST['last_name'] ) ){

    $msg_last_name = "You must your first name";
    $letters_pattern = '/^[a-zA-Z ]*$/';

  }else {
    echo htmlspecialchars( $_POST['last_name'] );
  }

  // EMAIL
  if( empty( $_POST['email'] ) ){
    // $email_pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
  }else {
    echo htmlspecialchars( $_POST['email'] );
  }

  // PHONE
  if( empty( $_POST['phone'] ) ){
    // $phone_pattern = '^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$';
  }else {
    echo htmlspecialchars( $_POST['phone'] );
  }

}
