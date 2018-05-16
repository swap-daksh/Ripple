<?php
namespace YPC\Ripple\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use YPC\Ripple\Support\Faker\FileFactory;
use Illuminate\Support\Facades\DB;
use App\Models\ApprovedCarGallery;
use App\Models\ApprovedCar;
use App\Models\Body;
use App\Models\Maker;
use Auth;

class DealerGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carsGallery = ApprovedCarGallery::where('user_id', Auth::user()->id)->get();
        return view('Ripple::dealergallery.index', compact('carsGallery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cars = ApprovedCar::where('user_id', Auth::user()->id)->get();
        return view('Ripple::dealergallery.create', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gallery = $request->gallery;
        $gallery['user_id'] = Auth::user()->id;
        $gallery['media'] = $this->galleryImage('gallery_image');
        $id = ApprovedCarGallery::insertGetId($gallery);
        return redirect()->route('Ripple::dealergallery.edit', ['id'=>$id]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cars = ApprovedCar::where('user_id', Auth::user()->id)->get();
        $carsgallery = ApprovedCarGallery::where('id', $id)->where('user_id', Auth::user()->id)->first();
        
        return view('Ripple::dealergallery.edit', compact('cars', 'carsgallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gallery = $request->gallery;
        $gallery['user_id'] = Auth::user()->id;
        if ($galleryImage = $this->galleryImage('gallery_image', true)) {
            $gallery['media'] = $galleryImage;
        }
        if (ApprovedCarGallery::where('id', $id)->update($gallery)) {
                return redirect()->route('Ripple::dealergallery.edit', ['id'=>$id]);
        }
        return redirect()->route('Ripple::dealergallery.edit', ['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (ApprovedCarGallery::where('id', $id)->delete()) {
            return redirect()->route('Ripple::dealergallery.index');
        }
    }


    private function galleryImage($file, $update = false)
    {
       
        if (request()->hasFile($file)) {
            return storeFileAs($file, 'dealer-'.str_slug(request('gallery')['car']).md5(strtotime(date('Y-m-d'))));
        }
        if ($update) {
            return false;
        }
        return Storage::putFile(
            'public',
            (new FileFactory())
            ->image('dealer-'.str_slug(request('gallery')['car']).md5(strtotime(date('Y-m-d'))).'.png', 1000, 1000)
        );
    }
}
