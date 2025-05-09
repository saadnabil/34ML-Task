<?php

// app/Helpers/Helper.php
function projectTypes() {
    return ['Residential Area', 'Commercial Area'];
}

function resource_collection($resource): array
{
    return json_decode($resource->response()->getContent(), true) ?? [];
}

function getCouponTypes(){
    return  ['fixed', 'percentage','firstOrder', 'FreeShipping'];
}




