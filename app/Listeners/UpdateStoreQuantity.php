<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ImportExportDetailCreated;
use Illuminate\Support\Facades\DB;

class UpdateStoreQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ImportExportDetailCreated $event)
    {
        $importExportDetail = $event->importExportDetail; //lấy ra thông tin của import detail
        return $importExportDetail;
        // foreach($importExportDetail as $item)
        // $productId = $importExportDetail->product_id;
        // $productSize = $importExportDetail->size;
        // $quantity = $importExportDetail->quantity;

        // // Giảm số lượng sản phẩm trong bảng store
        // DB::table('product_size_stores')
        //     ->where('product_id', $productId)
        //     ->where('size_name', $productSize)
        //     ->decrement('quantity', $quantity);
    }
}