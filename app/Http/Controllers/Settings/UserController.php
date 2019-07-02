<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Users\UserRequest;
use App\model\File;
use App\Models\Settings\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Storage;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var File
     */
    private $file;

    /**
     * UserController constructor.
     * @param User $user
     * @param File $file
     */
    public function __construct(User $user, File $file)
    {
        $this->user = $user;
        $this->file = $file;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->user->paginate(15);

        return view('settings.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('settings.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request)
    {

            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($request->file('image')) {
                $attributes['local_path'] = 'profile/images';
                $attributes['file'] = $request->file('image');
                $attributes['description'] = User::$PROFILE_IMAGE;
                $attributes['fileable_id'] = $user->id;
                $attributes['fileable_type'] = User::class;
                $this->file->createFile($attributes);

            }

        return redirect()->route('user.index')->with('message', ['type' => 'success', 'text' => trans('common.saveSuccess')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->user->find($id);

        return view('settings.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        return view('settings.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param int $id
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->user->find($id);

        if (!empty($user)){

            $user->update($request->all());

            if ($request->file('image')) {
                if (empty($user->image)) {
                    $attributes['local_path'] = 'profile/images';
                    $attributes['file'] = $request->file('image');
                    $attributes['description'] = User::$PROFILE_IMAGE;
                    $attributes['fileable_id'] = $user->id;
                    $attributes['fileable_type'] = User::class;

                    $this->file->createFile($attributes);
                } else {

                    $attributes['local_path'] = 'profile/images';
                    $attributes['file'] = $request->file('image');
                    $attributes['description'] = User::$PROFILE_IMAGE;
                    $attributes['fileable_id'] = $user->id;
                    $attributes['fileable_type'] = User::class;

                    $attributes['old_file'] = $user->image->path;

                    $user->image->updateFile($attributes);
                }
            }

            return redirect()->route('department.index')->with('message', ['type' => 'success', 'text' => trans('common.updateSuccess')]);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => trans('users.notFoundUser')]);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);
        if ($user) {

            if (!empty($user->image->path)) {
                Storage::disk('public')->delete($user->image->path);
                $user->image->delete();
            }

            $user->delete();

            return redirect()->route('department.index')->with('message', ['type' => 'success', 'text' => trans('common.successRemoved')]);
        }

        return redirect()->route('system-user.index')->with('message', ['type' => 'error', 'text' => 'users.notFoundUser']);
    }
}
