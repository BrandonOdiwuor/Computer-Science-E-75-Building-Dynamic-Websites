<?php
function authenticate_user()
{
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  $error_messages = array();
  if(empty($email) || empty($password))
  {
    if(empty($_POST['email']))
      $error_messages[] = 'Please enter email';
    if(empty($_POST['password']))
      $error_messages[] = 'Please enter password';

    render_sign_in_form(array('email'=>$email,
                              'password' => $password,
                              'error_messages' => $error_messages));
  }
  else
  {
    require_once($_SERVER["DOCUMENT_ROOT"] . '/CS75Finance/models/user.php');
    $user = new User;
    if($user->email_exists($email))
    {
      if($user->sign_in($email, $password))
      {
        $_SESSION['user_id'] = $user->id($email);
        header('Location: home');
      }
      else
      {
        $error_messages[] = "The password entered is incorrect";
        render_sign_in_form(array('email'=>$email,
                                  'password' => $password,
                                  'error_messages' => $error_messages));
      }
    }
    else
    {
      $error_messages[] = "The email entered is not recorgonized";
      render_sign_in_form(array('email'=>$email,
                                'password' => $password,
                                'error_messages' => $error_messages));
    }
  }
}

function render_sign_in_form($form_elements = array())
{
  render('header');
  render('sign_in', $form_elements);
  render('footer');
}
?>
