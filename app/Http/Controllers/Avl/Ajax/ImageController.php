<?php namespace App\Http\Controllers\Avl\Ajax;

use App\Http\Controllers\Avl\AvlController;
use Illuminate\Http\Request;
use LaravelLocalization;
use App\Models\{News, Sections, Media, Links, Rubrics, Pages, PagesMedia, Langs};
use Carbon\Carbon;
use File;
use Image;

class ImageController extends AvlController
{
    protected $fileTypes = ['jpg', 'jpeg', 'gif', 'png', 'JPEG', 'JPG', 'PNG', 'GIF'];

    protected $file;

    protected $maxFileSize = 12582912;   // размер загружаемого файла не более 12 мб

    protected $fileName;

    public function __construct(Request $request)
    {
        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];

            $this->file = $_FILES['Filedata'];

            $this->fileName = pathinfo($_FILES['Filedata']['name']);

            if (!in_array(strtolower($this->fileName['extension']), $this->fileTypes)) {
                abort(404);
            }
        }
    }

    public function newsImages()
    {
        if ($this->file['size'] < $this->maxFileSize) {
            $name = $this->fileName['filename'];

            $ext = '.' . strtolower($this->fileName['extension']);

            $section_id = intval($_POST['section_id']);
            $news_id = intval($_POST['news_id']);

            $path = public_path('data/media/news/images/');

            $news = News::where('section_id', $section_id)->find($news_id);
            // dd($news);
            if ($news) {
                $sind = $news->media()->where('type', 'image')->orderBy('sind', 'DESC')->first();
                $item = ($sind) ? ++$sind->sind : 1;

                $picture = new Media;
                $picture->section_id = $section_id;
                $picture->news_id = $news->id;
                $picture->type = 'image';
                $picture->sind = $item;
                $picture->title_ru = $name;
                $picture->publish_at = Carbon::now();

                if ($picture->save()) {
                    $newImage = 'data/media/news/images/' . md5(Carbon::now() . $picture->id) . $ext;

                    if (File::exists($this->file['tmp_name'])) {
                        if (File::exists(public_path($newImage))) {
                            File::delete(public_path($newImage));
                        }

                        if (File::copy($this->file['tmp_name'], public_path($newImage))) {
                            File::delete($this->file['tmp_name']);

                            $img = Image::make(public_path($newImage));
                            $img->resize(2000, 2000, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                            // $img->insert(public_path('avl/img/zp-logo.png'), 'top-right', 30, 30);
                            $img->save(public_path($newImage));
                            chmod($newImage, 0755);

                            $picture->link = $newImage;

                            $langs = \App\Models\Langs::where('good', 1)->get()->toArray();

                            if ($picture->save()) {
                                return [
                                    'success' => true,
                                    'file' => [
                                        'id' => $picture->id,
                                        'good' => $picture->good,
                                        'main' => $picture->main,
                                        'langs' => $langs,
                                        'src' => $newImage,
                                        'ext' => $picture->ext,
                                        'sind' => $picture->sind,
                                    ]
                                ];
                            } else {
                                $picture->delete();
                            }
                        }
                    }
                }
            }
            return ['errors' => ['Ошибка загрузки, обратитесь к администратору.']];

        } else {
            return ['errors' => ['Размер фотографии не более <b>3-х</b> мегабайт.']];
        }
    }

    public function pageImages()
    {
        if ($this->file['size'] < $this->maxFileSize) {
            $name = $this->fileName['filename'];
            $ext = '.' . strtolower($this->fileName['extension']);
            $section_id = intval($_POST['section_id']);

            $path = public_path('data/media/page/images/');

            $page = Pages::where('section_id', $section_id)->first();

            // dd($page);
            if (!is_null($page)) {

                $sind = $page->images()->orderBy('sind', 'DESC')->first();
                $item = ($sind) ? ++$sind->sind : 1;

                $image = $page->images()->create([
                    'page_id' => $section_id,
                    'slider' => 1,
                    'sind' => $item,
                    'title_ru' => $name
                ]);
                if ($image) {
                    $newImage = 'data/media/page/images/' . md5(Carbon::now() . $image->id) . $ext;

                    if (File::exists($this->file['tmp_name'])) {

                        if (File::exists(public_path($newImage))) {
                            File::delete(public_path($newImage));
                        }

                        if (File::copy($this->file['tmp_name'], public_path($newImage))) {
                            File::delete($this->file['tmp_name']);

                            chmod($newImage, 0755);

                            $image->link = $newImage;

                            $langs = Langs::where('good', 1)->get()->toArray();

                            if ($image->save()) {
                                return [
                                    "success" => true,
                                    "file" => [
                                        "id" => $image->id,
                                        "good" => $image->good,
                                        "langs" => $langs,
                                        "slider" => $image->slider,
                                        "src" => $newImage
                                    ]
                                ];
                            } else {
                                $image->delete();
                            }
                        }
                    }

                }
            }

        }
    }

    public function pageUpdate($id, Request $request)
    {
        $media = PagesMedia::find($id);

        if ($media) {
            $translates = $request->input('translates');
            foreach ($translates as $lang => $translate) {
                $title = 'title_' . $lang;

                $media->$title = $translate;
            }
            if ($media->save()) {
                return ['success' => ['Сохранено!']];
            }
        }
        return ['errors' => ['Произошла ошибка, попробуйте позже или обратитесь к администратору.']];
    }

    public function rubricImages()
    {
        if ($this->file['size'] < $this->maxFileSize) {
            $name = $this->fileName['filename'];

            $ext = '.' . strtolower($this->fileName['extension']);

            $rubric_id = intval($_POST['rubric_id']);

            $path = public_path('data/media/rubrics/images/');

            $rubric = Rubrics::find($rubric_id);
            // dd($news);
            if ($rubric) {
                $sind = $rubric->images()->orderBy('sind', 'DESC')->first();
                $item = ($sind) ? ++$sind->sind : 1;

                $image = new Media();

                $image->good = 1;
                $image->rubric_id = $rubric_id;
                $image->type = 'image';
                $image->sind = $item;
                $image->lang = 'ru';
                $image->title_ru = $name;
                $image->publish_at = Carbon::now();

                if ($image) {
                    $newImage = 'data/media/rubrics/images/' . md5(Carbon::now() . $image->id) . $ext;

                    if (File::exists($this->file['tmp_name'])) {
                        if (File::exists(public_path($newImage))) {
                            File::delete(public_path($newImage));
                        }

                        if (File::copy($this->file['tmp_name'], public_path($newImage))) {
                            File::delete($this->file['tmp_name']);

                            $img = Image::make(public_path($newImage));
                            $img->resize(2000, 2000, function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                            // $img->insert(public_path('avl/img/zp-logo.png'), 'top-right', 30, 30);
                            $img->save(public_path($newImage));
                            chmod($newImage, 0755);

                            $image->link = $newImage;

                            $langs = \App\Models\Langs::where('good', 1)->get()->toArray();
                            // dd($langs);

                            if ($image->save()) {
                                return [
                                    'success' => true,
                                    'file' => [
                                        'id' => $image->id,
                                        'good' => $image->good,
                                        'main' => $image->main,
                                        'title_ru' => $image->title_ru,
                                        'langs' => $langs,
                                        'src' => $newImage,
                                        'ext' => $image->ext,
                                        'sind' => $image->sind,
                                    ]
                                ];
                            } else {
                                $image->delete();
                            }
                        }
                    }
                }
            }
            return ['errors' => ['Ошибка загрузки, обратитесь к администратору.']];

        } else {
            return ['errors' => ['Размер фотографии не более <b>3-х</b> мегабайт.']];
        }
    }

    public function links_photo()
    {
        if ($this->file['size'] < config('avl.picMaxSize')) {
            $name = $this->fileName['filename'];
            // dd($_POST);
            $ext = '.' . strtolower($this->fileName['extension']);
            $links_id = (int)$_POST['link_id'];
            $lang = $_POST['link_lang'];
            $photo = 'photo_';
            $photo .= $lang;

            $links = Links::find($links_id);

            $fileD = 'data/media/links/' . md5(Carbon::now() . $links->id) . $ext;

            if (File::exists($this->file['tmp_name'])) {


                if (File::exists(public_path($links->$photo))) {
                    File::delete(public_path($links->$photo));
                }

                if (File::exists(public_path($fileD))) {
                    File::delete(public_path($fileD));
                }

                if (File::copy($this->file['tmp_name'], public_path($fileD))) {
                    File::delete($this->file['tmp_name']);

                    $img = Image::make(public_path($fileD));

                    $img->resize(1600, 1600, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $img->save(public_path($fileD));

                    $links->$photo = $fileD;
                    // $links->save();
                    if ($links->save()) {
                        return [
                            'success' => true,
                            'file' => [
                                'id' => $links->id,
                                'image' => $fileD,
                                'lang' => $lang
                            ]
                        ];
                    } else {
                        return ['errors' => true, 'messages' => ['Ошибка обратитесь к администратору']];
                    }
                }
            }
            return ['errors' => true];
        }
        return ['errors' => true, 'messages' => ['Размер фотографии превышает <b>' . config('avl.picMaxSize') . 'кб</b>']];
    }
}
