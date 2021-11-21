<?php

namespace App\Http\Controllers\Avl\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Avl\AvlController;
use App\Models\{Langs, Media};
use Validator;
use Carbon\Carbon;

class DefaultController extends AvlController
{
    public function good(Request $request)
    {
        $postModel = $request->input('model');
        $exModel = 'App\Models\\' . $postModel;
        $good = 'good';
        if (!is_null($request->input('lang'))) {
            $good = 'good_' . $request->input('lang');
        }

        if (class_exists($exModel)) {
            $model = $exModel::findOrFail($request->input('id'));
            if ($model) {
                $model->$good = ($model->$good == 1) ? 0 : 1;
                if ($model->save()) {
                    return ['success' => 'Готово'];
                }
            }
        }
        return ['errors' => 'Что-то пошло не так'];
    }

    public function changeSwitch(Request $request)
    {
        $lang = $request->input('lang');

        $model = Media::findOrFail($request->input('id'));

        if ($model) {
            $model->{'switch_' . $lang} = !$model->{'switch_' . $lang};

            if ($model->save()) {
                return ['success' => 'Готово'];
            }
        }

        return ['errors' => 'Что-то пошло не так'];
    }

    /**
     * Включение\Выключение раздела из меню
     */
    public function menu(Request $request)
    {
        $model = \App\Models\Sections::findOrFail($request->input('id'));
        if ($model) {
            $model->menu = ($model->menu == 1) ? 0 : 1;
            if ($model->save()) {
                return ['success' => 'Готово'];
            }
        }
        return ['errors' => 'Что-то пошло не так'];
    }

    /**
     * Сортировка разделов для меню
     */
    public function changeOrder(Request $request)
    {
        $model = \App\Models\Sections::findOrFail($request->input('id'));
        if ($model) {
            $model->order = $request->input('order');
            if ($model->save()) {
                return ['success' => ['Готово']];
            }
        }
        return ['errors' => ['Что-то пошло не так']];
    }

    public function mainPhoto($id = 0, Request $request)
    {
        $post = $request->input('model');
        $news_id = $request->input('news_id');

        $table = '\App\Models\\' . $post;

        $table::where('news_id', $news_id)->update(['main' => 0]);

        $model = $table::find($id);

        if ($model) {
            $model->main = 1;
            if ($model->save()) {
                return ['success' => true];
            }
        }
        return ['errors' => 'Что-то пошло не так, обратитесь к администратору'];
    }

    public function changeFileLang($id, Request $request)
    {
        $file = Media::findOrFail($id);

        $langs = Langs::get()->toArray();
        $key = 0;
        foreach ($langs as $index => $lang) {
            if ($lang['key'] == $file->lang) {
                $key = $index;
            }
        }

        $newLang = $key + 1;
        if ($newLang >= count($langs)) {
            $newLang = 0;
        }

        $file->lang = $langs[$newLang]['key'];
        $file->save();

        return ['file' => $langs[$newLang]];
    }

    /**
     * Фиксирование новости на главную страницу
     * @param integer $id
     * @param Request $request
     * @return JSON
     */
    public function fixedNews($id = 0, Request $request)
    {
        $data = \App\Models\News::find($id);

        if ($data) {
            $data->fixed = !$data->fixed;
            if ($data->save()) {
                return ['success' => ['Сохранено!!!']];
            }
        }
        return ['errors' => 'Что-то пошло не так, обратитесь к администратору'];
    }

    public function deleteMedia($id = 0, Request $request)
    {
        $post = $request->input('model');

        $table = '\App\Models\\' . $post;
        $model = $table::find($id);

        if ($model) {
            if (!is_null($model->link)) {
                $fileName = last(explode('/', $model->link));
                array_map("unlink", glob(public_path('data/media/news/_thumbs/thumb_*-' . $fileName)));

                if (\File::exists(public_path($model->link))) {
                    \File::delete(public_path($model->link));
                }

                if ($model->delete()) {
                    return ['success' => true];
                }
            } else {
                if ($model->delete()) {
                    return ['success' => true];
                }
            }
        }
        return ['errors' => 'Что-то пошло не так, обратитесь к администратору'];
    }

    public function deletePhotoLinks($id = 0, Request $request)
    {
        $post = $request->input('model');
        $lang = $request->input('lang');
        $photo = 'photo_' . $lang;
        $table = '\App\Models\\' . $post;
        $model = $table::find($id);

        if ($model) {
            if (!is_null($model->$photo)) {
                $fileName = last(explode('/', $model->$photo));
                array_map("unlink", glob(public_path('data/media/links/_thumbs/thumb_*-' . $fileName)));
                if (\File::exists(public_path($model->$photo))) {
                    if (\File::delete(public_path($model->$photo))) {
                        $model->$photo = '';
                        if ($model->save()) {
                            return ['success' => true];
                        }
                    }
                }
            } else {
                return ['success' => true];
            }
        }
        return ['errors' => 'Что-то пошло не так, обратитесь к администратору'];
    }

    public function saveVideoLink(Request $request)
    {
        $news = \App\Models\News::where('section_id', $request->input('id'))->find($request->input('news_id'));

        $validator = Validator::make($request->input(), [
            'link' => 'url'
        ]);

        if (!$validator->fails()) {
            if ($news) {

                $media = new \App\Models\Media();

                $media->section_id = $request->input('id');
                $media->news_id = $request->input('news_id');
                $media->good = 1;
                $media->type = 'video';
                $media->lang = $request->input('lang');
                $media->{'title_' . $request->input('lang')} = $request->input('title');
                $media->link = $request->input('link');
                $media->publish_at = Carbon::now();

                if ($media->save()) {
                    return [
                        'success' => ['Ссылка сохранена!'],
                        'file' => $media->toArray()
                    ];
                } else {
                    $media->delete();
                }
            } else {
                return ['errors' => 'Что-то пошло не так, обратитесь к администратору'];
            }
        } else {
            return ['errors' => ['Введите корректную ссылку']];
        }
    }

    public function updateVideoLink($id, Request $request)
    {
        $title = $request->input('title');
        $validator = Validator::make($request->input(), [
            'link' => 'url'
        ]);

        if (!$validator->fails()) {
            $media = \App\Models\Media::find($id);
            if (!is_null($media)) {
                $column = 'title_' . $media->lang;

                $media->$column = $title;
                $media->link = $request->input('link');

                if ($media->save()) {
                    return ['success' => ['Сохранено!!!']];
                }
            }
            return ['errors' => ['Ошибка']];
        } else {
            return ['errors' => ['Введите корректную ссылку']];
        }
    }

    public function deleteVideo($id, Request $request)
    {
        $post = $request->input('model');

        $table = '\App\Models\\' . $post;
        $model = $table::find($id);

        if ($model) {
            if (!is_null($model->link)) {
                if ($model->delete()) {
                    return ['success' => ['Ссылка удалена']];
                }
            } else {
                return ['errors' => ['Запись не найдена']];
            }
        }
        return ['errors' => ['Что-то пошло не так, обратитесь к администратору']];
    }

}
