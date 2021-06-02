<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class checklistController extends Controller
{
    public function Get_groups()
    {
        $groups = Group::where('user_id', auth()->user()->id)->get(['id', 'type']);
        if ($groups->count() > 0) {
            return view('checklist', compact('groups'));
        } else {
            return view('checklist');
        }
    }

    public function add_checklist(Request $request)
    {
        $data = $request->all();
        $rules = [
            'checklist' => ['required'],
            'group_id' => ['required']
        ];
        $error = [
            'checklist.required' => 'checklist name required!',
            'group_id.required' => 'Please select a group!'
        ];
        $validation = Validator::make($data, $rules, $error);
        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validation->errors()->toArray()
            ]);
        }

        $create_Checklist = new Checklist;
        $create_Checklist->group_id = $request->group_id;
        $create_Checklist->checklist_name = $request->checklist;
        $create_Checklist->save();
        if ($create_Checklist == true) {
            return response()->json([
                'status' => true,
                'message' => 'Checklist created',
                'data' => $create_Checklist
            ]);
        }
    }
    
}
