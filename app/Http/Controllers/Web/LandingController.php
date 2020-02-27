<?php

namespace App\Http\Controllers\Web;

use App\Models\Header;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
class LandingController extends Controller
{
    public function index(){
        $top_header = Header::where(['type'=>0])->where(['lang'=>App::getLocale()])->first();
        $top_sliders = App\Models\Slider::where(['type'=>0])->get();
        return view('web.index', compact('top_header', 'top_sliders'));
    }
}
