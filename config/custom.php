<?php

return [
   'shopify_api_key' => env('SHOPIFY_API_KEY','ad0e7d8d732da0e5806253159f974fda'),
   'shopify_api_secret' => env('SHOPIFY_SECRET_KEY','e25d38446651e7b8807b282fe53d47ab'),
   'shopify_api_version' => env('SHOPIFY_API_VERSION','2024-04'),
   'api_scopes' => 'write_customers,read_customers,read_all_orders,read_locations,write_locations,read_products,write_products'
];