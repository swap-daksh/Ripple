<?php
namespace YPC\Ripple\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use YPC\Ripple\Support\Faker\FileFactory;
use Illuminate\Support\Facades\DB;
use App\Models\ApprovedCar;
use App\Models\Body;
use App\Models\Maker;
use Auth;

class DealerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = ApprovedCar::where('user_id', Auth::user()->id)->get();
        return view('Ripple::dealer.index', compact('cars'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showApproved()
    {
        $cars = ApprovedCar::where('user_id', Auth::user()->id)->where('approved', '1')->get();
        return view('Ripple::dealer.index', compact('cars'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUnapproved()
    {
        $cars = ApprovedCar::where('user_id', Auth::user()->id)->where('approved', '0')->get();
        return view('Ripple::dealer.index', compact('cars'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSold()
    {
        $cars = ApprovedCar::where('user_id', Auth::user()->id)->where('sold', '1')->get();
        return view('Ripple::dealer.index', compact('cars'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bodies = Body::get();
        $makers = Maker::get();
        return view('Ripple::dealer.create', compact('makers', 'bodies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dealer = $request->dealer;
        $dealer['image'] = $this->dealerImage('dealer_image');
        dd($dealerImage);
        $id = ApprovedCar::insertGetId($dealer);
        return redirect()->route('Ripple::dealer.edit', ['id'=>$id]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bodies = Body::get();
        $makers = Maker::get();
        $car = ApprovedCar::where('id', $id)->where('user_id', Auth::user()->id)->first();
        
        return view('Ripple::dealer.edit', compact('car', 'makers', 'bodies'));
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
        $dealer = $request->dealer;
        if ($dealerImage = $this->dealerImage('dealer_image', true)) {
            $dealer['image'] = $dealerImage;
        }
        if (ApprovedCar::where('id', $id)->update($dealer)) {
                return redirect()->route('Ripple::dealer.edit', ['id'=>$id]);
        }
        return redirect()->route('Ripple::dealer.edit', ['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (ApprovedCar::where('id', $id)->delete()) {
            return redirect()->route('Ripple::dealer.index');
        }
    }


    private function dealerImage($file, $update = false)
    {
       
        if (request()->hasFile($file)) {
            return storeFileAs($file, 'dealer-'.str_slug(request('dealer')['name']).md5(strtotime(date('Y-m-d'))));
        }
        if ($update) {
            return false;
        }
        return Storage::putFile(
            'public',
            (new FileFactory())
            ->image('dealer-'.str_slug(request('dealer')['name']).md5(strtotime(date('Y-m-d'))).'.png', 1000, 1000)
        );
    }
}
