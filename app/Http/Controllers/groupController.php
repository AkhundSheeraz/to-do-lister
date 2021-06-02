<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class groupController extends Controller
{
    public function addGroup(Request $request)
    {
        $data = $request->all();
        $rules = [
            'group_type' => ['required']
        ];
        $error = [
            'group_type.required' => 'Group name required!'
        ];

        $validator = Validator::make($data, $rules, $error);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->toArray()
            ]);
        }
        // In this we dont have to write foreign key!
        // $intoDB = auth()->user()->groups()->create([
        //     'type' => $request->group_type
        // ]);

        //foreign key should be given with attribute explicitly here!
        $createGroup = new Group;
        $createGroup->user_id = auth()->user()->id;
        $createGroup->type = $request->group_type;
        $createGroup->save();
        if ($createGroup == true) {
            return response()->json([
                'status' => true,
                'message' => 'Group Added',
                'data' => $createGroup
            ]);
        }
    }

    public function fetchGroups()
    {
        $groups = Group::where('user_id', auth()->user()->id)->get('type');
        if ($groups->count() > 0) {
            return view('groups', compact('groups'));
        } else {
            return view('groups');
        }
    }
}
