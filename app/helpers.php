<?php
function taka_format($number){
    $decimal = (string)($number - floor($number));
    $money = floor($number);
    $length = strlen($money);
    $delimiter = '';
    $money = strrev($money);

    for($i=0;$i<$length;$i++){
        if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
            $delimiter .=',';
        }
        $delimiter .=$money[$i];
    }

    $result = strrev($delimiter);
    $decimal = preg_replace("/0\./i", ".", $decimal);
    $decimal = substr($decimal, 0, 3);

    if( $decimal != '0'){
        $result = $result.$decimal;
    }

    return $result;
}

function has_permission($role_id,$permission_url){
//    dd($role_id,$permission_url);
    $user_permission = \App\Models\RolePermission::where('role_id',$role_id)->where('permission_url','LIKE','%'.$permission_url.'%')->get();
//dd($user_permission);
    if($user_permission->isEmpty()){
        return false;
    }else{
        return true;
    }
}



?>
