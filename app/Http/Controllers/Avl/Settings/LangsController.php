<?php namespace App\Http\Controllers\Avl\Settings;

use App\Http\Controllers\Avl\AvlController;
use Illuminate\Http\Request;
use App\Models\Langs;
use Schema;

class LangsController extends AvlController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', new Langs);

        return view('avl.settings.langs.index', [
            'langs' => Langs::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', new Langs);

        return view('avl.settings.langs.create', [
            'existLangs' => Langs::all()->pluck('key')->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Langs);

        $post = $this->validate(request(), [
            'button' => 'required|in:add,save',
            'lang_key' => 'required|unique:langs,key',
            'lang_name' => 'required|min:2'
        ]);

        $create = Langs::create([
            'good' => 1,
            'key' => $post['lang_key'],
            'name' => $post['lang_name']
        ]);

        if ($create) {
            if ($post['button'] == 'add') {
                return redirect()->route('langs.create')->with(['success' => ['Сохранение прошло успешно!']]);
            }
            return redirect()->route('langs.index')->with(['success' => ['Сохранение прошло успешно!']]);
        }

        return redirect()->route('langs.create')->with(['errors' => ['Что-то пошло не так.']]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $this->authorize('view', new Langs);

        return view('avl.settings.langs.show', [
            'lang' => Langs::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $this->authorize('update', new Langs);

        return view('avl.settings.langs.edit', [
            'lang' => Langs::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', new Langs);

        $post = $this->validate(request(), [
            // 'lang_key' => 'required|unique:langs,key,'.$id,
            'lang_name' => 'required|min:2'
        ]);

        $lang = Langs::findOrFail($id);
        if ($lang) {
            $lang->name = $post['lang_name'];

            if ($lang->save()) {
                return redirect()->route('langs.index')->with(['success' => ['Сохранение прошло успешно!']]);
            }
        }

        return redirect()->route('langs.edit', ['langs' => $id])->with(['errors' => ['Что-то пошло не так.']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $this->authorize('delete', new Langs);

        $lang = Langs::findOrFail($id);

        if ($lang) {
            if ($lang->delete()) {
                return ['success' => ['Запись удалена']];
            }
        }
        return ['errors' => ['Что-то пошло не так']];
    }
}
