<?php
function register_user()
{
  $first_name = htmlspecialchars($_POST['first_name']);
  $surname = htmlspecialchars($_POST['surname']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  $balance = 10000;
  $error_messages = array();
  if(empty($email) || empty($password) || empty($surname) || empty($first_name))
  {
    if(empty($first_name))
      $error_messages[] = 'Please enter your first name';
    if(empty($surname))
      $error_messages[] = 'Please enter your surname';
    if(empty($email))
      $error_messages[] = 'Please enter an email adress';
    if(empty($password))
      $error_messages[] = 'Please enter your password';

    render_sign_up_form(array('first_name' => $first_name,
                              'surname' => $surname,
                              'email'=>$email,
                              'password' => $password,
                              'error_messages' => $error_messages));
  }
  else
  {
    require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/models/user.php');
    $user = new User;
    if($user->email_exists($email))
    {
      $error_messages[] = 'The email entered is already registered';
      render_sign_up_form(array('first_name' => $first_name,
                                'surname' => $surname,
                                'email'=>$email,
                                'password' => $password,
                                'error_messages' => $error_messages));
    }
    else
    {
      $user->sign_up($email, $first_name, $surname, $password, $balance);

      # Sign In the registered user
      require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/controllers/sign_in_controller.php');
      authenticate_user();
    }
  }
}


function render_sign_up_form($form_elements = array())
{
  render('header');
  render('sign_up', $form_elements);
  render('footer');
}
?>
