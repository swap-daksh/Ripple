<?php
namespace YPC\Ripple\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use YPC\Ripple\Support\Faker\FileFactory;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('Ripple::product.index', compact('products'));
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
        $product['image'] = $this->productImage('product_image');
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
        $product = Product::where('id', $id)->first();
        return view('Ripple::product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        
        return view('Ripple::product.edit', compact('product'));
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
        $product = $request->product;
        if ($productImage = $this->productImage('product_image', true)) {
            $product['image'] = $productImage;
        }
        if (Product::where('id', $id)->update($product)) {
                return redirect()->route('Ripple::products.show', ['id'=>$id]);
        }
        return redirect()->route('Ripple::products.edit', ['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Product::where('id', $id)->delete()) {
            return redirect()->route('Ripple::products.index');
        }
    }


    private function productImage($file, $update = false)
    {
        if (request()->hasFile($file)) {
            return storeFileAs($file, 'product-'.str_slug(request('product')['title']).md5(strtotime(date('Y-m-d'))));
        }
        if ($update) {
            return false;
        }
        return Storage::putFile(
            'public',
            (new FileFactory())
            ->image('product-'.str_slug(request('product')['title']).md5(strtotime(date('Y-m-d'))).'.png', 1000, 1000)
        );
    }
}
