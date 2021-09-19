<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';
// 購入履歴
function get_history($db,$user_id){
    $sql = "
     SELECT
       order_histories.order_id,
       SUM(order_details.price * order_details.amount) AS total
     FROM
        order_histories
     JOIN
        order_details
     ON
        order_histories.order_id  = order_details.order_id
     WHERE 
         user_id = ?

    ";

    return fetch_all_query($db, $sql, array($user_id));
}

// ユーザ毎の購入明細
function get_detail($db, $order_id){
   $sql = "
      SELECT 
         order_details.price,
         order_details.amount,
         order_details.item_id,
      FROM
         order_details
      JOIN
         order_details.item_id
      ON
         order_details.item_id = order_items.item_id   
      WHERE
         order_id = ?    
         



   ";
   return fetch_all_query($db, $sql, array($order_id));
}

