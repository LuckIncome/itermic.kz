<?php namespace App\Traits;

use App\Models\Sections;
use LaravelLocalization;
use App\Traits\SectionsTrait;
/**
 * Functions by Models
 */
trait PageTrait
{
  use SectionsTrait;

  public static function getPage ($alias = '')
  {
    $section = Sections::where('type', 'page')->where('alias', $alias)->first();

    if (!is_null($section)) {
      $template = 'site.templates.page.col.' . self::getTemplateFileName($section->current_template->file_col);

      $text  = '';
      $page = (!is_null($section->page)) ? $section->page->toArray() : [] ;

      if (!empty($page)) {
        $text = $page['description_' . LaravelLocalization::getCurrentLocale()] ?? $page['description_ru'];
      }

      return view($template, [
          'text' => $text,
          'section' => $section,
          'images' => (!is_null($section->page->images)) ? $section->page->images()->where('good', 1)->get() : null
      ])->render();
    }
    return false;
  }

  public static function getTemplateFileName ($file)
  {
    return substr($file, 0, strpos($file, "."));
  }

}
