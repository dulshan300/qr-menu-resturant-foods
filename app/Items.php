<?php

namespace App;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Models\TranslateAwareModel;
use App\Models\Variants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Items extends TranslateAwareModel
{
    use SoftDeletes;
    public $translatable = ['name', 'description'];

    protected $table = 'items';
    protected $appends = ['logom', 'icon', 'short_description'];
    protected $fillable = ['name', 'description', 'image', 'price', 'category_id', 'vat','enable_system_variants'];
    protected $imagePath = '/uploads/restorants/';

    protected function getImge($imageValue, $default, $version = '_large.jpg')
    {
        if ($imageValue == '' || $imageValue == null) {
            //No image
            return $default;
        } else {
            if (strpos($imageValue, 'http') !== false) {
                //Have http
                if (strpos($imageValue, '.jpg') !== false || strpos($imageValue, '.jpeg') !== false || strpos($imageValue, '.png') !== false) {
                    //Has extension
                    return $imageValue;
                } else {
                    //No extension
                    return $imageValue.$version;
                }
            } else {
                //Local image
                return ($this->imagePath.$imageValue).$version;
            }
        }
    }

    public function substrwords($text, $chars, $end = '...')
    {
        if (strlen($text) > $chars && strpos($text, " ") !== false) {
            $text = $text.' ';
            $text = substr($text, 0, $chars);
            $text = substr($text, 0, strrpos($text, ' '));
            $text = $text.'...';
        }

        return $text;
    }

    public function getLogomAttribute()
    {
        return $this->getImge($this->image, config('global.restorant_details_image'));
    }

    public function getIconAttribute()
    {
        return $this->getImge($this->image, config('global.restorant_details_image'), '_thumbnail.jpg');
    }

    public function getItempriceAttribute()
    {
        return  Money($this->price, config('settings.cashier_currency'), config('settings.do_convertion'))->format();
    }

    public function getShortDescriptionAttribute()
    {
        return  $this->substrwords($this->description, config('settings.chars_in_menu_list'));
    }

    public function category()
    {
        return $this->belongsTo(\App\Categories::class);
    }

    public function extras()
    {
        return $this->hasMany(\App\Extras::class, 'item_id', 'id');
    }

    public function options()
    {
        return $this->hasMany(\App\Models\Options::class, 'item_id', 'id');
    }

    public function variants()
    {
        return $this->hasMany(\App\Models\Variants::class, 'item_id', 'id')->whereNull('deleted_at');;
    }

    public function allergens()
    {
        return $this->belongsToMany(\App\Models\Allergens::class,'item_has_allergens','item_id', 'allergen_id');
    }


    public function systemvariants()
    {
        return $this->hasMany(\App\Models\Variants::class, 'item_id', 'id')->where('variants.is_system',1)->whereNull('deleted_at');
    }

    public function uservariants()
    {
        return $this->hasMany(\App\Models\Variants::class, 'item_id', 'id')->where('variants.is_system',0)->whereNull('deleted_at');;
    }

    public function makeAllMissingVariants($itemPrice){
        //At this moment, all system variables, should be removed
        
        //The idea is to go over all the options to create the matrix
        $optionsMatrix=[];
        foreach ($this->options as $key => $option) {
            $optionsMatrix[$option->id]=explode(',', $option->options);
            foreach ($optionsMatrix[$option->id] as $key => &$value) {
                $value=["op_id"=>$option->id,"value"=>Str::slug($value, '-'),'data'=>[]];
            }
        }

        //Regular array
        $regular=[];
        foreach ($optionsMatrix as $key => $valuer) {
            array_push($regular,$valuer);
        }
        for ($i=sizeof($regular)-1; $i>0 ; $i--) { 
           foreach ($regular[$i-1] as $key => &$valueSE) {
                $valueSE['data']=$regular[$i];
           }
        }

        //Ok, now we have the matrix - 
       // print_r($regular);
        $strings=[];
        if(sizeof($regular)>0){
            foreach ($regular[0] as $key => $valueM) {
                $current=$this->converterKV($valueM);
                if(count($valueM['data'])==0){
                    array_push($strings,"{".$current."}");
                }else{
                    foreach ($valueM['data'] as $key => $valueL) {
                        $secondCurrent=$current.",".$this->converterKV($valueL);
                        if(count($valueL['data'])==0){
                            array_push($strings,"{".$secondCurrent."}");
                        }else{
                            foreach ($valueL['data'] as $key => $valueK) {
                                $thirdCurrent=$secondCurrent.",".$this->converterKV($valueK);
                                if(count($valueK['data'])==0){
                                    array_push($strings,"{".$thirdCurrent."}");
                                }else{
                                    foreach ($valueK['data'] as $key => $valueJ) {
                                        $forthCurrent=$secondCurrent.",".$this->converterKV($valueJ);
                                        if(count($valueJ['data'])==0){
                                            array_push($strings,"{".$forthCurrent."}");
                                        }else{
                                            foreach ($valueJ['data'] as $key => $valuH) {
                                                $fifthCurrent=$secondCurrent.",".$this->converterKV($valuH);
                                                if(count($valuH['data'])==0){
                                                    array_push($strings,"{".$fifthCurrent."}");
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        


        //Now for each variant, l
        foreach ($this->uservariants as $key => $variant) {
            if (($key = array_search($variant->options, $strings)) !== false) {
                unset($strings[$key]);
            }
        }

        //Add the missing varaints
        foreach ($strings as $key => $value) {
            $variant = Variants::create([
                'price'=>$itemPrice,
                'item_id'=>$this->id,
                'options'=>$value,
                'is_system'=>1,
            ]);
            $variant->save();
        }
    }

    private function converterKV($value){
        return "\"".$value['op_id']."\"".":"."\"".$value['value']."\"";
    }

   
    public static function boot()
    {
        parent::boot();
        self::deleting(function ($model) {
            if ($model->isForceDeleting()) {
               

                //Delete Options
                $model->options()->forceDelete();

                //Deletee Variants
                foreach ($model->variants()->get() as $key => $variant) {
                    $variant->extras()->detach();
                }
                $model->variants()->forceDelete();

                //Delete extras
                $model->extras()->forceDelete();
            }

            return true;
        });
    }
}
