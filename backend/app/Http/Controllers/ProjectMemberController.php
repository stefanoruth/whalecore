<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\MemberResource;
use App\ProjectMember;

class ProjectMemberController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            'email' => [
                'required',
                'email',
                Rule::exists('users', 'email'),
            ],
        ]);

        $user = User::where('email', $data['email'])->firstOrFail();
        $project = Project::findOrFail(session('tenant'));
        $member = $project->members()->firstOrCreate(['user_id' => $user->id], ['role_id' => 3]);

        return MemberResource::make($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        request()->validate([
            'role' => [
                'required',
                Rule::exists('roles', 'name'),
            ],
        ]);

        $role = Role::where('name', request('role'))->firstOrFail();
        ProjectMember::where('user_id', $id)->where('project_id', session('tenant'))->update(['role_id' => $role->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Project::findOrFail(session('tenant'))->members()->where('user_id', $id)->delete();
    }
}
