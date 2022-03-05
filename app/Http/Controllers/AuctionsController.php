<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\auction\StoreAuction;
use App\Http\Requests\admin\auction\UpdateAuction;
use App\Models\Artist;
use App\Models\Auction;
use App\Models\Gallery;
use Illuminate\Http\Request;

class AuctionsController extends Controller
{
    public function index($artist_id)
    {
        $artist = Artist::find($artist_id);
        $auctions = Auction::query()->where('artist_id', $artist_id)->orderBy('created_at',"desc")->get();
        return view('admin.auction.index',compact('auctions', 'artist', 'artist_id'));
    }
    public function create($artist_id)
    {
        return view('admin.auction.create',compact('artist_id'));
    }
    public function store(StoreAuction $request , $artist_id)
    {
        $auction = Auction::query()->create([
            'artist_id'=>$artist_id,
            'asset_name'=>$request->asset_name,
            'auction_name'=>$request->auction_name,
            'creation_date'=>$request->creation_date,
            'auction_date'=>$request->auction_date,
            'sold_price'=>$request->sold_price,
            'size'=>$request->size,
            'material'=>$request->material
        ]);

        return redirect()->route('upload.page',['type'=>Auction::class,'id'=>$auction->id]);
    }
    public function show($auction_id)
    {
        $auction=Auction::with('media')->find($auction_id);

        return view('admin.auction.show',compact('auction'));
    }
    public function edit($auction_id)
    {
        $auctions = Auction::find($auction_id);
        return view('admin.auction.edit', compact('auctions'));
    }

    public function update( UpdateAuction  $request, $auction_id)
    {
        $auctions = Auction::find($auction_id);
        $auctions->asset_name = $request->asset_name;
        $auctions->auction_name= $request->auction_name;
        $auctions->creation_date= $request->creation_date;
        $auctions->auction_date= $request->auction_date;
        $auctions->sold_price= $request->sold_price;
        $auctions->size= $request->size;
        $auctions->material= $request->material;
        $auctions->save();
        return redirect()->route('auctions.index',$auctions->artist_id);
    }
    public function destroy($auction_id)
    {
        $auctions = Auction::find($auction_id);
        $auctions->delete();
        \request()->session()->flash('message', 'deleted successfully');
        return redirect()->back();

    }
}
