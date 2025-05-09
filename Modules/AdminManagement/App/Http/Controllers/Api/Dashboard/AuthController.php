<?php

namespace Modules\AdminManagement\App\Http\Controllers\Api\Dashboard;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\AdminManagement\App\Http\Requests\Api\Dashboard\CreateAdminRequest;
use Modules\AdminManagement\App\Http\Requests\Api\Dashboard\UpdateAdminRequest;
use Modules\AdminManagement\App\Models\Admin;
use Modules\AdminManagement\App\resources\Api\Dashboard\LoginResource;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    use ApiResponseTrait;

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        //$token = $this->respondWithToken($token);
         $user = Admin::where('email',$request->email)->first(['id','name','email','image']);
        $user->access_token = $token;
        return $this->sendResponse(LoginResource::collection([$user]));
    }

    public function logout()
    {
        auth('admin')->logout();
        $data = [
            'message' => __('AdminManagement::messages.Successfully logged out')
        ];
        return $this->sendResponse([$data]);
    }

    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAdminRequest $request)
    {

        try {
            $path = '';
            if(isset($data['image'])){
                $path = FileHelper::upload_file('uploads/admin',$data['image']);
            };
            DB::table('admins')->insert([
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'image' => $path,
                    'remember_token' => null,
                    'verification_code' => null,
                ]
            ]);
            $data = [
                'message' => __('AdminManagement::messages.Successfully Created')
            ];
            return $this->sendResponse([$data]);
        } catch (\Exception $e) {

            return $this->sendResponse([$data],'Error',$e->getMessage(),400);
        }

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('adminmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('adminmanagement::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request,$id)
    {
        try {
            $admin = Admin::findOrFail($id);

            if ($request->has('name')) {
                $admin->name = $request->input('name');
            }

            if ($request->has('email')) {
                $admin->email = $request->input('email');
            }

            if ($request->has('password')) {
                $admin->password = Hash::make($request->input('password'));
            }

            if(isset($data['image'])){
                $data['image'] = FileHelper::update_file('uploads/admin',$data['image'], $admin->image);
            }

            $admin->save();
            $data = [
                'message' => __('AdminManagement::messages.Successfully Updated')
            ];
            return $this->sendResponse([$data]);
        } catch (\Exception $e) {

            return $this->sendResponse([$data,'Error',$e->getMessage(),400]);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Admin::where('id',$id)->delete();
            $data = [
                'message' => __('AdminManagement::messages.Successfully Deleted')
            ];
            return $this->sendResponse([$data]);
        } catch (\Exception $e) {

            return $this->sendResponse([$data,'Error',$e->getMessage(),400]);
        }
    }
}
