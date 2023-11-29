<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
class CatController extends Controller
{
    use GeneralTrait;
    public function index(){
$categories = Category::selection()->get();
return $this -> returnData('categories',$categories,'تم جلب البيانات بنجاح');
    }
    public function getCategoryById(Request $request)
    {

        $category = Category::selection()->find($request->id);
        if (!$category){
            return $this->returnError('001', 'هذا القسم غير موجود');
        }
        return $this->returnData('categroy', $category,'تم جلب البيانات بنجاح');
    }

    public function changeStatus(Request $request)
    {
      

        Category::where('id',$request -> id) -> update(['active' =>$request ->active]);

        return $this -> returnSuccessMessage('تم تغيير الحالة بنجاح');
       

    

    }
}
