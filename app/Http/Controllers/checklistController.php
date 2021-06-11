<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Group;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class checklistController extends Controller
{
    public function Get_groups()
    {
        $groups = Group::where('user_id', auth()->user()->id)->get(['id', 'type']);
        if ($groups->count() > 0) {
            $checklists = $this->get_checklists();
            if ($checklists->count() > 0) {
                return view('checklist', compact('groups', 'checklists'));
            } else {
                return view('checklist', compact('groups'));
            }
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

    public function get_checklists()
    {
        $checklist = Checklist::whereHas('group', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();
        return $checklist;
    }

    public function insert_taskorItem(Request $request)
    {
        $data = $request->all();
        $rules = [
            'task_item' => ['required']
        ];
        $error = [
            'task_item.required' => 'Insert task or item please!'
        ];
        $validation = Validator::make($data, $rules, $error);
        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validation->errors()->toArray()
            ]);
        }
        $addIn_checklist = new Items;
        $addIn_checklist->checklists_id = $request->id;
        $addIn_checklist->item_name = $request->task_item;
        $addIn_checklist->save();
        if ($addIn_checklist == true) {
            return response()->json([
                'status' => true,
                'message' => "Task/Item inserted",
                'data' => $addIn_checklist
            ]);
        }
    }

    public function get_taskoritems($id)
    {
        $fetching = Items::whereHas('checklists', function ($query) use($id){
            $query->whereHas('group', function ($queryagain) {
                $queryagain->where('user_id', auth()->user()->id);
            })->where('checklists_id',$id);
        })->get();
        if ($fetching->count() > 0) {
            return view('view_checklist', ['id' => $id])->with(compact('fetching'));
        } else {
            return view('view_checklist', ['id' => $id]);
        }
    }
}
