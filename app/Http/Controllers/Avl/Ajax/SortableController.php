<?php namespace App\Http\Controllers\Avl\Ajax;

use App\Http\Controllers\Avl\AvlController;
use Illuminate\Http\Request;
use App\Models\Sections;

class SortableController extends AvlController
{

    public function mediaSortable($id, Request $request)
    {
        $errors = false;
        $sortable = $request->input('mediaSortable');
        $type = (!is_null($request->input('type'))) ? $request->input('type') : 'image';
        $media = $this->reSortMediaArray($sortable);

        $news = Sections::find($id)->news()->find($request->input('news_id'));
        if ($news) {
            foreach ($media as $index => $media_id) {
                $sind = $news->media($type)->find($media_id);

                $sind->sind = $index;
                if (!$sind->save()) {
                    $errors = true;
                }
            }
        }
        return ['errors' => $errors];
    }

    public function reSortMediaArray($array = [])
    {
        $return = [];
        $idsImages = array_values($array);
        $j = 0;
        for ($i = count($idsImages); $i > 0; $i--) {
            $return[$i] = $idsImages[$j++];
        }
        return $return;
    }
}
