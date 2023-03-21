<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGetway;
use App\Orders\OrderDetails;
use Google\Client;
use Google\Service\Books;
use Google\Service\ShoppingContent\Price;
use Google\Service\ShoppingContent\Product;
use Google\Service\ShoppingContent\ProductShipping;
use Google\Service\ShoppingContent\ProductShippingWeight;
use Google\Service\ShoppingContent\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class PayOrderController extends Controller
{
    public function getProducts()
    {
        $client = new Client();
        $client->setAuthConfig('/home/mohamed/Downloads/content-api-key.json');
        // $client->addScope(Google\Service\Drive::DRIVE);
        $client->setApplicationName("Awesome Testing");
        // $client->setDeveloperKey("YOUR_APP_KEY");

        $service = new Books($client);
        $query = 'Harry';
        // $optParams = [
        //     'filter' => 'free-ebooks',
        // ];

        $results = $service->volumes->listVolumes($query);
        // echo "<a href='http://localhost:8000/set-products'>Set Product</a>";
        foreach ($results->getItems() as $item) {
            dump($item);
        }
    }

    public function setProduct(Request $request){
        // $service = new Service();
        // $tokenEnpoint = 'https://books.googleapis.com/books/v1/cloudloading/addBook';
        // $clientId = '569526797176-8g6ui3usphvi4big2fks4a13819i1ql3.apps.googleusercontent.com';
        // $token = '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';
        // $client = new Client();
        // $client->setAuthConfig('/home/mohamed/Downloads/content-api-key.json');
        // $response = Http::acceptJson()->asForm()->post($tokenEnpoint, [
        //     $client
        // ]);
        // dd($response->body());
        $merchant_id = '115058746071629025879';
        $client = new Client();
        $client->setAuthConfig('/home/mohamed/Downloads/content-api-key.json');
        $service = new Books($client);
        $product = new Product();
        
        
        $product->setOfferId('book123');
        $product->setTitle('MeMo memo memo');
        $product->setDescription('fake book');
        $product->setLink('http://localhost:8000:mybook-link');
        $product->setImageLink('http://localhost:8000/memo.jpg');
        $product->setContentLanguage('en');
        $product->setTargetCountry('GB');
        $product->setChannel('online');
        $product->setAvailability('in stock');
        $product->setCondition('new');
        $product->setGoogleProductCategory('Media > Books');
        $product->setGtin('9780007350896');

        $price = new Price();
        $price->setValue('2.50');
        $price->setCurrency('GBP');

        $shipping_price = new Price();
        $shipping_price->setValue('0.99');
        $shipping_price->setCurrency('GBP');

        $shipping = new ProductShipping();
        $shipping->setPrice($shipping_price);
        $shipping->setCountry('GB');
        $shipping->setService('Standard shipping');

        $shipping_weight = new ProductShippingWeight();
        $shipping_weight->setValue(200);
        $shipping_weight->setUnit('grams');

        $product->setPrice($price);
        $product->setShipping(array($shipping));
        $product->setShippingWeight($shipping_weight);
        dd($service);

        // $parameters = [
        //     'drive_document_id' => 'test',
        //     'mime_type' =>'pdf',
        //     'name' => 'memo',
        //     'upload_client_token' => 'token'
        // ];
        // dd($service->cloudloading);
        $result = $service->cloudloading->addBook($product);
        dd($result);
    }
}
