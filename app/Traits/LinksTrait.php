<?php namespace App\Traits;

use App\Models\Sections;
use Cache;

/**
 * Functions by Models
 */
trait LinksTrait
{

    public static function getLinks($alias = '', $templatePath = '')
    {
        $section = Sections::whereType('links')->whereAlias($alias)->whereGood(true)->first();

        if (!is_null($section)) {
            $template = 'site.templates.links.col.' . (($templatePath != '') ? $templatePath : self::getTemplateFileName($section->current_template->file_col));

            $links = $section->links()->where('good_' . app()->getLocale(), true)
                ->orderBy('published_at', 'DESC')
                ->limit($section->current_template->records_col)
                ->get();

            return view($template, [
                'links' => $links,
                'section' => $section
            ]);
        }
    }

    public static function getTemplateFileName($file)
    {
        return substr($file, 0, strpos($file, "."));
    }
}
