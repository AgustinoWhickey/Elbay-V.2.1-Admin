<?php

function api_data_post($url, $params){

    $data_string = json_encode($params);

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
    );

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); 

    $result = curl_exec($curl);

    curl_close($curl);

    echo $result;
 }

 function api_data_put($url, $params){

   $data_string = json_encode($params);

   $curl = curl_init($url);

   curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
   'Content-Type: application/json',
   'Content-Length: ' . strlen($data_string))
   );

   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
   curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); 

   $result = curl_exec($curl);

   curl_close($curl);

   echo $result;
}

 function api_data_deletes($url){
 
   $curl = curl_init();
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
   curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   $response = curl_exec($curl);
   curl_close($curl);
   echo $response; 
   }

 function api_data_delete($url, $params){

   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
   curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/x-www-form-urlencoded'
   ));

   $response = curl_exec($ch);

   curl_close($ch);
}

 function api_data_get($url){

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_USERAGENT => 'Elbay API Request'
    ));

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
 }

 function indo_currency($nominal)
 {
	$result = "Rp. ".number_format($nominal, 0, ',', '.');
	return $result;
 }

 function item_stocks($items){
   $result = array();
   foreach($items as $stock) {
      $id = $stock->item_id;
      if($stock->type=='in') {
            $result[$id][] = (int)$stock->qty;
      } else {
            $result[$id][] = -(int)$stock->qty;
      }
   }

   $newresult = [];
   foreach($result as $key => $value) {
      $newresult[] = array('item_id' => $key, 'stock' => array_sum($value));
   }

   return $newresult;
 }

 function product_stock($id) {
   $itemByProductId = array();
   $itemByItemId = array();
   $itemStocks = array();
   $getMenuItem = json_decode(api_data_get($_ENV['API_URL'].'/itemmenu?email='.Session::get('data')['email'].'&iditem='.$id.'&X-API-KEY=restapi123'));
   if($getMenuItem->data->item_by_itemid) {
      $itemByItemId = $getMenuItem->data->item_by_itemid;
      $itemStocks = $getMenuItem->data->stocks;
   }

   $newresult = item_stocks($itemStocks);
   
   $stockresult = array();
   foreach($itemByItemId as $val){
   $getMenu = json_decode(api_data_get($_ENV['API_URL'].'/itemmenu?email='.Session::get('data')['email'].'&id='.$val->product_id.'&X-API-KEY=restapi123'));
      if($getMenu->data->item_menus) {
            $itemByProductId = $getMenu->data->item_menus;
      }
      $stockbahan = array();

      foreach($itemByProductId as $item) {
            $qtystock = 0;
            foreach($newresult as $index => $value) {
               if($item->item_id == $value['item_id']){
                  $qtystock = $value['stock'];
                  array_push($stockbahan, intval($qtystock/(int)$item->qty));
               }
            }

            array_push($stockresult, min($stockbahan));
         
      }
      $data = [
            'id' => (int)$item->product_id,
            'stock' => min($stockresult),
            'type' => 'update_stock',
            'X-API-KEY' => 'restapi123'
      ];

      api_data_put($_ENV['API_URL']."/menuitem", $data);

   }

 }

 function product_stock_by_sale($id) {
   $saleresult = array();
   $getSaleDetail = json_decode(api_data_get($_ENV['API_URL'].'/saledetail?email='.Session::get('data')['email'].'&id='.$id.'&X-API-KEY=restapi123'));
   if($getSaleDetail->data->saledetail) {
      $saleresult = $getSaleDetail->data->saledetail;
   }
   
   foreach($saleresult as $sale) {
      $itemByProductId = array();
      $itemStocks = array();
         $getMenu = json_decode(api_data_get($_ENV['API_URL'].'/itemmenu?email='.Session::get('data')['email'].'&id='.$sale->item_id.'&X-API-KEY=restapi123'));
         if($getMenu->data->item_menus) {
               $itemByProductId = $getMenu->data->item_menus;
         }

         if(count($itemByProductId) > 0){
            foreach($itemByProductId as $item){
               $data = [
                  'item_id' => $item->item_id,
                  'type' => 'out',
                  'detail' => 'Pembelian Produk '.$sale->name,
                  'supplier_id' => '',
                  'qty' => $item->qty,
                  'user_id' => Session::get('data')['user_id'],
                  'date' => strtotime('now'),
                  'X-API-KEY' => 'restapi123'
            ];
            product_stock($item->item_id);
            api_data_post($_ENV['API_URL']."/stock", $data);
            }
         } else {
            $data = [
               'id' => $sale->item_id,
               'type' => 'stockout',
               'stock' => $sale->qty,
               'X-API-KEY' => 'restapi123'
         ];
            api_data_put($_ENV['API_URL']."/menuitem", $data);
         }
      }
}