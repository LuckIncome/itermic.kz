<?php

namespace App\Http\Controllers\Avl\Settings\Sections;

use Illuminate\Http\Request;
use App\Http\Controllers\Avl\AvlController;
use App\Models\{Rubrics, Sections, Langs, Links};
use Cache;

class LinksController extends AvlController
{

    protected $langs = null;

    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->langs = Langs::get();
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id, Request $request)
    {
        $section = Sections::find($id);

        $links = Links::where('section_id', $id);

        if (!is_null($request->input('rubric'))) {
            if ($request->input('rubric') == 0) {
                $links = $links->whereNull('rubric_id');
            } else {
                $links = $links->where('rubric_id', $request->input('rubric'));
            }
        }

        return view('avl.settings.sections.links.index', [
            'id' => $id,
            'section' => $section,
            'langs' => $this->langs,
            'links' => $links->orderBy('published_at', 'DESC')->paginate(20),
            'rubrics' => toSelectTransform(Rubrics::select('id', 'title_ru')->where('section_id', $section->id)->get()->toArray()),
        ]);
    }

    public function create($id)
    {
        $section = Sections::find($id);

        return view('avl.settings.sections.links.create', [
            'langs' => $this->langs,
            'section' => $section,
            'rubrics' => $section->rubrics()->orderBy('published_at', 'DESC')->get(),
            'id' => $id
        ]);
    }

    public function store(Request $request, $id)
    {
        $post = $request->input();

        $this->validate(request(), [
            'button' => 'required|in:add,save',
            'links_published_at' => 'required|date_format:"Y-m-d"',
            'links_published_time' => 'required|date_format:"H:i"',
            'links_class' => '',
            'links_title_ru' => '',
            'links_link_ru' => 'required',
            'links_description_ru' => ''
        ]);

        $links = new Links;

        foreach ($this->langs as $lang) {
            $links->{'good_' . $lang->key} = $post['links_good_' . $lang->key];
            $links->{'title_' . $lang->key} = $post['links_title_' . $lang->key];
            $links->{'link_' . $lang->key} = $post['links_link_' . $lang->key];
            $links->{'description_' . $lang->key} = $post['links_description_' . $lang->key];
        }

        $links->published_at = $post['links_published_at'] . ' ' . $post['links_published_time'];
        $links->class = $post['links_class'];
        $links->section_id = $id;

        if (isset($post['links_rubric_id']) && ($post['links_rubric_id'] > 0)) {
            $links->rubric_id = $post['links_rubric_id'];
        }   // проставляему рубрику если ее выбрали

        if ($links->save()) {
            if ($post['button'] == 'save') {
                return redirect()->route('links.create', ['id' => $id])->with(['success' => ['Сохранение прошло успешно!']]);
            }
            return redirect()->route('links.index', ['id' => $id])->with(['success' => ['Сохранение прошло успешно!']]);
        }

        return redirect()->route('links.create', ['id' => $id])->with(['errors' => ['Что-то пошло не так.']]);
    }

    public function edit($id, $link_id)
    {
        $section = Sections::find($id);
        $link = Links::findOrFail($link_id);

        return view('avl.settings.sections.links.edit', [
            'section' => $section,
            'rubrics' => $section->rubrics()->orderBy('published_at', 'DESC')->get(),
            'id' => $id,
            'langs' => $this->langs,
            'link' => $link,
        ]);
    }

    public function show($id, $link_id)
    {
        $link = Links::findOrFail($link_id);

        return view('avl.settings.sections.links.show', [
            'section' => Sections::find($id),
            'id' => $id,
            'langs' => $this->langs,
            'link' => $link,
        ]);
    }

    public function update(Request $request, $id, $link_id)
    {
        $section = Sections::findOrFail($id);

        $data = $request->input();
        $this->validate(request(), [
            'button' => 'required|in:add,save',
            'links_published_at' => 'required|date_format:"Y-m-d"',
            'links_published_time' => 'required|date_format:"H:i"',
            'links_class' => '',
            'links_title_ru' => '',
            'links_link_ru' => 'required',
            'links_description_ru' => ''
        ]);

        $links = Links::findOrFail($link_id);

        foreach ($this->langs as $lang) {
            $links->{'good_' . $lang->key} = $data['links_good_' . $lang->key];
            $links->{'title_' . $lang->key} = $data['links_title_' . $lang->key];
            $links->{'link_' . $lang->key} = $data['links_link_' . $lang->key];
            $links->{'description_' . $lang->key} = $data['links_description_' . $lang->key];

            // Очищаем файлы кеша
            if (Cache::has('col-links-' . $lang->key . '-' . $section->alias)) {
                Cache::forget('col-links-' . $lang->key . '-' . $section->alias);
            }
        }

        $links->published_at = $data['links_published_at'] . ' ' . $data['links_published_time'];
        $links->class = $data['links_class'];

        $links->rubric_id = null;
        if (isset($data['links_rubric_id']) && ($data['links_rubric_id'] > 0)) {
            $links->rubric_id = $data['links_rubric_id'];
        }

        if ($links->save()) {
            return redirect()->route('links.index', ['id' => $id])->with(['success' => ['Сохранение прошло успешно!']]);
        }
        return redirect()->back()->with(['errors' => ['Что-то пошло не так.']]);
    }

    public function destroy($id)
    {
        //
    }
}
