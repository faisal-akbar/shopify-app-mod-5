<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use App\Models\Faq;
use Illuminate\Support\Facades\URL;

class ShopController extends Controller {
    public function getDetails(Request $request) {
        $shop = $request->user();
        $shop = $shop->api()->rest('GET','/admin/shop.json');
        $shopInfo = $shop['body']['shop'];
        return view('shop.info', compact('shopInfo'));
        
    }
    public function collectionIndex(Request $request): View
    {
        $collections = Collection::where('shop_id', auth()->user()->id)->get();
        return view('collection.index', compact('collections'));
    }


    public function collectionStore(Request $request): RedirectResponse
    {
        $collectionId = $request->collectionId;
        if ($collectionId != 0) {
            $collection = Collection::find($collectionId);
        } else {
            $collection = new Collection();
        }

        $collection->name = $request->name;
        $collection->description = $request->description;
        $collection->shop_id = auth()->user()->id;

        $collection->save();

        return Redirect::away(URL::shopifyRoute('collection.index'));

    }

    function products(Request $request, $collectionId)
    {
        //get products for a collection
        //check if this collection id belongs to shop id
        $collection = Collection::findOrFail($collectionId);
        $shop = $request->user();
        if ($collection->shop_id != $request->user()->id) {
            return Redirect::tokenRedirect('collection.index');
        }

        if ($request->isMethod('post')) {
            $productId = $request->productId;
            if ($productId != 0) {
                $product = Product::find($productId);
            } else {
                $product = new Product();
            }

            $product->name = $request->name;
            $product->description = $request->description;
            $product->collection_id = $collection->id;
            $product->shop_id = $shop->id;

            $product->save();

            $redirectUrl = getRedirectRoute('collection.products', ['collectionId' => $collection->id]);
            return redirect($redirectUrl);

        }

        $products = Product::where('collection_id', $collection->id)->get();
        return view('collection.products', compact('products', 'collection'));
    }
}
