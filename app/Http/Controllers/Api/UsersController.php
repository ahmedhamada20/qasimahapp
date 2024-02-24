<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Mail\ForgetPassword;
use App\Models\Contact;
use App\Models\Token;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class UsersController extends Controller
{

    //  public function Login_with_google(Request $request)
    // {

    //       $validator = Validator::make($request->all(), [
    //             'google_id' => 'required',
              
    //         ]);
            
            
            
    //         if ($validator->fails()) {
    //             return response($validator->errors(), 400);
    //         }
            
            
    //         $emailCheck = User::where('email', $request->email)->first();
    //     if ($emailCheck) {
    //       $updated = User::where('email', $request->email)->update([
    //             'google_id'=> $request->google_id,
    //       ]);

    //       $data = new UserResource($emailCheck);

    //       return response()->json(['value' => true, 'data' => $data, 'code' => 200]);
    //     }
            
            

    //     $googleIp = User::where('google_id', $request->google_id)->first();
        
    //     if (!$googleIp) {
    //         $user = User::create([
    //             'email' => $request->email,
    //             'name' => $request->name,
    //             'google_id' => $request->google_id,
    //             'password' => bcrypt($request->name) ?? bcrypt($request->google_id),
    //         ]);
          
    //         $data = new UserResource($user);
    //         return response()->json(['value' => true, 'data' => $data, 'code' => 200]);
    //     }else{
    //         $data = new UserResource($googleIp);
    
    //         return response()->json(['value' => true, 'data' => $data, 'code' => 200]);
    //     }
    // }
    
    
      public function Login_with_google(Request $request)
        {

            $lang = $request->header('Accept-Language', 'ar');

            $validator = Validator::make($request->all(), [
                'google_id' => 'required',
                'device_token' => 'required',

            ]);
            if ($validator->fails()) {
                return response($validator->errors(), 400);
            }

            $emailCheck = User::where('email', $request->email)->first();
            if ($emailCheck) {
                $updated = User::where('email', $request->email)->update([
                    'google_id'=> $request->google_id,
                ]);


                $check = Token::where('token', $request['device_token'])->first();
                if ($check) {
                    $check->status = 'connected';
                    $check->user_id = $emailCheck->id;
                    if ($request['device_type']) {
                        $check->device_type = $request['device_type'];
                    }
                    $check->device_language = $lang;
                    $check->update();
                } else {
                    Token::create([
                        'user_id' => $emailCheck->id,
                        'token' => $request['device_token'],
                        'device_type' => $request['device_type'],
                        'status' => 'connected',
                        'device_language' => $lang
                    ]);
                }






                $data = new UserResource($emailCheck);

                return response()->json(['value' => true, 'data' => $data, 'code' => 200]);
            }

            $googleIp = User::where('google_id', $request->google_id)->first();



            if (!$googleIp) {
                $user = User::create([
                    'email' => $request->email,
                    'name' => $request->name,
                    'google_id' => $request->google_id,
                    'password' => bcrypt($request->name) ?? bcrypt($request->google_id),
                ]);


                $check = Token::where('token', $request['device_token'])->first();
                if ($check) {
                    $check->status = 'connected';
                    $check->user_id = $user->id;
                    if ($request['device_type']) {
                        $check->device_type = $request['device_type'];
                    }
                    $check->device_language = $lang;
                    $check->update();
                } else {
                    Token::create([
                        'user_id' => $user->id,
                        'token' => $request['device_token'],
                        'device_type' => $request['device_type'],
                        'status' => 'connected',
                        'device_language' => $lang
                    ]);
                }


                $data = new UserResource($user);
                return response()->json(['value' => true, 'data' => $data, 'code' => 200]);
            } else {

                $check = Token::where('token', $request['device_token'])->first();
                if ($check) {
                    $check->status = 'connected';
                    $check->user_id = $googleIp->id;
                    if ($request['device_type']) {
                        $check->device_type = $request['device_type'];
                    }
                    $check->device_language = $lang;
                    $check->update();
                } else {
                    Token::create([
                        'user_id' => $googleIp->id,
                        'token' => $request['device_token'],
                        'device_type' => $request['device_type'],
                        'status' => 'connected',
                        'device_language' => $lang
                    ]);
                }




                $data = new UserResource($googleIp);

                return response()->json(['value' => true, 'data' => $data, 'code' => 200]);
            }
        }
    
        public function Login_with_apple(Request $request)
        {

            $lang = $request->header('Accept-Language', 'ar');

            $validator = Validator::make($request->all(), [
                'apple_id' => 'required',
                'device_token' => 'required',

            ]);
            if ($validator->fails()) {
                return response($validator->errors(), 400);
            }

            $emailCheck = User::where('email', $request->email)->first();
            if ($emailCheck) {
                $updated = User::where('email', $request->email)->update([
                    'apple_id'=> $request->apple_id,
                ]);


                $check = Token::where('token', $request['device_token'])->first();
                if ($check) {
                    $check->status = 'connected';
                    $check->user_id = $emailCheck->id;
                    if ($request['device_type']) {
                        $check->device_type = $request['device_type'];
                    }
                    $check->device_language = $lang;
                    $check->update();
                } else {
                    Token::create([
                        'user_id' => $emailCheck->id,
                        'token' => $request['device_token'],
                        'device_type' => $request['device_type'],
                        'status' => 'connected',
                        'device_language' => $lang
                    ]);
                }






                $data = new UserResource($emailCheck);

                return response()->json(['value' => true, 'data' => $data, 'code' => 200]);
            }else{
                $user = User::create([
                    'email' => $request->email,
                    'name' => $request->name,
                    'apple_id' => $request->apple_id,
                    'password' => bcrypt($request->name) ?? bcrypt($request->apple_id),
                ]);
            }

            $googleIp = User::where('apple_id', $request->apple_id)->first();



            if (!$googleIp) {


                $check = Token::where('token', $request['device_token'])->first();
                if ($check) {
                    $check->status = 'connected';
                    $check->user_id = $user->id;
                    if ($request['device_type']) {
                        $check->device_type = $request['device_type'];
                    }
                    $check->device_language = $lang;
                    $check->update();
                } else {
                    Token::create([
                        'user_id' => $user->id,
                        'token' => $request['device_token'],
                        'device_type' => $request['device_type'],
                        'status' => 'connected',
                        'device_language' => $lang
                    ]);
                }


                $data = new UserResource($user);
                return response()->json(['value' => true, 'data' => $data, 'code' => 200]);
            } else {

                $check = Token::where('token', $request['device_token'])->first();
                if ($check) {
                    $check->status = 'connected';
                    $check->user_id = $googleIp->id;
                    if ($request['device_type']) {
                        $check->device_type = $request['device_type'];
                    }
                    $check->device_language = $lang;
                    $check->update();
                } else {
                    Token::create([
                        'user_id' => $googleIp->id,
                        'token' => $request['device_token'],
                        'device_type' => $request['device_type'],
                        'status' => 'connected',
                        'device_language' => $lang
                    ]);
                }




                $data = new UserResource($googleIp);

                return response()->json(['value' => true, 'data' => $data, 'code' => 200]);
            }
        }
        
    

    public function register(Request $request)
    {
        $lang = $request->header('Accept-Language', 'ar');
        \App::setLocale($lang);

        $validator = \Validator::make($request->all(), [

            'device_token' => 'required',
            'device_type' => 'required|in:ios,android',

            'social_token' => 'nullable|unique:users,social_token',
            'name' => ['required_if:social_token,null'/*, 'unique:users,name'*/],
            'email' => 'required_if:social_token,null|email|unique:users,email',
            'password' => 'required_if:social_token,null|confirmed|min:6',
            'password_confirmation' => 'sometimes|required_with:password',

        ],[
            'email.unique'=>__('data.emailExists')
        ]);
        if ($validator->passes()) {


            if ($request->social_token) {
                $check = User::where('social_token', $request['social_token'])->first();
                if ($check) {
                    $user = $check;
                } else {
                    $user = new User();
                    $user['social_token'] = $request['social_token'];
                    $user['google_id'] = $request['google_id'] ?? null;
                    $user->save();
                }


            } else {
                $user = new User();
                $user['email'] = $request['email'];
                $user['name'] = $request['name'];
                $user['google_id'] = $request['google_id'] ?? null;
                $user['password'] = bcrypt($request['password']);
                $user->save();

            }

            $check = Token::where('token', $request['device_token'])->first();
            if ($check) {
                $check->status = 'connected';
                $check->user_id = $user->id;
                if ($request['device_type']) {
                    $check->device_type = $request['device_type'];
                }
                $check->device_language = $lang;
                $check->update();
            } else {
                Token::create([
                    'user_id' => $user->id,
                    'token' => $request['device_token'],
                    'device_type' => $request['device_type'],
                    'status' => 'connected',
                    'device_language' => $lang
                ]);
            }

            $data = new UserResource($user);
            return response()->json(['value' => true, 'data' => $data, 'code' => 200]);
        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first(), 'code' => 422]);
        }
    }

    public function login(Request $request)
    {
        $lang = $request->header('Accept-Language', 'ar');
        \App::setLocale($lang);
        $validator = \Validator::make($request->all(), [
            'device_token' => 'required',
            'device_type' => 'required|in:ios,android',

            'social_token' => 'nullable',

            'email' => 'required_if:social_token,null|email',
            'password' => 'required_if:social_token,null|min:6',

        ]);
        if ($validator->passes()) {
            
            
            
             if ($request['google_id']) {
                $check_user_google_id = User::where('google_id', $request['google_id'])->first();
                if ($check_user_google_id) {
                    $user = $check_user_google_id;
                } else {
                    $user = new User();
                    $user['google_id'] = $request['google_id'];
                    $user->save();
                }
            } 
            


            if ($request['social_token']) {
                $check_user = User::where('social_token', $request['social_token'])->first();
                if ($check_user) {
                    $user = $check_user;
                } else {
                    $user = new User();
                    $user['social_token'] = $request['social_token'];
                    $user->save();
                }
            } else {
                $auth = ['email' => $request->input('email'), 'password' => $request->input('password')];


                try {
                    if (!$token = JWTAuth::attempt($auth, ['exp' => Carbon::now()->addDays(7300)->timestamp])) {

                        return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_password'), 'code' => 422]);
                    }
                } catch (JWTException $e) {
                    return response()->json(['value' => false, 'msg' => 'could_not_create_token'], 500);
                }
                $user = User::whereEmail($request['email'])->first();
            }


            $check = Token::where('token', $request['device_token'])->first();
            if ($check) {
                $check->status = 'connected';
                if ($request['device_type']) {
                    $check->device_type = $request['device_type'];
                }
                $check['user_id'] = $user->id;
                $check->device_language = $lang;

                $check->update();
            } else {
                Token::create([
                    'user_id' => $user->id,
                    'token' => $request['device_token'],
                    'device_type' => $request['device_type'],
                    'status' => 'connected',
                    'device_language' => $lang,
                ]);
            }

            $data = new UserResource($user);
            return response()->json(['value' => true, 'data' => $data, 'code' => 200]);


        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first(), 'code' => 422]);
        }
    }

    public function logout(Request $request)
    {
        $lang = \request()->header('Accept-Language', 'ar');
        \App::setLocale($lang);

        $validator = \Validator::make($request->all(), [
            'device_token' => 'required|exists:device_tokens,token'
        ]);
        if ($validator->passes()) {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_token'), 'code' => 401]);
            }


            $exist_token = Token::where(['token' => $request['device_token']])->first();
            if (!$exist_token) return response()->json(['value' => false, 'msg' => 'device token and auth not match', 'code' => 401]);

            $exist_token->status = 'disconnected';
            $exist_token->update();

            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['value' => true, 'data' => \Lang::get('data.logout'), 'code' => 200]);

        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first(), 'code' => 422]);
        }


    }

    public function update_profile(Request $request)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_token'), 'code' => 401]);
        }
        $validator = \Validator::make($request->all(), [
            'name' => 'unique:users,name,' . $user->id,
            'email' => 'unique:users,email,' . $user->id,

        ]);
        if ($validator->passes()) {
            $user['name'] = $request['name'] ? $request['name'] : $user->name;
            $user['email'] = $request['email'] ? $request['email'] : $user->email;

            $user->update();
            $data = new UserResource($user);
            return response()->json(['value' => true, 'data' => $data]);
        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first()]);
        }
    }

    public function forget_password(Request $request)
    {
        $lang = $request->header('Accept-Language', 'ar');
        \App::setLocale($lang);
        $validator = \Validator::make($request->all(), [
            'email' => 'required'
        ]);
        if ($validator->passes()) {

            $user = User::whereEmail($request['email'])->first();
            if (!$user) return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_email'), 'code' => 422]);
            $code = rand(1111, 9999);
            $user->code = $code;
            $user->update();

            \Mail::to($request['email'])->send(new ForgetPassword($code));
            $data = new UserResource($user);
            return response()->json(['value' => true, 'data' => $data, 'code' => 200]);

        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first(), 'code' => 422]);
        }
    }

    public function check_forget_code(Request $request)
    {
        $lang = $request->header('Accept-Language', 'ar');
        \App::setLocale($lang);
        $validator = \Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'code' => 'required|exists:users,code'
        ]);
        if ($validator->passes()) {
            $user = User::whereEmail($request['email'])->first();
            if (!$user) return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_email'), 'code' => 422]);
            if ($user->code != $request['code']) return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_code'), 'code' => 422]);
            $data = new UserResource($user);
            return response()->json(['value' => true, 'data' => $data, 'msg' => \Lang::get('data.correct_code'), 'code' => 200]);

        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first(), 'code' => 422]);
        }
    }

    public function change_password(Request $request)
    {
        $lang = $request->header('Accept-Language', 'ar');
        \App::setLocale($lang);
        $validator = \Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required|min:6',
            'device_token' => 'required',
            'device_type' => 'required|in:android,ios',

        ]);
        if ($validator->passes()) {

            $user = User::whereEmail($request['email'])->first();
            $user->password = bcrypt($request['password']);
            $user->update();
            $check = Token::where('token', $request['device_token'])->first();
            if ($check) {
                $check->status = 'connected';
                if ($request['device_type']) {
                    $check->device_type = $request['device_type'];
                }
                $check['user_id'] = $user->id;
                $check->device_language = $lang;

                $check->update();
            } else {
                Token::create([
                    'user_id' => $user->id,
                    'token' => $request['device_token'],
                    'device_type' => $request['device_type'],
                    'status' => 'connected',
                    'device_language' => $lang
                ]);
            }
            $data = new UserResource($user);


            return response()->json(['value' => true, 'data' => $data, 'code' => 200]);
        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first(), 'code' => 422]);
        }
    }

    public function change_old_password(Request $request)
    {

        $lang = \request()->header('Accept-Language', 'ar');
        \App::setLocale($lang);

        $validator = \Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required'
        ]);
        if ($validator->passes()) {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_token'), 'code' => 401]);
            }

            if (\Hash::check($request['old_password'], $user->password)) {
                $user->password = bcrypt($request['new_password']);
                $user->update();
                $data = new UserResource($user);
                return response()->json(['value' => true, 'data' => $data, 'code' => 200]);
            } else {
                return response()->json(['value' => false, 'msg' => \Lang::get('data.password_not_match'), 'code' => 422]);
            }

        } else {
            return response()->json(['value' => false, 'msg' => $validator->errors()->first(), 'code' => 422]);
        }

    }



    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }
}
