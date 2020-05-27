<?php

namespace App\Http\Controllers;

use App\Http\Requests\OwnerRequest;
use App\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OwnerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(OwnerRequest $request)
    {
        $owner = Owner::find(1);

        if(! $owner){
            $owner = new Owner();
        }

        if ($request->hasfile('logo')) {
            if($owner->logo){
                //Borrar la imagen del servidor
                if (File::exists($owner->logo)) {
                    unlink($owner->logo);
                }
            }

            $logo = $request->logo;
            $logo->move(public_path("img"), 'logo_owner.' . $logo->getClientOriginalExtension());

            $owner->logo = 'img/logo_owner.' . $logo->getClientOriginalExtension();
        }

        if ($owner->sliders) {
            $sliders = json_decode($owner->sliders);

            for ($i=0; $i < count($sliders); $i++) {
                $nameSlider = 'slider_' . $i++;
                if ($request->hasfile($nameSlider)) {
                    //Borrar la imagen del servidor
                    if (File::exists($sliders[$i])) {
                        unlink($sliders[$i]);
                    }
                    $slider = $request->$nameSlider;

                    $slider->move(public_path("img"), $nameSlider . '.' . $slider->getClientOriginalExtension());

                    $sliders[] = $nameSlider . '.' . $slider->getClientOriginalExtension();
                } else {
                    if(isset($sliders[$i])){
                        $sliders[] = $sliders[$i];
                    }
                }
            }
        } else {
            for ($i = 1; $i <= 3; $i++) {
                if ($request->hasfile('slider_' . $i)) {
                    $nameSlider = 'slider_' . $i;
                    $slider = $request->$nameSlider;

                    $slider->move(public_path("img"), 'slider_' . $i . '.' . $slider->getClientOriginalExtension());

                    $sliders[] = 'img/slider_' . $i . '.' . $slider->getClientOriginalExtension();
                }
            }
        }

        $owner->email = $request->email;
        $owner->name = $request->name;
        $owner->phone = $request->phone;
        $owner->logo = 'img/logo_owner.png';
        $owner->sliders = json_encode($sliders);
        $owner->save();

        return back()->with('owner', $owner);
    }
}
