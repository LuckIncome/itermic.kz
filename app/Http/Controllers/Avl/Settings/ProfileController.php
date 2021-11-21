<?php namespace App\Http\Controllers\Avl\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Avl\AvlController;
use App\Models\User;
use App\Models\Profile;

class ProfileController extends AvlController
{
    public function edit($id)
    {
        $this->authorize('view', new User);

        return view('avl.settings.profile.edit', [
            'user' => \App\Models\User::findOrFail($id),
            'roles' => \App\Models\Roles::where('name', '!=', 'admin')->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', new User);
        $rules = [
            'profile_email' => 'required|email|unique:users,email,' . $id,
            'profile_iin' => 'required|size:12',
            'profile_name' => 'required|min:2|max:100',
            'profile_surname' => 'max:100',
            'profile_patronymic' => 'max:100',
            'profile_homephone' => 'max:100',
            'profile_mobile' => 'max:100'
        ];

        if ($request->input('profile_password')) {
            $rules['profile_password'] = 'required|min:5';
        }

        $post = $this->validate(request(), $rules);

        $user = \App\Models\User::findOrFail($id);
        if ($user) {
            $user->email = $post['profile_email'];
            if ($request->input('profile_password')) {
                $user->password = $post['profile_password'];
            }

            $user->iin = $post['profile_iin'];
            $user->name = $post['profile_name'];
            $user->surname = $post['profile_surname'];
            $user->patronymic = $post['profile_patronymic'];
            $user->homephone = $post['profile_homephone'];
            $user->mobile = $post['profile_mobile'];

            if ($user->save()) {
                return redirect()->route('profile.edit', ['profile' => $id])->with(['success' => ['Сохранение прошло успешно!']]);
            }
        }
        return redirect()->route('profile.edit', ['user' => $id])->with(['errors' => ['Что-то пошло не так.']]);
    }
}
