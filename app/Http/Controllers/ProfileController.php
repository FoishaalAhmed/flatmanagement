<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileObject;

    public function __construct()
    {
        $this->profileObject = new Profile();
    }

    public function photo(Request $request)
    {
        $request->validate(Profile::$validatePhoto);
        $this->profileObject->updateProfilePhoto($request);
        return back();
    }

    public function password(Request $request)
    {
        $request->validate(Profile::$validatePassword);
        $this->profileObject->updateProfilePassword($request);
        return back();
    }

    public function info(ProfileRequest $request)
    {
        $this->profileObject->updateProfileInfo($request);
        return back();
    }
}
