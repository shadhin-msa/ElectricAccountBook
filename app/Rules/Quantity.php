<?php


namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class Quantity implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    
    public function passes($attribute, $value)
    {   Global $request;
        $products = $request->product_id;
        for($i =0;$i<count($products);$i++){
            $p = Product::find($products[$i]);
            if ($value[$i] > $p->calculateStock()){

                return false;
            }

        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */ 
    public function message()
    {
        return 'Insufficiant stock for a product ';
    }
}

?>