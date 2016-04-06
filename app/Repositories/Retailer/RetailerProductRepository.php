<?php

namespace Sibas\Repositories\Retailer;

use Sibas\Entities\RetailerProduct;
use Sibas\Entities\RetailerProductCoverage;
use Sibas\Entities\RetailerProductPaymentMethod;
use Sibas\Repositories\BaseRepository;

class RetailerProductRepository extends BaseRepository
{

    /**
     * Find Questions for Product Retailer
     *
     * @param $rp_id
     *
     * @return array
     */
    public function getQuestionByProduct($rp_id)
    {
        $this->model = RetailerProduct::with([
            'productQuestions' => function ($q) {
                $q->where('active', true);
                $q->orderBy('order', 'asc');
            }
        ])->where('id', $rp_id)->get();

        $questions = [ ];

        foreach ($this->model as $retailer) {
            foreach ($retailer->productQuestions as $productQuestion) {
                $check_yes = $productQuestion->response ? true : false;
                $check_no  = ! $productQuestion->response ? true : false;

                $questions[] = [
                    'id'        => $productQuestion->question->id,
                    'order'     => $productQuestion->order,
                    'question'  => $productQuestion->question->question,
                    'response'  => $productQuestion->response,
                    'expected'  => (int) $productQuestion->response,
                    'check_yes' => $check_yes,
                    'check_no'  => $check_no
                ];
            }
        }

        return $questions;
    }


    public function getRetailerProductById($rp_id)
    {
        $this->model = RetailerProduct::with([
            'companyProduct.product',
            'rates.increments.category',
            'parameters',
            'subProducts.productCompany',
            'subProducts.companyProduct.product',
            'coverages'
        ])->where('id', $rp_id)->get();

        if ($this->model->count() === 1) {
            $this->model = $this->model->first();

            return true;
        }

        return false;
    }


    public function getCoverageByProduct($rp_id)
    {
        $selectOption     = $this->getSelectOption();
        $productCoverages = RetailerProductCoverage::with('coverage')->where('ad_retailer_product_id', $rp_id)->get();
        $coverages        = [ ];

        foreach ($productCoverages as $productCoverage) {
            $coverages[] = [
                'id'            => $productCoverage->coverage->id,
                'name'          => $productCoverage->coverage->name,
                'data_coverage' => $productCoverage->coverage->slug,
            ];
        }

        $coverages = $selectOption->merge($coverages);

        return $coverages;
    }


    public function getPaymentMethodsByProductById($rp_id)
    {
        $selectOption          = $this->getSelectOption();
        $productPaymentMethods = RetailerProductPaymentMethod::where('ad_retailer_product_id', $rp_id)->get();
        $paymentMethods        = [ ];

        foreach ($productPaymentMethods as $productPaymentMethod) {
            $paymentMethods[] = [
                'id'                  => $productPaymentMethod->payment_method,
                'name'                => config('base.payment_methods.' . $productPaymentMethod->payment_method),
                'data_payment_method' => $productPaymentMethod->payment_method,
            ];
        }

        $paymentMethods = $selectOption->merge($paymentMethods);

        return $paymentMethods;
    }
}