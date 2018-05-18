<?php
namespace YPC\Ripple\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use YPC\Ripple\Support\Faker\FileFactory;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductVarient;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->get();
        return view('Ripple::order.index', compact('orders'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $order = Order::where('id', $id)->first();
        return view('Ripple::order.edit', compact('order'));
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
        $order = $request->order;

        Order::where('id', $id)->update($order);
        
        return redirect()->route('Ripple::order.edit', ['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Order::where('id', $id)->delete()) {
            return redirect()->route('Ripple::order.index');
        }
    }


    private function orderImage($file, $update = false)
    {
       
        if (request()->hasFile($file)) {
            return storeFileAs($file, 'order-'.str_slug(request('order')['name']).md5(strtotime(date('Y-m-d'))));
        }
        if ($update) {
            return false;
        }
        return Storage::putFile(
            'public',
            (new FileFactory())
            ->image('order-'.str_slug(request('order')['name']).md5(strtotime(date('Y-m-d'))).'.png', 1000, 1000)
        );
    }
}
