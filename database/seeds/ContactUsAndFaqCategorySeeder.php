<?php

use Illuminate\Database\Seeder;
use App\Models\FaqCategory;
use App\Models\ContactUsCategory;

class ContactUsAndFaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //faq categories
        $faq_category = FaqCategory::where('category', 'Resumes & Cover Letters')->first();
        if(!$faq_category) {
            $faq_category = new FaqCategory();
            $faq_category->category = 'Resumes & Cover Letters';
            $faq_category->save();
        }

        $faq_category = FaqCategory::where('category', 'Billing & Accounts')->first();
        if(!$faq_category) {
            $faq_category = new FaqCategory();
            $faq_category->category = 'Billing & Accounts';
            $faq_category->save();
        }

        $faq_category = FaqCategory::where('category', 'Pricing')->first();
        if(!$faq_category) {
            $faq_category = new FaqCategory();
            $faq_category->category = 'Pricing';
            $faq_category->save();
        }

        //contact us categories
        $cont_category = ContactUsCategory::where('category', 'Resumes & Cover Letters')->first();
        if(!$cont_category) {
            $cont_category = new ContactUsCategory();
            $cont_category->category = 'Resumes & Cover Letters';
            $cont_category->save();
        }

        $cont_category = ContactUsCategory::where('category', 'Billing & Accounts')->first();
        if(!$cont_category) {
            $cont_category = new ContactUsCategory();
            $cont_category->category = 'Billing & Accounts';
            $cont_category->save();
        }

        $cont_category = ContactUsCategory::where('category', 'Pricing')->first();
        if(!$cont_category) {
            $cont_category = new ContactUsCategory();
            $cont_category->category = 'Pricing';
            $cont_category->save();
        }
    }
}
