<?php
function checkItemFav($user_id, $item_id)
{
    $check = \App\Models\FavouriteItem::whereUserId($user_id)->whereItemId($item_id)->first();
    if ($check) {
        return true;
    } else {
        return false;
    }
}


if (!function_exists('checkSubItems')){
    function checkSubItems($id)
    {
        $check = \App\Models\SubItems::where('item_id',$id)->first();
        if ($check){
            return true;
        }
        return false;
    }
}
