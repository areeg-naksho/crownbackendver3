<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\BaseController as AuthBaseController;
use App\Models\Email;
use Validator;

class EmailController extends AuthBaseController
{

    public function index()
    {
        $email = Email::all();
        return $this->sendResponse(
            $email,
            "All Email Sent"
        );
    }



    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Please validate error', $validator->errors());
        }
        $email = Email::create($input);
        return $this->sendResponse($email, 'Email created successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
