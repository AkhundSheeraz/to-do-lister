<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class itemController extends Controller
{
    public function change_status(Request $request)
    {
        $dataID = $request->id;
        // $fetch = Items::where('id',$dataID)->get();
        $changin_Status = Items::whereHas('checklists', function ($query) {
            $query->whereHas('group', function ($queryagain) {
                $queryagain->where('user_id', auth()->user()->id);
            });
        })->where('id', $dataID)->first();
        if($changin_Status->status == 0){
            $changin_Status->status = 1;
            $changin_Status->save();
        }else{
            $changin_Status->status = 0;
            $changin_Status->save();
        }
        return response()->json([
            'status' => true,
            'message' => 'updated',
            'data' => $changin_Status
        ]);
    }
}
