<?php
namespace YPC\Ripple\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use YPC\Ripple\Support\Faker\FileFactory;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('Ripple::product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(url(Storage::url(Storage::putFile('public', (new FileFactory())->image('test.png', 1000, 1000)))));
        //dd((new FileFactory())->image('test.jpg', 100, 200)->store());
        //dd(Storage::putFile('public', (new FileFactory())->image('test.jpg', 1000, 1000)));
        return view('Ripple::product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $request->product;
        $product['image'] = Storage::putFile('public', (new FileFactory())->image('test.png', 1000, 1000));
        $id = DB::table('products')->insertGetId($product);
        return redirect()->route('Ripple::products.show', ['id'=>$id]);
    }

    /**
     * Display the specified resource.'
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Ripple::product.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
