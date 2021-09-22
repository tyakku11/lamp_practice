<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';
// 購入履歴
function get_histories($db,$user_id){
    $sql = "
     SELECT
       *
     FROM
        order_histories
     WHERE 
         user_id = ?

    ";

    return fetch_all_query($db, $sql, array($user_id));
}

function get_all_history($db,$order_id){
   $sql = "
    SELECT
      *
    FROM
       order_histories
    WHERE
      order_id = ?   
   ";

   return fetch_query($db, $sql,[$order_id]);
}

function get_history($db,$user_id,$order_id){
   $sql = "
    SELECT
      *
    FROM
       order_histories
    WHERE 
        user_id = ?
    AND 
        order_id = ?    
   ";

   return fetch_query($db, $sql, array($user_id,$order_id));
}

function get_all_histories($db){
  $sql = "
   SELECT
     *
   FROM
      order_histories
  ";

  return fetch_all_query($db, $sql);
}

// ユーザ毎の購入明細
function get_details($db, $order_id){
   $sql = "
      SELECT 
         order_details.price,
         order_details.amount,
         name,
         order_details.amount * order_details.price AS subtotal
      FROM
         order_details
      JOIN
         items
      ON
         order_details.item_id = items.item_id   
      WHERE
         order_id = ?    
   ";
   return fetch_all_query($db, $sql, array($order_id));
}

function get_user_details($db, $order_id,$user_id){
   $sql = "
      SELECT 
         order_details.price,
         order_details.amount,
         name,
         order_details.amount * order_details.price AS subtotal
      FROM
         order_details
      JOIN
         items
      ON
         order_details.item_id = items.item_id   
      JOIN
         order_histories
      ON
         order_histories.order_id = order_details.order_id   
      WHERE
         order_details.order_id = ? 
      AND 
         user_id = ?      
   ";
   return fetch_all_query($db, $sql, array($order_id,$user_id));
}
