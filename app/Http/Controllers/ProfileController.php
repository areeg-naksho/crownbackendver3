<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Controllers\Auth\BaseController as AuthBaseController;

use Illuminate\Http\Request;
use Validator;

class ProfileController extends AuthBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::all();
        return $this->sendResponse(
            $profile,
            "All Profile Sent"
        );
    }



    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address',
            'address2',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'zip_code' => 'required',
            'po_box' => 'required',
            'image'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Please validate error', $validator->errors());
        }
        $profile = Profile::create($input);
        return $this->sendResponse($profile, 'Profile created successfully');
    }


    public function show($id)
    {
        $profile = Profile::find($id);
        if (is_null($profile)) {
            return $this->sendError('Product not found', "asd");
        }
        return $this->sendResponse($profile, 'Profile found successfully');
    }


    public function update(Request $request, Profile $profile)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address',
            'address2',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'zip_code' => 'required',
            'po_box' => 'required',
            'image'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Please validate error', $validator->errors());
        }
        $profile->first_name = $input['first_name'];
        $profile->last_name = $input['last_name'];
        $profile->email = $input['email'];
        $profile->phone = $input['phone'];
        $profile->address = $input['address'];
        $profile->address2 = $input['address2'];
        $profile->country_id = $input['country_id'];
        $profile->state_id = $input['state_id'];
        $profile->city_id = $input['city_id'];
        $profile->zip_code = $input['zip_code'];
        $profile->po_box = $input['po_box'];
        $profile->image = $input['image'];
        $profile->save();
        return $this->sendResponse($profile, 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return $this->sendResponse($profile, 'Profile deleted successfully');
    }
}
