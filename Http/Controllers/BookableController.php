<?php

namespace Modules\Bookable\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Vanilo\Cart\Facades\Cart;
use Modules\Core\Http\Controllers\Controller;
use Modules\Bookable\Models\BookableProxy;
use Modules\Bookable\Models\Bookable as BookableModel;
use Modules\Bookable\Contracts\Bookable;

class BookableController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index() {
        $bookables = BookableProxy::all();
        return view('bookable::index', compact('bookables'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(string $slug) {
        if (!$bookable = BookableProxy::findBySlug($slug)) {
            abort(404);
        }
        return view('bookable::show', [
            'bookable' => $bookable
        ]);
    }

    public function addCartItem(Bookable $bookable) {
        Cart::addItem($bookable, 1, ['attributes' => [
                'product_type' => 'Modules\Bookable\Models\Bookable'
        ]]);
        flash()->success($bookable->name . ' has been added to cart');

        return redirect()->route('cart.show');
    }

}
