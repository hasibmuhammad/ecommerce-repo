<?php
namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Models\User;      
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use Respect\Validation\Validator;

class HomeController extends Controller
{
    public function getIndex()
    {
        view('home');
    }
    public function getRegister()
    {
        view('register');
    }
    public function postRegister()
    {
        $validator = new Validator();
        $errors = [];
        $username = strtolower($_POST['username']);
        $email = strtolower($_POST['email']);
        $password = $_POST['password'];
        $profilePhoto = $_FILES['profilePhoto'];

        if ($validator::alnum()->noWhitespace()->validate($username) === false) {
            $errors['username'] = 'Username can only contain alphabets or numeric';
        }
        if (strlen($username) < 6) {
            $errors['username'] = 'Username can not be less than 6 character';
        }
        if ($validator::email()->validate($email) === false) {
            $errors['email'] = "Email must be a valid Email Address!";
        }
        if (strlen($password) < 6) {
            $errors['password'] = 'Password must have at least 6 characters';
        }
        if ($validator::image()->validate($profilePhoto['name']) == true) {
            $errors['profilePhoto'] = "File msut be an image to upload!";
        }
        if (empty($errors)) {

            $fileName = 'profile_photo' . time();
            $extension = explode('.', $profilePhoto['name']);
            $ext = end($extension);
            move_uploaded_file($profilePhoto['tmp_name'], 'media/profilePhoto/' . $fileName . '.' . $ext);
            $token = sha1($username . $email . uniqid('lws', true));

            User::create([
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'profile_photo' => $fileName . '.' . $ext,
                'email_verification_token' => $token,
            ]);

            $mail = new PHPMailer(true);

            try {

                // Server Setting

                $mail->SMTPDebug = 2;
                $mail->isSMTP();
                $mail->Host = 'smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Username = '5dc3d0e028a958';
                $mail->Password = 'a0862823eab931';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 2525;

                //Recipients

                $mail->setFrom('hasibmu99@gmail.com', 'Storyteller');
                $mail->addAddress($email, $username);

                // Content

                $mail->isHTML(true);
                $mail->Subject = "Registration Successfull";
                $mail->Body = 'Dear ' . $username . ', <br/>
            Please click the following link to activate your account<br/>
            <a href="http://storyteller.com/activate/' . $token . '">Click Here to Activate</a>
            <br/>- LWS Team';
                $mail->send();
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }

            $_SESSION['success'] = "User Registration Successfull!";
            header("Location: /login");
            exit();
        } else {
            $_SESSION['errors'] = $errors;
            header("Location: /register");
            exit();
        }
    }
    public function getLogin()
    {
        view('login');
    }

    public function postLogin()
    {
        $validator = new Validator();
        $errors = [];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validation

        if ($validator::email()->validate($email) === false) {
            $_SESSION['errors'] = "Invalid email address!";
        }
        if (strlen($password) < 6) {
            $_SESSION['errors'] = "Password must be at least 6 chars!";
        }

        if (empty($errors)) {

            $user = User::select(['id', 'username', 'email', 'password', 'email_verified_at'])->where('email', $email)->first();

            if ($user) {
                if ($user->email_verified_at === null) {
                    $errors[] = "Account is not verified yet!";
                    $_SESSION['errors'] = $errors;
                    header("Location: /login");
                    exit();
                }
                if (password_verify($password, $user->password) === true) {
                    $_SESSION['success'] = "Logged in!";
                    $_SESSION['user'] = [
                        'id' => $user->id,
                        'email' => $user->email,
                        'username' => $user->username,
                    ];
                    header("Location: /dashboard");
                    exit();
                }
                $errors[] = 'Invaild Credentials!';
                $_SESSION['errors'] = $errors;
                header("Location: /login");
                exit();
            }
            $errors[] = "No user found!";
            $_SESSION['errors'] = $errors;
            header("Location: /login");
            exit();
        }
    }

    public function getActivate($token = '')
    {
        $errors = [];
        if (empty($token)) {
            $errors[] = "No token provided";
            $_SESSION['errors'] = $errors;
            header("Location: /login");
            extit();
        }

        $user = User::where('email_verification_token', $token)->first();

        if ($user) {
            $user->update([
                'email_verified_at' => Carbon::now(),
                'email_verification_token' => null,
            ]);

            $_SESSION['success'] = 'Account is activated. You can login now !';
            header("Location: /login");
            exit();
        }
        $errors[] = "Invalid token provided!";
        $_SESSION['errors'] = $errors;
        header("Location: /login");
        exit();
    }

    public function getLogout()
    {
        unset($_SESSION['user']);
        
        $_SESSION['success'] = 'You have been logged out!';
        header("Location: /login");
        exit();
    }
}
