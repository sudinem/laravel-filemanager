<?php namespace Unisharp\Laravelfilemanager\controllers;

use Unisharp\Laravelfilemanager\controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

/**
 * Class CropController
 * @package Unisharp\Laravelfilemanager\controllers
 */
class CropController extends LfmController {

    /**
     * Show crop page
     *
     * @return mixed
     */
    public function getCrop()
    {
        $working_dir = Input::get('working_dir');
        $img = parent::getUrl('directory') . Input::get('img');

        return View::make('laravel-filemanager::crop')
            ->with(compact('working_dir', 'img'));
    }


    /**
     * Crop the image (called via ajax)
     */
    public function getCropimage()
    {
        $image = Input::get('img');
        $dataX = Input::get('dataX');
        $dataY = Input::get('dataY');
        $dataHeight = Input::get('dataHeight');
        $dataWidth = Input::get('dataWidth');

        // crop image
        $tmp_img = Image::make(public_path() . $image);
        $new_file_name = uniqid().'.jpg';
        $new_file = parent::getPath('directory') . $new_file_name;
        $tmp_img->crop($dataWidth, $dataHeight, $dataX, $dataY)
            ->save($new_file);

        // make new thumbnail
        $thumb_img = Image::make($new_file);
        $thumb_img->fit(200, 200)
            ->save(parent::getPath('thumb') . $new_file_name);
    }
}
