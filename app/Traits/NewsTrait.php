<?php namespace App\Traits;

use App\Models\Sections;

/**
 * Functions by Models
 */
trait NewsTrait
{

    public static function getNews($alias = '', $templatePath = '')
    {
        $section = Sections::whereType('news')->whereAlias($alias)->whereGood(true)->first();

        if (!is_null($section)) {
            $template = 'site.templates.news.col.' . (($templatePath != '') ? $templatePath : self::getTemplateFileName($section->current_template->file_col));

            $news = $section->news()
                ->where('good_' . app()->getLocale(), 1)
                ->orderBy('published_at', 'DESC')
                ->limit($section->current_template->records_col)
                ->get();

            $news->load(['media' => function ($query) {
                $query->where('good', 1)->orderBy('main', 'DESC')->orderBy('sind', 'DESC');
            }]);

            return view($template, [
                'news' => $news,
                'section' => $section
            ])->render();
        }
        return false;
    }

    public static function getTemplateFileName($file)
    {
        return substr($file, 0, strpos($file, "."));
    }

}
