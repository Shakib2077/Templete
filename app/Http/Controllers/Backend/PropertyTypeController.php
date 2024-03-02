<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;
use App\Models\Aminities;

class PropertyTypeController extends Controller
{
    public function AllType(){
        $types = PropertyType::latest()->get();
        return view('backend.type.all_type',compact('types'));
    }

    public function AddType(){
        return view('backend.type.add_type');
    }

    public function StoreType(Request $request){
        $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required',
        ]);
        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        $notification = array(
            'message' => 'Property Type Created Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.type')->with($notification);
    }

    public function EditType($id){
        $types = PropertyType::findOrFail($id);
        return view('backend.type.edit_type',compact('types'));
    }

    public function UpdateType(Request $request){

        $pid = $request->id;

        $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required',
        ]);
        PropertyType::findOrFail($pid)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,
        ]);
        $notification = array(
            'message' => 'Property Type Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.type')->with($notification);
    }

    public function DeleteType($id){

        PropertyType::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Property Type Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    //Aminities Method


    public function AllAminitie(){
        $aminities = Aminities::latest()->get();
        return view('backend.aminities.all_aminities',compact('aminities'));
    }

    public function AddAminitie(){
        return view('backend.aminities.add_aminities');
    }

    public function StoreAminitie(Request $request){

        Aminities::insert([
            'aminities_name' => $request->aminities_name,
        ]);
        $notification = array(
            'message' => 'Aminities Created Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.aminitie')->with($notification);
    }

    public function EditAminitie($id){

        $aminities = Aminities::findOrFail($id);
        return view('backend.aminities.edit_aminities',compact('aminities'));
    }

    public function UpdateAminitie(Request $request){

        $ame_id = $request->id;

        Aminities::findOrFail($ame_id)->update([
            'aminities_name' => $request->aminities_name,
        ]);
        $notification = array(
            'message' => 'Amintie Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.aminitie')->with($notification);
    }

    public function DeleteAminitie($id){

        Aminities::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Aminitie Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

}


