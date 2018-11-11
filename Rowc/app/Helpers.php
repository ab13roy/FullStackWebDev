<?php
namespace App;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use DB;

use Exception;

class Helpers
{




    public static function unlinkImages($path){
        try {
            if (file_exists($path)) {
                unlink($path);
            }
            return true;
        }catch (\Exception $e){
            Log::error('unlinkImages', ['Exception' => $e->getMessage()]);
        }
    }
    public static function upload_images($file,$destinationPath){
        try {
            $fileName = time() . str_random(5) . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            return $fileName;
        }catch (\Exception $e){
            Log::error('upload_image', ['Exception' => $e->getMessage()]);
        }
    }
    public static function sendMail($emailtemplate,$email){
        try {
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <appdemobeta@gmail.com>' . "\r\n";

            $message_body = '<div dir="ltr"><div class="adM"><br><br>
    </div><div class="gmail_quote"><center>
            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="font-size:14px;background-color:#f0f0f0">
                <tbody><tr>
                    <td style="background-color:#126790;padding:10px;padding-bottom:0px;">
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tbody><tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width:600px">

                                        <tbody><tr>
                                            <td align="center" style="padding:20px"><a target="_blank" style="outline:none;border:0px"><img border="0" align="absbottom" alt="" src="http://18.219.211.127/rwc/includes/img/xrwc_logo.PNG.pagespeed.ic.k-0r8lPf1s.webp" class="CToWUd" width="270" height="80"></a></td>
                                        </tr>
                                        <tr>
                                            <td style="padding:20px;text-align:center;font-size:22px;background-color:#fff;border-top-right-radius:7px;border-top-left-radius:7px"></td>
                                        </tr>
                                        </tbody></table> </td>
                            </tr>
                            </tbody></table> </td>
                </tr>
                <tr>
                    <td>
                        <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width:600px;padding:20px;padding-top:5px;text-align:center;line-height:22px;font-size:16px;background-color:#fff;border-bottom-right-radius:7px;border-bottom-left-radius:7px">
                            <tbody>
                            <tr>
                                <td style="padding-top:10px;font-family:Georgia, Times New Roman;">Hi,</td>
                            </tr>
                            <tr>
                                <td style="padding-top:10px;font-family:Georgia, Times New Roman;">We\'ve received a request to reset your password. If you didn\'t make the request, just ignore this email. Otherwise you may login to your account with following password </td>
                            </tr>
                            <tr>
                                <td style="padding-top:10px;font-family:Georgia, Times New Roman;">Your new password is: <b>'.$password.'</b></td>
                            </tr>
                         
                            <tr><td style="line-height: 19px;font-family:Georgia, Times New Roman;">If you have any questions or trouble logging on please contact an app administrator.</p></td></tr>
                            </tbody></table> </td>
                </tr>
                <tr>
                    <td style="padding:10px;text-align:center;font-size:10px;color:#898989;background-color:#f0f0f0"> Sincerely yours,RWC Team</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:center;font-size:11px;color:#898989;background-color:#f0f0f0">© 2018, All Rights Reserved | RWC </td>
                </tr>
                </tbody></table>
        </center>
    </div></div>';
            mail($email, "Forgot Password", $message_body,$headers);
            return true;
        }catch (\Exception $e){
            Log::error('sendMail', ['Exception' => $e->getMessage()]);
        }
    }
    public static function sendForgotMail($password,$email){
        try {
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <appdemobeta@gmail.com>' . "\r\n";

            $message_body = '<div dir="ltr"><div class="adM"><br><br>
            </div><div class="gmail_quote"><center>
            <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="font-size:14px;background-color:#f0f0f0">
                <tbody><tr>
                    <td style="background-color:#126790;padding:10px;padding-bottom:0px;">
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tbody><tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width:600px">

                                        <tbody><tr>
                                            <td align="center" style="padding:20px"><a target="_blank" style="outline:none;border:0px"><img border="0" align="absbottom" alt="" src="http://18.219.211.127/rwc/includes/img/xrwc_logo.PNG.pagespeed.ic.k-0r8lPf1s.webp" class="CToWUd" width="270" height="80"></a></td>
                                        </tr>
                                        <tr>
                                            <td style="padding:20px;text-align:center;font-size:22px;background-color:#fff;border-top-right-radius:7px;border-top-left-radius:7px"></td>
                                        </tr>
                                        </tbody></table> </td>
                            </tr>
                            </tbody></table> </td>
                </tr>
                <tr>
                    <td>
                        <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width:600px;padding:20px;padding-top:5px;text-align:center;line-height:22px;font-size:16px;background-color:#fff;border-bottom-right-radius:7px;border-bottom-left-radius:7px">
                            <tbody>
                            <tr>
                                <td style="padding-top:10px;font-family:Georgia, Times New Roman;">Hi,</td>
                            </tr>
                            <tr>
                                <td style="padding-top:10px;font-family:Georgia, Times New Roman;">We\'ve received a request to reset your password. If you didn\'t make the request, just ignore this email. Otherwise you may login to your account with following password </td>
                            </tr>
                            <tr>
                                <td style="padding-top:10px;font-family:Georgia, Times New Roman;">Your new password is: <b>'.$password.'</b></td>
                            </tr>
                         
                            <tr><td style="line-height: 19px;font-family:Georgia, Times New Roman;">If you have any questions or trouble logging on please contact an app administrator.</p></td></tr>
                            </tbody></table> </td>
                </tr>
                <tr>
                    <td style="padding:10px;text-align:center;font-size:10px;color:#898989;background-color:#f0f0f0"> Sincerely yours,RWC Team</td>
                </tr>
                <tr>
                    <td style="padding:5px;text-align:center;font-size:11px;color:#898989;background-color:#f0f0f0">© 2018, All Rights Reserved | RWC </td>
                </tr>
                </tbody></table>
        </center>
    </div></div>';
            mail($email, "Forgot Password", $message_body,$headers);
            return true;
        }catch (\Exception $e){
            Log::error('sendMail', ['Exception' => $e->getMessage()]);
        }
    }
    public static function checkCurrentAuthUserDetail(){
        try {
            if(auth()->guard('customer')->user() !=NULL){
                $user_detail = User::where('id',auth()->guard('customer')->user()->id)->first();
            }else if(auth()->guard('business')->user() !=NULL){
                $user_detail = User::where('id',auth()->guard('business')->user()->id)->first();
            }else{
                $user_detail = array();
            }
            return $user_detail;
        }catch (\Exception $e){
            Log::error('checkCurrentAuthUserDetail', ['Exception' => $e->getMessage()]);
        }
    }
    public static function getAuthUserDetailGuardWise($gaurd_name){
        try {
            if($gaurd_name == "customer"){
                if(auth()->guard('customer')->user() !=NULL) {
                    $user_detail = User::where('id', auth()->guard('customer')->user()->id)->first();
                }else{
                    $user_detail = array();
                }
            }else if($gaurd_name == "business"){
                if(auth()->guard('business')->user() !=NULL) {
                    $user_detail = User::where('id', auth()->guard('business')->user()->id)->first();
                }else{
                    $user_detail = array();
                }
            }else if($gaurd_name == "admin"){
                if(auth()->guard('admin')->user() !=NULL) {
                    $user_detail = Admin::where('id', auth()->guard('admin')->user()->id)->first();
                }else{
                    $user_detail = array();
                }
            }else{
                $user_detail = array();
            }
            return $user_detail;
        }catch (\Exception $e){
            Log::error('getAuthUserDetailGuardWise', ['Exception' => $e->getMessage()]);
        }
    }

    public static function getAllPermission(){
        try {
            $admin_detail = Admin::where('id', Auth::guard('admin')->user()->id)->with('rolePermission')->first();
            if ($admin_detail) {
                $data = json_decode($admin_detail->rolePermission->permission);
                return $data;
            } else {
                return array();
            }
        }catch (\Exception $e){
            Log::error('getAllPermission', ['Exception' => $e->getMessage()]);
        }
    }
    public static function getPermissionByValue($value){
        try {
            $admin_detail = Admin::where('id', Auth::guard('admin')->user()->id)->with('rolePermission')->first();
            if ($admin_detail) {
                $data = json_decode($admin_detail->rolePermission->permission);
                if ($value == "sub_admin") {
                    return $data->sub_admin;
                } else if ($value == "places") {
                    return $data->places;
                } else if ($value == "promotion_prices") {
                    return $data->promotion_prices;
                } else if ($value == "general_setting") {
                    return $data->general_setting;
                } else if ($value == "email_template") {
                    return $data->email_template;
                } else if ($value == "faq") {
                    return $data->faq;
                } else if ($value == "cms") {
                    return $data->cms;
                }
            } else {
                return array();
            }
        }catch (\Exception $e){
            Log::error('getPermissionByValue', ['Exception' => $e->getMessage()]);
        }

    }
    public static function checkContollerName($controller){
        try {
            if ($controller == "EmailTemplateController") {
                return "email_template";
            } else if ($controller == 'GeneralSettingController') {
                return "general_setting";
            } else if ($controller == 'PromotionController') {
                return "promotion_prices";
            } else if ($controller == 'SubAdminController') {
                return "sub_admin";
            } else {
                return "";
            }
        }catch (\Exception $e){
            Log::error('checkContollerName', ['Exception' => $e->getMessage()]);
        }
    }
    public static function checkMethodName($method){
        try {
            if ($method == "create") {
                return "add_edit";
            } else if ($method == 'edit') {
                return "add_edit";
            } else if ($method == 'destroy') {
                return "delete";
            } else if ($method == 'index') {
                return "view";
            } else {
                return "";
            }
        }catch (\Exception $e){
            Log::error('checkMethodName', ['Exception' => $e->getMessage()]);
        }

    }
    public static function checkSubAdminExistRole($controller,$method){
        // return $method;
        try {
            if ($controller == "" || $method == "") {
                return 1;
            } else {
                $permission_data = Helpers::getPermissionByValue($controller);
                if (in_array($method, $permission_data)) {
                    return 1;
                } else {
                    return 0;
                }
            }
        }catch (\Exception $e){
            Log::error('checkSubAdminExistRole', ['Exception' => $e->getMessage()]);
        }

    }
    public static function EncryptId($id){
        try {
            return base64_encode($id);
        }catch (\Exception $e){
            Log::error('EncryptId', ['Exception' => $e->getMessage()]);
        }
    }
    public static function DecryptId($id){
        try {
            return base64_decode($id);
        }catch (\Exception $e){
            Log::error('DecryptId', ['Exception' => $e->getMessage()]);
        }
    }




}