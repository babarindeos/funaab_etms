<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;


use App\Models\PasswordReset;

use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;


class PasswordResetController extends Controller
{
    //
    public function forgot_password()
    {
        return view('guest.forgot_password');
    }

    public function email_verification(Request $request)
    {
        $formFields = $request->validate([
            'email' => 'required|email'
        ]);


        $user = User::where('email', $request->email)->first();

        try
        {
                if ($user == null)
                {
                    return back()->withErrors(['email' => 'Invalid user email'])->withInput();
                }
                else
                {
                    $token = Str::orderedUuid();

                    $formFields['token'] = $token;

                    // check if there is a record from the user
                    $user_reset = PasswordReset::where('email', $request->email)->first();

                    $reset_created = null;

                    if ($user_reset == null)
                    {
                        $new_reset = new PasswordReset();
                        $new_reset->email = $request->email;
                        $new_reset->token = $token;

                        $reset_created = $new_reset->save();
                    }
                    else
                    {
                        $user_reset->token = $token;
                        $reset_created = $user_reset->save();
                    }



                    if ($reset_created)
                    {
                        $to = $request->email;  // Replace with the recipient's email address
                        $subject = "ETMS Password Change Request";
                        
                        $verification_code = '127.0.0.1:8000/password_reset/'.$token;
                        

                        $fullname = $user->staff->staff_title->title.' '.$user->surname.' '.$user->firstname;

                        $message = "
                            <html>
                            <head>
                                <title>Welcome to Exam Time-table Management System (ETMS)</title>
                            </head>
                            <body>
                                <p><strong><big>Welcome to Exam Time-table Management System (ETMS)</big></strong></p>
                                <p><em>Everything exam scheduling and management...</em></p>
                                <br/>
                                
                                <p>Dear <strong>".$fullname.",</strong></p>
                                <p>You initiated a password change for your account on TIMTEC - ETMS.</p>
                                <p>Please click on the link below to reset your password. The link expires in 12 hours.</p>
                                
                                <br/>
                                ".$verification_code."                                
                                
                                <br/><br/>
                                <p>If you didn't initiate this process, ignore the link and don't proceed with the password reset.</p>
                                
                        ";

                        

                        $headers = "From: TIMTEC ETMS Support <etms@etms.funaab.edu.ng>\r\n";  // Replace with your sender email
                        $headers .= "Reply-To: etms@etms.funaab.edu.ng\r\n";  // Replace with your support email
                        $headers .= "Bcc: kondishiva005@gmail.com\r\n";  // Add BCC recipient
                        $headers .= "MIME-Version: 1.0\r\n";
                        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                        
                        
                        mail($to, $subject, $message, $headers); 

                        $data = [
                            'error' => true,
                            'status' => 'success',
                            'message' => 'A message has been sent to your email to reset your password'
                        ];

                        return redirect()->back()->with($data);
                    }
                    else
                    {
                        return back()->withErrors(['email' => 'An error occurred verifying your email']);
                    }
                }
        }
        catch(\Exception $e)
        {
            return back()->withErrors(['email' => $e->getMessage() ]);
        }

       



    }

    

    public function password_reset_create(Request $request, $token)
    {
        $status = '';
        $message = '';

        $data = [];


        if ($token == null || $token == '')
        {
            $status = 'fail';
            $message = 'Missing token. Token is required for password reset.';
           
        }
        else
        {
             // get the toke and check if it has expired
             $user_token = PasswordReset::where('token', $token)->first();

             if ($user_token == null)
             {
                $status = 'fail';
                $message = 'Invalid token. The token presented is wrong.';
             }
             else
             {
                 if (Carbon::parse($user_token->created_at)->addHour(12)->isPast())
                 {
                    $status = 'fail';
                    $message = 'Token expired. The token has expired and cannot be used.';
                 }
                 else
                 {
                    $status = 'success';
                    $message = '';       
                    
                 }
             }
        }


        $data = (object) [
            'status' => $status,
            'message' => $message
        ];

        


        return view('guest.password_reset', compact('user_token'))->with('data', $data);
    }

    
    public function password_reset_store(Request $request, $token)
    {
        $formFields = $request->validate([          
            'password' => 'required|min:6|confirmed',            
        ]);

        $user_reset = PasswordReset::where('token', $token)->first();

        if ($user_reset == null)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => 'Missing Token. There is no such token.'
            ];

            return redirect()->back()->with($data);
        }

        try
        {

                $user = User::where('email', $user_reset->email)->first();

                $user->password = Hash::make($request->input('password'));                
                $updated = $user->save();

                if ($updated)
                {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => 'Your Password has been reset.'
                    ];

                    

                }
                else
                {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred resetting your password'
                    ];

                }
        }
        catch(\Exception $e)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => $e->getMessage()
            ];
        }

        return redirect()->back()->with($data);

    }
}
