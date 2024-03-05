<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use App\Models\User;
use DB;

class RoleController extends Controller
{
    public function AllPermission(){

        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission',compact('permissions'));
    }

    public function AddPermission(){

        return view('backend.pages.permission.add_permission');
    }

    public function StorePermission(Request $request){

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Created Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }

    public function EditPermission($id){

        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission',compact('permission'));
    }

    public function UpdatePermission(Request $request){

        $per_id = $request->id;

        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id){

        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ImportPermission(){

        return view('backend.pages.permission.import_permission');
    }

    public function Export(){

        return Excel::download(new PermissionExport, 'permission.xlsx');
    }

    public function Import(Request $request){

        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = array(
            'message' => 'Permission Imported Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    //Role method

    public function AllRoles(){

        $roles = Role::all();
        return view('backend.pages.roles.all_roles',compact('roles'));
    }

    public function AddRoles(){
        return view('backend.pages.roles.add_roles');
    }

    public function StoreRoles(Request $request){

        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Roles Created Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);
    }

    public function EditRoles($id){

        $roles = Role::findOrFail($id);
        return view('backend.pages.roles.edit_roles',compact('roles'));
    }

    public function UpdateRoles(Request $request){

        $role_id = $request->id;

        Role::findOrFail($role_id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);
    }

    public function DeleteRoles($id){

        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Role Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    //Add Roles Permission all method//

    public function AddRolesPermission(){

        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.add_roles_permission',compact('roles','permissions','permission_groups'));
    }

    public function RolePermissionStore(Request $request){

        $permissions = $request->permission;
        foreach($permissions as $key => $permission_id){
            $data = [
                'role_id' => $request->role_id,
                'permission_id' => $permission_id
            ];
            DB::table('role_has_permissions')->insert($data);
        }
        $notification = [
            'message' => 'Role Permission Added Successfully!',
            'alert-type' => 'success'
        ];
        return redirect()->route('all_roles_permission')->with($notification);
    }

    public function AllRolesPermission(){

        $roles = Role::all();
        return view('backend.pages.rolesetup.all_roles_permission',compact('roles'));
    }
}
